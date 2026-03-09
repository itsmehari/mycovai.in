<!DOCTYPE html>
<html lang="en">
<head>
<?php include '../components/meta.php'; ?>
<?php include '../components/analytics.php'; ?>
<?php include '../components/head-resources.php'; ?>
    <title>Advertise Your Business in OMR - Post an Ad | MyOMR</title>
    <meta name="description" content="Promote your business in OMR with targeted local advertising. Get more visibility & customers.">
    <meta name="keywords" content="business ads OMR, advertise business Chennai, promote local business OMR">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="components/nav-footer-styles.css">
</head>
<body>

<!-- Include Navigation Bar -->
<?php include '../components/navbar.php'; ?>

<!-- Include Action Links -->
<?php include __DIR__ . '/../components/action-links.php'; ?>

<!-- Main Content -->
<div class="container">
    <h1>Advertise Your Business in OMR</h1>
    <p>Fill in the details below to proceed.</p>

    <form action="process-listing.php" method="POST">
        <input type="hidden" name="service_type" value="post-business-ad">
        
        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="details">Details:</label>
        <textarea id="details" name="details" required></textarea>

        <button type="submit">Submit</button>
    </form>
</div>

<!-- Include Footer -->
<?php include 'components/footer.php'; ?>

<!-- Social Icons -->
<?php include '../components/social-icons.php'; ?>

</body>
</html>
