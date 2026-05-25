<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../recaptcha.php';
?>
<form class="footer-newsletter site-form" action="<?= safe(link_to('form-submission.php')) ?>" method="post" data-form-action="newsletter_signup">
    <label for="nlEmail">Receive new releases &amp; essays</label>
    <div class="nl-wrap">
        <input id="nlEmail" name="email" type="email" placeholder="you@somewhere.com" required>
        <button type="submit" aria-label="Subscribe"><i class="fa-solid fa-arrow-right"></i></button>
    </div>
    <input type="hidden" name="form_type" value="newsletter">
    <input type="hidden" name="source_page" value="">
    <?php recaptcha_field('newsletter_signup'); ?>
</form>
