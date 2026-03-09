<?php require_once __DIR__ . '/../core/omr-connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discover <?php echo defined('SITE_NAME') ? htmlspecialchars(SITE_NAME) : 'MyCovai'; ?> - Community</title>
    <meta name="description" content="Join the Discover <?php echo defined('SITE_NAME') ? htmlspecialchars(SITE_NAME) : 'MyCovai'; ?> community – connect with neighbors, participate in forums, events, and local groups. Help shape Coimbatore!">
    <meta name="keywords" content="<?php echo defined('SITE_NAME') ? htmlspecialchars(SITE_NAME) : 'MyCovai'; ?>, community, Coimbatore, Covai, groups, forums, connect">
    <!-- Canonical URL -->
    <link rel="canonical" href="https://mycovai.in/discover/community.php">
    
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
        <section class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-green-800 mb-4">
                Join the Discover <?php echo defined('SITE_NAME') ? htmlspecialchars(SITE_NAME) : 'MyCovai'; ?> Community
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-6">
                Connect with neighbors, participate in forums and events, and help shape the future of Coimbatore.
            </p>
        </section>
        <!-- Areas Covered Section -->
        <section class="bg-green-50 rounded-lg p-6 mb-12">
            <h2 class="text-2xl font-bold text-green-700 mb-2">Areas We Cover</h2>
            <p class="text-gray-700 mb-4"><?php echo defined('SITE_NAME') ? htmlspecialchars(SITE_NAME) : 'MyCovai'; ?> serves Coimbatore, including RS Puram, Gandhipuram, Saibaba Colony, Peelamedu, Race Course, Sungam, Saravanampatti, Kovaipudur, and more.</p>
            <a href="/discover/areas-covered.php" class="inline-block bg-green-700 text-white px-6 py-2 rounded font-medium hover:bg-green-800 transition-colors">See All Areas</a>
        </section>
        <section class="grid md:grid-cols-3 gap-8 mb-12">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold mb-2 text-green-700">Community Forums</h3>
                <p class="text-gray-600">Join discussions, ask questions, and share your thoughts with fellow residents.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold mb-2 text-green-700">Events & Meetups</h3>
                <p class="text-gray-600">Participate in local events, meetups, and activities to connect in person.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold mb-2 text-green-700">Volunteering</h3>
                <p class="text-gray-600">Get involved in community projects and make a positive impact in Covai.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold mb-2 text-green-700">Local Groups</h3>
                <p class="text-gray-600">Find and join groups based on your interests, location, or profession.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold mb-2 text-green-700">Feedback & Suggestions</h3>
                <p class="text-gray-600">Share your ideas and feedback to help us improve the platform and the community.</p>
            </div>
        </section>
        <section class="text-center bg-green-50 rounded-lg p-8 mb-12">
            <h2 class="text-2xl font-bold text-green-800 mb-4">Ready to Get Involved?</h2>
            <p class="text-gray-600 mb-6">Sign up, join a group, or participate in an event today!</p>
            <a href="/discover/getting-started.php" class="inline-block bg-green-700 text-white px-6 py-3 rounded-lg font-medium hover:bg-green-800 transition-colors">
                Get Started
            </a>
        </section>
    </main>
    <!-- Footer (same as others) -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Discover <?php echo defined('SITE_NAME') ? htmlspecialchars(SITE_NAME) : 'MyCovai'; ?></h3>
                    <p class="text-gray-400">Your local gateway to Coimbatore.</p>
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
                        <li><a href="//privacy-policy.php" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2">
                        <li class="text-gray-400">Email: <?php echo defined('CONTACT_EMAIL') ? htmlspecialchars(CONTACT_EMAIL) : 'mycovai@gmail.com'; ?></li>
                        <li class="text-gray-400">Phone: <?php echo defined('CONTACT_PHONE_FULL') ? htmlspecialchars(CONTACT_PHONE_FULL) : '+91 94450 88028'; ?></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; <?php echo date('Y'); ?> Discover <?php echo defined('SITE_NAME') ? htmlspecialchars(SITE_NAME) : 'MyCovai'; ?>. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <!-- Mobile Menu -->
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden" id="mobile-menu">
        <div class="bg-white h-full w-64 p-6">
            <div class="flex justify-between items-center mb-6">
                <a href="/" class="text-2xl font-bold text-green-700">Discover <?php echo defined('SITE_NAME') ? htmlspecialchars(SITE_NAME) : 'MyCovai'; ?></a>
                <button class="text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <nav class="space-y-4">
                <a href="/discover/overview.php" class="block text-gray-600">Overview</a>
                <a href="/discover/getting-started.php" class="block text-gray-600">Get Started</a>
                <a href="/discover/features.php" class="block text-gray-600">Features</a>
                <a href="/discover/pricing.php" class="block text-gray-600">Pricing</a>
                <a href="/discover/community.php" class="block text-gray-600">Community</a>
                <a href="/discover/support.php" class="block text-gray-600">Support</a>
            </nav>
        </div>
    </div>
    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }
    </script>
</body>
</html> 