<?php
/**
 * Manage sessions and cookies all over the application scope
 */
class Session
{
    public static function init_session()
    {
        @session_start();
    }

    public static function add_to_session($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function remove_from_session($key)
    {
        Session::init_session();
        if (array_key_exists($key, $_SESSION)) {
            if ($_SESSION[$key] != null) {
                unset($_SESSION[$key]);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function get_from_session($key)
    {
        Session::init_session();
        if (array_key_exists($key, $_SESSION)) {
            if ($_SESSION[$key] != null) {
                return $_SESSION[$key];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function destroy_session()
    {
        session_destroy();
    }
}
