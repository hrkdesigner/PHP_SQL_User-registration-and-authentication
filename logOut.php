<?php
session_start();

if (empty($_SESSION['verified'])) {
    header("Location: login.php");
    exit();
}


if (isset($_POST['submit'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

include("./Common/Header.php");

?>
<div class="container">
    <h3>User Dashbord</h3>
    <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
        <div class="form-group row xx nn">
            <button class="btn btn-primary " type="submit" name="submit">Log out</button>
        </div>
    </form>
</div>

<?php include('./common/footer.php'); ?>

</html>