<?php require_once __DIR__ . '/../core/omr-connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Areas Covered | Discover <?php echo defined('SITE_NAME') ? htmlspecialchars(SITE_NAME) : 'MyCovai'; ?></title>
    <meta name="description" content="See all the neighborhoods and regions covered by <?php echo defined('SITE_NAME') ? htmlspecialchars(SITE_NAME) : 'MyCovai'; ?> in Coimbatore.">
    <meta name="keywords" content="<?php echo defined('SITE_NAME') ? htmlspecialchars(SITE_NAME) : 'MyCovai'; ?>, Coimbatore, Covai, areas covered, neighborhoods, RS Puram, Gandhipuram">
    <!-- Canonical URL -->
    <link rel="canonical" href="https://mycovai.in/discover/areas-covered.php">
    
    <!-- Google Analytics -->
    <?php include '../components/analytics.php'; ?>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <?php include $_SERVER['DOCUMENT_ROOT'].'/components/discover-nav.php'; ?>
    <main class="container mx-auto px-4 py-8">
        <section class="bg-green-50 rounded-lg p-8 mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-green-700 mb-4">Areas We Cover</h1>
            <p class="text-lg text-gray-700 mb-6">Discover <?php echo defined('SITE_NAME') ? htmlspecialchars(SITE_NAME) : 'MyCovai'; ?> serves Coimbatore and its vibrant neighborhoods. We connect residents, businesses, and communities across all these areas:</p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white rounded shadow p-4 text-center font-semibold text-green-800">RS Puram</div>
                <div class="bg-white rounded shadow p-4 text-center font-semibold text-green-800">Gandhipuram</div>
                <div class="bg-white rounded shadow p-4 text-center font-semibold text-green-800">Saibaba Colony</div>
                <div class="bg-white rounded shadow p-4 text-center font-semibold text-green-800">Peelamedu</div>
                <div class="bg-white rounded shadow p-4 text-center font-semibold text-green-800">Race Course</div>
                <div class="bg-white rounded shadow p-4 text-center font-semibold text-green-800">Ukkadam</div>
                <div class="bg-white rounded shadow p-4 text-center font-semibold text-green-800">Sungam</div>
                <div class="bg-white rounded shadow p-4 text-center font-semibold text-green-800">Saravanampatti</div>
                <div class="bg-white rounded shadow p-4 text-center font-semibold text-green-800">Kovaipudur</div>
                <div class="bg-white rounded shadow p-4 text-center font-semibold text-green-800">Tatabad</div>
                <div class="bg-white rounded shadow p-4 text-center font-semibold text-green-800">Avinashi Road</div>
                <div class="bg-white rounded shadow p-4 text-center font-semibold text-green-800">Trichy Road</div>
                <div class="bg-white rounded shadow p-4 text-center font-semibold text-green-800">Sitra</div>
                <div class="bg-white rounded shadow p-4 text-center font-semibold text-green-800">Kuniyamuthur</div>
                <div class="bg-white rounded shadow p-4 text-center font-semibold text-green-800">Other Covai Neighborhoods</div>
            </div>
            <p class="text-gray-600 mt-8">If your area is not listed, let us know! We're always expanding our coverage to serve the entire Coimbatore community.</p>
        </section>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/components/footer.php'; ?>
    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }
    </script>
</body>
</html> 