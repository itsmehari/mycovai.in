<?php
/**
 * Build MyCovai main database file (structure only + Coimbatore List of Areas seed).
 * Per conversion plan: MyOMR → MyCovai (empty tables, Coimbatore areas only).
 */

$inFile  = __DIR__ . '/metap8ok_myomr.sql';
$outFile = __DIR__ . '/metap8ok_mycovai-main.sql';

if (!is_readable($inFile)) {
    die("Cannot read: $inFile\n");
}

$fp = fopen($inFile, 'r');
$out = fopen($outFile, 'w');

// Write MyCovai header
fwrite($out, "-- MyCovai main database (structure only + Coimbatore seed)\n");
fwrite($out, "-- Generated from MyOMR per conversion plan. Target: metap8ok_mycovai\n");
fwrite($out, "-- No Chennai/OMR data; List of Areas = Coimbatore localities only.\n");
fwrite($out, "-- \n");
fwrite($out, "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n");
fwrite($out, "SET time_zone = \"+00:00\";\n");
fwrite($out, "SET NAMES utf8mb4;\n\n");

$inInsert = false;
$lineNum = 0;

while (($line = fgets($fp)) !== false) {
    $lineNum++;
    $trimmed = trim($line);

    // Start of INSERT - skip this and all following lines until we see ); or line ending with ;
    if (preg_match('/^\s*INSERT\s+INTO\s+/i', $line)) {
        $inInsert = true;
        continue;
    }
    if ($inInsert) {
        // End of INSERT: line ends with ); or just ;
        if (preg_match('/\)\s*;\s*$/', $line) || (preg_match('/;\s*$/', $trimmed) && substr_count($line, ')') > 0)) {
            $inInsert = false;
        }
        continue;
    }

    // Skip "Dumping data for table" comment
    if (preg_match('/^--\s*Dumping data for table/i', $line)) {
        continue;
    }

    // Strip AUTO_INCREMENT=N from ALTER MODIFY lines (start fresh)
    if (preg_match('/,\s*AUTO_INCREMENT=\d+/', $line)) {
        $line = preg_replace('/,\s*AUTO_INCREMENT=\d+/', '', $line);
    }

    // Point database comment to MyCovai
    $line = preg_replace('/Database:\s*`metap8ok_myomr`/', 'Database: `metap8ok_mycovai`', $line);

    fwrite($out, $line);
}

fclose($fp);

// Append Coimbatore List of Areas seed
fwrite($out, "\n\n-- =============================================================================\n");
fwrite($out, "-- MyCovai: Coimbatore 'List of Areas' seed (Phase 5.1)\n");
fwrite($out, "-- =============================================================================\n\n");
fwrite($out, "ALTER TABLE `List of Areas` MODIFY `Areas` VARCHAR(50) DEFAULT NULL;\n\n");
fwrite($out, "INSERT INTO `List of Areas` (`Sl No`, `Areas`) VALUES\n");
fwrite($out, "(1, 'RS Puram'),\n(2, 'Gandhipuram'),\n(3, 'Peelamedu'),\n(4, 'Ukkadam'),\n(5, 'Saibaba Koil'),\n");
fwrite($out, "(6, 'Townhall'),\n(7, 'Rathinapuri'),\n(8, 'Tatabad'),\n(9, 'Ramnagar'),\n(10, 'Singanallur'),\n");
fwrite($out, "(11, 'Saravanampatti'),\n(12, 'Kalapatti'),\n(13, 'Podanur'),\n(14, 'Sivananda Colony'),\n(15, 'Race Course'),\n");
fwrite($out, "(16, 'Gopalapuram'),\n(17, 'Sidhapudur'),\n(18, 'Kottaimedu'),\n(19, 'Selvapuram'),\n(20, 'Avarampalayam'),\n");
fwrite($out, "(21, 'Sukrawarpettai'),\n(22, 'Ramanathapuram'),\n(23, 'Vadavalli'),\n(24, 'Thudiyalur'),\n(25, 'Kuniyamuthur');\n");

fclose($out);

echo "Done. Output: $outFile\n";
