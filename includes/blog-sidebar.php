<?php
/**
 * Sidebar for single blog posts.
 * Expects: $post (array), $share_url (string)
 */
require_once __DIR__ . '/config.php';
$post        = $post ?? [];
$share_url   = $share_url ?? '';
$share_title = $post['title'] ?? '';
?>
<aside class="blog-sidebar" aria-label="Article sidebar">

    <div class="blog-side-card blog-side-share">
        <span class="blog-side-label">Share this article</span>
        <ul class="blog-share">
            <li>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= safe(urlencode($share_url)) ?>" target="_blank" rel="noopener" aria-label="Share on Facebook" class="share-btn fb">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
            </li>
            <li>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= safe(urlencode($share_url)) ?>" target="_blank" rel="noopener" aria-label="Share on LinkedIn" class="share-btn li">
                    <i class="fa-brands fa-linkedin-in"></i>
                </a>
            </li>
            <li>
                <a href="https://twitter.com/intent/tweet?url=<?= safe(urlencode($share_url)) ?>&text=<?= safe(urlencode($share_title)) ?>" target="_blank" rel="noopener" aria-label="Share on X / Twitter" class="share-btn tw">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>
            </li>
            <li>
                <a href="https://api.whatsapp.com/send?text=<?= safe(urlencode($share_title . ' ' . $share_url)) ?>" target="_blank" rel="noopener" aria-label="Share on WhatsApp" class="share-btn wa">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
            </li>
            <li>
                <a href="mailto:?subject=<?= safe(urlencode($share_title)) ?>&body=<?= safe(urlencode($share_url)) ?>" aria-label="Share by email" class="share-btn em">
                    <i class="fa-solid fa-envelope"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="blog-side-card blog-side-toc">
        <span class="blog-side-label">In This Article</span>
        <ul class="blog-toc-list" id="blog-toc">
            <!-- Headings injected via JS at the bottom of the post page -->
        </ul>
    </div>

    <div class="blog-side-card blog-side-cta">
        <span class="blog-side-label">Need help with your book?</span>
        <h4>Book a <em class="serif-italic">free 30-minute</em> consultation.</h4>
        <p>Tell us where you are with your manuscript and we&rsquo;ll come back within one working day.</p>
        <a class="btn btn-cta" href="#popup" data-popup>
            Start a Conversation <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

</aside>
