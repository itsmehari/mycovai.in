-- Elections 2026 subsite – optional tables for candidates and announcements
-- Run via dev-tools/run-election-2026-migration.php (supports DB_HOST for remote)

CREATE TABLE IF NOT EXISTS election_2026_candidates (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ac_slug VARCHAR(64) NOT NULL,
  party VARCHAR(128) DEFAULT NULL,
  candidate_name VARCHAR(255) NOT NULL,
  bio TEXT DEFAULT NULL,
  photo_url VARCHAR(512) DEFAULT NULL,
  announced_at DATE DEFAULT NULL,
  sort_order SMALLINT UNSIGNED DEFAULT 0,
  source VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  KEY ac_slug (ac_slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS election_2026_announcements (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  announcement_date DATE NOT NULL,
  title VARCHAR(512) NOT NULL,
  source VARCHAR(255) DEFAULT NULL,
  summary TEXT DEFAULT NULL,
  url VARCHAR(512) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  KEY announcement_date (announcement_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
