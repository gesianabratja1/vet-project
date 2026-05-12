# PutraCare - Projekt veterinar në shqip

PutraCare është një projekt i thjeshtë për një klinikë veterinare, i ndërtuar me **PHP, JavaScript, HTML, CSS dhe MySQL**. Përmbajtja është në gjuhën shqipe dhe përfshin shërbime, këshilla, informacion emergjence dhe formular për rezervim vizite.

## Teknologjitë

- **PHP** - gjeneron faqen, lexon shërbimet/këshillat nga MySQL dhe ruan kërkesat e formularit.
- **MySQL** - ruan shërbimet, këshillat dhe rezervimet.
- **HTML/CSS** - struktura dhe dizajni responsive i faqes.
- **JavaScript** - menuja mobile dhe këshillat interaktive.

## Si ta hapësh projektin

1. Krijo databazën dhe tabelat:

   ```bash
   mysql -u root -p < schema.sql
   ```

2. Nëse përdor kredenciale të tjera, vendos variablat e mjedisit:

   ```bash
   export DB_HOST=127.0.0.1
   export DB_PORT=3306
   export DB_NAME=putracare
   export DB_USER=root
   export DB_PASS=passwordi_yt
   ```

3. Nise serverin lokal të PHP-së:

   ```bash
   php -S localhost:8000
   ```

4. Hape faqen në shfletues:

   ```text
   http://localhost:8000/index.php
   ```

> Nëse MySQL nuk është ndezur, faqja përsëri hapet me të dhëna rezervë, por formulari nuk mund të ruajë rezervime derisa databaza të konfigurohet.

## Strukturë e shkurtër

- `index.php` - faqja kryesore në shqip dhe renderimi i të dhënave nga MySQL.
- `save_appointment.php` - validon dhe ruan rezervimet në tabelën `appointments`.
- `db.php` dhe `config.php` - lidhja me databazën MySQL.
- `schema.sql` - krijon databazën, tabelat dhe të dhënat fillestare.
- `styles.css` - dizajni, ngjyrat dhe përshtatja për celular.
- `script.js` - menuja mobile dhe këshillat interaktive.
