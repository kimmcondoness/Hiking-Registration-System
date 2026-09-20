<?php
include("../hikingdatabase.php");

if (isLoggedIn()) {
    header("Location: dashboard.php");
    exit();
}

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";
    } else {
        $stmt = mysqli_prepare($conn, "SELECT * FROM admin WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['admin_id'] = $row['admin_id'];
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Invalid login.";
            }
        } else {
            $error = "Invalid login.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#6366f1,#1e293b);
    font-family:'Poppins',sans-serif;
}

.login-box{
    background:#fff;
    padding:40px;
    border-radius:20px;
    width:350px;
    text-align:center;
    box-shadow:0 20px 50px rgba(0,0,0,0.3);
}

.login-box h2{
    color:#6366f1;
    margin-bottom:20px;
}

.login-box input{
    width:100%;
    padding:12px;
    margin:10px 0;
    border-radius:10px;
    border:1px solid #ddd;
}

.btn-login{
    background:linear-gradient(135deg,#6366f1,#4f46e5);
    color:white;
    border:none;
    padding:10px;
    width:100%;
    border-radius:10px;
    margin-top:15px;
}
</style>
</head>

<body>

<div class="login-box">
    <h2>Admin Portal</h2>

    <?php if($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="login" class="btn-login">Login</button>
    </form>
</div>

</body>
</html>