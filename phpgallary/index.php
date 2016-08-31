<?php
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.php';
});
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'pages/header.php'; ?>
<body>
<?php include_once 'pages/navbar.php'; ?>
<div class="container">
    <?php
    if(isset($_GET['page'])) {
        if(file_exists('pages/content-'.$_GET['page'].'.php')) {
            include_once 'pages/content-'.$_GET['page'].'.php';
        } else {
            include_once 'pages/404.php';
        }
    } else {
        if(file_exists('pages/content-home.php')) {
            include_once 'pages/content-home.php';
        } else {
            include_once 'pages/404.php';
        }
    }
    ?>
</div>
<?php include_once 'pages/footer.php'; ?>
</body>
</html>