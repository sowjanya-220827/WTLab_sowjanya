<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Home</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f9ff; }
        .box { width: 520px; margin: 40px auto; padding: 24px; background: #fff; border-radius: 10px; }
        a { display: inline-block; margin: 6px 0; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
        <p>Your login is active. Use the links below to explore the lab tasks:</p>
        <a href="DASH.html">Open Smart Health Dashboard (HTML)</a><br>
        <a href="Appoint_form.php">Book Appointment (POST form)</a><br>
        <a href="file_functions_demo.php">File Functions Demo</a><br>
        <a href="scope_demo.php">PHP Variable Scope Demo</a><br>
        <a href="logout.php">Log out</a>
    </div>
</body>
</html>
