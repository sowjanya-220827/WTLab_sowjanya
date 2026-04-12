<?php
session_start();
require_once 'DASHdb_con.php';
require_once 'google_oauth_config.php';

function http_post_form($url, $data) {
    $payload = http_build_query($data);

    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        $result = curl_exec($ch);
        if ($result === false) {
            $err = curl_error($ch);
            curl_close($ch);
            return [null, $err];
        }
        curl_close($ch);
        return [$result, null];
    }

    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => $payload,
        ],
    ]);
    $result = @file_get_contents($url, false, $context);
    if ($result === false) {
        return [null, 'HTTP request failed'];
    }
    return [$result, null];
}

function http_get_json($url, $headers = []) {
    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($headers) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $result = curl_exec($ch);
        if ($result === false) {
            $err = curl_error($ch);
            curl_close($ch);
            return [null, $err];
        }
        curl_close($ch);
        return [$result, null];
    }

    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => $headers ? implode("\r\n", $headers) . "\r\n" : '',
        ],
    ]);
    $result = @file_get_contents($url, false, $context);
    if ($result === false) {
        return [null, 'HTTP request failed'];
    }
    return [$result, null];
}

if (isset($_GET['error'])) {
    echo 'Google sign-in error: ' . htmlspecialchars($_GET['error']);
    exit;
}

$state = $_GET['state'] ?? '';
if ($state === '' || !isset($_SESSION['oauth2_state']) || $state !== $_SESSION['oauth2_state']) {
    echo 'Invalid OAuth state. Please try again.';
    exit;
}
unset($_SESSION['oauth2_state']);

$code = $_GET['code'] ?? '';
if ($code === '') {
    echo 'Missing authorization code.';
    exit;
}

list($tokenResponse, $tokenError) = http_post_form('https://oauth2.googleapis.com/token', [
    'code' => $code,
    'client_id' => GOOGLE_CLIENT_ID,
    'client_secret' => GOOGLE_CLIENT_SECRET,
    'redirect_uri' => GOOGLE_REDIRECT_URI,
    'grant_type' => 'authorization_code',
]);

if ($tokenError || !$tokenResponse) {
    echo 'Token request failed: ' . htmlspecialchars($tokenError ?? 'Unknown error');
    exit;
}

$tokenData = json_decode($tokenResponse, true);
$accessToken = $tokenData['access_token'] ?? '';

if ($accessToken === '') {
    echo 'No access token returned from Google.';
    exit;
}

list($userInfoResponse, $userInfoError) = http_get_json(
    'https://openidconnect.googleapis.com/v1/userinfo',
    ['Authorization: Bearer ' . $accessToken]
);

if ($userInfoError || !$userInfoResponse) {
    echo 'Failed to fetch user info: ' . htmlspecialchars($userInfoError ?? 'Unknown error');
    exit;
}

$userInfo = json_decode($userInfoResponse, true);
$email = $userInfo['email'] ?? '';
$name = $userInfo['name'] ?? 'Google User';
$emailVerified = $userInfo['email_verified'] ?? false;

if ($email === '' || !$emailVerified) {
    echo 'Google account email not available or not verified.';
    exit;
}

// Check if user already exists by email
$lookup = mysqli_prepare($conn, 'SELECT id, username FROM users WHERE email = ?');
mysqli_stmt_bind_param($lookup, 's', $email);
mysqli_stmt_execute($lookup);
mysqli_stmt_store_result($lookup);

if (mysqli_stmt_num_rows($lookup) === 1) {
    mysqli_stmt_bind_result($lookup, $id, $username);
    mysqli_stmt_fetch($lookup);
    mysqli_stmt_close($lookup);
} else {
    mysqli_stmt_close($lookup);

    // Create a new local user for this Google account
    $baseUsername = preg_replace('/[^a-zA-Z0-9._-]/', '_', strstr($email, '@', true));
    if ($baseUsername === '') {
        $baseUsername = 'google_user';
    }

    $username = $baseUsername;
    $suffix = 1;
    while (true) {
        $check = mysqli_prepare($conn, 'SELECT id FROM users WHERE username = ?');
        mysqli_stmt_bind_param($check, 's', $username);
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);
        $exists = mysqli_stmt_num_rows($check) > 0;
        mysqli_stmt_close($check);

        if (!$exists) {
            break;
        }
        $username = $baseUsername . $suffix;
        $suffix++;
        if ($suffix > 50) {
            $username = $baseUsername . '_' . bin2hex(random_bytes(2));
            break;
        }
    }

    $randomPassword = bin2hex(random_bytes(16));
    $hash = password_hash($randomPassword, PASSWORD_DEFAULT);
    $insert = mysqli_prepare($conn, 'INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)');
    mysqli_stmt_bind_param($insert, 'sss', $username, $email, $hash);
    mysqli_stmt_execute($insert);
    $id = mysqli_insert_id($conn);
    mysqli_stmt_close($insert);
}

// Log the user in
session_regenerate_id(true);
$_SESSION['user_id'] = $id;
$_SESSION['username'] = $username ?: $name;
$_SESSION['login_provider'] = 'google';

header('Location: DASHindex.php');
exit;
?>
