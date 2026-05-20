<?php
require_once __DIR__ . '/config.php';

$faqs = $faqs ?? [
    ['q' => 'Who owns European Publishing House?',
     'a' => "European Publishing House is an independent publishing company founded in 2021. We're not affiliated with any of the Big 5 publishers, we operate independently, which means we can offer authors faster turnaround, more flexibility, and a direct working relationship with our team."],
    ['q' => 'What is the average cost to publish a book in Europe?',
     'a' => "Publishing costs in Europe vary quite a bit depending on what your book needs. A basic self-publishing package might start from a few hundred pounds or euros, while a full-service package covering editing, cover design, formatting, and distribution can run into the thousands. The honest answer is that pricing depends on your manuscript's length, genre, current state, and which services you need. We build a custom quote for every author after a free consultation."],
    ['q' => 'How much does it cost to make 1,000 copies of a book in Europe?',
     'a' => "Print-on-demand means you don't have to order 1,000 copies upfront, books are printed as readers buy them. If you do want a bulk print run, the cost per copy varies based on page count, size, colour interiors, and binding. Generally, a standard paperback with black-and-white interiors might cost anywhere from &pound;2&ndash;&pound;6 per copy at volume. We'll walk you through the options during your consultation."],
    ['q' => 'Are there any reputable hybrid publishers in Europe?',
     'a' => "Yes, European Publishing House offers hybrid publishing services in Europe. Hybrid publishing sits between traditional and self-publishing: you get professional editing, design, and distribution, while retaining your rights and a larger share of royalties than a traditional deal would give you. It's a strong option for authors who want quality without the waiting list."],
    ['q' => 'How expensive is hybrid publishing in Europe?',
     'a' => "Hybrid publishing costs more than DIY self-publishing because you're paying for professional services, but you retain rights and earn higher royalties than through a traditional publisher. Costs vary based on what's included. Some authors need the full package, editing, design, formatting, marketing, and distribution. Others just need certain services. We quote based on what your book actually needs."],
    ['q' => 'Who are the best publishing houses in Europe?',
     'a' => "Finding the right publishing house in Europe comes down to one thing, who's actually going to care about your book. European Publishing House is one of the best publishing houses in Europe, and the numbers speak for themselves. Since 2021, we've published over 800 books across every genre, working with authors from first draft to final sale. We handle editing, cover design, formatting, ghostwriting, marketing, and global distribution, all under one roof. You keep your rights, you keep your royalties, and you work directly with a team that treats your manuscript like it matters. You've already found your publisher."],
];
$faqsEyebrow = $faqsEyebrow ?? 'FAQs';
$faqsTitle   = $faqsTitle   ?? "We're here to answer all your <em class=\"serif-italic\">questions</em>";
$faqsIntro   = $faqsIntro   ?? "Can't find what you're looking for? Speak with our team directly.";
$faqsCtaText = $faqsCtaText ?? 'Get in Touch';
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
            <a href="contact.php" class="btn btn-cta btn-lg" data-no-popup>
                <?= safe($faqsCtaText) ?> <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
