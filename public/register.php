<?php
require_once __DIR__ . '/../app/Controllers/AuthController.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new AuthController();
    $result = $auth->register($_POST);

    if ($result === "success") {
        header("Location: login.php");
        exit;
    } else {
        $message = $result;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Create Account</h2>

<?php if ($message): ?>
<p style="color:red;"><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST">
    <input type="text" name="name" placeholder="Full Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Register</button>
</form>

</body>
</html>
