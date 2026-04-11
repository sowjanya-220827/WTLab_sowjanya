<?php
session_start();
require_once 'DASHdb_con.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifier = trim($_POST['identifier'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($identifier === '' || $password === '') {
        $errors[] = 'Both fields are required.';
    }

    if (!$errors) {
        $stmt = mysqli_prepare($conn, 'SELECT id, username, password_hash FROM users WHERE username = ? OR email = ?');
        mysqli_stmt_bind_param($stmt, 'ss', $identifier, $identifier);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) === 1) {
            mysqli_stmt_bind_result($stmt, $id, $username, $hash);
            mysqli_stmt_fetch($stmt);

            if (password_verify($password, $hash)) {
                session_regenerate_id(true);
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                header('Location: DASHindex.php');
                exit;
            } else {
                $errors[] = 'Invalid credentials.';
            }
        } else {
            $errors[] = 'Invalid credentials.';
        }

        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f9ff; }
        .box { width: 420px; margin: 40px auto; padding: 24px; background: #fff; border-radius: 10px; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        input { width: 100%; padding: 8px; margin-top: 6px; }
        button { width: 100%; margin-top: 16px; padding: 10px; background: #3498db; border: 0; border-radius: 6px; cursor: pointer; }
        .error { color: #b30000; }
        .links { margin-top: 12px; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Login</h2>

        <?php if ($errors): ?>
            <div class="error">
                <?php foreach ($errors as $e): ?>
                    <div><?php echo htmlspecialchars($e); ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <label>Username or Email</label>
            <input type="text" name="identifier" value="<?php echo htmlspecialchars($identifier ?? ''); ?>" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Log In</button>
        </form>

        <div class="links">
            New user? <a href="register.php">Create an account</a>
        </div>
    </div>
</body>
</html>
