<?php
$site_base = '../';
$GLOBALS['site_base']        = $site_base;
$GLOBALS['current_page_key'] = 'blog';

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/blog-data.php';

$current_slug = 'what-is-a-memoir';
$post = blog_get_post($current_slug);

if (!$post) {
    header('HTTP/1.0 404 Not Found');
    echo 'Article not found.';
    exit;
}

$page_title       = 'What Is a Memoir? A Complete Writing Guide for Writers';
$page_description = 'Discover what a memoir is, how it differs from an autobiography, and what it truly takes to sit down and write one well with genuine craft and intention.';
$page_keywords    = 'what is a memoir, memoir vs autobiography, how to write a memoir, memoir writing guide, memoir definition, memoir elements, memoir genre';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/blogs/' . $current_slug . '/';
$og_image         = rtrim(BRAND_SITE_URL, '/') . '/' . ltrim($post['image'], '/');
$og_type          = 'article';
$share_url        = $canonical_url;

require __DIR__ . '/../includes/header.php';

$banner = [
    'crumb' => 'What Is a Memoir?',
    'title' => 'What Is a <em class="serif-italic">Memoir</em>?',
    'sub'   => 'A precise understanding of what a memoir is, what it demands from you as a writer, and what separates it from every other form near it on the shelf.',
];
include __DIR__ . '/../includes/page-banner.php';
?>

<section class="blog-section">
    <div class="container">

        <figure class="blog-feature" data-aos="fade-up">
            <div class="blog-feature__art">
                <img src="<?= safe($post['image']) ?>"
                     alt="<?= safe($post['image_alt']) ?>"
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
                    <span class="post-cat"><?= safe($post['category']) ?> &middot; Memoir</span>
                    <span><i class="fa-regular fa-calendar"></i><?= safe(blog_format_date($post['date'])) ?></span>
                    <span class="meta-divider" aria-hidden="true"></span>
                    <span><i class="fa-regular fa-user"></i><?= safe($post['author']) ?></span>
                    <span class="meta-divider" aria-hidden="true"></span>
                    <span><i class="fa-regular fa-clock"></i><?= safe($post['read']) ?></span>
                </div>

                <p>You have a folder full of old journals. Maybe a Notes app scattered with half-formed memories, fragments of conversations you never quite finished writing down. You know something happened to you that matters. You know, somewhere in your gut, that it deserves to exist on a page.</p>

                <p>But then comes the question that stops most writers cold: what exactly am I writing?</p>

                <p>Is it a memoir? An autobiography? A very long confession? A novel with your name swapped in? The confusion is not a small thing. Without clarity on what a memoir actually is, you risk spending years drafting something that no reader can enter. You risk writing eighty thousand words of therapy when you meant to write literature. You might expose people you love without realising you had the tools to protect them. Or worse, you abandon the whole thing because the genre never felt solid enough to stand on.</p>

                <p>This guide is not here to hype your story or tell you that your voice needs to be &ldquo;unleashed.&rdquo; It is here to give you a precise understanding of what a memoir is, what it demands from you as a writer, and what separates it from every other form that sits near it on the shelf. Whether you want to read memoirs more deeply or write one yourself, the architecture is the same. Let us start building it.</p>

                <h2>What Is a Memoir?</h2>
                <p>A memoir is not a transcript of your suffering. It is not a record of everything that happened to you between two dates. It is not a diary made public, and it is certainly not an autobiography with a softer title.</p>
                <p>A memoir is an argument. It investigates a specific period, relationship, question, or experience from your life and asks: what does this mean? The word itself comes from the French &ldquo;m&eacute;moire,&rdquo; which translates simply to &ldquo;memory&rdquo; or &ldquo;recollection.&rdquo; But the literary form asks far more of memory than simple recollection. It asks you to interrogate it.</p>
                <p>The most important thing to understand when you are trying to define a memoir is that it operates on a narrow lens. You are not writing your entire life. You are writing a slice of it, thematically focused, driven by a central question that you have not yet fully answered. Mary Karr, whose memoir &ldquo;The Liar&rsquo;s Club&rdquo; redefined the genre, has written that memoir asks writers to approach memory as truth told slant, not a complete record, but an honest investigation. Vivian Gornick, whose work on the memoir is essential reading for any serious writer, draws a sharp distinction between what happened and the meaning of what happened. The first is raw material. The second is memoir.</p>
                <p>This distinction matters in a very practical way. If you remove the dates from your manuscript and the meaning collapses, you are not writing a memoir. You are writing a chronicle. Memoir holds together through thematic coherence, not through the passage of time.</p>
                <p>The genre of memoir is also a genre of selection. What you leave out is as important as what you include. Every scene, every digression, every reconstructed piece of dialogue should answer one question: does this serve the controlling idea? If it does not, it does not belong in the book, regardless of how true it is or how much it hurt.</p>

                <h2>Memoir vs. Autobiography vs. Novel: Understanding the Difference</h2>
                <p>One of the most persistent sources of confusion for first-time writers is the difference between an autobiography and a memoir. They are not interchangeable, and treating them as such leads to very different books than the one you intended to write.</p>
                <p>An autobiography is a comprehensive, chronological account of a life. It begins near the beginning and moves forward. It prioritises factual accuracy and historical documentation. It is, in many ways, a record. Politicians write autobiographies. Public figures write autobiographies. The form concerns itself with the arc of an entire life within its social and historical context.</p>
                <p>A memoir is narrower. It does not start at the beginning of your life and end where you are now. It starts at the beginning of a question and ends when that question finds an answer, or at least a resting place. A memoir about addiction does not need to cover your childhood in detail unless your childhood is directly relevant to the question the book is asking. A memoir about grief does not owe the reader a complete biography of the person you lost.</p>
                <p>The difference between autobiography and memoir, put plainly, is this: autobiography documents. Memoir investigates.</p>
                <p>A novel, on the other hand, has no obligation to factual accuracy at all. Invention is its medium. Characters can be composite. Events can be invented entirely. The internal logic of the world the writer creates is the only logic that matters. This is where autofiction, a genre that increasingly complicates these boundaries, begins to live. Autofiction draws on lived experience with the full creative licence of fiction. It does not carry the ethical contract that memoir does.</p>
                <p>That ethical contract is what makes memoir distinct from all three. When you publish a memoir, you are making an implicit agreement with the reader: this happened. You are claiming emotional truth, at the very least. Compression and reconstructed dialogue are accepted tools of the form. Wholesale invention is not.</p>
                <p>If you have been wondering whether your story is more naturally a novel than a memoir, ask yourself this: are you trying to tell the reader what happened, or are you trying to protect yourself from the full consequences of saying what happened? The answer is usually instructive.</p>

                <h2>Is My Story a Memoir? A Diagnostic Framework</h2>
                <p>Not every personal story belongs in a memoir. That is not a discouragement. It is a useful fact that will save you years.</p>
                <p>There are three criteria worth examining before you commit your material to this form.</p>
                <p>The first is thematic cohesion. Does your material cohere around a question rather than a chronology? If you strip away the timeline, does a controlling idea remain? If the only thread holding your chapters together is &ldquo;and then, and then, and then,&rdquo; you are not in memoir territory yet.</p>
                <p>The second is narrative distance. Memoir requires you to write about the past from the vantage point of the present. This does not mean you need decades between you and the events. It means you need enough distance to witness the person you were, rather than simply being that person again on the page. If you are still processing the experience in real time, the writing will feel it. Readers can tell when a writer is narrating from wound rather than from witness.</p>
                <p>The third is the harder one to hear: resonance beyond the self. A memoir is not a private document. It is a public one. The experiences you are writing about need to carry resonance for strangers. That does not mean your life needs to be extraordinary. It means the question your memoir is asking must be one that other human beings are also asking, even if they have never lived your specific circumstances.</p>
                <p>If your material does not yet carry that outward resonance, it does not mean your story is not worth writing. It means it may not yet be a memoir. It may be a private journal, a family document, or the raw material that a few more years of living will eventually shape into something that readers can enter.</p>

                <h2>The Core Literary Elements of a Memoir</h2>
                <p>Once you have established that your material belongs in a memoir, the question shifts from what to write to how.</p>

                <h3>Theme and the Controlling Idea</h3>
                <p>The controlling idea is the spine of your memoir. It is, at its simplest, what happened and what it means. You should be able to write it on a sticky note. Not a paragraph. A sentence.</p>
                <p>&ldquo;This is a memoir about the year I stopped speaking to my mother, and what I learned about the stories families tell to survive.&rdquo; That is a controlling idea. &ldquo;This is a memoir about my complicated life&rdquo; is not.</p>
                <p>When you have your controlling idea written down, check every chapter against it. If a chapter does not serve the controlling idea, it does not belong in the manuscript. This sounds harsh, and it is. But memoir fails most often not because the writer lacked things to say but because they included too many of them.</p>

                <h3>Scene, Summary, and the Specific Moment</h3>
                <p>Memoir lives in specific moments. It dies in summary.</p>
                <p>If you find yourself writing things like &ldquo;we fought for years&rdquo; or &ldquo;that period was the hardest of my life,&rdquo; you are summarising. You are telling the reader what to feel rather than showing them the moment that produced the feeling. The scene-test is simple: zoom in. Find the specific evening, the specific conversation, the specific smell of the room. Put the reader inside the moment rather than above it.</p>
                <p>Sensory details are not decorative in memoir. They are the primary mechanism for unlocking genuine memory and conveying it to a reader who was not there. The smell of a particular cigarette brand. A specific song on a car radio. The texture of a hospital blanket. These are the keys that open scenes most writers only summarise.</p>

                <h3>Voice and Double Vision</h3>
                <p>One of the defining characteristics of memoir as a form is what Vivian Gornick calls the &ldquo;memoirist&rsquo;s double vision.&rdquo; You are simultaneously the person living the experience and the person writing about it now. Both voices are present at once. The tension between them is where the psychological depth of the genre lives.</p>
                <p>Warning signs that you have lost double vision: you are defending yourself rather than observing yourself. You are narrating exactly what you felt at the time without any reflection from the present. You are so inside the experience that there is no room for the reader to arrive with their own interpretation.</p>

                <h3>The Vulnerability Spectrum</h3>
                <p>Memoir does not succeed by revealing everything. It succeeds by calibrating vulnerability with craft. There is a significant difference between disclosure and confession. Disclosure serves the book. Confession serves the writer.</p>
                <p>Know your tender spots. Mark the sections of your draft that are emotionally difficult and return to them when you are psychologically ready. Forced vulnerability reads as performative on the page. The reader can feel when you are oversharing to prove something rather than to illuminate it.</p>

                <h2>Ethics, Memory, and the Law: Navigating Truth and Privacy</h2>
                <p>The ethics of memoir are not a bureaucratic obstacle. They are a craft question.</p>
                <p>Memory is not a recording. Everyone who has written a memoir seriously has confronted the fact that their version of events and someone else&rsquo;s version of the same events are fundamentally different documents. The genre acknowledges this. What it asks is not perfect factual accuracy but fidelity to emotional truth. What you felt, what you understood, what that experience meant to you.</p>
                <p>The James Frey scandal of 2006 remains the most instructive case in recent memoir history. Frey&rsquo;s &ldquo;A Million Little Pieces&rdquo; was exposed as containing fabricated events presented as fact. The fallout was severe. The lesson was not that memoir must be a court transcript. It was that readers have a right to know what kind of truth they are being offered. When compression or composite characters serve the narrative, the ethical move is transparency, either within the text or in an author&rsquo;s note.</p>

                <h3>Protecting the Living</h3>
                <p>Writing about real people is where most first-time memoirists feel the sharpest anxiety. That anxiety is worth taking seriously.</p>
                <p>Changing names, compositing minor characters, and altering identifying details are all legitimate and widely practised tools of the form. They do not compromise the emotional truth of the memoir. What they do is protect people who did not consent to being characters in your book.</p>
                <p>The harder question is what to do with the central figures in your story, particularly family members. There is no universal answer. Some memoirists seek consent. Others do not. Some change enough to shield without distorting. The craft decision and the ethical decision are inseparable here. If changing a detail would undermine the meaning of a scene, the ethical question becomes more complex. Document your decisions in a private reference file. If you are writing about events that could expose you to legal liability, seek a legal review before publication. This is not overcaution. It is professionalism.</p>
                <p>If you are working with a professional <a href="<?= link_to('editing.php') ?>">editing team</a> early in the process, these decisions can be part of the editorial conversation rather than a crisis discovered in the final draft.</p>

                <h2>From First Memory to Finished Draft: A Writing Framework</h2>
                <p>Most guides on memoir writing jump straight to structure. This one will not, because structure is not where most writers stall. Emotional readiness is.</p>
                <p>Imposter syndrome in memoir is almost universal. The thought that your life is not dramatic enough, that you have no right to take up this much space, that the people you love will never forgive you. These fears are not irrational. They deserve to be named before you attempt to outrun them with an outline.</p>

                <h3>Stage One: The Zero Draft</h3>
                <p>Give yourself permission to write badly. The zero draft is not a manuscript. It is a memory excavation. Write non-linearly. Start wherever the emotional charge is highest. Do not worry about where this scene belongs in the final structure. Voice-to-text transcription is useful here, particularly for capturing oral memories or for writers who think more naturally in speech than in prose. Anchor your personal timeline to public events, a year in politics, a cultural moment, a natural disaster. It gives you context and gives future readers a way in.</p>

                <h3>Stage Two: Finding the Architecture</h3>
                <p>Once you have a substantial zero draft, the controlling idea usually reveals itself. If it does not, you are not done excavating. The architecture of your memoir should be driven by meaning, not chronology. Does your narrator change over the course of the book in a way that answers the central question? If not, you do not yet have an arc. You have episodes.</p>

                <h3>Stage Three: The Emotional Truth Audit</h3>
                <p>Go through your zero draft and flag three things. Summaries that need to become scenes. Moments where you need to use composite characters or timeline compression. Gaps in the timeline where memory has genuinely failed you.</p>
                <p>Reconstructed dialogue is one of the most misunderstood tools in memoir. You are not required to remember conversations verbatim. You are required to write what feels emotionally true to the moment, what captured the spirit of what was said. If it sounds like a court transcript, revise it for dramatic truth.</p>

                <h3>Stage Four: Revision and Narrative Distance</h3>
                <p>Read your dialogue aloud. Check every chapter against your controlling idea. Run a scene-versus-summary audit on the full manuscript. Locate the paragraphs that collapse years into a single sentence and ask whether a representative scene would serve the reader better.</p>
                <p>This is also the stage at which many writers benefit from professional <a href="<?= link_to('formatting.php') ?>">book formatting</a> and structural support, particularly if they intend to approach traditional publishers or self-publish with the level of production quality that readers now expect.</p>

                <h3>Stage Five: Micro-Memoir and the Gateway Manuscript</h3>
                <p>If the book-length manuscript feels overwhelming, flash nonfiction and the lyric essay are not lesser forms. They are valid entry points that teach scene construction without the burden of managing a full narrative arc. Many accomplished memoirists published short-form personal essays for years before their first book. If your first container should be shorter, there is no shame in that. The craft is the same.</p>

                <h2>The Memoirist&rsquo;s Toolbox: Books, Software, and Courses</h2>
                <p>Tools should serve the writing. They should not become the project.</p>

                <h3>Essential Craft Books</h3>
                <p>&ldquo;The Art of Memoir&rdquo; by Mary Karr is the definitive craft book in the genre. It is both technically instructive and philosophically serious. Karr does not flinch from the hard ethical questions, and she writes about them with the authority of someone who has lived them.</p>
                <p>&ldquo;The Memoir Project&rdquo; by Marion Roach Smith is the book to read when you are drowning in material and cannot locate the point. It is short, direct, and useful.</p>

                <h3>Digital Organisation and Transcription</h3>
                <p>Scrivener is the most widely recommended tool for long-form memoir writing, particularly for non-linear drafting. Its corkboard view allows you to move scenes around without losing them, which matters enormously when you are working with material that does not want to sit in chronological order.</p>
                <p>Otter.ai is useful for capturing oral memories, interviews with family members, or simply for writers who draft better by speaking than by typing.</p>
                <p>Notion or Evernote both work well as thematic research banks, places to hold character profiles, timeline notes, and the emotional truth audit in one searchable system.</p>

                <h3>Instruction and Editing Support</h3>
                <p>MasterClass memoir courses offer structured video instruction from writers who have published significant memoirs. They are not a substitute for the books above, but they are a useful companion.</p>
                <p>ProWritingAid is useful for maintaining consistent narrative voice across a long draft, particularly if you are revising in sections over a long period and want to check for tonal inconsistencies.</p>
                <p>When evaluating any tool or course, the question to ask is this: does this serve the manuscript, or is it delaying it? The most expensive course is rarely the most necessary one.</p>

                <h2>Reading Like a Writer: Memoirs That Master the Form</h2>
                <p>The best education in memoir craft is reading memoir with attention to how it is made.</p>

                <h3>Subgenre Snapshots</h3>
                <p>The coming-of-age memoir typically anchors itself in the gap between who the narrator was and who they became. Mary Karr&rsquo;s &ldquo;The Liar&rsquo;s Club&rdquo; is a masterclass in this structure, using a child&rsquo;s limited understanding as a narrative lens while the adult writer provides the emotional translation.</p>
                <p>The trauma and resilience memoir carries a particular ethical weight. It must resist the pressure to resolve too neatly. Carmen Maria Machado&rsquo;s &ldquo;In the Dream House,&rdquo; a memoir of an abusive same-sex relationship, is notable for its structural invention, using genre conventions to hold material that might otherwise be too raw to sustain.</p>
                <p>Travel and place memoirs use geography as a mirror. The place is never just the place. It is a way of writing about the self without the self becoming unbearably central.</p>
                <p>Illness and body memoirs grapple directly with the ethics of writing about experiences that are often shared involuntarily with family members who have their own versions of events.</p>

                <h3>Technique in Action</h3>
                <p>When you read a memoir as a writer rather than as a reader, look for three things. First, where does the writer use public events to ground the personal timeline? Historical and cultural touchstones give the reader a handhold and prevent the memoir from feeling sealed in its own private world. Second, where does the writer compress time and how do they signal that compression without falsifying causality? Third, how does the narrator&rsquo;s voice shift between the experiencing self and the reflecting self?</p>
                <p>These are the tools you will eventually use yourself. Reading them in the hands of skilled writers is the best way to learn them.</p>

                <h2>The Memoirist&rsquo;s Journey from Manuscript to Published Book</h2>
                <p>Writing the memoir is one thing. Publishing it is another conversation entirely, and it is worth understanding what happens after the manuscript is finished.</p>
                <p>Traditional publishing requires a book proposal for memoir, usually including a sample of the manuscript, a market analysis, and a chapter outline. The memoir proposal is a distinct form and deserves as much craft attention as the book itself.</p>
                <p>Self-publishing has become a serious option for memoirists, particularly for stories that are too specific in their appeal to attract a major publisher but deeply valuable to the readers who would find them. If you are considering this route, production quality matters. A professionally designed cover, proper interior formatting, and a distribution strategy are not optional extras. They are the difference between a book that reaches readers and a file that sits in a cloud folder. Understanding <a href="<?= link_to('blogs/how-much-does-book-cover-design-cost-in-europe.php') ?>">how book cover design works</a> and what it costs is a practical early step.</p>
                <p>For writers in Europe specifically, the publishing landscape has its own particularities. Knowing <a href="<?= link_to('blogs/top-book-publishers-in-europe.php') ?>">who the major publishers are</a> and how they approach memoir can save you significant time in the querying process. Alternatively, <a href="<?= link_to('blogs/self-publish-on-amazon-kdp-in-europe.php') ?>">self-publishing on platforms like Amazon KDP</a> is an increasingly viable path that many first-time memoirists in Europe are choosing.</p>
                <p>If you are working with a <a href="<?= link_to('ghostwriting.php') ?>">ghostwriting professional</a> to help structure or develop your manuscript, the process is not fundamentally different from writing it yourself. The controlling idea still needs to be yours. The emotional truth still needs to be yours. What the ghostwriter provides is craft support for the translation of that truth into a manuscript that a reader can enter.</p>
                <p>Whether you are working independently or with a <a href="<?= link_to('publishing.php') ?>">publishing team</a>, the <a href="<?= link_to('design.php') ?>">book design</a> phase is something most writers underestimate until they see it handled well. A memoir that is beautifully designed signals to readers before they read the first sentence that the interior will be taken just as seriously. Good book design is not vanity. It is respect for the work.</p>
                <p>Marketing a memoir is a different challenge from marketing genre fiction. Memoir readers are often drawn to specific experiences, specific communities, or specific cultural moments. A targeted <a href="<?= link_to('marketing.php') ?>">marketing strategy</a> that understands who your reader is, and where they already gather, is far more effective than a broad approach. Knowing your reader is not a commercial concession. It is an extension of the same clarity that drives the writing itself.</p>

                <h2>When the Question Finds Its Answer</h2>
                <p>A memoir ends when the central inquiry finds resolution. Not when the writer runs out of material. Not when a certain number of years have passed. When the question the book was asking has been answered, or when the narrator has reached a changed understanding of why it could not be.</p>
                <p>Resist the urge to update the reader on every year that followed. The contract is with the question, not with the entire life. The moment the narrator arrives at a transformed understanding is the moment the book closes. Everything after that belongs to a different book, or to no book at all.</p>
                <p>You do not need an extraordinary life to write a memoir. You need a question you are willing to examine with honesty and craft. You need the discipline to select rather than include, to witness rather than defend, to write scenes rather than summaries. You need the patience to write a zero draft that goes nowhere in particular, and the courage to find the architecture hidden inside it.</p>
                <p>The genre asks a great deal. But what it gives back, when it is done with genuine care, is something no other form of writing can provide: the sense that a particular human life, specific and strange and full of its own private logic, was worth examining at length.</p>
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
                        ['q'=>'What is a memoir?',                                                       'a'=>'A memoir is a focused, thematically driven account of a specific period, relationship, or question from a writer\'s life. It is not a complete biography. It investigates what a particular experience means, not simply what happened during it.'],
                        ['q'=>'How is a memoir different from an autobiography?',                         'a'=>'An autobiography is a comprehensive, chronological account of an entire life, prioritising factual documentation. A memoir focuses on a narrower period or theme and prioritises emotional truth over completeness. Autobiography documents. Memoir investigates.'],
                        ['q'=>'Is a memoir considered a non-fiction genre?',                            'a'=>'Yes. Memoir is a non-fiction genre. It operates under an implicit contract with the reader that the events described are true, or at least emotionally true. Compression and reconstructed dialogue are accepted tools, but wholesale invention is not.'],
                        ['q'=>'What makes a memoir different from a novel?',                             'a'=>'A novel has no obligation to factual accuracy. The writer can invent characters, events, and worlds entirely. A memoir is grounded in real experience and real people, even when those people are given changed names or composited for privacy.'],
                        ['q'=>'What are the key characteristics of a memoir?',                          'a'=>'A memoir is defined by thematic cohesion, a controlling idea, narrative distance between the experiencing self and the writing self, emotional truth, and a specific scope. It uses scenes rather than summaries, and it ends when the central question is answered rather than when the writer runs out of material.'],
                        ['q'=>'Can anyone write a memoir?',                                              'a'=>'Anyone who has lived through something and can locate the meaning of that experience can attempt memoir. What the genre requires is not an extraordinary life but a willingness to examine a specific experience with honesty and craft.'],
                        ['q'=>'What is the main purpose of writing a memoir?',                          'a'=>'The primary purpose is to investigate meaning. A memoir asks: what did this experience mean, and why does it matter beyond my private life? The best memoirs answer that question in a way that allows readers who have never shared the experience to recognise something true in it.'],
                        ['q'=>'Does a memoir have to be completely factual?',                           'a'=>'Not in a verbatim sense. Emotional truth is the standard. Reconstructed dialogue, timeline compression, and composite characters are all accepted within the genre, provided they serve the narrative and do not fundamentally misrepresent what occurred.'],
                        ['q'=>'What should be included in a memoir?',                                    'a'=>'Everything that serves the controlling idea. Scenes that illuminate the central question. Moments of genuine reflection. The specific sensory details that make the experience real to a reader who was not there. What should not be included is anything that is true but irrelevant to the question the book is asking.'],
                        ['q'=>'Is a memoir focused on a person\'s entire life or a specific experience?', 'a'=>'A specific experience, period, or question. That is what distinguishes memoir from autobiography. The scope is narrow by design. The narrowness is not a limitation. It is what gives the form its power.'],
                    ];
                    foreach ($faqs as $i => $f): ?>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button <?= $i === 0 ? '' : 'collapsed' ?>" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#pfaq<?= $i ?>"
                                    aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>">
                                <span class="faq-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                                <?= safe($f['q']) ?>
                            </button>
                        </h3>
                        <div id="pfaq<?= $i ?>" class="accordion-collapse collapse <?= $i === 0 ? 'show' : '' ?>" data-bs-parent="#postFaq">
                            <div class="accordion-body"><p><?= safe($f['a']) ?></p></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="<?= link_to('blog.php') ?>" class="btn btn-outline-dark">&larr; Back to all articles</a>
            <a href="<?= link_to('ghostwriting.php') ?>" class="btn btn-cta">Explore Ghostwriting <i class="fa-solid fa-arrow-right"></i></a>
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

    /* Active-section highlighting */
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
