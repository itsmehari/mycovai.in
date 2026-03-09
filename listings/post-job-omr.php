<!DOCTYPE html>
<html lang="en">
<head>
    <title>Post a Job Vacancy in OMR - Find Employees | MyOMR</title>
    <meta name="description" content="Post job vacancies in OMR, Chennai. Connect with local job seekers easily.">
    <meta name="keywords" content="post job OMR, job vacancy Chennai, OMR job listings, hire employees OMR">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="components/nav-footer-styles.css">
</head>
<body>

<!-- Include Navigation Bar -->
<?php include 'components/nav-bar.php'; ?>

<!-- Include Action Links -->
<?php include __DIR__ . '/../components/action-links.php'; ?>

<!-- Main Content -->
<div class="container">
    <h1>Post a Job Vacancy in OMR</h1>
    <p>Fill in the details below to proceed.</p>

    <form action="process-listing.php" method="POST">
        <input type="hidden" name="service_type" value="post-job">
        
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

</body>
</html>
