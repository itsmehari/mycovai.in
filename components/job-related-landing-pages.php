<?php
/**
 * Related Landing Pages Component
 * Shows contextually relevant landing pages on each landing page
 *
 * Usage: <?php
 *   $current_page_type = 'location'; // 'location', 'industry', 'experience', 'type'
 *   $current_page_value = 'RS Puram';
 *   include 'components/job-related-landing-pages.php';
 * ?>
 */

$related_pages = [];

if (isset($current_page_type)) {
    switch ($current_page_type) {
        case 'location':
            $related_pages = [
                ['url' => '/it-jobs-coimbatore.php', 'title' => 'IT Jobs in Coimbatore', 'icon' => 'laptop-code'],
                ['url' => '/jobs/?category=teaching', 'title' => 'Teaching Jobs in Covai', 'icon' => 'chalkboard-teacher'],
                ['url' => '/jobs/?experience=fresher', 'title' => 'Fresher Jobs in Covai', 'icon' => 'user-graduate'],
                ['url' => '/jobs/?job_type=part-time', 'title' => 'Part-Time Jobs in Covai', 'icon' => 'clock'],
            ];
            break;

        case 'industry':
            $related_pages = [
                ['url' => '/jobs-in-gandhipuram.php', 'title' => 'Jobs in Gandhipuram', 'icon' => 'map-marker-alt'],
                ['url' => '/jobs-in-rs-puram.php', 'title' => 'Jobs in RS Puram', 'icon' => 'map-marker-alt'],
                ['url' => '/jobs/?experience=fresher', 'title' => 'Fresher Jobs', 'icon' => 'user-graduate'],
                ['url' => '/jobs/?experience=experienced', 'title' => 'Experienced Jobs', 'icon' => 'user-tie'],
            ];
            break;

        case 'experience':
            $related_pages = [
                ['url' => '/it-jobs-coimbatore.php', 'title' => 'IT Jobs for Freshers', 'icon' => 'laptop-code'],
                ['url' => '/jobs-in-saravanampatti.php', 'title' => 'Jobs in Saravanampatti', 'icon' => 'map-marker-alt'],
                ['url' => '/jobs/?job_type=part-time', 'title' => 'Part-Time Jobs', 'icon' => 'clock'],
            ];
            break;

        case 'type':
            $related_pages = [
                ['url' => '/jobs/?category=retail', 'title' => 'Retail Jobs', 'icon' => 'shopping-bag'],
                ['url' => '/jobs-in-peelamedu.php', 'title' => 'Jobs in Peelamedu', 'icon' => 'map-marker-alt'],
                ['url' => '/jobs/?experience=fresher', 'title' => 'Fresher Jobs', 'icon' => 'user-graduate'],
            ];
            break;

        default:
            $related_pages = [
                ['url' => '/it-jobs-coimbatore.php', 'title' => 'IT Jobs in Coimbatore', 'icon' => 'laptop-code'],
                ['url' => '/jobs-in-gandhipuram.php', 'title' => 'Jobs in Gandhipuram', 'icon' => 'map-marker-alt'],
                ['url' => '/jobs/?experience=fresher', 'title' => 'Fresher Jobs', 'icon' => 'user-graduate'],
                ['url' => '/jobs/?job_type=part-time', 'title' => 'Part-Time Jobs', 'icon' => 'clock'],
            ];
    }
}

$related_pages = array_slice($related_pages, 0, 4);
?>

<?php if (!empty($related_pages)): ?>
<section class="related-landing-pages py-4 bg-light">
    <div class="container">
        <h3 class="h5 mb-4">You Might Also Be Interested In</h3>
        <div class="row g-3">
            <?php foreach ($related_pages as $page): ?>
            <div class="col-md-3 col-sm-6">
                <a href="<?php echo htmlspecialchars($page['url']); ?>" class="card card-hover text-decoration-none h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-<?php echo htmlspecialchars($page['icon'] ?? 'briefcase'); ?> fa-2x text-primary mb-2"></i>
                        <h5 class="card-title mb-0"><?php echo htmlspecialchars($page['title']); ?></h5>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<style>
.card-hover {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid #dee2e6;
}
.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    text-decoration: none;
}
</style>
