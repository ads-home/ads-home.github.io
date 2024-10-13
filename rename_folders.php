<?php
// تحديد المسار للمجلد الرئيسي
$base_path = 'path/to/your/assets/'; // استبدل هذا بالمسار الصحيح لـ assets

// قائمة بأسماء المجلدات الحالية
$current_folders = [
    'تصميمات سوشيال ميديا جديدة 1',
    'تصميمات سوشيال ميديا جديدة 2',
    'تصميمات سوشيال ميديا جديدة 3',
    'تصميمات سوشيال ميديا جديدة 4',
    'تصميمات سوشيال ميديا جديدة 5',
    'تصميمات سوشيال ميديا جديدة 6'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($current_folders as $index => $current_folder) {
        // الحصول على الاسم الجديد من المدخلات
        $new_folder = trim($_POST['new_folder'][$index]);

        // التحقق من أن الاسم الجديد ليس فارغًا
        if (!empty($new_folder)) {
            $current_folder_path = $base_path . $current_folder;
            $new_folder_path = $base_path . $new_folder;

            // التحقق مما إذا كان المجلد الجديد موجودًا بالفعل
            if (!file_exists($new_folder_path)) {
                // تغيير اسم المجلد
                if (rename($current_folder_path, $new_folder_path)) {
                    echo "تم تغيير اسم المجلد '$current_folder' إلى '$new_folder' بنجاح.<br>";
                } else {
                    echo "حدث خطأ أثناء تغيير اسم المجلد '$current_folder'.<br>";
                }
            } else {
                echo "المجلد '$new_folder' موجود بالفعل. يرجى اختيار اسم آخر.<br>";
            }
        } else {
            echo "يرجى إدخال اسم جديد للمجلد '$current_folder'.<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تغيير أسماء المجلدات</title>
</head>
<body>
    <h1>تغيير أسماء المجلدات</h1>
    <form method="POST" action="">
        <?php foreach ($current_folders as $index => $folder): ?>
            <div>
                <label for="new_folder_<?php echo $index; ?>">الاسم الجديد للمجلد "<?php echo $folder; ?>":</label>
                <input type="text" id="new_folder_<?php echo $index; ?>" name="new_folder[]" required>
            </div>
        <?php endforeach; ?>
        <button type="submit">تغيير الأسماء</button>
    </form>
</body>
</html>
