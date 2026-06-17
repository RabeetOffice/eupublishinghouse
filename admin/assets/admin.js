/* ==========================================================================
   EU Publishing House — Admin shared UI + blog editor engine
   ========================================================================== */
(function () {
  'use strict';

  /* ---------- shared: sidebar nav (mobile) ---------- */
  var shell = document.getElementById('admShell');
  document.addEventListener('click', function (e) {
    if (e.target.closest('[data-nav-toggle]')) { shell && shell.classList.toggle('nav-open'); }
    if (e.target.closest('[data-nav-close]'))  { shell && shell.classList.remove('nav-open'); }
  });

  /* ---------- shared: toasts ---------- */
  window.admToast = function (msg, type) {
    var box = document.getElementById('admToasts');
    if (!box) { alert(msg); return; }
    var t = document.createElement('div');
    t.className = 'adm-toast ' + (type === 'err' ? 'err' : (type === 'ok' ? 'ok' : ''));
    t.innerHTML = '<i class="fa-solid fa-' + (type === 'err' ? 'circle-exclamation' : 'circle-check') + '"></i><span></span>';
    t.querySelector('span').textContent = msg;
    box.appendChild(t);
    setTimeout(function () { t.style.opacity = '0'; setTimeout(function () { t.remove(); }, 300); }, 3600);
  };

  /* ---------- shared: drag-to-reorder ---------- */
  window.AdmDrag = function (list, itemSel, handleSel) {
    var dragEl = null;
    list.addEventListener('dragstart', function (e) {
      var it = e.target.closest(itemSel); if (!it) return;
      dragEl = it; it.style.opacity = '.5';
    });
    list.addEventListener('dragend', function () { if (dragEl) dragEl.style.opacity = ''; dragEl = null; });
    list.addEventListener('dragover', function (e) {
      e.preventDefault();
      var after = getAfter(list, itemSel, e.clientY);
      if (!dragEl) return;
      if (after == null) list.appendChild(dragEl); else list.insertBefore(dragEl, after);
    });
    function getAfter(container, sel, y) {
      var els = [].slice.call(container.querySelectorAll(sel + ':not([style*="opacity"])'));
      return els.reduce(function (closest, child) {
        var box = child.getBoundingClientRect();
        var offset = y - box.top - box.height / 2;
        if (offset < 0 && offset > closest.offset) return { offset: offset, element: child };
        return closest;
      }, { offset: -Infinity }).element || null;
    }
  };

  /* ======================================================================
     EDITOR ENGINE
     ====================================================================== */
  var rte, source, sourceMode = false, dirty = false, selectedImg = null;

  function $(id) { return document.getElementById(id); }
  function csrf() { return window.ADM_CSRF || ''; }
  function assetBase() { return window.ADM_ASSET_BASE || '/assets/'; }

  var AdmEditor = {
    init: function () {
      rte = $('rte'); source = $('rteSource');
      if (!rte) return;

      resolveImages();
      this.wireToolbar();
      this.wireSource();
      this.wireImages();
      this.wireFeatured();
      this.wireLinkTable();
      this.wireFaq();
      this.wireSeo();
      this.wireAuthor();
      this.wireButtons();
      this.wirePaste();
      this.wireImageSelect();

      rte.addEventListener('input', function () { dirty = true; AdmEditor.refresh(); });
      this.refresh();
      // autosave (45s) — never flips the source view (gotcha #6)
      setInterval(function () { if (dirty && $('f_title').value.trim()) AdmEditor.save(true); }, 45000);
      // Ctrl+S
      document.addEventListener('keydown', function (e) {
        if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 's') { e.preventDefault(); AdmEditor.save(false); }
      });
      window.addEventListener('beforeunload', function (e) { if (dirty) { e.preventDefault(); e.returnValue = ''; } });
    },

    /* ---- toolbar ---- */
    wireToolbar: function () {
      var tb = $('rteToolbar');
      tb.addEventListener('click', function (e) {
        var b = e.target.closest('.adm-tool[data-cmd]'); if (!b) return;
        e.preventDefault();
        rte.focus();
        var cmd = b.getAttribute('data-cmd'), val = b.getAttribute('data-val') || null;
        if (cmd === 'formatBlock' && val) document.execCommand('formatBlock', false, val);
        else document.execCommand(cmd, false, val);
        dirty = true; AdmEditor.refresh();
      });
    },

    /* ---- HTML source view (read whichever view is active; gotcha #6) ---- */
    wireSource: function () {
      var btn = $('btnSource');
      btn.addEventListener('click', function () {
        sourceMode = !sourceMode;
        if (sourceMode) { source.value = AdmEditor.bodyForSave(); source.style.display = ''; rte.style.display = 'none'; btn.classList.add('is-active'); }
        else { rte.innerHTML = source.value; source.style.display = 'none'; rte.style.display = ''; btn.classList.remove('is-active'); resolveImages(); }
        dirty = true; AdmEditor.refresh();
      });
      // Editing raw HTML must also mark the post dirty (so autosave + unload-guard fire).
      source.addEventListener('input', function () { dirty = true; });
    },
    currentBody: function () { return sourceMode ? source.value : AdmEditor.bodyForSave(); },

    /* ---- inline + featured images ---- */
    wireImages: function () {
      var self = this, fileInput = $('imgFile');
      $('btnImage').addEventListener('click', function () { rte.focus(); self._savedRange = saveRange(); fileInput.click(); });
      fileInput.addEventListener('change', function () {
        if (!fileInput.files[0]) return;
        upload(fileInput.files[0], 'inline-image').then(function (r) {
          if (!r.ok) { admToast(r.error || 'Upload failed', 'err'); return; }
          restoreRange(self._savedRange);
          var alt = prompt('Image alt text (for SEO & accessibility):', '') || '';
          var img = '<img src="' + r.url + '" data-arg="' + r.asset + '" data-asset="1" alt="' + escAttr(alt) + '" loading="lazy">';
          document.execCommand('insertHTML', false, img);
          dirty = true; self.refresh();
        });
        fileInput.value = '';
      });
    },
    wireFeatured: function () {
      var drop = $('featuredDrop'), input = $('featuredFile');
      if (!drop) return;
      drop.addEventListener('click', function (e) { if (!e.target.closest('img')) input.click(); });
      ['dragover', 'dragenter'].forEach(function (ev) { drop.addEventListener(ev, function (e) { e.preventDefault(); drop.classList.add('is-drag'); }); });
      ['dragleave', 'drop'].forEach(function (ev) { drop.addEventListener(ev, function (e) { e.preventDefault(); drop.classList.remove('is-drag'); }); });
      drop.addEventListener('drop', function (e) { if (e.dataTransfer.files[0]) handleFeatured(e.dataTransfer.files[0]); });
      input.addEventListener('change', function () { if (input.files[0]) handleFeatured(input.files[0]); });
      function handleFeatured(file) {
        upload(file, $('f_title').value || 'featured').then(function (r) {
          if (!r.ok) { admToast(r.error || 'Upload failed', 'err'); return; }
          $('f_image').value = r.asset;
          $('featuredImg').src = r.url;
          $('featuredPreview').hidden = false;
          dirty = true; AdmEditor.refresh();
          admToast('Featured image uploaded', 'ok');
        });
      }
    },

    /* ---- link picker + table ---- */
    wireLinkTable: function () {
      var self = this;
      $('btnLink').addEventListener('click', function () { rte.focus(); self._savedRange = saveRange(); openLinkModal(); });
      $('btnTable').addEventListener('click', function () {
        rte.focus();
        var cols = parseInt(prompt('Columns?', '3'), 10), rows = parseInt(prompt('Rows (incl. header)?', '3'), 10);
        if (!cols || !rows) return;
        var html = '<table class="table"><thead><tr>';
        for (var c = 0; c < cols; c++) html += '<th>Heading</th>';
        html += '</tr></thead><tbody>';
        for (var r = 1; r < rows; r++) { html += '<tr>'; for (var c2 = 0; c2 < cols; c2++) html += '<td>Cell</td>'; html += '</tr>'; }
        html += '</tbody></table><p><br></p>';
        document.execCommand('insertHTML', false, html);
        dirty = true; self.refresh();
      });
    },

    /* ---- FAQ builder ---- */
    wireFaq: function () {
      var list = $('faqList');
      (window.ADM_POST.faqs || []).forEach(function (f) { list.appendChild(faqRow(f.q, f.a)); });
      $('btnAddFaq').addEventListener('click', function () { list.appendChild(faqRow('', '')); dirty = true; });
      list.addEventListener('click', function (e) {
        var rm = e.target.closest('.faq-rm'); if (rm) { rm.closest('.adm-repeat-item').remove(); dirty = true; }
      });
      list.addEventListener('input', function () { dirty = true; });
      if (window.AdmDrag) AdmDrag(list, '.adm-repeat-item', '.adm-handle');
    },
    collectFaqs: function () {
      var out = [];
      $('faqList').querySelectorAll('.adm-repeat-item').forEach(function (it) {
        var q = it.querySelector('.faq-q').value.trim(), a = it.querySelector('.faq-a').value.trim();
        if (q) out.push({ q: q, a: a });
      });
      return out;
    },

    /* ---- SEO counters + score + read time ---- */
    wireSeo: function () {
      ['f_title', 'f_excerpt', 'f_page_title', 'f_page_description', 'f_page_keywords', 'f_read_auto', 'f_read'].forEach(function (id) {
        var el = $(id); if (el) { el.addEventListener('input', function () { dirty = true; AdmEditor.refresh(); }); el.addEventListener('change', function () { AdmEditor.refresh(); }); }
      });
      // auto-slug from title for new posts
      var slug = $('f_slug');
      if (slug && !slug.readOnly && slug.value === '') {
        $('f_title').addEventListener('input', function () {
          slug.value = slugify($('f_title').value);
        });
      }
      $('f_read_auto').addEventListener('change', function () { $('f_read').readOnly = this.checked; AdmEditor.refresh(); });
    },

    /* ---- author: show the bio that will be auto-applied for the chosen author ---- */
    wireAuthor: function () {
      var inp = $('f_author'), out = $('authorBio');
      if (!inp || !out) return;
      function render() {
        var name = inp.value.trim();
        var bios = window.ADM_AUTHORS || {};
        if (name && bios[name]) {
          out.textContent = 'Bio on file: ' + bios[name];
          out.style.color = 'var(--adm-muted)';
        } else if (name) {
          out.innerHTML = 'No saved bio for “' + escAttr(name) + '” — the fallback bio will be used. Add one under <a href="authors.php" target="_blank">Authors</a>.';
          out.style.color = 'var(--adm-amber)';
        } else {
          out.textContent = '';
        }
      }
      inp.addEventListener('input', render);
      inp.addEventListener('change', render);
      render();
    },
    refresh: function () {
      counter('cnt_title', $('f_page_title').value.length || $('f_title').value.length, 60);
      counter('cnt_desc', $('f_page_description').value.length || $('f_excerpt').value.length, 160);
      counter('cnt_excerpt', $('f_excerpt').value.length, 160);
      // read time
      var words = wordCount(rteText());
      var mins = Math.max(3, Math.ceil(words / 210));
      $('readout').textContent = words + ' words · ' + mins + ' min read';
      if ($('f_read_auto').checked) $('f_read').value = mins + ' min read';
      this.score();
    },
    score: function () {
      var checks = [
        { ok: (($('f_page_title').value || $('f_title').value).length) >= 20 && (($('f_page_title').value || $('f_title').value).length) <= 60, label: 'Title tag 20–60 chars' },
        { ok: (($('f_page_description').value || $('f_excerpt').value).length) >= 80 && (($('f_page_description').value || $('f_excerpt').value).length) <= 160, label: 'Meta description 80–160 chars' },
        { ok: $('f_page_keywords').value.trim().length > 0, label: 'Keywords added' },
        { ok: rte.querySelectorAll('h2').length > 0, label: 'At least one H2' },
        { ok: wordCount(rteText()) >= 300, label: 'Body 300+ words' },
        { ok: rte.querySelectorAll('a[data-int="1"]').length > 0, label: 'An internal link' },
        { ok: $('f_image').value.trim().length > 0, label: 'Featured image set' },
        { ok: this.collectFaqs().length >= 2, label: '2+ FAQ entries' }
      ];
      var passed = checks.filter(function (c) { return c.ok; }).length;
      var pct = Math.round(passed / checks.length * 100);
      var ring = $('scoreRing');
      ring.style.strokeDashoffset = (100 - pct);
      ring.style.stroke = pct >= 75 ? 'var(--adm-leaf)' : (pct >= 40 ? 'var(--adm-gold)' : 'var(--adm-rose)');
      $('scoreNum').textContent = pct;
      var ul = $('seoChecklist'); ul.innerHTML = '';
      checks.forEach(function (c) {
        var li = document.createElement('li');
        li.className = c.ok ? 'pass' : 'fail';
        li.innerHTML = '<i class="fa-solid fa-' + (c.ok ? 'circle-check' : 'circle') + '"></i><span>' + c.label + '</span>';
        ul.appendChild(li);
      });
    },

    /* ---- paste cleanup (incl. Google Docs; gotcha #4) ---- */
    wirePaste: function () {
      rte.addEventListener('paste', function (e) {
        var html = (e.clipboardData || window.clipboardData).getData('text/html');
        var text = (e.clipboardData || window.clipboardData).getData('text/plain');
        e.preventDefault();
        if (html) { document.execCommand('insertHTML', false, cleanPaste(html)); }
        else { document.execCommand('insertText', false, text); }
        dirty = true; AdmEditor.refresh();
      });
    },

    /* ---- image select + safe delete (gotcha #5) ---- */
    wireImageSelect: function () {
      rte.addEventListener('click', function (e) {
        clearImgSel();
        if (e.target.tagName === 'IMG') { e.target.classList.add('adm-img-selected'); selectedImg = e.target; }
      });
      rte.addEventListener('keydown', function (e) {
        if (selectedImg && (e.key === 'Delete' || e.key === 'Backspace')) {
          e.preventDefault();
          selectImgNode(selectedImg);
          document.execCommand('delete');  // keeps undo history
          selectedImg = null; dirty = true; AdmEditor.refresh();
        } else if (e.key !== 'Shift') { clearImgSel(); }
      });
      // NOTE: no global 'selectionchange' clearer — the selecting click itself
      // fires selectionchange and would immediately deselect the image, defeating
      // the controlled delete above. Clicking elsewhere (click handler) and any
      // non-Delete keydown already clear the selection.
    },

    /* ---- serialize RTE for saving (display src -> asset arg) ---- */
    bodyForSave: function () {
      var clone = rte.cloneNode(true);
      clone.querySelectorAll('img.adm-img-selected').forEach(function (i) { i.classList.remove('adm-img-selected'); });
      clone.querySelectorAll('img[data-arg]').forEach(function (i) {
        i.setAttribute('src', i.getAttribute('data-arg'));
        i.setAttribute('data-asset', '1');
        i.removeAttribute('data-arg');
      });
      return clone.innerHTML.trim();
    },

    /* ---- gather + AJAX ---- */
    gather: function () {
      return {
        action: '', orig_slug: window.ADM_POST.slug || '',
        slug: $('f_slug').value, title: $('f_title').value, excerpt: $('f_excerpt').value,
        category: $('f_category').value, date: $('f_date').value, author: $('f_author').value,
        read: $('f_read').value, read_auto: $('f_read_auto').checked ? '1' : '0',
        page_title: $('f_page_title').value, page_description: $('f_page_description').value, page_keywords: $('f_page_keywords').value,
        crumb: $('f_crumb').value, banner_title: $('f_banner_title').value, banner_sub: $('f_banner_sub').value,
        cat_suffix: $('f_cat_suffix').value, cta_href: $('f_cta_href').value, cta_label: $('f_cta_label').value,
        image: $('f_image').value, image_alt: $('f_image_alt').value,
        body: this.currentBody(), faqs: JSON.stringify(this.collectFaqs())
      };
    },
    post: function (data) {
      var body = new URLSearchParams(); body.append('csrf', csrf());
      Object.keys(data).forEach(function (k) { body.append(k, data[k]); });
      return fetch('post-actions.php', { method: 'POST', headers: { 'X-CSRF-Token': csrf() }, body: body })
        .then(function (r) { return r.json(); });
    },
    save: function (silent) {
      if (!$('f_title').value.trim()) { if (!silent) admToast('Add a title first', 'err'); return; }
      var d = this.gather(); d.action = 'save';
      this.post(d).then(function (r) {
        if (r.ok) { dirty = false; window.ADM_POST.slug = r.slug; if (r.read) AdmEditor.maybeRead(r.read); if (!silent) admToast(r.message || 'Saved', 'ok'); }
        else admToast(r.error || 'Save failed', 'err');
      });
    },
    maybeRead: function (read) { if ($('f_read_auto').checked) $('f_read').value = read; },
    wireButtons: function () {
      var self = this;
      $('btnSave').addEventListener('click', function () { self.save(false); });
      $('btnPublish').addEventListener('click', function () {
        if (!$('f_title').value.trim()) { admToast('Add a title first', 'err'); return; }
        var d = self.gather(); d.action = 'publish';
        self.post(d).then(function (r) {
          if (r.ok) { dirty = false; window.ADM_POST.slug = r.slug; admToast(r.message || 'Published', 'ok'); window.ADM_POST.published = true; if (r.url) setTimeout(function () { window.open(r.url, '_blank'); }, 400); }
          else admToast(r.error || 'Publish failed', 'err');
        });
      });
      $('btnPreview').addEventListener('click', function () {
        var d = self.gather(); d.action = 'preview';
        self.post(d).then(function (r) { if (r.ok && r.url) window.open(r.url, '_blank'); else admToast(r.error || 'Preview failed', 'err'); });
      });
      var un = $('btnUnpublish');
      if (un) un.addEventListener('click', function () {
        if (!confirm('Unpublish this post? The live file moves to /trash and it leaves the sitemap.')) return;
        self.post({ action: 'unpublish', slug: window.ADM_POST.slug }).then(function (r) { admToast(r.message || 'Done', r.ok ? 'ok' : 'err'); if (r.ok) setTimeout(function () { location.href = 'posts.php'; }, 800); });
      });
      var del = $('btnDelete');
      if (del) del.addEventListener('click', function () {
        if (!confirm('Delete this post permanently? (The file is moved to /trash.)')) return;
        self.post({ action: 'delete', slug: window.ADM_POST.slug }).then(function (r) { if (r.ok) location.href = r.redirect || 'posts.php'; else admToast(r.error || 'Delete failed', 'err'); });
      });
    }
  };
  window.AdmEditor = AdmEditor;

  /* ---------- helpers ---------- */
  function counter(id, len, max) {
    var el = document.getElementById(id); if (!el) return;
    el.textContent = len + ' / ' + max;
    el.className = 'adm-counter ' + (len === 0 ? '' : (len <= max ? 'good' : 'bad'));
  }
  function rteText() { var c = rte.cloneNode(true); c.querySelectorAll('script,style').forEach(function (n) { n.remove(); }); return c.textContent || ''; }
  function wordCount(t) { t = (t || '').replace(/\s+/g, ' ').trim(); return t === '' ? 0 : t.split(/\s+/).length; }
  function slugify(s) { return (s || '').toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, ''); }
  function escAttr(s) { return (s || '').replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/</g, '&lt;'); }

  function resolveImages() {
    if (!rte) return;
    rte.querySelectorAll('img[data-asset="1"]').forEach(function (img) {
      var src = img.getAttribute('src') || '';
      if (!/^(https?:)?\/\//.test(src) && src.indexOf(assetBase()) !== 0) {
        img.setAttribute('data-arg', src);
        img.setAttribute('src', assetBase() + src.replace(/^\/+/, ''));
      }
    });
  }
  function clearImgSel() { if (selectedImg) { selectedImg.classList.remove('adm-img-selected'); selectedImg = null; } }
  function selectImgNode(node) { var r = document.createRange(); r.selectNode(node); var s = window.getSelection(); s.removeAllRanges(); s.addRange(r); }
  function saveRange() { var s = window.getSelection(); return s.rangeCount ? s.getRangeAt(0).cloneRange() : null; }
  function restoreRange(r) { if (!r) return; var s = window.getSelection(); s.removeAllRanges(); s.addRange(r); }

  function upload(file, hint) {
    var fd = new FormData(); fd.append('action', 'upload'); fd.append('csrf', csrf()); fd.append('hint', hint); fd.append('file', file);
    return fetch('post-actions.php', { method: 'POST', headers: { 'X-CSRF-Token': csrf() }, body: fd }).then(function (r) { return r.json(); });
  }

  function faqRow(q, a) {
    var d = document.createElement('div');
    d.className = 'adm-repeat-item';
    d.setAttribute('draggable', 'true');
    d.innerHTML = '<div class="adm-repeat-head"><span class="adm-handle" title="Drag to reorder"><i class="fa-solid fa-grip-vertical"></i></span><button type="button" class="adm-btn adm-btn-icon adm-btn-ghost faq-rm"><i class="fa-solid fa-xmark"></i></button></div>'
      + '<div class="adm-field"><label class="adm-label">Question</label><input class="adm-input faq-q"></div>'
      + '<div class="adm-field" style="margin-bottom:0"><label class="adm-label">Answer</label><textarea class="adm-textarea faq-a" rows="2" style="min-height:auto"></textarea></div>';
    d.querySelector('.faq-q').value = q || '';
    d.querySelector('.faq-a').value = a || '';
    return d;
  }

  /* ---- Google-Docs-aware paste cleanup (gotcha #4) ---- */
  function cleanPaste(html) {
    var doc = new DOMParser().parseFromString(html, 'text/html');
    // 1. Unwrap Google Docs wrapper <b style="font-weight:normal" id="docs-internal-guid-…">
    doc.querySelectorAll('b,strong').forEach(function (b) {
      var st = (b.getAttribute('style') || '').replace(/\s/g, '');
      var id = b.getAttribute('id') || '';
      if (/font-weight:normal/i.test(st) || id.indexOf('docs-internal-guid') === 0) unwrap(b);
    });
    // 2. Convert weight/italic spans to <strong>/<em> BEFORE stripping attributes
    doc.querySelectorAll('span,font').forEach(function (sp) {
      var st = (sp.getAttribute('style') || '');
      var wrap = null;
      if (/font-weight\s*:\s*(bold|[6-9]00)/i.test(st)) wrap = 'strong';
      if (/font-style\s*:\s*italic/i.test(st)) wrap = wrap ? wrap : 'em';
      if (wrap) { var w = doc.createElement(wrap); while (sp.firstChild) w.appendChild(sp.firstChild); sp.replaceWith(w); }
      else unwrap(sp);
    });
    // 3. Whitelist tags + drop all attributes except href on <a>
    var allow = { P: 1, H2: 1, H3: 1, H4: 1, UL: 1, OL: 1, LI: 1, BLOCKQUOTE: 1, A: 1, B: 1, STRONG: 1, I: 1, EM: 1, U: 1, BR: 1, TABLE: 1, THEAD: 1, TBODY: 1, TR: 1, TD: 1, TH: 1, HR: 1, IMG: 1 };
    [].slice.call(doc.body.querySelectorAll('*')).forEach(function (el) {
      var tag = el.tagName;
      if (tag === 'H1') { rename(el, 'h2'); tag = 'H2'; }
      if (tag === 'H5' || tag === 'H6') { rename(el, 'h4'); tag = 'H4'; }
      if (!allow[tag]) { unwrap(el); return; }
      [].slice.call(el.attributes).forEach(function (at) {
        if (tag === 'A' && at.name === 'href') return;
        if (tag === 'IMG' && (at.name === 'src' || at.name === 'alt')) return;
        el.removeAttribute(at.name);
      });
      if (tag === 'A') { var h = el.getAttribute('href') || ''; if (/^\s*(javascript|data|vbscript):/i.test(h)) el.removeAttribute('href'); }
    });
    return doc.body.innerHTML;
  }
  function unwrap(el) { var p = el.parentNode; if (!p) return; while (el.firstChild) p.insertBefore(el.firstChild, el); p.removeChild(el); }
  function rename(el, name) { var n = document.createElement(name); while (el.firstChild) n.appendChild(el.firstChild); el.replaceWith(n); }

  /* ---- link modal ---- */
  function openLinkModal() {
    var existing = document.getElementById('linkOverlay');
    if (existing) existing.remove();
    var groups = {};
    (window.ADM_LINK_TARGETS || []).forEach(function (t) { (groups[t.group] = groups[t.group] || []).push(t); });
    var opts = '';
    Object.keys(groups).forEach(function (g) {
      opts += '<optgroup label="' + g + '">';
      groups[g].forEach(function (t) { opts += '<option value="' + escAttr(t.value) + '">' + escAttr(t.label) + '</option>'; });
      opts += '</optgroup>';
    });
    var ov = document.createElement('div');
    ov.className = 'adm-modal-overlay is-open'; ov.id = 'linkOverlay';
    ov.innerHTML = '<div class="adm-modal"><div class="adm-flex-between"><h3>Insert link</h3><button class="adm-btn adm-btn-icon adm-btn-ghost" data-x><i class="fa-solid fa-xmark"></i></button></div>'
      + '<div class="adm-field"><label class="adm-label">Internal page or post</label><select class="adm-select" id="lnkInternal"><option value="">— choose —</option>' + opts + '</select></div>'
      + '<div class="adm-field"><label class="adm-label">…or an external URL</label><input class="adm-input" id="lnkExternal" placeholder="https://…"></div>'
      + '<div class="adm-modal-foot"><button class="adm-btn adm-btn-ghost" data-x>Cancel</button><button class="adm-btn adm-btn-cta" id="lnkApply">Insert</button></div></div>';
    document.body.appendChild(ov);
    ov.addEventListener('click', function (e) { if (e.target.closest('[data-x]') || e.target === ov) ov.remove(); });
    document.getElementById('lnkApply').addEventListener('click', function () {
      var internal = document.getElementById('lnkInternal').value;
      var ext = document.getElementById('lnkExternal').value.trim();
      restoreRange(AdmEditor._savedRange);
      var sel = window.getSelection();
      var text = sel && sel.toString() ? sel.toString() : (internal || ext);
      var a;
      if (internal) a = '<a href="' + escAttr(internal) + '" data-int="1">' + escAttr(text) + '</a>';
      else if (ext) { if (!/^(https?:|mailto:|tel:|#)/i.test(ext)) ext = 'https://' + ext; a = '<a href="' + escAttr(ext) + '" target="_blank" rel="noopener">' + escAttr(text) + '</a>'; }
      else { ov.remove(); return; }
      document.execCommand('insertHTML', false, a);
      ov.remove(); dirty = true; AdmEditor.refresh();
    });
  }

})();
