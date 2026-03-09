<?php
require_once __DIR__ . '/../core/omr-connect.php';
$site_name = defined('SITE_NAME') ? SITE_NAME : 'MyCovai';
$region_short = defined('SITE_REGION_SHORT') ? SITE_REGION_SHORT : 'Covai';
$region_full = defined('SITE_REGION') ? SITE_REGION : 'Coimbatore';
$discover_label = defined('MYCOVAI_CONFIG_LOADED') ? 'Discover ' . $site_name : 'Discover MyCovai';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($discover_label); ?> – Welcome</title>
    <meta name="description" content="<?php echo htmlspecialchars($discover_label); ?> – Your local gateway to news, jobs, events, business listings, and more in <?php echo htmlspecialchars($region_full); ?>. Join the community and get full access for just ₹1 per day!">
    <meta name="keywords" content="<?php echo htmlspecialchars($site_name); ?>, <?php echo htmlspecialchars($region_short); ?> community, <?php echo htmlspecialchars($region_full); ?>, community platform, local news, business listings">
    <!-- Canonical URL -->
    <link rel="canonical" href="https://mycovai.in/discover/overview.php">
    
    <!-- Google Analytics -->
    <?php include '../components/analytics.php'; ?>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <?php include $_SERVER['DOCUMENT_ROOT'].'/components/discover-nav.php'; ?>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Hero Section -->
        <section class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-green-800 mb-4">
                Welcome to <?php echo htmlspecialchars($discover_label); ?>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-4">
                Your local gateway to news, jobs, events, business listings, and more in <?php echo htmlspecialchars($region_full); ?>.
            </p>
            <div class="flex flex-col md:flex-row items-center justify-center gap-8 mt-8">
                <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center">
                    <span class="text-2xl font-bold text-green-700 mb-2">Just ₹1 Per Day</span>
                    <span class="text-gray-600">Full access to all features</span>
                    <img src="/images/omr-city-skyline.jpg" alt="<?php echo htmlspecialchars($region_full); ?> Skyline" class="w-40 h-40 object-cover rounded-full mt-4 mb-2">
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center">
                    <img src="/images/myomr-qr-code.png" alt="<?php echo htmlspecialchars($site_name); ?> QR Code" class="w-32 h-32 mb-2">
                    <span class="text-gray-600">Scan to get started instantly!</span>
                </div>
            </div>
        </section>

        <!-- Areas Covered Section -->
        <section class="bg-green-50 rounded-lg p-6 mb-12">
            <h2 class="text-2xl font-bold text-green-700 mb-2">Areas We Cover</h2>
            <p class="text-gray-700 mb-4"><?php echo htmlspecialchars($site_name); ?> serves <?php echo htmlspecialchars($region_full); ?><?php echo defined('MYCOVAI_CONFIG_LOADED') ? ', including RS Puram, Gandhipuram, Saibaba Colony, Peelamedu, Race Course, Ukkadam, Saravanampatti, and more.' : ', including Perungudi, Thuraipakkam, Karapakkam, Kandhanchavadi, Mettukuppam, Sholinganallur, Navalur, Kelambakkam, and more.'; ?></p>
            <a href="/discover/areas-covered.php" class="inline-block bg-green-700 text-white px-6 py-2 rounded font-medium hover:bg-green-800 transition-colors">See All Areas</a>
        </section>

        <!-- Key Features Grid -->
        <section class="grid md:grid-cols-3 gap-8 mb-12">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold mb-2 text-green-700">Local News & Updates</h3>
                <p class="text-gray-600">Stay informed with the latest news, events, and developments in the <?php echo htmlspecialchars($region_short); ?> community.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold mb-2 text-green-700">Job Search & Local Jobs</h3>
                <p class="text-gray-600">Find and post jobs, connect with local employers, and grow your career in <?php echo htmlspecialchars($region_short); ?>.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold mb-2 text-green-700">Events & Activities</h3>
                <p class="text-gray-600">Discover and participate in local events, festivals, and activities happening around you.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold mb-2 text-green-700">Business Directory</h3>
                <p class="text-gray-600">Explore local businesses, services, and opportunities in the <?php echo htmlspecialchars($region_short); ?> area.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold mb-2 text-green-700">Real Estate Listings</h3>
                <p class="text-gray-600">Browse and post real estate listings for rent, sale, or lease in <?php echo htmlspecialchars($region_short); ?>.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold mb-2 text-green-700">Targeted Advertising</h3>
                <p class="text-gray-600">Promote your business or event to a highly engaged local audience.</p>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="text-center bg-green-50 rounded-lg p-8 mb-12">
            <h2 class="text-2xl font-bold text-green-800 mb-4">Ready to <?php echo htmlspecialchars($discover_label); ?>?</h2>
            <p class="text-gray-600 mb-6">Join our growing community and start exploring all that <?php echo htmlspecialchars($site_name); ?> has to offer.</p>
            <a href="/discover/getting-started.php" class="inline-block bg-green-700 text-white px-6 py-3 rounded-lg font-medium hover:bg-green-800 transition-colors">
                Get Started
            </a>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4"><?php echo htmlspecialchars($discover_label); ?></h3>
                    <p class="text-gray-400">Your local gateway to <?php echo htmlspecialchars($region_full); ?>.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="/discover/overview.php" class="text-gray-400 hover:text-white">Overview</a></li>
                        <li><a href="/discover/getting-started.php" class="text-gray-400 hover:text-white">Get Started</a></li>
                        <li><a href="/discover/features.php" class="text-gray-400 hover:text-white">Features</a></li>
                        <li><a href="/discover/pricing.php" class="text-gray-400 hover:text-white">Pricing</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="/discover/community.php" class="text-gray-400 hover:text-white">Community</a></li>
                        <li><a href="/discover/support.php" class="text-gray-400 hover:text-white">Support</a></li>
                        <li><a href="/discover/it-parks-in-omr.php" class="text-gray-400 hover:text-white">Guide: IT Parks</a></li>
                        <li><a href="//privacy-policy.php" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2">
                        <li class="text-gray-400">Email: <?php echo htmlspecialchars(defined('CONTACT_EMAIL') ? CONTACT_EMAIL : 'mycovai@gmail.com'); ?></li>
                        <li class="text-gray-400">Phone: <?php echo htmlspecialchars(defined('CONTACT_PHONE_FULL') ? CONTACT_PHONE_FULL : '+91 94450 88028'); ?></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($discover_label); ?>. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu (Hidden by default) -->
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden" id="mobile-menu">
        <div class="bg-white h-full w-64 p-6">
            <div class="flex justify-between items-center mb-6">
                <a href="/" class="text-2xl font-bold text-green-700"><?php echo htmlspecialchars($discover_label); ?></a>
                <button class="text-gray-600" onclick="toggleMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <nav class="space-y-4">
                <a href="/discover/overview.php" class="block text-green-700 font-medium">Overview</a>
                <a href="/discover/getting-started.php" class="block text-gray-600">Get Started</a>
                <a href="/discover/features.php" class="block text-gray-600">Features</a>
                <a href="/discover/pricing.php" class="block text-gray-600">Pricing</a>
                <a href="/discover/community.php" class="block text-gray-600">Community</a>
                <a href="/discover/support.php" class="block text-gray-600">Support</a>
            </nav>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }
    </script>
</body>
</html> 