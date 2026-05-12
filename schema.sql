CREATE DATABASE IF NOT EXISTS putracare
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE putracare;

CREATE TABLE IF NOT EXISTS services (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  icon VARCHAR(16) NOT NULL,
  title VARCHAR(120) NOT NULL,
  description TEXT NOT NULL,
  sort_order INT UNSIGNED NOT NULL DEFAULT 0,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY services_title_unique (title)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS tips (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(120) NOT NULL,
  message TEXT NOT NULL,
  sort_order INT UNSIGNED NOT NULL DEFAULT 0,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY tips_title_unique (title)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS appointments (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  contact VARCHAR(150) NOT NULL,
  pet_type ENUM('Qen', 'Mace', 'Kafshë tjetër') NOT NULL,
  message TEXT NOT NULL,
  status ENUM('new', 'contacted', 'closed') NOT NULL DEFAULT 'new',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO services (icon, title, description, sort_order) VALUES
  ('💉', 'Vaksinime', 'Plan vaksinimi sipas moshës, stilit të jetesës dhe historikut shëndetësor.', 10),
  ('🔬', 'Analiza laboratorike', 'Kontrolle gjaku, urine dhe parazitësh me rezultate të shpejta.', 20),
  ('🦷', 'Kujdes dentar', 'Pastrime, këshilla ushqimi dhe trajtime për frymëmarrje më të freskët.', 30),
  ('🏥', 'Kirurgji të vogla', 'Sterilizime dhe ndërhyrje të sigurta me monitorim gjatë rikuperimit.', 40)
ON DUPLICATE KEY UPDATE
  icon = VALUES(icon),
  description = VALUES(description),
  sort_order = VALUES(sort_order);

INSERT INTO tips (title, message, sort_order) VALUES
  ('Hidratimi', 'Uji i freskët duhet ndërruar çdo ditë, sidomos gjatë verës.', 10),
  ('Ushqimi', 'Kontrollo peshën çdo muaj dhe shmang ushqimin nga tavolina.', 20),
  ('Parandalimi', 'Vaksinat dhe antiparazitarët duhet të ndiqen sipas kalendarit të veterinerit.', 30)
ON DUPLICATE KEY UPDATE
  message = VALUES(message),
  sort_order = VALUES(sort_order);
