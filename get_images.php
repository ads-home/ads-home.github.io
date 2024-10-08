<?php
$projectNumber = $_GET['project']; // جلب رقم المشروع من الطلب
$dir = "assets/img/portfolio/fullsize/project" . $projectNumber; // مسار المجلد
$images = array_diff(scandir($dir), array('.', '..')); // قراءة الملفات داخل المجلد

// إرجاع أسماء الصور في JSON
echo json_encode(array_values($images));
?>
