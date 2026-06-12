<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$c = new mysqli('mycovai.in:3306', 'metap8ok_myomr_admin', 'myomr@123', 'metap8ok_mycovai');
$r = $c->query("SELECT phone, LENGTH(phone) AS len FROM employers WHERE company_name LIKE '%Dharshe%'");
var_export($r->fetch_assoc());
