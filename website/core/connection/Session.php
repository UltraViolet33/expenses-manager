<?php

class Session
{

    public static function init(): void
    {
        session_start();
    }


    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }


    public static function get(string $key): mixed
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }

        return false;
    }


    public static function unsetKey(string $key): bool
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
            return true;
        }
        return false;
    }

    
    public static function destroy()
    {
        session_destroy();
        echo "<script>window.location='login.php';</script>";
    }
}
