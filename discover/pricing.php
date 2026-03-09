<?php
require_once __DIR__ . '/../core/omr-connect.php';
$site_name = defined('SITE_NAME') ? SITE_NAME : 'MyCovai';
$region_short = defined('SITE_REGION_SHORT') ? SITE_REGION_SHORT : 'Covai';
$discover_label = defined('MYCOVAI_CONFIG_LOADED') ? 'Discover ' . $site_name : 'Discover MyCovai';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing | <?php echo htmlspecialchars($discover_label); ?></title>
    <meta name="description" content="Choose the best plan for your <?php echo htmlspecialchars($site_name); ?> experience. Daily, monthly, yearly, and lifetime packages available for the <?php echo htmlspecialchars($region_short); ?> community.">
    <meta name="keywords" content="<?php echo htmlspecialchars($site_name); ?>, pricing, plans, subscription, <?php echo htmlspecialchars($region_short); ?> community">
    <!-- Canonical URL -->
    <link rel="canonical" href="https://mycovai.in/discover/pricing.php">
    
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
        <!-- Pricing Section -->
        <section class="bg-green-600 rounded-lg p-8 mb-12 flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="md:w-1/2 text-white mb-8 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Choose Your Pricing Plan</h1>
                <p class="text-lg mb-6">Flexible plans for every <?php echo htmlspecialchars($region_short); ?> community member. Get full access to news, jobs, events, business listings, and more!</p>
                <div class="flex gap-4 mb-6">
                    <button class="bg-white text-green-700 font-bold px-6 py-2 rounded shadow">MONTHLY</button>
                    <button class="bg-green-700 text-white font-bold px-6 py-2 rounded shadow">YEARLY</button>
                </div>
                <p class="text-white text-opacity-80">All plans include community access, business directory, events, and support.</p>
            </div>
            <div class="md:w-1/2 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Daily -->
                <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center">
                    <span class="text-lg font-bold text-green-700 mb-1">Daily</span>
                    <span class="text-gray-600 mb-2">One Day Access</span>
                    <span class="text-3xl font-bold text-green-700 mb-2">₹1</span>
                    <ul class="text-gray-600 text-sm mb-4 space-y-1">
                        <li>24-hour full access</li>
                        <li>Read news & events</li>
                        <li>Browse business directory</li>
                        <li>Basic community forum access</li>
                    </ul>
                    <button class="bg-green-700 text-white font-bold px-6 py-2 rounded w-full">BUY NOW</button>
                </div>
                <!-- Monthly -->
                <div class="bg-green-50 rounded-lg shadow-md p-6 flex flex-col items-center">
                    <span class="text-lg font-bold text-green-700 mb-1">Monthly</span>
                    <span class="text-gray-600 mb-2">Subscription</span>
                    <span class="text-3xl font-bold text-green-700 mb-2">₹25</span>
                    <ul class="text-gray-600 text-sm mb-4 space-y-1">
                        <li>30-day unlimited access</li>
                        <li>Post in forums & events</li>
                        <li>Priority support</li>
                        <li>Exclusive member events</li>
                    </ul>
                    <button class="bg-green-700 text-white font-bold px-6 py-2 rounded w-full">BUY NOW</button>
                </div>
                <!-- Yearly -->
                <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center">
                    <span class="text-lg font-bold text-green-700 mb-1">Yearly</span>
                    <span class="text-gray-600 mb-2">Best Value</span>
                    <span class="text-3xl font-bold text-green-700 mb-2">₹199</span>
                    <ul class="text-gray-600 text-sm mb-4 space-y-1">
                        <li>365-day unlimited access</li>
                        <li>Annual member badge</li>
                        <li>Early access to new features</li>
                        <li>Business listing highlights</li>
                    </ul>
                    <button class="bg-green-700 text-white font-bold px-6 py-2 rounded w-full">BUY NOW</button>
                </div>
                <!-- Lifetime -->
                <div class="bg-green-50 rounded-lg shadow-md p-6 flex flex-col items-center">
                    <span class="text-lg font-bold text-green-700 mb-1">Lifetime</span>
                    <span class="text-gray-600 mb-2">One-Time Payment</span>
                    <span class="text-3xl font-bold text-green-700 mb-2">₹499</span>
                    <ul class="text-gray-600 text-sm mb-4 space-y-1">
                        <li>Lifetime access</li>
                        <li>VIP badge & support</li>
                        <li>All future updates</li>
                        <li>Free event & job postings</li>
                    </ul>
                    <button class="bg-green-700 text-white font-bold px-6 py-2 rounded w-full">BUY NOW</button>
                </div>
            </div>
        </section>
        <!-- Areas Covered Section -->
        <section class="bg-green-50 rounded-lg p-6 mb-12">
            <h2 class="text-2xl font-bold text-green-700 mb-2">Areas We Cover</h2>
            <p class="text-gray-700 mb-4"><?php echo htmlspecialchars($site_name); ?> serves Coimbatore, including RS Puram, Gandhipuram, Saibaba Colony, Peelamedu, Race Course, Sungam, Saravanampatti, Kovaipudur, and more.</p>
            <a href="/discover/areas-covered.php" class="inline-block bg-green-700 text-white px-6 py-2 rounded font-medium hover:bg-green-800 transition-colors">See All Areas</a>
        </section>
        <!-- Pre-Payment Integration Section -->
        <section class="bg-white rounded-lg shadow-md p-8 mb-12">
            <h2 class="text-2xl font-bold text-green-700 mb-4">How Payment Works</h2>
            <p class="text-gray-700 mb-4">Select your preferred plan above and click "Buy Now". You'll be redirected to our secure payment gateway to complete your purchase. We accept UPI, credit/debit cards, and net banking. All transactions are encrypted and 100% secure.</p>
            <ul class="list-disc list-inside text-gray-600 mb-4">
                <li>After payment, you'll receive instant access to your chosen plan's features.</li>
                <li>You'll get a confirmation email with your membership details and support contact.</li>
                <li>For any issues, our support team is available 24/7 to assist you.</li>
            </ul>
            <p class="text-green-700 font-semibold">Your privacy and security are our top priority. We never store your payment details.</p>
        </section>
        <!-- Additional sections can follow the discover style -->
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