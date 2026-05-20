<?php
require_once __DIR__ . '/config.php';

$faqs = $faqs ?? [
    ['q' => 'Who owns European Publishing House?',
     'a' => "We are an independent publishing company founded in 2021, not affiliated with any of the Big 5. Independence means faster turnaround, more flexibility, and a direct working relationship with our editorial team."],
    ['q' => 'What does it cost to publish a book in Europe?',
     'a' => "Publishing costs vary based on what your manuscript actually needs, length, genre, current condition, and which services you require. A basic package starts from a few hundred euros; a full editorial-to-launch service can run into the thousands. We build a custom quote after a free manuscript review."],
    ['q' => 'Do I keep my rights and royalties?',
     'a' => "Yes, 100% of them. You retain all creative rights, all royalties, and full ownership of your work. We charge for the services we provide; we do not take a slice of your book."],
    ['q' => 'How long does the publishing process take?',
     'a' => "Most projects move from finalised manuscript to published book in 8–14 weeks, depending on the services included. Editing-heavy projects naturally take longer; format-and-distribute-only projects move faster. You will get a realistic timeline before we start."],
    ['q' => 'Where will my book be available?',
     'a' => "Amazon Kindle and paperback (every territory), Apple Books (170+ countries), Kobo (190+ countries), Google Play, Barnes &amp; Noble, Scribd, IngramSpark and 150+ other retailers. Print-on-demand means readers buy it however they prefer."],
    ['q' => 'Can you help if I have not finished writing yet?',
     'a' => "Yes, that is what our ghostwriting service is for. Whether you need help shaping a first draft, completing a half-finished manuscript, or writing the whole book in your voice, we can take it on confidentially. You own every word."],
];
$faqsEyebrow = $faqsEyebrow ?? 'FAQ';
$faqsTitle   = $faqsTitle   ?? 'Questions, answered <em class="serif-italic">honestly</em>';
$faqsIntro   = $faqsIntro   ?? 'The questions authors ask us most, and the straight answers we give them.';
$faqsCtaText = $faqsCtaText ?? 'Speak with the team';
?>
<section class="faq-section" id="faq">
    <div class="container">

        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow"><?= safe($faqsEyebrow) ?></span>
            <h2 class="section-title"><?= $faqsTitle ?></h2>
            <p><?= safe($faqsIntro) ?></p>
        </div>

        <div class="faq-wrap" data-aos="fade-up" data-aos-delay="100">
            <div class="faq-accordion" data-faq-accordion>
                <?php foreach ($faqs as $i => $f): ?>
                    <div class="faq-item <?= $i === 0 ? 'is-open' : '' ?>">
                        <button class="faq-trigger" type="button" aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>">
                            <span>
                                <span class="faq-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                                <?= safe($f['q']) ?>
                            </span>
                            <span class="faq-icon"><i class="fa-solid fa-plus"></i></span>
                        </button>
                        <div class="faq-body">
                            <div class="faq-body-inner"><?= $f['a'] ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="#popup" class="btn btn-cta btn-lg" data-popup>
                <?= safe($faqsCtaText) ?> <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
