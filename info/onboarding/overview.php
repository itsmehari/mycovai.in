<?php require_once __DIR__ . '/_bootstrap.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to <?php echo htmlspecialchars($site_name); ?> | <?php echo htmlspecialchars($region); ?> Community</title>
    <meta name="description" content="Discover <?php echo htmlspecialchars($site_name); ?> — local news, jobs, events, and business listings for <?php echo htmlspecialchars($region); ?>.">
    <meta name="keywords" content="<?php echo htmlspecialchars($site_name); ?>, Coimbatore, Covai, community platform, local news">
    <link rel="canonical" href="<?php echo htmlspecialchars($site_domain); ?>/info/onboarding/overview.php">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap'); body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50">
    <header class="bg-white shadow-sm">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="/" class="text-2xl font-bold text-green-700"><?php echo htmlspecialchars($site_name); ?></a>
                <div class="hidden md:flex space-x-6">
                    <a href="/info/onboarding/overview.php" class="text-green-700 font-medium">Overview</a>
                    <a href="/discover/getting-started.php" class="text-gray-600 hover:text-green-700">Getting Started</a>
                    <a href="/discover/features.php" class="text-gray-600 hover:text-green-700">Features</a>
                    <a href="/discover/community.php" class="text-gray-600 hover:text-green-700">Community</a>
                    <a href="/info/onboarding/support.php" class="text-gray-600 hover:text-green-700">Support</a>
                </div>
            </div>
        </nav>
    </header>
    <main class="container mx-auto px-4 py-8">
        <section class="flex flex-col md:flex-row items-center bg-white rounded-lg shadow-md p-8 mb-12">
            <img src="<?php echo htmlspecialchars(covai_logo_url()); ?>" alt="<?php echo htmlspecialchars($site_name); ?>" class="w-32 h-32 object-contain mb-6 md:mb-0 md:mr-10">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-green-800 mb-2">Welcome to <?php echo htmlspecialchars($site_name); ?></h2>
                <p class="text-lg text-gray-600 mb-4">Plan. Connect. Grow.<br>Your community platform for <?php echo htmlspecialchars($region); ?> — news, jobs, events, and local business.</p>
                <a href="/discover/getting-started.php" class="inline-block bg-green-700 text-white px-6 py-2 rounded-lg font-medium hover:bg-green-800">Get Started</a>
            </div>
        </section>
        <section class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold mb-2">Local News</h3>
                <p class="text-gray-600">Stay informed with Covai news, elections, and civic updates.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold mb-2">Directory & Jobs</h3>
                <p class="text-gray-600">Find schools, hospitals, restaurants, and job openings in <?php echo htmlspecialchars($region_short); ?>.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold mb-2">List Your Business</h3>
                <p class="text-gray-600"><a href="/directory/get-listed.php" class="text-green-700 underline">Get listed</a> or <a href="/jobs/employer-landing-covai.php" class="text-green-700 underline">post jobs</a>.</p>
            </div>
        </section>
        <section class="text-center bg-green-50 rounded-lg p-8">
            <h2 class="text-2xl font-bold mb-4">Ready to explore <?php echo htmlspecialchars($region_short); ?>?</h2>
            <a href="/directory/" class="inline-block bg-green-700 text-white px-6 py-3 rounded-lg font-medium hover:bg-green-800">Explore Directory</a>
        </section>
    </main>
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4 text-center text-gray-400">
            <p>Contact: <a href="mailto:<?php echo htmlspecialchars($contact_email); ?>" class="underline"><?php echo htmlspecialchars($contact_email); ?></a> · <?php echo htmlspecialchars($contact_phone); ?></p>
            <p class="mt-4">&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($site_name); ?>. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
