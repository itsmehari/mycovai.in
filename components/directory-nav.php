<?php
/**
 * Directory category sub-navigation – MyCovai design
 * Used on list pages: schools, hospitals, banks, etc.
 */
$navItems = [
    ['Emergency & Civic', '/directory/emergency-civic-directory.php'],
    ['Schools', '/directory/schools.php'],
    ['Best Schools', '/directory/best-schools.php'],
    ['Hospitals', '/directory/hospitals.php'],
    ['Banks', '/directory/banks.php'],
    ['ATMs', '/directory/atms.php'],
    ['Parks', '/directory/parks.php'],
    ['Restaurants', '/directory/restaurants.php'],
    ['Industries', '/directory/industries.php'],
    ['IT Companies', '/directory/it-companies.php'],
    ['IT Parks', '/directory/it-parks.php'],
    ['Government Offices', '/directory/government-offices.php'],
];
$current_path = isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : '';
$current_script = basename($_SERVER['SCRIPT_NAME'] ?? '');
?>
<nav class="directory-subnav" role="navigation" aria-label="Directory categories">
    <div class="directory-subnav-inner">
        <a href="/directory/index.php" class="directory-subnav-item<?php echo ($current_script === 'index.php') ? ' active' : ''; ?>">Explore Covai</a>
        <?php foreach ($navItems as $item): ?>
        <a href="<?php echo htmlspecialchars($item[1]); ?>" class="directory-subnav-item<?php echo ($current_path === $item[1]) ? ' active' : ''; ?>"><?php echo htmlspecialchars($item[0]); ?></a>
        <?php endforeach; ?>
    </div>
</nav>
<style>
.directory-subnav { background: var(--mycovai-text, #2C2825); }
.directory-subnav-inner { max-width: 1280px; margin: 0 auto; padding: 0 1rem; display: flex; flex-wrap: wrap; gap: 0.25rem; }
.directory-subnav-item { display: block; color: #fff; padding: 0.6rem 1rem; font-size: 0.9rem; font-weight: 500; text-decoration: none; border-radius: 6px; transition: background 0.2s, color 0.2s; font-family: 'Poppins', sans-serif; }
.directory-subnav-item:hover { background: rgba(255,255,255,0.1); color: #fff; }
.directory-subnav-item.active { background: var(--mycovai-primary, #B8522E); color: #fff; }
@media (max-width: 768px) { .directory-subnav-inner { justify-content: center; } }
</style>
