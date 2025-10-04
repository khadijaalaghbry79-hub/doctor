<!-- شريط التنقل السفلي -->
<div class="navbar">
    <a href="index.php?screen=home" class="nav-item <?php echo ($_SESSION['current_screen'] == 'home') ? 'active' : ''; ?>">الرئيسية</a>
    <a href="index.php?screen=booking" class="nav-item <?php echo ($_SESSION['current_screen'] == 'booking') ? 'active' : ''; ?>">حجز موعد</a>
    <a href="#" class="nav-item">الاشعارات</a>
    <a href="#" class="nav-item">الاعدادات</a>
</div>
