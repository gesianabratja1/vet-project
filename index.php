<?php

declare(strict_types=1);

session_start();
require __DIR__ . '/db.php';

$defaultServices = [
    ['icon' => '💉', 'title' => 'Vaksinime', 'description' => 'Plan vaksinimi sipas moshës, stilit të jetesës dhe historikut shëndetësor.'],
    ['icon' => '🔬', 'title' => 'Analiza laboratorike', 'description' => 'Kontrolle gjaku, urine dhe parazitësh me rezultate të shpejta.'],
    ['icon' => '🦷', 'title' => 'Kujdes dentar', 'description' => 'Pastrime, këshilla ushqimi dhe trajtime për frymëmarrje më të freskët.'],
    ['icon' => '🏥', 'title' => 'Kirurgji të vogla', 'description' => 'Sterilizime dhe ndërhyrje të sigurta me monitorim gjatë rikuperimit.'],
];

$defaultTips = [
    ['title' => 'Hidratimi', 'message' => 'Uji i freskët duhet ndërruar çdo ditë, sidomos gjatë verës.'],
    ['title' => 'Ushqimi', 'message' => 'Kontrollo peshën çdo muaj dhe shmang ushqimin nga tavolina.'],
    ['title' => 'Parandalimi', 'message' => 'Vaksinat dhe antiparazitarët duhet të ndiqen sipas kalendarit të veterinerit.'],
];

$services = fetchRows('services', $defaultServices);
$tips = fetchRows('tips', $defaultTips);
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="sq">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Klinika veterinare PutraCare ofron kontrolle, vaksinime, kirurgji dhe këshilla kujdesi për kafshët shtëpiake në gjuhën shqipe."
    />
    <title>PutraCare | Klinikë Veterinare</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <header class="site-header">
      <nav class="nav" aria-label="Navigimi kryesor">
        <a class="logo" href="#hero" aria-label="PutraCare faqja kryesore">
          <span class="logo__icon" aria-hidden="true">🐾</span>
          PutraCare
        </a>
        <button class="nav__toggle" type="button" aria-expanded="false" aria-controls="nav-menu">
          Menu
        </button>
        <ul class="nav__menu" id="nav-menu">
          <li><a href="#sherbimet">Shërbimet</a></li>
          <li><a href="#rreth-nesh">Rreth nesh</a></li>
          <li><a href="#keshilla">Këshilla</a></li>
          <li><a href="#kontakt">Kontakt</a></li>
        </ul>
      </nav>
    </header>

    <main>
      <section class="hero" id="hero">
        <div class="hero__content">
          <p class="eyebrow">Kujdes i ngrohtë për çdo putër</p>
          <h1>Klinikë veterinare moderne në gjuhën shqipe</h1>
          <p>
            Nga vizitat rutinë deri te emergjencat, ekipi ynë ndihmon qentë, macet dhe
            kafshët e vogla të jetojnë më shëndetshëm e më të lumtur.
          </p>
          <div class="hero__actions">
            <a class="button button--primary" href="#kontakt">Rezervo vizitë</a>
            <a class="button button--secondary" href="#sherbimet">Shiko shërbimet</a>
          </div>
        </div>
        <div class="hero__card" aria-label="Informacion urgjence">
          <span class="hero__emoji" aria-hidden="true">🩺</span>
          <h2>Urgjencë 24/7</h2>
          <p>Na telefono menjëherë për helmime, lëndime, probleme me frymëmarrjen ose dhimbje të forta.</p>
          <a href="tel:+355691234567">+355 69 123 4567</a>
        </div>
      </section>

      <section class="section" id="sherbimet">
        <div class="section__heading">
          <p class="eyebrow">Çfarë ofrojmë</p>
          <h2>Shërbime veterinare</h2>
          <p>Paketa të qarta për pronarët dhe kujdes profesional për kafshët.</p>
        </div>
        <div class="services-grid">
          <?php foreach ($services as $service): ?>
            <article class="service-card">
              <span aria-hidden="true"><?= e($service['icon']) ?></span>
              <h3><?= e($service['title']) ?></h3>
              <p><?= e($service['description']) ?></p>
            </article>
          <?php endforeach; ?>
        </div>
      </section>

      <section class="section split" id="rreth-nesh">
        <div>
          <p class="eyebrow">Rreth nesh</p>
          <h2>Një ekip që dëgjon me kujdes</h2>
          <p>
            PutraCare u krijua për t'u dhënë familjeve shqiptare një vend të besueshëm,
            të qartë dhe miqësor ku mund të marrin përgjigje për shëndetin e kafshëve.
          </p>
          <ul class="check-list">
            <li>Komunikim i thjeshtë dhe i kuptueshëm në shqip</li>
            <li>Plane trajtimi të personalizuara</li>
            <li>Kujdes parandalues për jetë më të gjatë</li>
          </ul>
        </div>
        <div class="stats-card">
          <strong>1,200+</strong>
          <span>pacientë të lumtur çdo vit</span>
          <strong>15 min</strong>
          <span>koha mesatare e përgjigjes për urgjencat</span>
        </div>
      </section>

      <section class="section tips" id="keshilla">
        <div class="section__heading">
          <p class="eyebrow">Këshilla të shpejta</p>
          <h2>Si ta mbash kafshën të shëndetshme</h2>
        </div>
        <div class="tips__list">
          <?php foreach ($tips as $index => $tip): ?>
            <button
              class="tip<?= $index === 0 ? ' is-active' : '' ?>"
              type="button"
              data-tip="<?= e($tip['message']) ?>"
            >
              <?= e($tip['title']) ?>
            </button>
          <?php endforeach; ?>
        </div>
        <p class="tips__message" id="tip-message" aria-live="polite">
          <?= e($tips[0]['message'] ?? 'Zgjidh një këshillë për më shumë informacion.') ?>
        </p>
      </section>

      <section class="section contact" id="kontakt">
        <div>
          <p class="eyebrow">Na kontakto</p>
          <h2>Rezervo një vizitë</h2>
          <p>Plotëso formularin dhe ne do të të kontaktojmë për të konfirmuar orarin.</p>
        </div>
        <form class="contact-form" action="save_appointment.php" method="post">
          <label>
            Emri
            <input type="text" name="name" placeholder="Emri yt" maxlength="100" required />
          </label>
          <label>
            Telefoni ose emaili
            <input type="text" name="contact" placeholder="p.sh. +355 69 123 4567" maxlength="150" required />
          </label>
          <label>
            Lloji i kafshës
            <select name="pet_type" required>
              <option value="">Zgjidh një opsion</option>
              <option value="Qen">Qen</option>
              <option value="Mace">Mace</option>
              <option value="Kafshë tjetër">Kafshë tjetër</option>
            </select>
          </label>
          <label>
            Mesazhi
            <textarea name="message" rows="4" maxlength="1000" placeholder="Përshkruaj arsyen e vizitës" required></textarea>
          </label>
          <button class="button button--primary" type="submit">Dërgo kërkesën</button>
          <p class="form-status <?= $flash ? 'form-status--' . e($flash['type']) : '' ?>" role="status" aria-live="polite">
            <?= $flash ? e($flash['message']) : '' ?>
          </p>
        </form>
      </section>
    </main>

    <footer class="site-footer">
      <p>© 2026 PutraCare. Të gjitha të drejtat e rezervuara.</p>
      <p>Rruga e Kafshëve 12, Tiranë • info@putracare.al</p>
    </footer>

    <script src="script.js"></script>
  </body>
</html>
