<?php include_once('header.php'); ?>

<?php if(empty($_SESSION['admin'])): ?>
    <?php header('location:home.php'); ?>
<?php endif; ?>
