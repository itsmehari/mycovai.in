-- Sample seed for Coimbatore ACs (election_2026_candidates, election_2026_announcements)
-- Run after create-election-2026-tables.sql via run-election-2026-migration.php

-- Sample candidates (placeholder – update when nominations are finalised)
INSERT IGNORE INTO election_2026_candidates (ac_slug, party, candidate_name, sort_order) VALUES
('palladam', 'Sample Party', 'Sample Candidate 1', 1),
('sulur', 'Sample Party', 'Sample Candidate 2', 1),
('kavundampalayam', 'Sample Party', 'Sample Candidate 3', 1),
('coimbatore-north', 'Sample Party', 'Sample Candidate 4', 1),
('coimbatore-south', 'Sample Party', 'Sample Candidate 5', 1),
('singanallur', 'Sample Party', 'Sample Candidate 6', 1);

-- Sample announcement
INSERT IGNORE INTO election_2026_announcements (announcement_date, title, source, summary) VALUES
('2026-03-30', 'Gazette notification – TN Assembly election 2026', 'ECI', 'Election Commission notifies schedule for Tamil Nadu Assembly election 2026. Poll 23 Apr, counting 4 May.');
