<?php
require_once __DIR__ . '/../core/omr-connect.php';
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
        <section class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-green-800 mb-4">Explore Coimbatore</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-6">Find everything you need in Covai: schools, IT companies, banks, hospitals, restaurants, hostels, coworking spaces, and more. Click a category to explore detailed listings.</p>
        </section>
        <section class="grid md:grid-cols-3 gap-8 mb-12">
            <a href="/it-parks" class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center hover:bg-green-50 transition">
                <span class="text-3xl text-green-700 mb-2"><i class="fas fa-building"></i></span>
                <h3 class="text-xl font-semibold mb-2 text-green-800">IT Parks</h3>
                <p class="text-gray-600 text-center">Major IT parks and SEZ campuses in and around Coimbatore.</p>
            </a>
            <a href="/directory/schools.php" class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center hover:bg-green-50 transition">
                <span class="text-3xl text-green-700 mb-2"><i class="fas fa-school"></i></span>
                <h3 class="text-xl font-semibold mb-2 text-green-800">Schools</h3>
                <p class="text-gray-600 text-center">Comprehensive list of schools in Coimbatore.</p>
            </a>
            <a href="/directory/best-schools.php" class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center hover:bg-green-50 transition">
                <span class="text-3xl text-green-700 mb-2"><i class="fas fa-star"></i></span>
                <h3 class="text-xl font-semibold mb-2 text-green-800">Best Schools</h3>
                <p class="text-gray-600 text-center">Top-rated schools for quality education in Covai.</p>
            </a>
            <a href="/directory/it-companies.php" class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center hover:bg-green-50 transition">
                <span class="text-3xl text-green-700 mb-2"><i class="fas fa-laptop-code"></i></span>
                <h3 class="text-xl font-semibold mb-2 text-green-800">IT Companies</h3>
                <p class="text-gray-600 text-center">Major IT and tech companies in Coimbatore.</p>
            </a>
            <a href="/directory/industries.php" class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center hover:bg-green-50 transition">
                <span class="text-3xl text-green-700 mb-2"><i class="fas fa-industry"></i></span>
                <h3 class="text-xl font-semibold mb-2 text-green-800">Industries</h3>
                <p class="text-gray-600 text-center">Key industries and manufacturing units in Covai.</p>
            </a>
            <a href="/directory/restaurants.php" class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center hover:bg-green-50 transition">
                <span class="text-3xl text-green-700 mb-2"><i class="fas fa-utensils"></i></span>
                <h3 class="text-xl font-semibold mb-2 text-green-800">Restaurants</h3>
                <p class="text-gray-600 text-center">Popular restaurants and eateries in Coimbatore.</p>
            </a>
            <a href="/directory/government-offices.php" class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center hover:bg-green-50 transition">
                <span class="text-3xl text-green-700 mb-2"><i class="fas fa-university"></i></span>
                <h3 class="text-xl font-semibold mb-2 text-green-800">Government Offices</h3>
                <p class="text-gray-600 text-center">Important government offices and services in Covai.</p>
            </a>
            <a href="/directory/atms.php" class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center hover:bg-green-50 transition">
                <span class="text-3xl text-green-700 mb-2"><i class="fas fa-credit-card"></i></span>
                <h3 class="text-xl font-semibold mb-2 text-green-800">ATMs</h3>
                <p class="text-gray-600 text-center">ATM locations for all major banks in Coimbatore.</p>
            </a>
            <a href="/directory/parks.php" class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center hover:bg-green-50 transition">
                <span class="text-3xl text-green-700 mb-2"><i class="fas fa-tree"></i></span>
                <h3 class="text-xl font-semibold mb-2 text-green-800">Parks</h3>
                <p class="text-gray-600 text-center">Green spaces and parks for recreation in Covai.</p>
            </a>
            <a href="/directory/banks.php" class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center hover:bg-green-50 transition">
                <span class="text-3xl text-green-700 mb-2"><i class="fas fa-university"></i></span>
                <h3 class="text-xl font-semibold mb-2 text-green-800">Banks</h3>
                <p class="text-gray-600 text-center">All major banks and branches in Coimbatore.</p>
            </a>
            <a href="/directory/hospitals.php" class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center hover:bg-green-50 transition">
                <span class="text-3xl text-green-700 mb-2"><i class="fas fa-hospital"></i></span>
                <h3 class="text-xl font-semibold mb-2 text-green-800">Hospitals</h3>
                <p class="text-gray-600 text-center">Hospitals and healthcare centers in the Covai region.</p>
            </a>
            <a href="/hostels-pgs/" class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center hover:bg-green-50 transition">
                <span class="text-3xl text-green-700 mb-2"><i class="fas fa-bed"></i></span>
                <h3 class="text-xl font-semibold mb-2 text-green-800">Hostels & PGs</h3>
                <p class="text-gray-600 text-center">Find safe and affordable accommodation in Covai for students and professionals.</p>
            </a>
            <a href="/coworking-spaces/" class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center hover:bg-green-50 transition">
                <span class="text-3xl text-green-700 mb-2"><i class="fas fa-building"></i></span>
                <h3 class="text-xl font-semibold mb-2 text-green-800">Coworking Spaces</h3>
                <p class="text-gray-600 text-center">Discover professional workspaces, hot desks, and meeting rooms in Coimbatore.</p>
            </a>
        </section>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/components/footer.php'; ?>
    <script src="https://kit.fontawesome.com/4e9b2b1c0a.js" crossorigin="anonymous"></script>
    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }
    </script>
</body>
</html> 