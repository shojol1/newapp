<?php
include "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pass  = md5($_POST['password']);

    $q = mysqli_query($conn,
        "SELECT * FROM users WHERE email='$email' AND password='$pass'"
    );

    if (mysqli_num_rows($q) == 1) {
        $u = mysqli_fetch_assoc($q);
        $_SESSION['user_id'] = $u['id'];
        $_SESSION['role']    = $u['role'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Email অথবা Password ভুল";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Somiti Login</title>
    <link rel="stylesheet" href="assets/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="login-page">
 

<div class="card">
    <h2>Somiti Login</h2>

    <?php if (isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button class="btn">Login</button>
    </form>
</div>

</body>
</html>
