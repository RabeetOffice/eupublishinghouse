<?php require_once __DIR__ . '/config.php';
$menu = navMenu();
?>
<!-- ============== DESKTOP NAV ============== -->
<nav class="top" id="topNav" aria-label="Primary">
    <div class="wrap">

        <a class="brand" href="index.php" aria-label="<?= safe(WEBSITE_NAME) ?> home">
            <img src="<?= asset('images/logo.webp') ?>" alt="<?= safe(WEBSITE_NAME) ?>" loading="lazy" decoding="async">
        </a>

        <div class="navlinks" role="menubar">
            <?php foreach ($menu as $item):
                $hasKids  = !empty($item['children']);
                $isMega   = !empty($item['mega']);
                $isActive = navIsActiveTree($item);
            ?>
                <?php if ($hasKids): ?>
                    <div class="nav-item has-dd <?= $isActive ? 'is-active' : '' ?>">
                        <a class="<?= $isActive ? 'is-active' : '' ?>"
                           href="<?= safe($item['href']) ?>"
                           role="menuitem"
                           aria-haspopup="true"
                           aria-expanded="false">
                            <?= safe($item['label']) ?>
                            <i class="fa-solid fa-chevron-down nav-caret" aria-hidden="true"></i>
                        </a>
                        <ul class="nav-dd <?= $isMega ? 'nav-dd--wide' : '' ?>" role="menu">
                            <?php foreach ($item['children'] as $child): ?>
                                <li role="none">
                                    <a role="menuitem" href="<?= safe($child['href']) ?>">
                                        <?php if (!empty($child['icon'])): ?>
                                            <i class="fa-solid <?= safe($child['icon']) ?>"></i>
                                        <?php endif; ?>
                                        <div>
                                            <b><?= safe($child['label']) ?></b>
                                            <?php if (!empty($child['desc'])): ?>
                                                <span><?= safe($child['desc']) ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php else: ?>
                    <a class="<?= $isActive ? 'is-active' : '' ?>"
                       href="<?= safe($item['href']) ?>"
                       role="menuitem"><?= safe($item['label']) ?></a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="navactions">
            <a href="tel:<?= PHONE_NUMBER_RAW ?>" class="nav-phone-btn" aria-label="Call <?= safe(PHONE_NUMBER) ?>">
                <i class="fa-solid fa-phone-volume" aria-hidden="true"></i>
            </a>
            <a class="btn btn-cta nav-cta" href="#popup" data-popup>
                <span class="lbl lbl--long">Submit Manuscript</span>
                <span class="lbl lbl--short">Submit</span>
                <span class="arr" aria-hidden="true">&rarr;</span>
            </a>
            <button class="navtoggle" type="button"
                    aria-label="Open menu"
                    aria-expanded="false"
                    aria-controls="mobileMenu"
                    id="navToggle">
                <span></span><span></span><span></span>
            </button>
        </div>

    </div>
</nav>

<!-- ============== MOBILE SLIDE-IN MENU ============== -->
<div class="mobile-overlay" id="mobileOverlay" aria-hidden="true"></div>
<aside class="mobile-menu" id="mobileMenu" aria-hidden="true">
    <div class="mm-head">
        <a class="brand" href="index.php" aria-label="<?= safe(WEBSITE_NAME) ?> home">
            <img src="<?= asset('images/logo.webp') ?>" alt="<?= safe(WEBSITE_NAME) ?>" loading="lazy" decoding="async">
        </a>
        <button class="mm-close" type="button" aria-label="Close menu" id="navDrawerClose">
            <i class="fa-solid fa-xmark" aria-hidden="true"></i>
        </button>
    </div>

    <nav class="mm-links" aria-label="Mobile">
        <?php foreach ($menu as $item):
            $hasKids  = !empty($item['children']);
            $isActive = navIsActiveTree($item);
        ?>
            <?php if ($hasKids): ?>
                <div class="mm-group <?= $isActive ? 'is-active' : '' ?>">
                    <button type="button" class="mm-trigger" aria-expanded="false">
                        <span><?= safe($item['label']) ?></span>
                        <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
                    </button>
                    <div class="mm-sub">
                        <a href="<?= safe($item['href']) ?>">All <?= safe($item['label']) ?></a>
                        <?php foreach ($item['children'] as $child): ?>
                            <a href="<?= safe($child['href']) ?>"><?= safe($child['label']) ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <a class="<?= $isActive ? 'is-active' : '' ?>" href="<?= safe($item['href']) ?>"><?= safe($item['label']) ?></a>
            <?php endif; ?>
        <?php endforeach; ?>
    </nav>

    <div class="mm-cta">
        <a class="btn btn-cta" href="#popup" data-popup>
            Submit Manuscript <span class="arr" aria-hidden="true">&rarr;</span>
        </a>
        <a class="btn btn-outline-dark" href="contact.php">Contact Us</a>
    </div>

    <div class="mm-foot">
        <a href="tel:<?= PHONE_NUMBER_RAW ?>"><i class="fa-solid fa-phone"></i> <?= safe(PHONE_NUMBER) ?></a>
        <a href="mailto:<?= EMAIL_ADDRESS ?>"><i class="fa-solid fa-envelope"></i> <?= safe(EMAIL_ADDRESS) ?></a>
    </div>
</aside>
