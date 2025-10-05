<?php
$base = "http://localhost/skill_pro_v2/";
$pages = [
  'index.php','courses.php','calendar.php','notices.php','inquiries.php','login.php','register.php',
  'student/dashboard.php','student/my_registrations.php',
  'instructor/dashboard.php','instructor/my_courses.php',
  'admin/index.php','admin/manage_users.php','admin/manage_courses.php',
  'admin/manage_schedules.php','admin/manage_notices.php','admin/manage_inquiries.php'
];

header("Content-Type: application/xml; charset=utf-8");
echo "<?xml version='1.0' encoding='UTF-8'?>\n<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>\n";
foreach($pages as $p){
  echo "<url><loc>{$base}{$p}</loc><priority>0.8</priority></url>\n";
}
echo "</urlset>";
?>
