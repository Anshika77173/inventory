<?php
include 'database2.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (loginUser($email, $password)) {
        header('Location: index.php');
        exit();
    } else {
        echo "Login failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>
<body style="
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    background-image: url('coc.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
">
    <div class="container" style="
        max-width: 600px;
        width: 100%;
        padding: 50px;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        border-radius: 8px;
        text-align: center;
       
    ">
        <h1 style="
            font-size: 35px;
            margin-bottom: 30px;
            text-align: center;
            margin-right:15px;
        ">Login</h1>
        <form action="login.php" method="POST">
            <div class="form-group" style="margin-bottom: 25px; width: 100%;">
                <input type="email" name="email" placeholder="Email" class="form-control" required style="
                    width: 100%;
                    padding: 15px;
                    font-size: 18px;
                    border-radius: 5px;
                    border: 1px solid #ccc;
                    box-sizing: border-box;
                ">
            </div>
            <div class="form-group" style="margin-bottom: 25px; width: 100%;">
                <input type="password" name="password" placeholder="Password" class="form-control" required style="
                    width: 100%;
                    padding: 15px;
                    font-size: 18px;
                    border-radius: 5px;
                    border: 1px solid #ccc;
                    box-sizing: border-box;
                ">
            </div>
            <div class="form-group">
                <button type="submit" style="
                    width: 100%;
                    padding: 15px;
                    font-size: 18px;
                    background-color: #007bff;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                ">Login</button>
            </div>
        </form>
        <p style="
            margin-top: 30px;
            font-size: 16px;
        ">Don't have an account? <a href="registration.php">Register here</a>.</p>
         <p>
            admin@gmail.com/password
        </p>
    </div>
</body>
</html>