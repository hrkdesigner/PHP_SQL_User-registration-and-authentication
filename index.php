<?php 
session_start();



include("./Common/Header.php"); 
 ?>

<div class="container">
    <h1>Welcome to Course Registration</h1>
    <p class="txt">If you have never used this before, you have to <a href="newUser.php">Sign up </a>first.</p>
    <p class="txt">If you have already signed up, you can <a href="login.php">login </a>now.</p>
    <br />
    <!-- <ul>
        <li><?php empty($_SESSION['agreement']) ? print('<a class="link" href="Disclaimer.php">Deposit Calculator</a>') : print('<a class="link" href="DepositeCalculator.php">Deposit Calculator</a>') ?></li>
    </ul> -->
</div>

<?php include('./common/footer.php'); ?>

</html>