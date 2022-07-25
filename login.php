<?php
session_start();

$dbConnection = parse_ini_file("db_connection.ini");
extract($dbConnection);
$myPdo = new PDO($dsn, $user, $password);

$password_error = $id_error = $login_error = "";
$error = false;
function ValidateId($id)
{
    $_SESSION['id'] = "";
    if (empty($id)) {
        $GLOBALS['error'] = true;
        $GLOBALS['id_error'] = "Id is Required";
        return;
    } else {
        $_SESSION['id'] = $id;
        return $id;
    }
}

function ValidatePassword($password)
{
    $_SESSION['password'] = "";
    if (empty($password)) {
        $GLOBALS['error'] = true;
        $GLOBALS['password_error'] = "Password is Required";
        return;
    } else {
        $_SESSION['password'] = $password;
        return $password;
    }
}

if (isset($_POST['submit'])) {
    $id = ValidateId($_POST['studentId']);
    $password = ValidatePassword($_POST['password']);
    if ($error == false) {

        $sql = $GLOBALS['myPdo']->query("SELECT StudentId, Name, Phone FROM Student WHERE StudentId = '$id' And Password = '$password'");
        $user = $sql->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $_SESSION['verified'] = "verified";
            header("Location: logOut.php");
            return;
        } else {
            $GLOBALS['login_error'] = "Incorect Student Id and/or Password";
        }
    }
}

if (isset($_POST['clear'])) {
    $password = "";
    $id = "";
    header("Location: login.php");
}

include("./Common/Header.php");

?>
<div class="container">
    <h3>Log In</h3>
    <div class="form-group row xx">
        <p class="txt">If you have never used this before, you have to <a href="newUser.php">Sign up </a>first.</p>
    </div>
    <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
        <div class="form-group row xx">
            <label for="id" class="col-sm-2 col-form-label">Student ID</label>
            <div class="col-sm-5 yy">
                <input type="text" autocomplete="off" name="studentId" id="student" class="form-control" value="<?= empty($_SESSION['id']) ? "" : $_SESSION['id'] ?>">
                <?php $id_error ? print("<P class='col-6 alert alert-danger m-1'>$id_error</p>") : "" ?>
            </div>
        </div>
        <div class="form-group row xx">
            <label for="phone" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-5 yy">
                <input autocomplete="off" type="password" name="password" id="password" class="form-control" value="<?= empty($_SESSION['password']) ? "" : $_SESSION['password'] ?>">
                <?php $password_error ? print("<P class='col-6 alert alert-danger m-1'>$password_error</p>") : "" ?>
            </div>
        </div>
        <div class="form-group row xx">
            <?php $login_error ? print("<P class='col-6 alert alert-danger m-1'>$login_error</p>") : "" ?>
        </div>
        <div class="form-group row xx nn">
            <button class="btn btn-primary m-1" type="submit" name="submit">Submit</button>
            <button class="btn btn-primary m-1" type="submit" name="clear">Clear</button>
        </div>
    </form>
</div>

<?php include('./common/footer.php'); ?>

</html>