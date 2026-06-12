<?php
require_once __DIR__ . '/../core/omr-connect.php';
require_once __DIR__ . '/../core/directory-hub-redirect.php';

$home_categories = include __DIR__ . '/../core/homepage-directory-categories.php';
if (!is_array($home_categories)) {
    $home_categories = [];
}

$hub_q = isset($_GET['q']) ? trim((string) $_GET['q']) : '';
$hub_location = isset($_GET['location']) ? trim((string) $_GET['location']) : '';
$hub_category = isset($_GET['category']) ? trim((string) $_GET['category']) : '';

$invalid_category = false;
if ($hub_category !== '') {
    $target = directory_hub_build_url($hub_category, $hub_q, $hub_location);
    if ($target !== null) {
        header('Location: ' . $target, true, 302);
        exit;
    }
    $invalid_category = true;
}

$show_refine = ($hub_q !== '' || $hub_location !== '') && $hub_category === '';
$jobs_hub_params = [];
if ($hub_q !== '') {
    $jobs_hub_params['search'] = $hub_q;
}
if ($hub_location !== '') {
    $jobs_hub_params['location'] = $hub_location;
}
$jobs_hub_url = '/jobs/' . ($jobs_hub_params !== [] ? '?' . http_build_query($jobs_hub_params) : '');

$page_title = defined('SITE_NAME') && defined('SITE_REGION_SHORT') ? 'Explore Covai | ' . SITE_NAME : 'Explore Covai | MyCovai';
$page_description = 'Explore the Coimbatore directory: schools, IT companies, banks, hospitals, restaurants, hostels, coworking spaces and more in Covai.';
$page_keywords = 'Coimbatore, Covai, directory, listings, schools, IT companies, banks, hospitals, restaurants, Tamil Nadu';
$canonical_url = (defined('SITE_CANONICAL_BASE') ? SITE_CANONICAL_BASE : 'https://mycovai.in') . '/directory/index.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($page_keywords); ?>">
    <link rel="canonical" href="<?php echo htmlspecialchars($canonical_url); ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <?php include $_SERVER['DOCUMENT_ROOT'].'/components/main-nav.php'; ?>
    <main class="container mx-auto px-4 py-8" style="max-width: 1280px;">
        <section class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-bold text-green-800 mb-4">Explore Coimbatore</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-6">Find everything you need in Covai: schools, IT companies, banks, hospitals, restaurants, hostels, coworking spaces, and more.</p>

            <form class="max-w-4xl mx-auto mb-6 text-left bg-white rounded-xl shadow-md p-4 md:p-6 border border-gray-100" action="/directory/index.php" method="get" role="search">
                <p class="text-sm font-semibold text-green-900 mb-3">Search the directory</p>
                <div class="grid md:grid-cols-12 gap-3 items-end">
                    <div class="md:col-span-4">
                        <label for="hub-q" class="block text-xs font-medium text-gray-600 mb-1">Keywords</label>
                        <input id="hub-q" type="text" name="q" value="<?php echo htmlspecialchars($hub_q, ENT_QUOTES, 'UTF-8'); ?>" placeholder="School name, bank, park…" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900" autocomplete="off">
                    </div>
                    <div class="md:col-span-4">
                        <label for="hub-location" class="block text-xs font-medium text-gray-600 mb-1">Area</label>
                        <input id="hub-location" type="text" name="location" value="<?php echo htmlspecialchars($hub_location, ENT_QUOTES, 'UTF-8'); ?>" placeholder="e.g. Peelamedu, RS Puram" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900" autocomplete="off">
                    </div>
                    <div class="md:col-span-3">
                        <label for="hub-category" class="block text-xs font-medium text-gray-600 mb-1">Category</label>
                        <select id="hub-category" name="category" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 bg-white">
                            <option value="">All categories (see suggestions below)</option>
                            <?php foreach ($home_categories as $slug => $info): ?>
                                <option value="<?php echo htmlspecialchars($slug, ENT_QUOTES, 'UTF-8'); ?>"<?php echo $hub_category === $slug ? ' selected' : ''; ?>><?php echo htmlspecialchars($info[0], ENT_QUOTES, 'UTF-8'); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="md:col-span-1 flex md:justify-end">
                        <button type="submit" class="w-full md:w-auto whitespace-nowrap rounded-lg bg-green-700 hover:bg-green-800 text-white font-semibold px-4 py-2">Go</button>
                    </div>
                </div>
                <?php if ($invalid_category): ?>
                    <p class="mt-3 text-sm text-red-700" role="alert">That category is not recognized. Choose a category from the list or leave it on “All categories”.</p>
                <?php endif; ?>
            </form>
        </section>

        <?php if ($show_refine): ?>
        <section class="mb-10 max-w-4xl mx-auto rounded-xl border border-green-100 bg-green-50/80 p-5 text-left" aria-labelledby="refine-heading">
            <h2 id="refine-heading" class="text-lg font-semibold text-green-900 mb-2">Open your search in a listing</h2>
            <p class="text-gray-700 text-sm mb-4">Pick a category to run the same keywords and area on the right listing page. For roles and hiring, use jobs.</p>
            <div class="flex flex-wrap gap-2">
                <?php foreach (directory_hub_listing_targets() as $slug => $_meta):
                    $label = isset($home_categories[$slug][0]) ? $home_categories[$slug][0] : ucfirst(str_replace('-', ' ', $slug));
                    $u = directory_hub_build_url($slug, $hub_q, $hub_location);
                    if ($u === null) {
                        continue;
                    }
                    ?>
                    <a href="<?php echo htmlspecialchars($u, ENT_QUOTES, 'UTF-8'); ?>" class="inline-flex items-center rounded-full bg-white px-3 py-1.5 text-sm font-medium text-green-900 shadow-sm ring-1 ring-green-200 hover:bg-green-100"><?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?></a>
                <?php endforeach; ?>
                <a href="<?php echo htmlspecialchars($jobs_hub_url, ENT_QUOTES, 'UTF-8'); ?>" class="inline-flex items-center rounded-full bg-green-800 px-3 py-1.5 text-sm font-medium text-white shadow-sm hover:bg-green-900">Jobs in Covai</a>
            </div>
        </section>
        <?php endif; ?>

        <section class="grid md:grid-cols-3 gap-8 mb-12">
            <?php foreach ($home_categories as $slug => $info):
                $label = $info[0];
                $url = $info[1];
                $icon = $info[2];
                ?>
            <a href="<?php echo htmlspecialchars($url, ENT_QUOTES, 'UTF-8'); ?>" class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center hover:bg-green-50 transition">
                <span class="text-3xl text-green-700 mb-2"><i class="<?php echo htmlspecialchars($icon, ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i></span>
                <h3 class="text-xl font-semibold mb-2 text-green-800"><?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?></h3>
                <p class="text-gray-600 text-center">Browse <?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?> listings across Coimbatore.</p>
            </a>
            <?php endforeach; ?>
        </section>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/components/footer.php'; ?>
    <script src="https://kit.fontawesome.com/4e9b2b1c0a.js" crossorigin="anonymous"></script>
    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenu) mobileMenu.classList.toggle('hidden');
        }
    </script>
</body>
</html>
