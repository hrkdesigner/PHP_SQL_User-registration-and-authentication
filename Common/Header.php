<!DOCTYPE html>
<html lang="en" style="position: relative; min-height: 100%;">

<head>
    <title>Online Course Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../Common/css/Site.css">
    <style>
        body {
            padding: 50px auto;
            margin: 0;
            box-sizing: border-box;
            background-color: #fff;
            cursor: default;
            font-weight: 400;

        }

        nav {
            width: 100%;
            height: 80px;
            background-color: #333;
            margin-bottom: 40px;
        }

        ul {
            list-style: none;
            height: 80px;
            display: flex;
            flex-wrap: nowrap;
            justify-content: space-evenly;
            align-items: center;
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
            font-size: 16px;
            color: white;

        }

        .txt>a {
            text-decoration: none;
            color: blue;
        }

        .txt>a:hover {
            text-decoration: none;
            color: blue;
        }

        a {
            text-decoration: none;
            color: white;
        }

        a:hover {
            text-decoration: none;
            color: greenyellow;
        }

        h3 {
            text-align: center;
            padding-bottom: 20px;
        }

        .link {
            color: blue;
            font-weight: 900;
            display: flex;
            justify-content: flex-start;
            text-decoration: none;
        }

        .link:hover {
            color: black;
        }

        .xx {
            display: flex;
            justify-content: center;
            align-content: center;
        }

        .nn {
            margin-bottom: 100px !important;
        }

        .yy {
            display: flex;
            justify-content: space-between;
            align-content: center;
            align-items: center;
        }

        .pp {
            margin: 2px auto 100px auto;
            width: 600px !important;
        }

        td,
        th {
            text-align: center;
            font-size: 16px;
        }

        .zz {
            margin-top: 30px;
            width: 100%;
            text-align: center;
            font-size: 20px;
        }

        .gg {
            font-size: 16px;
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <nav>
        <ul>
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="courseSelection.php">Course Slection</a></li>
            <li><a href="registration.php">Current Registration</a></li> 
            <?php !isset($_SESSION['verified'])? print('<li><a href="login.php">Login</a></li>') : print('<li><a href="logOut.php">Dashbord</a></li>') ?>
            
        </ul>
    </nav>