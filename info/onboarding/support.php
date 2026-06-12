<?php require_once __DIR__ . '/_bootstrap.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support | <?php echo htmlspecialchars($site_name); ?></title>
    <meta name="description" content="Get help with <?php echo htmlspecialchars($site_name); ?> — contact, FAQs, and community resources for <?php echo htmlspecialchars($region); ?>.">
    <link rel="canonical" href="<?php echo htmlspecialchars($site_domain); ?>/info/onboarding/support.php">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap'); body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50">
    <header class="bg-white shadow-sm">
        <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-green-700"><?php echo htmlspecialchars($site_name); ?></a>
            <div class="hidden md:flex space-x-6">
                <a href="/info/onboarding/overview.php" class="text-gray-600 hover:text-green-700">Overview</a>
                <a href="/discover/support.php" class="text-green-700 font-medium">Support</a>
            </div>
        </nav>
    </header>
    <main class="container mx-auto px-4 py-8 max-w-3xl">
        <h1 class="text-3xl font-bold text-green-800 mb-6">Support & Help</h1>
        <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
            <h2 class="text-xl font-semibold mb-3">Contact us</h2>
            <ul class="text-gray-700 space-y-2">
                <li>Email: <a href="mailto:<?php echo htmlspecialchars($contact_email); ?>" class="text-green-700 underline"><?php echo htmlspecialchars($contact_email); ?></a></li>
                <li>Phone: <?php echo htmlspecialchars($contact_phone); ?></li>
                <li><a href="/contact.php" class="text-green-700 underline">Contact form</a></li>
                <li><a href="/discover/support.php" class="text-green-700 underline">Discover support page</a></li>
            </ul>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
            <h2 class="text-xl font-semibold mb-3">Quick links</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-1">
                <li><a href="/directory/get-listed.php" class="text-green-700 underline">List your business</a></li>
                <li><a href="/jobs/employer-landing-covai.php" class="text-green-700 underline">Post a job</a></li>
                <li><a href="/coimbatore-news.php" class="text-green-700 underline">Covai news</a></li>
                <li><a href="/privacy-policy.php" class="text-green-700 underline">Privacy policy</a></li>
            </ul>
        </div>
        <a href="/info/onboarding/overview.php" class="inline-block bg-green-700 text-white px-6 py-2 rounded-lg">Back to overview</a>
    </main>
    <footer class="bg-gray-900 text-white py-6 text-center text-gray-400">
        <p>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($site_name); ?></p>
    </footer>
</body>
</html>
