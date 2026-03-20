<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Auth Class
 * 
 * Handles user authentication using sessions.
 * Provides methods to:
 *  - Check if a user is authenticated
 *  - Get the currently authenticated user's information
 *  - Log in a user
 *  - Log out a user
 */
final class Auth
{
    /**
     * check
     * 
     * Checks if a user is currently authenticated in the session.
     * 
     * @return bool Returns true if a user is logged in, false otherwise.
     */
    public static function check(): bool
    {
        return Session::get('user') !== null;
    }

    /**
     * user
     * 
     * Returns the currently authenticated user's data.
     * 
     * @return array|null Returns an array with the user's data, or null if no user is logged in.
     */
    public static function user(): ?array
    {
        $user = Session::get('user');
        return is_array($user) ? $user : null; // Ensure the session data is an array
    }

    /**
     * login
     * 
     * Logs in a user by storing their data in the session.
     * 
     * @param array $user The user data to store in the session.
     */
    public static function login(array $user): void
    {
        Session::regenerate();       // Regenerate session ID to prevent session fixation
        Session::put('user', $user); // Save user data to the session
    }

    /**
     * logout
     * 
     * Logs out the current user and clears the session.
     */
    public static function logout(): void
    {
        Session::invalidate(); // Destroys the session and removes user data
    }
}