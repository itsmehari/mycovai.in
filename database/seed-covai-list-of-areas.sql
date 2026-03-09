-- MyCovai: Seed "List of Areas" with Coimbatore localities
-- Target DB: metap8ok_mycovai
-- Run after the table exists (e.g. after structure import from MyOMR or after CREATE below).
-- Source: Wikipedia "List of neighbourhoods of Coimbatore", MagicBricks localities.

-- Optional: widen column if your source table has Areas varchar(14) (to fit longer names)
-- ALTER TABLE `List of Areas` MODIFY `Areas` VARCHAR(50) DEFAULT NULL;

-- Use this if the table does NOT exist yet (same structure as MyOMR)
CREATE TABLE IF NOT EXISTS `List of Areas` (
  `Sl No` int(10) NOT NULL AUTO_INCREMENT,
  `Areas` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Sl No`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Clear existing rows if re-running (optional; remove if you want to append)
-- TRUNCATE TABLE `List of Areas`;

INSERT INTO `List of Areas` (`Sl No`, `Areas`) VALUES
(1, 'RS Puram'),
(2, 'Gandhipuram'),
(3, 'Peelamedu'),
(4, 'Ukkadam'),
(5, 'Saibaba Koil'),
(6, 'Townhall'),
(7, 'Rathinapuri'),
(8, 'Tatabad'),
(9, 'Ramnagar'),
(10, 'Singanallur'),
(11, 'Saravanampatti'),
(12, 'Kalapatti'),
(13, 'Podanur'),
(14, 'Sivananda Colony'),
(15, 'Race Course'),
(16, 'Gopalapuram'),
(17, 'Sidhapudur'),
(18, 'Kottaimedu'),
(19, 'Selvapuram'),
(20, 'Avarampalayam'),
(21, 'Sukrawarpettai'),
(22, 'Ramanathapuram'),
(23, 'Vadavalli'),
(24, 'Thudiyalur'),
(25, 'Kuniyamuthur');

-- Add more Coimbatore localities as needed for dropdowns and filters (Phase 5.1).
