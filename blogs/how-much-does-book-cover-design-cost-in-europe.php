<?php
$site_base = '../';
$GLOBALS['site_base']        = $site_base;
$GLOBALS['current_page_key'] = 'blog';

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/blog-data.php';

$current_slug = 'how-much-does-book-cover-design-cost-in-europe';
$post = blog_get_post($current_slug);

if (!$post) {
    header('HTTP/1.0 404 Not Found');
    echo 'Article not found.';
    exit;
}

$page_title       = 'Book Cover Design Cost in Europe | EUPH';
$page_description = 'Wondering how much book cover design costs in Europe? EU Publishing House breaks down rates, factors, and hiring tips so you can budget smart.';
$page_keywords    = 'book cover design cost Europe, Reedsy cover design price, freelance book cover designer Europe, eBook cover cost';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/blogs/' . $current_slug . '/';
$og_image         = rtrim(BRAND_SITE_URL, '/') . '/' . ltrim($post['image'], '/');
$og_type          = 'article';
$share_url        = $canonical_url;

require __DIR__ . '/../includes/header.php';

$banner = [
    'crumb' => 'How Much Does Book Cover Design Cost in Europe?',
    'title' => 'How Much Does Book Cover Design Cost in <em class="serif-italic">Europe?</em>',
    'sub'   => 'A 2026 breakdown by region, experience, complexity, and the things designers forget to tell you about.',
];
include __DIR__ . '/../includes/page-banner.php';
?>

<section class="blog-section">
    <div class="container">

        <figure class="blog-feature" data-aos="fade-up">
            <div class="blog-feature__art">
                <img src="<?= safe($post['image']) ?>"
                     alt="<?= safe($post['title']) ?>"
                     class="blog-feature__img"
                     loading="lazy"
                     decoding="async"
                     onload="this.parentElement.classList.add('is-loaded')"
                     onerror="this.parentElement.classList.add('is-loaded','is-error')">
            </div>
        </figure>

        <div class="blog-layout" data-aos="fade-up">
            <div class="blog-post-body" id="blog-post-body">
                <div class="blog-post-meta-strip">
                    <span class="post-cat"><?= safe($post['category']) ?> &middot; Pricing</span>
                    <span><i class="fa-regular fa-calendar"></i><?= safe(blog_format_date($post['date'])) ?></span>
                    <span class="meta-divider" aria-hidden="true"></span>
                    <span><i class="fa-regular fa-user"></i><?= safe($post['author']) ?></span>
                    <span class="meta-divider" aria-hidden="true"></span>
                    <span><i class="fa-regular fa-clock"></i><?= safe($post['read']) ?></span>
                </div>

                <p>Picture this for a moment. Your book is sitting on a digital shelf next to thousands of others. A reader is scrolling, thumb moving fast, eyes scanning. They stop on yours for half a second. What made them pause? Almost always, it&rsquo;s the cover.</p>

                <p>Your cover is not decoration. It&rsquo;s the first conversation your book ever has with a reader, and it happens before a single word inside is read. It signals genre, tone, professionalism, and intent all at once. Get it right and you&rsquo;ve earned a click. Get it wrong and you&rsquo;ve lost the sale before the reader even knew you were trying to make one.</p>

                <p>For self-publishing authors across Europe, figuring out what a professional cover actually costs is harder than it should be. The market is fragmented. A designer in Berlin charges differently from one in Lisbon, who charges differently from one in Warsaw, who charges differently from one in Stockholm. Online platforms throw their own numbers into the mix. Agencies quote ranges that feel like guesses. And underneath all of it, you&rsquo;re trying to figure out whether you&rsquo;re getting a fair deal or being quietly overcharged.</p>

                <p>This guide is here to fix that. Whether you&rsquo;re publishing your first book or your fifth, we&rsquo;re going to walk through what a book cover actually costs across Europe in 2026, what drives those costs up or down, and how to find a designer who delivers real value rather than just a pretty picture. No vague estimates, no fluff, just a clear breakdown you can actually use to budget with confidence.</p>

                <p>By the time you finish reading, you&rsquo;ll know exactly what to expect, where to push back on a quote, and how to make the kind of investment that pays for itself in sales rather than draining your savings for a design that quietly underperforms.</p>

                <hr>

                <h2>Why Professional Book Cover Design in Europe Is Non-Negotiable</h2>
                <p>Let&rsquo;s get one thing out of the way first. You&rsquo;ve probably seen the tutorials. Drag, drop, export, publish. A free template, a stock image, ten minutes of effort, and you have a cover. Technically.</p>
                <p>The problem is that <em>technically</em> and <em>competitively</em> are two completely different things.</p>
                <p>Book cover design in Europe sits in a strange space where the entry barrier is almost nothing, but the gap between an amateur cover and a professional one is enormous. Readers can spot the difference instantly, even if they can&rsquo;t articulate exactly what they&rsquo;re seeing. A professional cover has a confidence to it, a deliberate use of space, type, and image that feels intentional. An amateur cover, even a competent one, almost always feels slightly off.</p>
                <p>Here&rsquo;s why that matters financially. The cost of book cover design in Europe is real, no question. But the cost of a bad cover is almost always higher, because a bad cover means a book that doesn&rsquo;t get clicked, doesn&rsquo;t get bought, and doesn&rsquo;t get reviewed. You&rsquo;ve already spent months or years writing the thing. Skimping on the one element that decides whether anyone reads it is a strange place to economize.</p>
                <p>A strong cover does four things at once. It signals genre instantly, so the right reader recognizes your book as something they&rsquo;d enjoy. It builds trust, telling the reader that the person who wrote this took the work seriously. It supports your marketing, because every social post, ad creative, and bookshop display starts with that image. And it builds your author brand over time, especially if you plan to publish more than one book.</p>
                <p>None of this is about spending the most money possible. It&rsquo;s about understanding that designing a book cover in Europe is one of the few publishing investments that compounds. A great cover sells your book today and continues selling it five years from now. That&rsquo;s the framing to hold onto as we move through the numbers.</p>
                <p>If you&rsquo;re new to indie publishing, our broader guide to <a href="<?= link_to('publishing.php') ?>">publishing your book in Europe</a> covers the wider picture, but cover design is one of the two or three places we consistently advise authors not to cut corners.</p>

                <hr>

                <h2>Key Factors That Influence Book Cover Design Costs in Europe</h2>
                <p>Before we get into specific price ranges, you need to understand what&rsquo;s actually driving the numbers. A quote isn&rsquo;t a random figure pulled from the air. It reflects a set of variables, and once you understand them, you&rsquo;ll know how to read a quote properly and where you have room to negotiate.</p>

                <h3>Designer Experience and Portfolio</h3>
                <p>This is the biggest single factor in how much a book cover costs in Europe.</p>
                <p>Emerging designers are often more affordable, sometimes dramatically so. You might find someone with two years of experience charging &euro;200-&euro;300 for a full cover. The work can be very good, but it&rsquo;s usually less specialized, and you&rsquo;re taking on a degree of risk in terms of consistency and reliability.</p>
                <p>Established professionals charge significantly more because they&rsquo;ve earned the right to. They have a track record, a body of work you can evaluate, and a reputation that means they&rsquo;re booked weeks or months in advance. Their rates typically start at &euro;500-&euro;800 and climb from there.</p>
                <p>Then there are genre specialists. These are designers who only design fantasy covers, or only romance, or only thrillers. Their rates are often at the top of the market, but they understand the visual codes of their genre so deeply that the result is almost always commercially stronger than a generalist could produce. For competitive genres especially, hiring a specialist is usually worth the premium.</p>

                <h3>Complexity of the Design</h3>
                <p>Not all covers require the same amount of work, and the price reflects that.</p>
                <p>A typography-driven cover, where the focus is on strong fonts and minimal imagery, is the most affordable end of the spectrum. It looks deceptively simple, but designing great typography is its own skill, and a good typographic cover can be just as effective as something more elaborate, particularly for literary fiction and non-fiction.</p>
                <p>Photo manipulation covers combine and edit multiple stock images into something that feels original. This is the most common approach for thrillers, romance, contemporary fiction, and historical fiction. The cost depends on how many elements need to be combined and how seamlessly they need to blend together.</p>
                <p>Custom illustration or artwork is at the top end. This involves an artist creating original imagery specifically for your book. It takes the longest and costs the most because you&rsquo;re paying for both creative time and artistic skill. For fantasy, sci-fi, and children&rsquo;s books, it&rsquo;s often the right choice. For other genres, it might be overkill.</p>
                <p>Advanced compositing, where multiple images, effects, and custom elements are layered into something genuinely unique, also sits at the premium end. It&rsquo;s the kind of cover that makes you stop and look twice.</p>

                <h4>Number of Revisions Included</h4>
                <p>Most professional cover design packages include between one and three rounds of revisions. That usually covers what most authors need, especially if your design brief is clear from the start.</p>
                <p>Where costs creep up is when you go beyond the agreed revisions. Each additional round typically adds 10-20% to the total fee, sometimes more if the changes are substantial. This is one of the most common reasons authors end up paying more than they expected, and it&rsquo;s almost always avoidable with better upfront communication.</p>

                <h3>Genre Specifics and Market Research</h3>
                <p>Some genres demand more conceptual work than others. Epic fantasy and science fiction often require detailed worldbuilding to be reflected on the cover, sometimes including custom illustration of specific scenes, characters, or environments. Historical fiction may need period-accurate visual references. Literary fiction often relies on subtle metaphor that takes longer to develop conceptually.</p>
                <p>A designer who understands your genre will spend less time researching and more time designing, which is one reason genre specialists deliver better value despite higher hourly rates.</p>

                <h3>Project Scope and Deliverables</h3>
                <p>What you actually need from the cover affects the price significantly.</p>
                <p>eBook only is the lowest cost, since you only need a single front-cover image at the right resolution. eBook plus print wrap adds the spine and back cover, which requires additional layout work and an understanding of print specifications, including bleed, trim, and spine width calculations. An audiobook cover, usually a square version of the main design, adds a small additional fee. A full marketing suite with 3D mockups, social media banners, and promotional graphics adds the most, but for authors planning a serious launch, it often saves money compared to commissioning these separately later.</p>

                <h3>Turnaround Time</h3>
                <p>Standard timelines for book cover design in Europe sit between two and four weeks. That&rsquo;s built into the regular rate.</p>
                <p>Rush projects, where you need a cover in under two weeks, typically incur a 20-50% surcharge depending on the designer and how tight the deadline is. This isn&rsquo;t designers being difficult; it&rsquo;s the reality that they&rsquo;re often booked, and prioritizing your project means rearranging existing client work.</p>

                <blockquote><strong><em>Expert Tip</em></strong><em>: When you&rsquo;re comparing designers, always look at their portfolio specifically for your genre. A designer who does brilliant literary fiction covers may not understand the visual language of romance, and vice versa. Genre alignment matters more than general design skill.</em></blockquote>

                <hr>

                <h2>Understanding Pricing Models: Freelancers, Agencies, and Platforms</h2>
                <p>Once you know what&rsquo;s driving the cost, the next question is where you&rsquo;re actually buying from. The cost of cover design in Europe varies significantly depending on the type of provider you choose, and each option has its own trade-offs.</p>

                <h3>Individual Freelance Designers</h3>
                <p>Freelance book cover designers in Europe make up the bulk of the market. You&rsquo;re working with one person directly, which usually means clearer communication, more flexibility, and often better value for money.</p>
                <p>The advantages are real. Direct contact with the person actually designing your cover. The ability to build a long-term relationship if you plan multiple books. Often more competitive rates than agencies. The trade-off is that quality and reliability vary widely. If a freelance designer falls ill, has a family emergency, or simply disappears, you don&rsquo;t have a backup.</p>
                <p>Typical price ranges for freelance book cover designers in Europe sit anywhere from &euro;150 for emerging designers up to &euro;1,000+ for established specialists. The middle of that range, around &euro;400-&euro;700, is where most quality work gets done for independent authors.</p>

                <h3>Design Agencies and Studios</h3>
                <p>Design agencies and studios offer a different model. You&rsquo;re paying for a team, project management, and a level of accountability that individual freelancers can&rsquo;t always match. The brand credibility is higher, and the work is usually polished.</p>
                <p>The downsides are cost and communication. Agency rates typically start at &euro;1,000 and can climb past &euro;5,000 per project. You also rarely speak to the designer directly; communication usually goes through an account manager, which can slow down feedback cycles.</p>
                <p>For most indie authors, agencies are overkill. They make more sense for small press publishers or authors with substantial marketing budgets who want the full launch package handled in one place.</p>

                <h3>Online Freelance Platforms</h3>
                <p>Online platforms have changed the way authors find designers. The two ends of the spectrum are worth understanding properly.</p>
                <p>Reedsy is the most well-known platform specifically for publishing services, including cover design. Reedsy book cover design costs in Europe generally fall between &euro;400 and &euro;2,000+, with many projects in the &euro;600-&euro;1,200 range depending on the designer&rsquo;s experience and the scope of work. Rates on the platform are set by individual designers, so it&rsquo;s worth checking current quotes directly. The advantage is vetting. Reedsy curates its designers, so you&rsquo;re choosing from a pre-filtered pool. The disadvantage is that you&rsquo;re paying platform fees built into the rates, and the choice can feel narrower than open marketplaces.</p>
                <p>Upwork and Fiverr cover a much wider range. You can find freelance book cover designers in Europe starting at &euro;50 on Fiverr and going well above &euro;1,000 on Upwork. The trade-off is that you do the vetting yourself, and the variance in quality is enormous. For an experienced author who knows what to look for, these platforms can deliver excellent value. For a first-time author without that filter, they can be a minefield.</p>

                <h3>Choosing Between Them</h3>
                <p>The question isn&rsquo;t which option is best in the abstract. It&rsquo;s which option is best for your specific book, budget, and timeline. A first-time author working on a literary debut might benefit most from a vetted freelancer through Reedsy. An established indie author on book seven probably has a designer they already work with directly. A traditionally minded small press might prefer an agency.</p>
                <p>If you&rsquo;re still figuring out where book cover design fits in the wider publishing picture, our overview of <a href="<?= link_to('design.php') ?>">design services for authors</a> explains how cover, interior, and marketing visuals work together.</p>

                <hr>

                <h2>Average Book Cover Design Costs Across European Regions</h2>
                <p>Now to the part most authors actually came here for. The cost of book cover design in Europe is not a single number, and pretending it is would do you a disservice. Rates vary significantly depending on where in Europe the designer is based, driven by local cost of living, market maturity, and demand.</p>
                <p>Here&rsquo;s how the regional breakdown looks across the three main service tiers in 2026.</p>

                <div class="table-responsive my-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><strong>European Region</strong></th>
                                <th><strong>Entry-Level / Budget (&euro;)</strong></th>
                                <th><strong>Mid-Tier Professional (&euro;)</strong></th>
                                <th><strong>Premium / Agency Level (&euro;)</strong></th>
                                <th><strong>Market Overview</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Western Europe (UK, Germany, France, Netherlands, Belgium)</td>
                                <td>150&ndash;400</td>
                                <td>600&ndash;1,500</td>
                                <td>2,000&ndash;5,000+</td>
                                <td>Mature publishing markets, strong demand, higher living costs</td>
                            </tr>
                            <tr>
                                <td>Northern Europe (Sweden, Denmark, Norway, Finland)</td>
                                <td>250&ndash;500</td>
                                <td>800&ndash;1,800</td>
                                <td>2,500&ndash;6,000+</td>
                                <td>Highest labour costs, design-led markets, premium pricing</td>
                            </tr>
                            <tr>
                                <td>Southern Europe (Spain, Portugal, Italy, Greece)</td>
                                <td>100&ndash;300</td>
                                <td>400&ndash;1,000</td>
                                <td>1,500&ndash;3,500</td>
                                <td>Competitive freelance sector, growing indie-author demand</td>
                            </tr>
                            <tr>
                                <td>Eastern Europe (Romania, Bulgaria, Ukraine)</td>
                                <td>50&ndash;200</td>
                                <td>250&ndash;700</td>
                                <td>1,000&ndash;2,500</td>
                                <td>Lowest regional pricing, strong outsourcing hub</td>
                            </tr>
                            <tr>
                                <td>Central Europe (Austria, Czech Republic, Hungary, Poland, Slovakia, Switzerland)</td>
                                <td>200&ndash;450</td>
                                <td>700&ndash;1,600</td>
                                <td>2,000&ndash;4,500</td>
                                <td>Mixed premium agencies and mid-cost freelancers</td>
                            </tr>
                            <tr>
                                <td>Pan-European Online Platforms (Fiverr, Upwork, Reedsy, 99designs)</td>
                                <td>30&ndash;250</td>
                                <td>300&ndash;1,200</td>
                                <td>1,500&ndash;4,000</td>
                                <td>Wide variability based on portfolio quality and rights/licensing terms</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <p>A few things worth noting about how to read this.</p>
                <p>Western Europe, particularly the UK, France, Germany, and the Netherlands, sits at the upper end of the European market. Designers in these countries face higher living costs, and the design industry is mature with strong demand. You&rsquo;re often paying for established professionals with substantial portfolios. UK book cover design prices, for example, frequently mirror or exceed those in Germany and France, and that&rsquo;s reflected in the table.</p>
                <p>Southern Europe, including Spain, Italy, and Portugal, offers more competitive rates without compromising on quality. The design talent pool in these countries is deep, and rates tend to be 20-30% lower than Western Europe for comparable work. For budget-conscious authors who still want high-quality output, Southern Europe is often the smartest hunting ground.</p>
                <p>Central and Eastern Europe is where you&rsquo;ll find the strongest value for money in the entire European market. Poland, the Czech Republic, Hungary, and Romania have produced exceptional book cover designers who charge significantly less than their Western counterparts. The combination of strong design education and lower living costs makes this region genuinely competitive. Don&rsquo;t make the mistake of assuming lower rates mean lower quality; some of the best cover designers working in Europe today are based here.</p>
                <p>Nordic countries sit at the top of the European market alongside the UK and Germany. Sweden, Denmark, Norway, and Finland have a strong design tradition and equally strong rates. If you specifically want a Scandinavian aesthetic, you&rsquo;ll pay for it, but the work is often distinctive enough to justify the premium.</p>
                <p>One important note: these figures don&rsquo;t include VAT, which we&rsquo;ll cover separately later in this guide.</p>

                <blockquote><strong><em>Expert Tip</em></strong><em>: Don&rsquo;t assume the most expensive region produces the best work. A &euro;500 cover from a skilled designer in Warsaw can easily outperform a &euro;1,500 cover from a less specialized designer in London. Focus on portfolio fit and genre experience over geography.</em></blockquote>

                <hr>

                <h2>What&rsquo;s Included in a Book Cover Design Package</h2>
                <p>A quote of &euro;700 from one designer and &euro;700 from another can mean very different things depending on what&rsquo;s actually included. Knowing what to expect as standard, and what&rsquo;s usually charged separately, helps you compare like with like.</p>

                <h3>Standard Inclusions</h3>
                <p>Most professional book cover design packages in Europe include the following as a baseline.</p>
                <p>A high-resolution eBook file, usually a JPG or PNG sized correctly for Kindle, Kobo, Apple Books, and other major platforms. This is the absolute minimum you should expect.</p>
                <p>A print-ready file, usually a PDF with the correct bleed, trim, and spine dimensions for paperback or hardcover. The designer needs to know your page count and trim size to calculate spine width accurately, so this is something you&rsquo;ll be asked about before work begins.</p>
                <p>Standard revisions, typically one to three rounds of feedback on the chosen concept. Most professional designers won&rsquo;t go below two rounds, and most won&rsquo;t include more than three without an additional fee.</p>
                <p>Basic font licensing, ensuring the typefaces used on your cover are appropriately licensed for commercial use. This is something a lot of authors don&rsquo;t even think about, but using an improperly licensed font can create legal issues down the line. A professional designer handles this as part of the job.</p>

                <h3>Common Add-Ons</h3>
                <p>Beyond the standard package, there are several extras that often get quoted separately.</p>
                <p>3D mockups are professional, photorealistic renderings of your book that look like a physical copy held in someone&rsquo;s hand, sitting on a shelf, or displayed on a desk. They&rsquo;re brilliant for marketing because they make your book feel real to potential readers. Most designers charge &euro;30-&euro;80 per mockup.</p>
                <p>Social media banners and graphics are custom-designed visuals optimized for Facebook, Instagram, X, TikTok, and other platforms. A small package with a few banners and ad creatives might cost &euro;100-&euro;300, depending on how many assets you need.</p>
                <p>An audiobook cover is a square version of your main cover, optimized for Audible and other audio platforms. Most designers charge &euro;50-&euro;150 for this, since it requires re-thinking the composition for a different aspect ratio.</p>
                <p>Additional marketing assets like bookmarks, business cards, website headers, and promotional images are usually quoted individually based on what you need.</p>
                <p>Extended revisions beyond the agreed scope are charged separately, often at an hourly rate or a flat fee per round.</p>
                <p>Complex image manipulation that wasn&rsquo;t clear from the initial brief sometimes warrants an additional fee, especially if the scope of work has grown substantially since the original quote.</p>

                <blockquote><strong><em>Expert Tip</em></strong><em>: Ask for examples of your designer&rsquo;s work in different formats: eBook, paperback, hardcover, and audiobook. Some designers are brilliant with the eBook front but less experienced with full print wraps. You want to see the whole job done well, not just the part that&rsquo;s easy to show off online.</em></blockquote>

                <p><em>Factor in potential add-ons when you set your budget. If you know you&rsquo;ll need social media graphics and 3D mockups for your launch, build that into the initial conversation rather than treating them as afterthoughts.</em></p>

                <hr>

                <h2>Custom Illustration vs Stock Photography: Price Implications</h2>
                <p>One of the biggest decisions affecting your book cover design cost in Europe is whether you&rsquo;re going with stock-based imagery or commissioning original artwork. The price gap between the two is significant, and so is the difference in what you end up with.</p>

                <h3>Stock Photography</h3>
                <p>Stock photography is the more affordable route, and for many genres, it&rsquo;s the right choice. Designers source images from libraries like Shutterstock, Getty Images, Adobe Stock, and Depositphotos, then manipulate, combine, and integrate them into a cover.</p>
                <p>The advantages are real. It&rsquo;s faster, since you&rsquo;re not waiting for an artist to create something from scratch. It&rsquo;s significantly cheaper, both in licensing fees and in design time. And the libraries are vast, so finding suitable imagery is rarely a problem for most contemporary fiction, thrillers, romance, mysteries, and non-fiction.</p>
                <p>The disadvantages need to be understood properly. The biggest one is uniqueness. Other authors may license the same image and use it on their own covers, which is awkward at best and damaging at worst if it happens with a competing book in your genre. A skilled designer mitigates this by combining multiple elements, but the risk never disappears entirely.</p>
                <p>Licensing is also more complex than authors usually realize. Standard royalty-free licenses cover most book cover uses, but if your book sells extraordinarily well, or if you want to use the cover image on merchandise, you may need an extended or enhanced license, which costs more. Editorial-only images cannot be used on commercial book covers at all, which catches some authors out.</p>

                <h3>Custom Illustration and Artwork</h3>
                <p>Custom illustration sits at the opposite end of the spectrum. You&rsquo;re commissioning an artist to create original imagery specifically for your book.</p>
                <p>The advantages are obvious. The cover is completely unique. It&rsquo;s tailored to your exact vision. It creates strong brand identity, especially if you plan multiple books in a series. And the usage rights are usually broader, since you&rsquo;re paying for the artwork itself rather than licensing someone else&rsquo;s image.</p>
                <p>The disadvantages come down to cost and time. Custom illustration for a book cover typically starts at &euro;500 for simpler work and can climb past &euro;3,000 for highly detailed pieces. Timelines stretch significantly too, with most custom illustrations taking three to eight weeks depending on complexity. And you need to communicate your vision clearly, since the artist is interpreting your ideas rather than working from existing imagery.</p>

                <h3>Which One Is Right for Your Book</h3>
                <p>For most contemporary fiction, romance, thrillers, mysteries, literary fiction, and non-fiction, stock-based covers work brilliantly when done well. The market expects them, and the cost-to-impact ratio is strong.</p>
                <p>For fantasy, science fiction, children&rsquo;s books, graphic novels, and certain types of historical fiction, custom illustration often pays for itself. These genres have a visual tradition that readers expect, and a stock-based cover can feel out of place even when it&rsquo;s technically well executed.</p>

                <blockquote><strong><em>Expert Tip</em></strong><em>: Always clarify the difference between licensing for stock images, which often comes with limits on usage, and custom illustration, which usually includes full commercial rights. Read the agreement carefully so you know exactly what you can and can&rsquo;t do with the cover.</em></blockquote>

                <hr>

                <h2>How to Set a Realistic Budget for Your Book Cover</h2>
                <p>The question isn&rsquo;t just how much a book cover costs in Europe. It&rsquo;s how much you should actually spend, and that&rsquo;s a more personal calculation.</p>

                <h3>Evaluate Your Personal Finances Honestly</h3>
                <p>Start with what you can comfortably afford. Self-publishing has many costs beyond the cover, including editing, formatting, marketing, and printing. Your cover budget needs to sit inside a wider publishing budget, not eat into the funds needed for other essentials.</p>
                <p>A useful exercise is to look at your total publishing budget and decide what percentage you&rsquo;re willing to allocate to design. For most indie authors, that ends up somewhere between 20% and 40% of total pre-publication spend, depending on genre and ambition.</p>

                <h3>Research What &ldquo;Professional&rdquo; Looks Like in Your Genre</h3>
                <p>Spend a few hours looking at the bestseller lists in your genre on Amazon, Kobo, and Apple Books. Look at the top fifty books. What do their covers have in common? What feels distinctive about each one?</p>
                <p>This research does two things. It tells you what readers in your genre expect, which is what your cover ultimately needs to deliver. And it gives you a visual vocabulary you can use when briefing your designer, which significantly reduces the number of revisions you&rsquo;ll need.</p>

                <h3>Prioritize Design Elements</h3>
                <p>Before you commission anything, decide what the must-haves are. Is custom typography essential? Do you need a specific scene illustrated? Is photo manipulation enough? Knowing your priorities means you can negotiate intelligently with designers and avoid paying for elements you don&rsquo;t actually need.</p>

                <h3>The Cost vs. Value Calculation</h3>
                <p>Here&rsquo;s the framing that matters most. The cheapest cover isn&rsquo;t always the best value. A &euro;200 cover that doesn&rsquo;t sell books is more expensive than an &euro;800 cover that does, because the &euro;200 cover costs you every reader who scrolls past it.</p>
                <p>Higher investment usually correlates with more unique design, more experienced designers, and stronger commercial appeal. That doesn&rsquo;t mean the most expensive option is automatically the right one, but it does mean rock-bottom pricing should always make you suspicious. Real professionals charge real money for their time. If a quote is dramatically below market rate, something is usually being sacrificed: experience, attention, originality, or all three.</p>

                <h3>DIY Options With Strong Caveats</h3>
                <p>Tools like Canva and Adobe Express let you create covers yourself, and the result can occasionally be passable, especially for very early drafts or unpublished work used for beta reader feedback.</p>
                <p>For your actual published cover, though, DIY is almost always a mistake. The difference between a Canva cover and a professionally designed one is visible to experienced readers, even if they can&rsquo;t articulate exactly what they&rsquo;re seeing. A weak cover hurts your sales, your reviews, and your author brand, and the money you saved disappears very quickly as a result.</p>

                <blockquote><strong><em>Expert Tip</em></strong><em>: Don&rsquo;t fixate on the lowest quote. Look at portfolio quality, communication, and how well the designer understands your genre. The cheapest option is often the most expensive in the long run, because the cost of a redesign is the original fee plus the lost sales from the version that didn&rsquo;t work.</em></blockquote>

                <p><em>Think about return on investment, not just price. A great cover keeps selling your book for years. The &euro;400 difference between a budget and a mid-range cover often pays for itself in the first few months of sales.</em></p>

                <hr>

                <h2>Finding and Vetting Book Cover Designers in Europe</h2>
                <p>Once you know what you want and roughly what you&rsquo;ll pay, the next step is finding the right designer. This is where most authors either succeed or stumble, and it&rsquo;s worth being systematic about it.</p>

                <h3>Where to Look for Designers</h3>
                <p>Online platforms are the most common starting point. Reedsy is the strongest option for vetted, publishing-specific designers and tends to deliver consistent quality. Upwork and Fiverr give you access to a wider pool of freelance book cover designers in Europe, with a broader price range, but require more careful vetting.</p>
                <p>Professional design directories are an underused resource. National design associations across Europe maintain directories of working professionals, often including book cover specialists. These directories tend to surface more established names than open marketplaces.</p>
                <p>Referrals from other authors in your genre are gold. If you&rsquo;re in any author communities, Facebook groups, Discord servers, writing forums, ask who other indie authors have worked with and how they found the experience. A recommendation from a peer is worth more than any portfolio page.</p>
                <p>Social media is also worth checking. Instagram and Behance are full of designers showcasing recent book cover work. Searching genre-specific hashtags can surface designers you wouldn&rsquo;t otherwise have found.</p>

                <h3>The Vetting Checklist</h3>
                <p>When you have a shortlist of two or three designers, work through this checklist before committing to anyone.</p>
                <p><strong>Portfolio review.</strong> Does their style align with your book&rsquo;s genre? Is the quality consistent across all the work they show, or are there one or two strong pieces with weaker work surrounding them? Do they have experience designing full print wraps, not just eBook fronts?</p>
                <p><strong>Testimonials and references.</strong> Look for reviews from other authors. Check whether designers have repeat clients, which is a strong signal of reliability. If you can, reach out to one or two of their past clients directly and ask about the experience.</p>
                <p><strong>Communication style.</strong> From the very first email, pay attention to how responsive and clear they are. Do they ask insightful questions about your book, your audience, your vision? A designer who asks good questions upfront delivers better work and fewer revisions.</p>
                <p><strong>Understanding your brief.</strong> When you describe your book, do they seem to grasp the essence quickly? Can they articulate how they&rsquo;d approach the project? A designer who can&rsquo;t summarize your vision back to you in their own words isn&rsquo;t ready to design your cover.</p>
                <p><strong>Pricing transparency.</strong> Is the quote detailed? Does it specify what&rsquo;s included and what costs extra? Are revision limits, file formats, and delivery timelines explicit? Vague quotes lead to surprises later, and surprises with money are never the good kind.</p>

                <h3>Red Flags to Watch For</h3>
                <p>A few things should make you walk away.</p>
                <p>Designers who can&rsquo;t show recent work. Designers who refuse to provide a written contract. Designers whose communication is slow or vague in the early stages, which always gets worse, never better. Designers who promise unlimited revisions, because either they&rsquo;re inexperienced enough not to know how draining that becomes, or they don&rsquo;t intend to honor it. And designers whose rates are dramatically below market, which usually means inexperience, lack of professionalism, or both.</p>

                <blockquote><strong><em>Expert Tip</em></strong><em>: Be clear about your budget upfront, but stay open to understanding how specific requests might affect the final cost. The conversation works better when both sides know where they stand.</em></blockquote>

                <p><em>Always confirm whether quotes include VAT, especially when working with designers based inside the EU. We&rsquo;ll cover the VAT situation in detail later, but it can add 20% or more to your final cost if you don&rsquo;t ask.</em></p>

                <hr>

                <h2>The Design Process: From Brief to Final Files</h2>
                <p>Knowing what a typical design process looks like helps you set expectations and spot when something is going off track. Here&rsquo;s how a well-run book cover project usually unfolds.</p>

                <h3>The Design Brief</h3>
                <p>Everything starts with a comprehensive brief. This is the most important document you&rsquo;ll produce, because it&rsquo;s what your designer uses to interpret your vision. A weak brief leads to weak first drafts, more revisions, and a higher final cost.</p>
                <p>A strong brief includes the following: your book&rsquo;s genre and subgenre, your synopsis (a short one of about 200-300 words is ideal), your target audience, the mood and tone you want the cover to convey, three to five example covers you admire and want to learn from, two or three example covers you don&rsquo;t like and want to avoid, any specific imagery or symbolism that&rsquo;s important to the story, technical specifications like trim size, page count for spine calculation, and intended print/digital formats, and your budget range.</p>
                <p>The clearer your brief, the better your first draft. Authors who skip the brief and just say &ldquo;make something good&rdquo; usually end up paying for extra revisions later.</p>

                <h3>Initial Concepts and Feedback</h3>
                <p>Your designer typically presents one to three initial concepts based on the brief. Look at each one carefully, not just for whether you personally like it but for whether it does the job. Does it signal genre correctly? Would it stop a reader scrolling? Does the typography work at thumbnail size? Some readers will only ever see your cover as a postage-stamp-sized image, so it has to work at that scale too.</p>
                <p>Your feedback at this stage should be specific and constructive. Instead of &ldquo;I don&rsquo;t like it,&rdquo; say &ldquo;the typography feels too modern for a historical setting&rdquo; or &ldquo;the central figure feels static, can we explore something with more movement.&rdquo; Specific feedback gives the designer something to work with.</p>

                <h3>Revisions and Refinement</h3>
                <p>The revision rounds are where the design gets sharpened. Stick to the agreed number of rounds, and consolidate your feedback into single, comprehensive responses rather than sending three separate emails as new ideas occur to you.</p>
                <p>If you find yourself wanting more revisions than the package includes, ask about the cost upfront. It&rsquo;s almost always cheaper to pay for an extra round than to settle for a cover you don&rsquo;t love.</p>

                <h3>Approval and Final Files</h3>
                <p>Final delivery should include all the agreed assets: eBook file, print-ready PDF with correct specifications, audiobook cover if commissioned, and any marketing assets included in the package.</p>
                <p>Check everything carefully before signing off. Once the project is closed, requesting changes later usually means starting a new commission.</p>

                <h3>Building Your Own Cost Estimator Brief</h3>
                <p>This isn&rsquo;t an interactive tool, but it&rsquo;s worth thinking of your brief as a kind of internal cost estimator. The clearer you are about what you need, the more accurate the quotes you&rsquo;ll receive will be.</p>
                <p>Ask yourself the following questions before reaching out to designers.</p>
                <p><strong>Genre and target audience.</strong> How visually specific are your needs? A romance reader expects different things from a thriller reader, and your brief should reflect that.</p>
                <p><strong>Desired complexity.</strong> Are you looking at simple typography, photo manipulation, partial illustration, or full custom artwork? Each tier has a different cost profile.</p>
                <p><strong>Required deliverables.</strong> eBook only, full print wrap, audiobook, social media kit? List everything you&rsquo;ll actually use.</p>
                <p><strong>Budget range.</strong> Be honest about what you can spend. A realistic window helps designers tell you quickly whether you&rsquo;re a fit, and saves everyone time.</p>
                <p><strong>Visual preferences.</strong> Have your mood board ready. Three to five reference covers go further than a thousand words of description.</p>
                <p>If you&rsquo;re planning to publish a series, our <a href="<?= link_to('formatting.php') ?>">book formatting service</a> integrates cleanly with cover design briefs and saves coordination time later.</p>

                <hr>

                <h2>Legal and Financial Considerations: Contracts, Rights, and VAT</h2>
                <p>This is the part most authors want to skip, and it&rsquo;s the part where most authors get burned. Spend the twenty minutes here. It will save you problems later.</p>

                <h3>The Importance of a Written Contract</h3>
                <p>Always get a written contract before any work starts. Always. A handshake, an email exchange, a verbal agreement, none of these protect you when something goes wrong, and something occasionally goes wrong even with the best designers.</p>
                <p>A proper contract specifies the following: scope of work and deliverables, timeline including key milestones, number of revisions included, total fee and payment schedule (usually 50% upfront and 50% on delivery), what happens if either party needs to cancel, file formats and resolution standards, and copyright and usage rights.</p>
                <p>If a designer refuses to provide a written contract, walk away. There&rsquo;s no upside to working without one, and the downside can be severe.</p>

                <h3>Copyright and Usage Rights</h3>
                <p>Understanding what you&rsquo;re actually buying matters more than authors usually realize.</p>
                <p>When you commission a book cover, you&rsquo;re usually buying either an exclusive license or full copyright. An exclusive license means the designer retains ownership of the design but grants you sole commercial rights to use it. Full copyright transfer means you own the design outright and the designer can&rsquo;t reuse it.</p>
                <p>Read your contract carefully on this point. If you plan to use the cover on merchandise, foreign editions, audiobook versions, or film tie-ins, you need to make sure those rights are included from the start. Adding them later, after the project is complete, is usually more expensive and sometimes impossible.</p>
                <p>Stock image licensing also matters here. The licenses your designer holds for stock photography don&rsquo;t always transfer cleanly to you, and certain uses (large print runs, merchandise, derivative works) may require additional licensing fees.</p>

                <h3>Navigating VAT in Europe</h3>
                <p>This is the part that genuinely confuses most authors, so let&rsquo;s break it down properly.</p>
                <p>VAT (Value Added Tax) is a consumption tax applied to goods and services across the EU. Rates vary by country: Germany sits at 19%, France at 20%, Spain at 21%, Italy at 22%, and most EU countries fall somewhere in that range. The UK, post-Brexit, sits at 20%.</p>
                <p>For most self-publishing authors, VAT works simply. The designer charges their rate plus VAT at their own country&rsquo;s rate, and you pay it as part of the invoice. So a &euro;500 cover from a French designer becomes &euro;600 once VAT is added. A &euro;500 cover from a Spanish designer becomes &euro;605.</p>
                <p>This applies whether the designer is in your own country or another EU country, since most indie authors are not VAT-registered businesses and are treated as consumers for tax purposes.</p>
                <p>If you&rsquo;re hiring a designer from outside the EU, the rules depend on the designer&rsquo;s country and your own. UK authors hiring EU designers, for example, fall under different rules than they did pre-Brexit. In most cases, VAT is still charged but at varying rates depending on the service and location.</p>
                <p>The practical takeaway is straightforward. VAT is a real cost that you absorb directly, since you can&rsquo;t reclaim it without being VAT-registered. Always confirm whether a quote includes or excludes VAT before agreeing to anything, and factor the tax into your budget from the start rather than treating it as a surprise at the invoice stage.</p>

                <blockquote><strong><em>Expert Tip</em></strong><em>: Always ask whether a quote includes or excludes VAT before agreeing to anything. A &ldquo;&euro;800 cover&rdquo; can suddenly become &ldquo;&euro;960&rdquo; once VAT is added, and that&rsquo;s the kind of surprise that throws budgets off course.</em></blockquote>

                <p>If you&rsquo;re navigating the wider financial picture of publishing, including <a href="<?= link_to('editing.php') ?>">editing budgets</a> and <a href="<?= link_to('marketing.php') ?>">marketing spend</a>, the same VAT logic applies across services.</p>

                <hr>

                <h2>Case Studies: Cost vs Value in European Book Covers</h2>
                <p>Numbers in tables are useful, but seeing how those numbers translate into actual covers is where the lesson really lands. Here are three hypothetical but realistic case studies that show how different budgets produce different outcomes.</p>

                <h3>Case Study 1: The Budget-Friendly Gem (&euro;300 &ndash; &euro;500)</h3>
                <p>Imagine a contemporary romance novel, debut author, modest first print run, modest budget. The author hires a specialist romance designer in Spain who has a strong typographic style and a clean portfolio.</p>
                <p>The concept that emerges is typographic-led, with a single carefully selected stock image as the background, strong custom typography for the title, and clean composition that signals genre instantly. No complex compositing, no custom illustration, no elaborate effects.</p>
                <p>The cost breakdown is straightforward. Standard royalty-free stock image licensing covers the imagery. The designer spends around two hours on photo editing and integration, three hours on typography and layout, and includes two rounds of revisions. Final delivery includes the eBook file and a print-ready file as standard.</p>
                <p>Why it worked: a focused brief, a designer who specializes in the exact genre, and smart use of existing assets rather than trying to invent everything from scratch. The cover does its job. It signals genre, looks professional at thumbnail size, and converts browsing readers into clicks.</p>

                <h3>Case Study 2: The Mid-Range Masterpiece (&euro;700 &ndash; &euro;1,200)</h3>
                <p>Now imagine an urban fantasy novel, second-book author, building a series brand, more ambitious budget. The author hires a designer in Germany known for fantasy and thriller work, with a strong portfolio of compositing.</p>
                <p>The concept involves multiple licensed stock images combined into something that feels original, custom typography that reflects the series brand, subtle atmospheric effects (mist, light treatments), and a partial custom element (a stylized symbol that becomes the series motif).</p>
                <p>The cost breakdown reflects the added complexity. Extended stock image licensing covers the premium imagery used. The designer spends around six hours on photo manipulation and compositing, four hours on custom typography and layout, and includes three rounds of revisions. Deliverables include the eBook file, a full print wrap, and a basic set of social media assets.</p>
                <p>What&rsquo;s added at this tier: significantly more uniqueness, stronger visual immersion, and assets that support the book&rsquo;s launch without requiring separate commissions. For a series build, that consistency pays off across multiple books.</p>

                <h3>Case Study 3: The Premium, Fully Custom Cover (&euro;1,500 &ndash; &euro;3,000+)</h3>
                <p>Finally, picture an epic fantasy novel, established author, major launch, premium budget. The author commissions a designer in the UK who works exclusively in fantasy and partners with a digital illustrator for original artwork.</p>
                <p>The concept is bespoke: a custom-painted scene depicting a key environment from the book, original character work, hand-lettered typography that ties into the visual language of the world, and a full marketing suite including 3D mockups, social media assets, audiobook cover, and promotional materials.</p>
                <p>The cost breakdown reflects the scope. The custom illustration alone takes 20+ hours of artist time. The designer adds another eight hours of compositing and effects work, five hours of custom lettering and typography, and four or more rounds of revisions across both the illustration and design phases. Deliverables include the full asset package.</p>
                <p>Why this tier exists: when the book is the centerpiece of an author&rsquo;s year and the launch needs to make an impact, the unique visual statement justifies the investment. For high-profile fantasy and sci-fi releases, it&rsquo;s often the difference between a launch that gets noticed and one that gets lost.</p>
                <p>The takeaway across all three is the same. The right cover for your book isn&rsquo;t the most expensive one. It&rsquo;s the one that matches your genre, your goals, and your stage as an author.</p>

                <hr>

                <h2>Investing in Your Book&rsquo;s Future</h2>
                <p>Let&rsquo;s bring it all back together.</p>
                <p>A professional book cover is not an expense to minimize. It&rsquo;s an investment that compounds, returning value to you in clicks, sales, reviews, and brand recognition for years after you pay for it. The book cover design cost in Europe varies enormously, from a few hundred euros in Eastern Europe to several thousand for premium custom work in the Nordic countries or the UK, but the principle stays the same across every market: spend enough to be competitive, no less, and ideally a little more.</p>
                <p>The key takeaways from everything we&rsquo;ve covered.</p>
                <p>Costs vary across Europe, driven by designer experience, complexity of design, scope of deliverables, and regional market dynamics. Pricing models, freelancers, agencies, and platforms, each have their place, but most indie authors get the best results from skilled freelance designers found through Reedsy, referrals, or curated marketplaces. Effective budgeting starts with understanding your genre, prioritizing the right design elements, and being honest about what you can spend. Vetting designers properly through portfolio review, references, communication style, and pricing transparency saves you money and disappointment later. And the legal and financial layer, contracts, rights, and VAT, matters more than authors usually realize, especially across borders.</p>
                <p>Your book cover is often the first, and sometimes the only, chance you get to capture a reader&rsquo;s attention. A well-designed cover doesn&rsquo;t just sell books today. It builds your author brand for the long term, supports every marketing campaign you&rsquo;ll ever run, and earns back its cost many times over through compounding sales.</p>
                <p>You&rsquo;ve now got the framework to navigate the European book cover design market with real confidence. Take the next step. Define your vision, set a realistic budget, draft a strong brief, and start the conversation with designers who can bring your book to life.</p>
                <p>If you&rsquo;re looking for end-to-end support across cover design, <a href="<?= link_to('editing.php') ?>">editing</a>, <a href="<?= link_to('ghostwriting.php') ?>">ghostwriting</a>, or full <a href="<?= link_to('publishing.php') ?>">publishing services</a>, the team at <a href="<?= link_to('index.php') ?>"><?= safe(WEBSITE_NAME) ?></a> works with authors at every stage. Your book deserves a cover that earns its place on the shelf. Now you know exactly how to get there.</p>
            </div>

            <div class="blog-sidebar-col">
                <?php include __DIR__ . '/../includes/blog-sidebar.php'; ?>
            </div>
        </div>

        <?php include __DIR__ . '/../includes/blog-author.php'; ?>

        <!-- FAQ -->
        <div class="row mt-5 justify-content-center" data-aos="fade-up">
            <div class="col-lg-9">
                <h2 class="section-title text-center">Frequently Asked <em class="serif-italic">Questions</em></h2>
                <div class="accordion faq-accordion mt-4" id="postFaq">
                    <?php
                    $faqs = [
                        ['q'=>'How much does it cost to design a book cover in Europe?',                                'a'=>'The cost of book cover design in Europe ranges from around &euro;200 for emerging designers handling basic eBook covers to &euro;3,000+ for premium custom-illustrated work. Most indie authors land in the &euro;400-&euro;900 range for a quality professional cover that includes eBook and print files.'],
                        ['q'=>'What are the average freelance book cover design rates in Europe?',                       'a'=>'Freelance book cover design rates in Europe typically sit between &euro;300 and &euro;1,000 for mid-tier work. Eastern European designers often charge &euro;200-&euro;600 for comparable quality, while Western European and Nordic designers usually start at &euro;500 and climb from there.'],
                        ['q'=>'How much does a professional eBook cover design cost?',                                  'a'=>'An eBook cover design price in Europe usually ranges from &euro;150-&euro;600 for a professional, eBook-only cover. Adding print wrap, marketing assets, or custom illustration increases the cost significantly.'],
                        ['q'=>'What factors affect book cover illustration prices in Europe?',                          'a'=>'Book cover illustration prices in Europe are driven by the illustrator&rsquo;s experience, the complexity of the artwork, the number of characters or scenes involved, the level of detail required, and the time commitment, which can range from 15 to 60+ hours for complex pieces.'],
                        ['q'=>'How much does it cost to hire a freelance book cover designer?',                         'a'=>'Hiring a freelance book cover designer in Europe usually costs between &euro;300 and &euro;1,200 for a complete project including eBook and print files. Premium specialists or designers with strong reputations can charge &euro;1,500-&euro;3,000+ for a single project.'],
                        ['q'=>'What is the difference between book cover design and book cover illustration pricing?',  'a'=>'Book cover design typically refers to layout, typography, and the integration of imagery (often stock photography), starting around &euro;200-&euro;800. Book cover illustration involves commissioning original artwork on top of design work, which usually starts at &euro;500 for the illustration alone and climbs based on complexity.'],
                        ['q'=>'How much does Reedsy charge for book cover design in 2026?',                             'a'=>'Reedsy book cover design costs in Europe in 2026 generally fall between &euro;400 and &euro;2,000+, with many projects in the &euro;600-&euro;1,200 range depending on the designer&rsquo;s experience and the scope of work. Rates on the platform are set by individual designers, so it&rsquo;s worth checking current quotes directly. Reedsy designers are vetted, which helps justify the platform&rsquo;s pricing for authors who want quality assurance.'],
                        ['q'=>'Are UK book cover design prices different from other European countries?',               'a'=>'Yes. UK book cover design prices tend to sit at the upper end of the European market alongside Germany, France, the Netherlands, and the Nordic countries. Southern and Central/Eastern Europe usually offer rates 20-40% lower for comparable quality.'],
                        ['q'=>'How much should authors budget for professional book cover design services?',           'a'=>'A realistic budget for professional book cover design in Europe sits between &euro;500 and &euro;1,500 for most indie authors. Authors working on series, complex genres like fantasy or sci-fi, or major launches should budget &euro;1,500-&euro;3,000+ for premium work.'],
                        ['q'=>'Where can I find affordable freelance book cover designers in Europe?',                 'a'=>'The strongest value typically comes from designers based in Central and Eastern Europe (Poland, Czech Republic, Hungary, Romania) and parts of Southern Europe (Spain, Portugal). Platforms like Reedsy, Upwork, and Fiverr offer access to these designers, with Reedsy providing the most curated experience.'],
                    ];
                    foreach ($faqs as $i => $f): ?>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button <?= $i === 0 ? '' : 'collapsed' ?>" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#pfaq<?= $i ?>"
                                    aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>">
                                <span class="faq-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                                <?= $f['q'] ?>
                            </button>
                        </h3>
                        <div id="pfaq<?= $i ?>" class="accordion-collapse collapse <?= $i === 0 ? 'show' : '' ?>" data-bs-parent="#postFaq">
                            <div class="accordion-body"><p><?= $f['a'] ?></p></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="<?= link_to('blog.php') ?>" class="btn btn-outline-dark">&larr; Back to all articles</a>
            <a href="<?= link_to('design.php') ?>" class="btn btn-cta">Explore Cover Design <i class="fa-solid fa-arrow-right"></i></a>
        </div>

    </div>
</section>

<?php
$current_slug = $post['slug'];
include __DIR__ . '/../includes/blog-recent.php';
include __DIR__ . '/../includes/blog-schema.php';
include __DIR__ . '/../includes/final-cta.php';
include __DIR__ . '/../includes/footer.php';
?>

<script>
/* Build the in-article Table of Contents from H2/H3s in the post body */
(function () {
    var body = document.getElementById('blog-post-body');
    var toc  = document.getElementById('blog-toc');
    if (!body || !toc) return;

    var headings = body.querySelectorAll('h2, h3');
    if (!headings.length) return;

    var slugify = function (text) {
        return text.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
    };

    headings.forEach(function (h, i) {
        if (!h.id) h.id = slugify(h.textContent || ('section-' + i));
        var li = document.createElement('li');
        li.className = h.tagName === 'H3' ? 'toc-h3' : 'toc-h2';
        var a  = document.createElement('a');
        a.href = '#' + h.id;
        a.textContent = h.textContent || '';
        li.appendChild(a);
        toc.appendChild(li);
    });

    var links = toc.querySelectorAll('a');
    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                links.forEach(function (l) { l.parentElement.classList.remove('is-active'); });
                var active = toc.querySelector('a[href="#' + entry.target.id + '"]');
                if (active) active.parentElement.classList.add('is-active');
            }
        });
    }, { rootMargin: '-30% 0px -65% 0px' });
    headings.forEach(function (h) { io.observe(h); });
})();
</script>
