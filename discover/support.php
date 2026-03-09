<?php require_once __DIR__ . '/../core/omr-connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support | <?php echo defined('SITE_NAME') ? htmlspecialchars(SITE_NAME) : 'MyCovai'; ?> Onboarding</title>
    <meta name="description" content="Need help with <?php echo defined('SITE_NAME') ? htmlspecialchars(SITE_NAME) : 'MyCovai'; ?>? Find answers to common questions or contact our support team for assistance.">
    <meta name="keywords" content="<?php echo defined('SITE_NAME') ? htmlspecialchars(SITE_NAME) : 'MyCovai'; ?>, support, help, FAQ, contact, onboarding">
    <!-- Canonical URL -->
    <link rel="canonical" href="https://mycovai.in/discover/support.php">
    
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
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Support & Help</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                We're here to help! Find answers to common questions or contact our team for assistance.
            </p>
        </section>
        <!-- Areas Covered Section -->
        <section class="bg-green-50 rounded-lg p-6 mb-12">
            <h2 class="text-2xl font-bold text-green-700 mb-2">Areas We Cover</h2>
            <p class="text-gray-700 mb-4"><?php echo defined('SITE_NAME') ? htmlspecialchars(SITE_NAME) : 'MyCovai'; ?> serves Coimbatore, including RS Puram, Gandhipuram, Saibaba Colony, Peelamedu, Race Course, Sungam, Saravanampatti, and more.</p>
            <a href="/discover/areas-covered.php" class="inline-block bg-green-700 text-white px-6 py-2 rounded font-medium hover:bg-green-800 transition-colors">See All Areas</a>
        </section>
        <section class="max-w-3xl mx-auto mb-12 space-y-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold mb-2 text-blue-600">Frequently Asked Questions</h3>
                <ul class="list-disc list-inside text-gray-600 space-y-2">
                    <li>How do I create an account?</li>
                    <li>How can I update my profile?</li>
                    <li>How do I report a civic issue?</li>
                    <li>How do I join a community group?</li>
                    <li>Who do I contact for technical support?</li>
                </ul>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold mb-2 text-blue-600">Contact Support</h3>
                <p class="text-gray-600 mb-2">If you need further assistance, please reach out:</p>
                <ul class="text-gray-600">
                    <li>Email: <a href="mailto:<?php echo defined('CONTACT_EMAIL') ? htmlspecialchars(CONTACT_EMAIL) : 'mycovai@gmail.com'; ?>" class="text-blue-600 underline"><?php echo defined('CONTACT_EMAIL') ? htmlspecialchars(CONTACT_EMAIL) : 'mycovai@gmail.com'; ?></a></li>
                    <li>Phone: <?php echo defined('CONTACT_PHONE_FULL') ? htmlspecialchars(CONTACT_PHONE_FULL) : '+91 94450 88028'; ?></li>
                    <li>Or use our <a href="/contact.php" class="text-blue-600 underline">Contact Form</a></li>
                </ul>
            </div>
        </section>
        <section class="text-center bg-blue-50 rounded-lg p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Back to Onboarding</h2>
            <a href="/info/onboarding/overview.php" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                Overview
            </a>
        </section>
    </main>
    <!-- Footer (same as others) -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4"><?php echo defined('SITE_NAME') ? htmlspecialchars(SITE_NAME) : 'MyCovai'; ?></h3>
                    <p class="text-gray-400">Your community platform for Coimbatore.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="/info/onboarding/overview.php" class="text-gray-400 hover:text-white">Overview</a></li>
                        <li><a href="/info/onboarding/getting-started.php" class="text-gray-400 hover:text-white">Getting Started</a></li>
                        <li><a href="/info/onboarding/features.php" class="text-gray-400 hover:text-white">Features</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="/info/onboarding/community.php" class="text-gray-400 hover:text-white">Community</a></li>
                        <li><a href="/info/onboarding/support.php" class="text-gray-400 hover:text-white">Support</a></li>
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
                <p>&copy; <?php echo date('Y'); ?> <?php echo defined('SITE_NAME') ? htmlspecialchars(SITE_NAME) : 'MyCovai'; ?>. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <!-- Mobile Menu -->
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden" id="mobile-menu">
        <div class="bg-white h-full w-64 p-6">
            <div class="flex justify-between items-center mb-6">
                <a href="/" class="text-2xl font-bold text-blue-600"><?php echo defined('SITE_NAME') ? htmlspecialchars(SITE_NAME) : 'MyCovai'; ?></a>
                <button class="text-gray-600" onclick="toggleMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <nav class="space-y-4">
                <a href="/info/onboarding/overview.php" class="block text-gray-600">Overview</a>
                <a href="/info/onboarding/getting-started.php" class="block text-gray-600">Getting Started</a>
                <a href="/info/onboarding/features.php" class="block text-gray-600">Features</a>
                <a href="/info/onboarding/community.php" class="block text-gray-600">Community</a>
                <a href="/info/onboarding/support.php" class="block text-blue-600 font-medium">Support</a>
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