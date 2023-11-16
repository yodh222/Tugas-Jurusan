<?php
include 'Func/conn.php';
require_once "Func/function.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $username = $_POST['username'];
    $query = "INSERT INTO user SET username=?, password=?, role='user'";
    $stmt = mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt,"ss",$username,$password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('Location: /');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Login Form</title>
    <link rel="shortcut icon" href="Assets/img/favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" class="p-3 border rounded">
                    <h2 class="text-center mb-4">Sign Up</h2>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required autocomplete="off">
                    </div>
                    <button name="submit" type="submit" class="btn btn-primary">Sign Up</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>