<?php

class Session
{

    /**
     * init
     *
     * @return void
     */
    public static function init(): void
    {
        session_start();
    }


    /**
     * set
     *
     * @param  string $key
     * @param  mixed $value
     * @return void
     */
    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }


    /**
     * get
     *
     * @param  string $key
     * @return mixed
     */
    public static function get(string $key): mixed
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }

        return false;
    }
}
