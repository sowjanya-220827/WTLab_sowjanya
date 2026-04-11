<?php
require_once 'DASHdb_con.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($username === '' || $email === '' || $password === '' || $confirm === '') {
        $errors[] = 'All fields are required.';
    }

    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    if ($password !== '' && strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters.';
    }

    if ($password !== '' && $confirm !== '' && $password !== $confirm) {
        $errors[] = 'Passwords do not match.';
    }

    if (!$errors) {
        $check = mysqli_prepare($conn, 'SELECT id FROM users WHERE username = ? OR email = ?');
        mysqli_stmt_bind_param($check, 'ss', $username, $email);
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);

        if (mysqli_stmt_num_rows($check) > 0) {
            $errors[] = 'Username or email already exists.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insert = mysqli_prepare($conn, 'INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)');
            mysqli_stmt_bind_param($insert, 'sss', $username, $email, $hash);
            mysqli_stmt_execute($insert);
            $success = 'Registration successful. You can log in now.';
        }

        mysqli_stmt_close($check);
        if (isset($insert)) {
            mysqli_stmt_close($insert);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f9ff; }
        .box { width: 420px; margin: 40px auto; padding: 24px; background: #fff; border-radius: 10px; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        input { width: 100%; padding: 8px; margin-top: 6px; }
        button { width: 100%; margin-top: 16px; padding: 10px; background: #27ae60; border: 0; border-radius: 6px; cursor: pointer; }
        .error { color: #b30000; }
        .success { color: #0a7a1f; }
        .links { margin-top: 12px; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Register</h2>

        <?php if ($errors): ?>
            <div class="error">
                <?php foreach ($errors as $e): ?>
                    <div><?php echo htmlspecialchars($e); ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <form method="POST" action="register.php">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username ?? ''); ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Confirm Password</label>
            <input type="password" name="confirm_password" required>

            <button type="submit">Create Account</button>
        </form>

        <div class="links">
            Already have an account? <a href="login.php">Log in</a>
        </div>
    </div>
</body>
</html>
