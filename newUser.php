<?php
session_start();

$dbConnection = parse_ini_file("db_connection.ini");
extract($dbConnection);
$myPdo = new PDO($dsn, $user, $password);

$error = false;
$name_error = $password_error = $confirm_error = $phone_error = $id_error = "";


function ValidateId($id)
{
    $_SESSION['id'] = "";
    if (empty($id)) {
        $GLOBALS['error'] = true;
        $GLOBALS['id_error'] = "Id is Required";
        return;
    } else {
        $sql = $GLOBALS['myPdo']->query("SELECT StudentId as UserId, Name, Phone FROM Student WHERE StudentId = '$id'");
        $user = $sql->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $GLOBALS['error'] = true;
            $GLOBALS['id_error'] = "Id already Exist!";
            $_SESSION['id'] = $id;
            return;
        }
        $_SESSION['id'] = $id;
        return $id;
    }
}

function ValidateName($name)
{
    $_SESSION['name'] = "";
    if (empty($name)) {
        $GLOBALS['error'] = true;
        $GLOBALS['name_error'] = "Name is Required";
        return;
    } else {
        $_SESSION['name'] = $name;
        return $name;
    }
}

function ValidatePassword($password)
{
    $_SESSION['password'] = "";
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);

    if (empty($password)) {
        $GLOBALS['error'] = true;
        $GLOBALS['password_error'] = "Password is Required";
        return;
    } else {
        if (strlen($password) < 6) {
            $GLOBALS['error'] = true;
            $GLOBALS['password_error'] = "Password must not be less than 6 characters";
            return;
        }

        if (!$uppercase || !$lowercase || !$number) {
            $GLOBALS['error'] = true;
            $GLOBALS['password_error'] = "Password must have at least on upper, lower and digit";
            return;
        }
        $_SESSION['password'] = $password;
        return $password;
    }
}
function ValidateConfirm($confirm)
{
    $_SESSION['confirm'] = "";
    if (empty($confirm)) {
        $GLOBALS['error'] = true;
        $GLOBALS['confirm_error'] = "Confirmation is Required";
        return;
    } else {
        if ($_SESSION['password'] === $confirm) {
            $_SESSION['confirm'] = $confirm;
            return $confirm;
        } else {
            $GLOBALS['error'] = true;
            $GLOBALS['confirm_error'] = "Passwords are not the same!";
            return;
        }
    }
}

function ValidatePhone($phone)
{
    $_SESSION['phone'] = "";
    if (empty($phone)) {
        $GLOBALS['error'] = true;
        return $GLOBALS['phone_error'] = "Enter your phone number";
    } else {
        $reg = "/^[2-9][0-9]{2}[-][2-9][0-9]{2}[-][0-9]{4}$/";
        if (!preg_match($reg, $phone)) {
            $GLOBALS['error'] = true;
            return $GLOBALS['phone_error'] = "Incorrect format | (000-000-0000)";
        } else {
            $_SESSION['phone'] = $phone;
            return $phone;
        }
    }
}


if (isset($_POST['submit'])) {
    $id = ValidateId($_POST['studentId']);
    $name = ValidateName($_POST['name']);
    $phone = ValidatePhone($_POST['phone']);
    $password = ValidatePassword($_POST['password']);
    $password = ValidateConfirm($_POST['confirm']);
    if ($error == false) {
        try {
            $sql = "INSERT INTO Student (StudentId, Name, Phone, Password) VALUES ('$id', '$name', '$phone', '$password')";
            $GLOBALS['myPdo']->exec($sql);
            header("Location: login.php");
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
        $myPdo = null;
    }
}



if (isset($_POST['studentId'])) {
    $id = $_POST['studentId'];
}
if (isset($_POST['name'])) {
    $name = $_POST['name'];
}
if (isset($_POST['phone'])) {
    $phone = $_POST['phone'];
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
}
if (isset($_POST['confirm'])) {
    $confirm = $_POST['confirm'];
}

if (isset($_POST['clear'])) {
    $name = "";
    $password = "";
    $id = "";
    $phone = "";
    $confirm = "";
    $name_error = "";
    session_destroy();
    header("Location: newUser.php");
}

include("./Common/Header.php");

?>
<div class="container">
    <h3>Sign Up</h3>
    <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
        <div class="form-group row xx">
            <label for="id" class="col-sm-2 col-form-label">Student ID</label>
            <div class="col-sm-5 yy">
                <input type="text" autocomplete="off" name="studentId" id="student" class="form-control" value="<?= empty($_SESSION['id']) ? "" : $_SESSION['id'] ?>">
                <?php $id_error ? print("<P class='col-6 alert alert-danger m-1'>$id_error</p>") : "" ?>
            </div>
        </div>
        <div class="form-group row xx">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-5 yy">
                <input type="text" name="name" id="name" class="form-control" value="<?= empty($_SESSION['name']) ? "" : $_SESSION['name'] ?>">
                <?php $name_error ? print("<P class='col-6 alert alert-danger m-1'>$name_error</p>") : "" ?>
            </div>
        </div>
        <div class="form-group row xx">
            <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
            <div class="col-sm-5 yy">
                <input type="text" name="phone" id="phone" class="form-control" value="<?= empty($_SESSION['phone']) ? "" : $_SESSION['phone'] ?>">
                <?php $phone_error ? print("<P class='col-6 alert alert-danger m-1'>$phone_error</p>") : "" ?>
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
            <label for="password" class="col-sm-2 col-form-label">Confirm Password</label>
            <div class="col-sm-5 yy">
                <input autocomplete="off" type="password" name="confirm" id="confirm" class="form-control" value="<?= empty($_SESSION['confirm']) ? "" : $_SESSION['confirm'] ?>">
                <?php $confirm_error ? print("<P class='col-6 alert alert-danger m-1'>$confirm_error</p>") : "" ?>
            </div>
        </div>
        <div class="form-group row xx nn">
            <button class="btn btn-primary m-1" type="submit" name="submit">Submit</button>
            <button class="btn btn-primary m-1" type="submit" name="clear">Clear</button>
        </div>
    </form>
</div>

<?php include('./common/footer.php'); ?>

</html>