<?php
session_start();
require 'config/db.php';   // MongoDB connection

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifier = trim($_POST['identifier'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($identifier === '' || $password === '') {
        $errors[] = 'Both fields are required.';
    }

    if (!$errors) {

        // Find user by username OR email
        $user = $users->findOne([
            '$or' => [
                ['username' => $identifier],
                ['email' => $identifier]
            ]
        ]);

        if ($user) {

            // Verify password
            if (password_verify($password, $user['password'])) {

                session_regenerate_id(true);
                $_SESSION['user_id'] = (string)$user['_id'];
                $_SESSION['username'] = $user['username'];

                header('Location: DASHindex.php');
                exit;

            } else {
                $errors[] = 'Invalid credentials.';
            }

        } else {
            $errors[] = 'Invalid credentials.';
        }
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
        .oauth-btn { display: block; text-align: center; margin-top: 12px; padding: 10px; background: #fff; border: 1px solid #ddd; border-radius: 6px; text-decoration: none; color: #333; }
        .oauth-btn:hover { background: #f7f7f7; }
        .error { color: #b30000; }
        .links { margin-top: 12px; }
        .divider { margin: 16px 0; text-align: center; color: #777; font-size: 14px; }
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

        <form method="POST" action="">
            <label>Username or Email</label>
            <input type="text" name="identifier" value="<?php echo htmlspecialchars($identifier ?? ''); ?>" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Log In</button>
        </form>

        <div class="divider">or</div>
        <a class="oauth-btn" href="google_oauth_start.php">Sign in with Google</a>

        <div class="links">
            New user? <a href="register.php">Create an account</a>
        </div>
    </div>
</body>
</html>