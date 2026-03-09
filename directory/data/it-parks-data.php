<?php
/**
 * Fallback IT Parks data for Coimbatore (used when DB covai_it_parks has no rows)
 * Matches covai_it_parks schema; IDs align with seed if applicable.
 */
$covai_it_parks_all = [
  [
    'id' => 1,
    'name' => 'Tidel Park Coimbatore',
    'location' => 'Saravanampatti',
    'locality' => 'Saravanampatti',
    'address' => 'Tidel Park Road, Saravanampatti, Coimbatore 641035',
    'phone' => '0422 710 0000',
    'website' => 'https://www.tidelpark.co.in',
    'inauguration_year' => '2010',
    'owner' => 'TIDCO',
    'built_up_area' => '5 lakh sq ft',
    'total_area' => '25 acres',
    'companies' => 'Cognizant, HCL, Sutherland',
    'image' => (defined('SITE_LOGO_URL') && SITE_LOGO_URL) ? SITE_LOGO_URL : '/My-OMR-Logo.jpg'
  ],
  [
    'id' => 2,
    'name' => 'ELCOT IT Park Coimbatore',
    'location' => 'Vedapatti',
    'locality' => 'Vedapatti',
    'address' => 'ELCOT IT Park, Vedapatti, Coimbatore',
    'phone' => '0422 231 5678',
    'website' => 'https://elcot.in',
    'inauguration_year' => '2008',
    'owner' => 'ELCOT',
    'built_up_area' => '3 lakh sq ft',
    'total_area' => '15 acres',
    'companies' => 'IT companies',
    'image' => (defined('SITE_LOGO_URL') && SITE_LOGO_URL) ? SITE_LOGO_URL : '/My-OMR-Logo.jpg'
  ],
  [
    'id' => 3,
    'name' => 'KG Tech Park',
    'location' => 'Saravanampatti',
    'locality' => 'Saravanampatti',
    'address' => 'KG Campus, Saravanampatti, Coimbatore 641035',
    'phone' => '0422 661 9000',
    'website' => 'https://www.kgisl.com',
    'inauguration_year' => '2012',
    'owner' => 'KGISL',
    'built_up_area' => '2 lakh sq ft',
    'total_area' => '10 acres',
    'companies' => 'KGISL, startups',
    'image' => (defined('SITE_LOGO_URL') && SITE_LOGO_URL) ? SITE_LOGO_URL : '/My-OMR-Logo.jpg'
  ],
  [
    'id' => 4,
    'name' => 'Kovai Industrial Park',
    'location' => 'Saravanampatti',
    'locality' => 'Saravanampatti',
    'address' => 'Kovai Industrial Park, Saravanampatti, Coimbatore',
    'phone' => null,
    'website' => null,
    'inauguration_year' => '2012',
    'owner' => 'Private',
    'built_up_area' => '2 lakh sq ft',
    'total_area' => '10 acres',
    'companies' => null,
    'image' => (defined('SITE_LOGO_URL') && SITE_LOGO_URL) ? SITE_LOGO_URL : '/My-OMR-Logo.jpg'
  ],
  [
    'id' => 5,
    'name' => 'Coimbatore Tech Park',
    'location' => 'Kalapatti',
    'locality' => 'Kalapatti',
    'address' => 'Kalapatti Road, Coimbatore 641048',
    'phone' => null,
    'website' => null,
    'inauguration_year' => '2015',
    'owner' => 'Private',
    'built_up_area' => '1.5 lakh sq ft',
    'total_area' => '8 acres',
    'companies' => null,
    'image' => (defined('SITE_LOGO_URL') && SITE_LOGO_URL) ? SITE_LOGO_URL : '/My-OMR-Logo.jpg'
  ],
];

// Backward compatibility alias
$omr_it_parks_all = $covai_it_parks_all;

/** Get IT park by ID from fallback data */
function covai_it_parks_get_by_id($id) {
  global $covai_it_parks_all;
  foreach ($covai_it_parks_all as $p) { if ((int)$p['id'] === (int)$id) return $p; }
  return null;
}

/** @deprecated Use covai_it_parks_get_by_id */
function omr_it_parks_get_by_id($id) {
  return covai_it_parks_get_by_id($id);
}
