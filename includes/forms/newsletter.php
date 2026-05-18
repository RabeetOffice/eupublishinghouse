<?php require_once __DIR__ . '/../config.php'; ?>
<form class="footer-newsletter" onsubmit="event.preventDefault();">
    <label for="nlEmail">Receive new releases &amp; essays</label>
    <div class="nl-wrap">
        <input id="nlEmail" type="email" placeholder="you@somewhere.com" required>
        <button type="submit" aria-label="Subscribe"><i class="fa-solid fa-arrow-right"></i></button>
    </div>
</form>
