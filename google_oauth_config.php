<?php
// Replace these values with your Google OAuth credentials.
// Create them in Google Cloud Console -> Credentials -> OAuth client (Web application).
define('GOOGLE_CLIENT_ID', 'YOUR_GOOGLE_CLIENT_ID');
define('GOOGLE_CLIENT_SECRET', 'YOUR_GOOGLE_CLIENT_SECRET');

// This must exactly match an authorized redirect URI in Google Cloud Console.
// Example: http://localhost/WTLab_sowjanya/google_oauth_callback.php
define('GOOGLE_REDIRECT_URI', 'http://localhost/WTLab_sowjanya/google_oauth_callback.php');

// Basic scopes for sign-in
define('GOOGLE_OAUTH_SCOPES', 'openid email profile');
?>
