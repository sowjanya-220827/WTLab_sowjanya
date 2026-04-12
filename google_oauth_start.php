<?php
session_start();
require_once 'google_oauth_config.php';

if (GOOGLE_CLIENT_ID === 'YOUR_GOOGLE_CLIENT_ID') {
    echo 'Google OAuth is not configured. Update google_oauth_config.php first.';
    exit;
}

$state = bin2hex(random_bytes(16));
$_SESSION['oauth2_state'] = $state;

$params = [
    'client_id' => GOOGLE_CLIENT_ID,
    'redirect_uri' => GOOGLE_REDIRECT_URI,
    'response_type' => 'code',
    'scope' => GOOGLE_OAUTH_SCOPES,
    'state' => $state,
    'access_type' => 'online',
    'prompt' => 'select_account',
    'include_granted_scopes' => 'true',
];

$authUrl = 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query($params);
header('Location: ' . $authUrl);
exit;
?>
