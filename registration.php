<?php
session_start();

if (!isset($_SESSION['verified'])) {
    header("Location: login.php");
    exit();
}
include("./common/header.php");
?>

<div class="container">
    <h1 class="text-left text-success">Course Registration</h1>
</div>

<?php include('./common/footer.php'); ?>