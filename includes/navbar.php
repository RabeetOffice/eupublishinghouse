<?php require_once __DIR__ . '/config.php';
$menu = navMenu();

/**
 * Recursive renderer — supports unlimited nesting depth, but the design is
 * tuned for two levels (top-level item + one row of children).
 */
if (!function_exists('renderNavItem')):
function renderNavItem($item, $depth = 0) {
    $hasChildren = !empty($item['children']);
    $isMega      = !empty($item['mega']);
    $activeTree  = navIsActiveTree($item);
    $itemId      = 'nav-' . ($item['key'] ?? md5($item['label']));

    $liClass = 'nav-item';
    if ($hasChildren) $liClass .= ' has-dropdown';
    if ($isMega)      $liClass .= ' has-mega';
    if ($activeTree)  $liClass .= ' is-active-tree';

    echo '<li class="' . safe($liClass) . '">';

    // Top-level link (also acts as dropdown trigger)
    echo '<a href="' . safe($item['href']) . '" '
       . 'class="' . ($activeTree ? 'active' : '') . '" '
       . ($activeTree ? 'aria-current="page" ' : '')
       . ($hasChildren ? 'aria-haspopup="true" aria-expanded="false" aria-controls="' . safe($itemId) . '"' : '')
       . '>';
    echo safe($item['label']);
    if ($hasChildren) {
        echo ' <i class="fa-solid fa-chevron-down nav-caret" aria-hidden="true"></i>';
    }
    echo '</a>';

    if ($hasChildren) {
        $panelClass = 'nav-dropdown' . ($isMega ? ' nav-dropdown--mega' : '');
        echo '<div class="' . safe($panelClass) . '" id="' . safe($itemId) . '" role="menu">';
        echo '<ul class="nav-dropdown__list" role="none">';
        foreach ($item['children'] as $child) {
            $childActive = navIsActiveTree($child);
            echo '<li role="none">';
            echo '<a href="' . safe($child['href']) . '" class="nav-sub' . ($childActive ? ' is-active' : '') . '" role="menuitem">';
            if (!empty($child['icon'])) {
                echo '<span class="nav-sub__icon" aria-hidden="true"><i class="fa-solid ' . safe($child['icon']) . '"></i></span>';
            }
            echo '<span class="nav-sub__body">';
            echo '<strong>' . safe($child['label']) . '</strong>';
            if (!empty($child['desc'])) {
                echo '<small>' . safe($child['desc']) . '</small>';
            }
            echo '</span>';
            echo '<span class="nav-sub__arrow" aria-hidden="true"><i class="fa-solid fa-arrow-right"></i></span>';
            echo '</a>';

            // Recursive nesting if this child has its own children
            if (!empty($child['children'])) {
                echo '<ul class="nav-dropdown__sublist" role="menu">';
                foreach ($child['children'] as $grandchild) {
                    renderNavItem($grandchild, $depth + 2);
                }
                echo '</ul>';
            }
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
    }

    echo '</li>';
}
endif;
?>
<header class="site-header" id="siteHeader">
    <div class="container-fluid">
        <nav class="nav-tri" aria-label="Primary">

            <!-- Pill 1 — Logo -->
            <div class="nav-pill nav-pill--logo">
                <a class="brand" href="index.php" aria-label="<?= safe(WEBSITE_NAME) ?> home">
                    <img src="<?= asset('images/logo.webp') ?>" alt="<?= safe(WEBSITE_NAME) ?>">
                </a>
            </div>

            <!-- Pill 2 — Navigation -->
            <div class="nav-pill nav-pill--menu">
                <ul class="nav-list" id="navList" role="menubar">
                    <li class="nav-drawer-head" aria-hidden="true">
                        <span class="nav-drawer-head__logo">
                            <img src="<?= asset('images/logo.webp') ?>" alt="<?= safe(WEBSITE_NAME) ?>">
                        </span>
                        <button type="button" class="nav-drawer-close" id="navDrawerClose" aria-label="Close menu">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </li>
                    <?php foreach ($menu as $item) renderNavItem($item); ?>
                    <li class="nav-drawer-foot" aria-hidden="true">
                        <a href="contact.php#submit" class="btn btn-cta nav-drawer-cta">
                            Submit Manuscript <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <div class="nav-drawer-contact">
                            <a href="mailto:<?= EMAIL_ADDRESS ?>"><i class="fa-solid fa-envelope"></i> <?= safe(EMAIL_ADDRESS) ?></a>
                            <a href="tel:<?= PHONE_NUMBER_RAW ?>"><i class="fa-solid fa-phone"></i> <?= safe(PHONE_NUMBER) ?></a>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Pill 3 — Phone + Submit CTA + Mobile toggle (transparent, creative) -->
            <div class="nav-pill nav-pill--cta">
                <a href="tel:<?= PHONE_NUMBER_RAW ?>" class="nav-phone" aria-label="Call us">
                    <span class="nav-phone__icon" aria-hidden="true"><i class="fa-solid fa-phone-volume"></i></span>
                    <span class="nav-phone__text">
                        <small>Call our editorial desk</small>
                        <strong><?= safe(PHONE_NUMBER) ?></strong>
                    </span>
                </a>
                <a href="contact.php#submit" class="nav-cta nav-cta--creative">
                    <span class="nav-cta__label">Submit Manuscript</span>
                    <span class="nav-cta__arrow" aria-hidden="true">
                        <i class="fa-solid fa-arrow-right"></i>
                    </span>
                </a>
                <button class="nav-toggle" type="button" aria-label="Open menu" aria-expanded="false" id="navToggle">
                    <span></span><span></span><span></span>
                </button>
            </div>

        </nav>
    </div>
</header>
