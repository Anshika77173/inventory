<?php
include 'database2.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = registerUser($email, $password);

    if ($result === true) {
        header('Location: index.php');
        exit();
    } else {
        $error = $result; // Set the error message
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        ">Register</h1>
        <?php if ($error): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form action="registration.php" method="POST">
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
                ">Register</button>
            </div>
        </form>
        <p style="
            margin-top: 30px;
            font-size: 16px;
        ">Already have an account? <a href="index.php">Login here</a>.</p>
    </div>
</body>
</html>
