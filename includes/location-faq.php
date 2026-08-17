<?php
/* =================================================================
   FAQ SECTION + FAQPage SCHEMA

   One include so the visible accordion and the structured data can
   never drift apart — both are generated from the same $faqs array.

   Set before include:
     $faqs        , [['q' => '...', 'a' => '...'], ...]  (HTML allowed in 'a')
     $faqId       , unique DOM id prefix for the accordion (required if a
                    page ever renders two FAQ blocks)
     $faqEyebrow  , small label above the heading
     $faqTitle    , H2 (HTML allowed)
     $faqIntro    , short paragraph under the heading
     $faqSchema   , false to suppress the JSON-LD (use when another block
                    on the page already emits FAQPage markup)
================================================================= */

require_once __DIR__ . '/config.php';

$faqs       = $faqs       ?? [];
$faqId      = $faqId      ?? 'locFaq';
$faqEyebrow = $faqEyebrow ?? 'FAQs';
$faqTitle   = $faqTitle   ?? 'We’re here to answer all your <em class="serif-italic">questions</em>';
$faqIntro   = $faqIntro   ?? 'Can’t find what you’re looking for? Speak with our team directly.';
$faqSchema  = $faqSchema  ?? true;

if ($faqs):
?>
<!-- ============================================================
     FAQs
     ============================================================ -->
<section class="faq-section" id="faq">
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-lg-4" data-aos="fade-right">
                <span class="eyebrow"><?= safe($faqEyebrow) ?></span>
                <h2 class="section-title"><?= $faqTitle ?></h2>
                <p><?= $faqIntro ?></p>
                <a href="<?= link_to('contact.php') ?>" class="btn btn-cta" data-no-popup>Get in Touch <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="col-lg-8" data-aos="fade-left" data-aos-delay="100">
                <div class="accordion faq-accordion" id="<?= safe($faqId) ?>">
                    <?php foreach ($faqs as $i => $f): ?>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button <?= $i === 0 ? '' : 'collapsed' ?>" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#<?= safe($faqId) ?>-<?= $i ?>"
                                    aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>" aria-controls="<?= safe($faqId) ?>-<?= $i ?>">
                                <span class="faq-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                                <?= $f['q'] ?>
                            </button>
                        </h3>
                        <div id="<?= safe($faqId) ?>-<?= $i ?>" class="accordion-collapse collapse <?= $i === 0 ? 'show' : '' ?>" data-bs-parent="#<?= safe($faqId) ?>">
                            <div class="accordion-body"><p><?= $f['a'] ?></p></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if ($faqSchema):
    /* Plain-text copies of the same Q&A pairs for Google. */
    $_faqLd = ['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => []];
    foreach ($faqs as $f) {
        $_faqLd['mainEntity'][] = [
            '@type'          => 'Question',
            'name'           => html_entity_decode(strip_tags($f['q']), ENT_QUOTES, 'UTF-8'),
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => html_entity_decode(strip_tags($f['a']), ENT_QUOTES, 'UTF-8'),
            ],
        ];
    }
?>
<script type="application/ld+json">
<?= json_encode($_faqLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>

</script>
<?php endif; ?>
<?php endif; ?>
