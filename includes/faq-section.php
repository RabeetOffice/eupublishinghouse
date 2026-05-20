<?php require_once __DIR__ . '/config.php';
$faqs = [
    ['q' => 'How does the submission process work?',    'a' => 'Every manuscript is submitted through our editorial portal. A senior editor will personally read and respond within four weeks. There is no submission fee.'],
    ['q' => 'Do you take on debut authors?',            'a' => 'Yes. A meaningful share of our list every year is debut work. Our acquisitions are based on the strength of the writing, not the size of an author platform.'],
    ['q' => 'What genres do you publish?',              'a' => 'Literary &amp; commercial fiction, memoir, business, children\'s, poetry and selected specialist non-fiction. We do not currently publish technical academic work.'],
    ['q' => 'What does the royalty structure look like?','a' => 'Authors keep market-leading royalty rates and retain ownership of their intellectual property. We sign clean, transparent contracts with no hidden clauses.'],
    ['q' => 'Where will my book be distributed?',       'a' => 'Worldwide. Through Amazon Kindle, Apple Books, Kobo, Google Play, Barnes &amp; Noble, Waterstones and a curated network of independent bookshops in 25+ countries.'],
    ['q' => 'Do you offer marketing &amp; PR?',         'a' => 'Yes, every title is matched with a dedicated publicist. We focus on press placements, considered digital campaigns and bookseller relationships rather than paid noise.'],
];
?>
<section class="faq-section" id="faq">
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-lg-4" data-aos="fade-right">
                <span class="eyebrow">Frequently Asked</span>
                <h2 class="section-title">Authors usually ask <em class="gold-italic">these</em>.</h2>
                <p class="section-lead">Can't find what you're looking for? Speak with our editorial team directly.</p>
                <a href="contact.php" class="btn btn-cta">Get in Touch <i class="fa-solid fa-arrow-right"></i></a>
            </div>

            <div class="col-lg-8" data-aos="fade-left" data-aos-delay="100">
                <div class="accordion faq-accordion" id="faqAcc">
                    <?php foreach ($faqs as $i => $f): ?>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button <?= $i === 0 ? '' : 'collapsed' ?>" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq<?= $i ?>"
                                    aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>" aria-controls="faq<?= $i ?>">
                                <span class="faq-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                                <?= $f['q'] ?>
                            </button>
                        </h3>
                        <div id="faq<?= $i ?>" class="accordion-collapse collapse <?= $i === 0 ? 'show' : '' ?>" data-bs-parent="#faqAcc">
                            <div class="accordion-body">
                                <p><?= $f['a'] ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
