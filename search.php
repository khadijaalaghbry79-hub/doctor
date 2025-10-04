<?php
// بيانات الأطباء (يمكن استبدالها بقاعدة بيانات)
$doctors = [
    ['name' => 'د. أحمد محمد', 'specialty' => 'طبيب قلب', 'rating' => 4.5, 'location' => 'الرياض'],
    ['name' => 'د. سارة عبدالله', 'specialty' => 'طبيب عظام', 'rating' => 4.8, 'location' => 'جدة'],
    ['name' => 'د. خالد حسن', 'specialty' => 'طبيب آذن', 'rating' => 4.2, 'location' => 'الدمام'],
    ['name' => 'د. فاطمة علي', 'specialty' => 'طبيب عيون', 'rating' => 4.7, 'location' => 'الرياض']
];
?>

<!-- شاشة البحث عن طبيب -->
<div class="screen active">
    <h2>اختر طبيبًا</h2>
    <form method="GET" action="">
        <input type="hidden" name="screen" value="search">
        <input type="text" class="search-box" name="query" placeholder="إبحث هنا" 
               value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
        
        <p>أختر الطبيب المناسب لك وفقًا للمعايير التالية</p>
        
        <div class="filter-options">
            <select name="location" class="filter-item">
                <option value="">جميع المواقع</option>
                <option value="الرياض" <?php echo (isset($_GET['location']) && $_GET['location'] == 'الرياض') ? 'selected' : ''; ?>>الرياض</option>
                <option value="جدة" <?php echo (isset($_GET['location']) && $_GET['location'] == 'جدة') ? 'selected' : ''; ?>>جدة</option>
                <option value="الدمام" <?php echo (isset($_GET['location']) && $_GET['location'] == 'الدمام') ? 'selected' : ''; ?>>الدمام</option>
            </select>
            
            <select name="rating" class="filter-item">
                <option value="">جميع التقييمات</option>
                <option value="5" <?php echo (isset($_GET['rating']) && $_GET['rating'] == '5') ? 'selected' : ''; ?>>5 نجوم</option>
                <option value="4" <?php echo (isset($_GET['rating']) && $_GET['rating'] == '4') ? 'selected' : ''; ?>>4 نجوم فأكثر</option>
                <option value="3" <?php echo (isset($_GET['rating']) && $_GET['rating'] == '3') ? 'selected' : ''; ?>>3 نجوم فأكثر</option>
            </select>
        </div>
        
        <button type="submit" class="filter-button">بحث</button>
    </form>
    
    <!-- عرض نتائج البحث -->
    <div class="doctors-list">
        <?php
        $filtered_doctors = $doctors;
        
        // تطبيق الفلترة
        if (isset($_GET['query']) && !empty($_GET['query'])) {
            $query = strtolower($_GET['query']);
            $filtered_doctors = array_filter($filtered_doctors, function($doctor) use ($query) {
                return strpos(strtolower($doctor['name']), $query) !== false || 
                       strpos(strtolower($doctor['specialty']), $query) !== false;
            });
        }
        
        if (isset($_GET['location']) && !empty($_GET['location'])) {
            $location = $_GET['location'];
            $filtered_doctors = array_filter($filtered_doctors, function($doctor) use ($location) {
                return $doctor['location'] == $location;
            });
        }
        
        if (isset($_GET['rating']) && !empty($_GET['rating'])) {
            $min_rating = (float)$_GET['rating'];
            $filtered_doctors = array_filter($filtered_doctors, function($doctor) use ($min_rating) {
                return $doctor['rating'] >= $min_rating;
            });
        }
        
        // عرض الأطباء
        foreach ($filtered_doctors as $doctor) {
            echo '<div class="doctor-card">';
            echo '<h3>' . $doctor['name'] . '</h3>';
            echo '<p>التخصص: ' . $doctor['specialty'] . '</p>';
            echo '<p>الموقع: ' . $doctor['location'] . '</p>';
            echo '<p>التقييم: ' . $doctor['rating'] . ' ★</p>';
            echo '<a href="index.php?screen=booking&doctor=' . urlencode($doctor['name']) . '" class="book-button">حجز موعد</a>';
            echo '</div>';
        }
        ?>
    </div>
</div>
