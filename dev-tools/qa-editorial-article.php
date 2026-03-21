<?php
/**
 * QA check for long-form editorial articles.
 * Validates word count, structure, and basic editorial requirements.
 *
 * Usage: php dev-tools/qa-editorial-article.php path/to/article.html
 */
$path = $argv[1] ?? null;
if (!$path || !is_readable($path)) {
    fwrite(STDERR, "Usage: php qa-editorial-article.php path/to/article.html\n");
    exit(1);
}

$html = file_get_contents($path);
$text = strip_tags($html);
$text = preg_replace('/\s+/', ' ', trim($text));
$words = $text === '' ? [] : explode(' ', $text);
$wordCount = count($words);

$requiredH2 = [
    "what happened",
    "stakeholder",
    "policy",
    "context",
    "local impact",
    "what to watch",
];
$foundH2 = [];
if (preg_match_all('/<h2[^>]*>([^<]+)<\/h2>/i', $html, $m)) {
    $foundH2 = array_map('strtolower', array_map('trim', $m[1]));
}

$passed = true;
echo "QA: " . basename($path) . "\n";
echo str_repeat("-", 50) . "\n";

// Word count
$wcOk = $wordCount >= 2000;
echo ($wcOk ? "[PASS]" : "[FAIL]") . " Word count: $wordCount (min 2000)\n";
if (!$wcOk) $passed = false;

// Structure
$hasLead = (bool) preg_match('/<p[^>]*class="lead"/i', $html);
echo ($hasLead ? "[PASS]" : "[WARN]") . " Lead paragraph (class=\"lead\")\n";

$h2Count = count($foundH2);
$h2Ok = $h2Count >= 5;
echo ($h2Ok ? "[PASS]" : "[FAIL]") . " H2 sections: $h2Count (min 5)\n";
if (!$h2Ok) $passed = false;

$hasWhatHappened = false;
$hasStakeholder = false;
$hasImpact = false;
foreach ($foundH2 as $h) {
    if (strpos($h, 'what happened') !== false) $hasWhatHappened = true;
    if (strpos($h, 'stakeholder') !== false) $hasStakeholder = true;
    if (strpos($h, 'impact') !== false) $hasImpact = true;
}
echo ($hasWhatHappened ? "[PASS]" : "[WARN]") . " Section: What happened\n";
echo ($hasStakeholder ? "[PASS]" : "[WARN]") . " Section: Stakeholder perspectives\n";
echo ($hasImpact ? "[PASS]" : "[WARN]") . " Section: Local impact\n";

// Promotional language check (basic)
$promo = preg_match('/\b(exciting|amazing|incredible|revolutionary|game.changer)\b/i', $text);
echo (!$promo ? "[PASS]" : "[WARN]") . " No obvious promotional language\n";

echo str_repeat("-", 50) . "\n";
echo ($passed ? "Overall: PASS" : "Overall: FAIL") . "\n";
exit($passed ? 0 : 1);
