<?php

// Set PHP configuration for session security
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

// Set session cookie parameters
session_set_cookie_params([
    'lifetime' => 7200,       // Cookie lifetime: 30 minutes
    'domain' => 'localhost',  // Cookie domain
    'path' => '/',            // Cookie path
    'secure' => true,         // Cookie is sent over secure (HTTPS) connections
    'httponly' => true        // Cookie is accessible only via HTTP (not JavaScript)
]);

// Start or resume the session
session_start();

// Check if the user is logged in
if (isset($_SESSION["user_id"])) {
    // If "last_generation" session variable is not set
    if (!isset($_SESSION["last_generation"])) {
        regenerate_session_id(); // Regenerate session ID for logged-in user
    } else {
        // Regenerate session ID for logged-in user after a certain interval
        $interval = 60 * 120; // 30 minutes
        if (time() - $_SESSION["last_generation"] >= $interval) {
            regenerate_session_id();
        }
    }
} else {
    // If "last_generation" session variable is not set
    if (!isset($_SESSION["last_generation"])) {
        regenerate_session_id(); // Regenerate session ID for non-logged-in user
    } else {
        // Regenerate session ID for non-logged-in user after a certain interval
        $interval = 60 * 120; // 30 minutes
        if (time() - $_SESSION["last_generation"] >= $interval) {
            regenerate_session_id();
        }
    }
}

// Function to regenerate session ID
function regenerate_session_id() {
    session_regenerate_id(true); // true parameter ensures deleting old session data
    $_SESSION["last_generation"] = time();
}

// Function to regenerate session ID for logged-in user
function regenerate_session_id_loggedIn() {
    session_regenerate_id();
    
    // Get the user ID from the session
    $userId = $_SESSION["user_id"];
    
    // Generate a new session ID
    $newSessionId = session_create_id();
    
    // Append user ID to the new session ID
    $sessionId = $newSessionId . '_' . $userId;
    
    // Set the new session ID
    session_id($sessionId);
}