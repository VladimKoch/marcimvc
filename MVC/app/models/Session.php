<?php

/**
 * Session Class
 * Save or read data to the current session
 * 
 */

namespace Core;

use \Model\Database as Database;



defined('ROOTPATH') OR exit('Acces Denied');


class Session
{  
    use Database;

    public $mainkey = 'APP';
    public $userkey = 'USER';

    /** active session if not yet started **/
    private function start_session(): int
    {
        if(session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }

        return 1;
    }

  

    /** put data into session **/
    public function set(mixed $keyOrArray, mixed $value = ''):int
    {
        $this->start_session();

        if(is_array($keyOrArray))
        {
            foreach($keyOrArray as $key => $value)
            {
                $_SESSION[$this->mainkey][$key] = $value;
            }

            return 1;
        }
        $_SESSION[$this->mainkey][$keyOrArray] = $value;
        return 1;
    }

    /** Get data from the session. default is return if data not found **/
    public function get(string $key,mixed $default = ''): mixed
    {
        $this->start_session();

        if(isset($_SESSION[$this->mainkey][$key]))
        {
            return $_SESSION[$this->mainkey][$key];
        }

        return $default;
    }

    /** Saves the user row data into the session after a login **/

    public function auth(mixed $user_row): int
    {
        $this->start_session();

        $_SESSION[$this->userkey] = $user_row;
    
        return 0;
    }

    /** Removes user data rom the session **/
    public function logout(): int
    {
        $this->start_session();

        if(!empty($_SESSION[$this->userkey]))
        {
            unset($_SESSION[$this->userkey]);
        }

        return 0;
    }

    /** Check if user is logged in **/
    public function is_logged_in():bool
    {
        $this->start_session();

        if(!empty($_SESSION[$this->userkey]))
        {
            return true;
        }
        return false;
    }

    /** Check if user is an admin **/
    public function is_admin(): bool
    {
        $this->start_session();
          
        if(!empty($_SESSION[$this->userkey]))
        {
            $arr = [];
            $arr['id'] = $_SESSION[$this->userkey] -> role_id;

            if($this->get_row("Select * from auth_roles where id = :id && role = 'admin' limit 1",$arr))
            {
                return true;
            }
        }

        return false;
    }

    /** Gets data from a column in the session user data **/
    public function user(string $key = '', mixed $default = ''): mixed
    {
        $this->start_session();

        if(empty($key) && !empty($_SESSION[$this->userkey]))
        {
            return $_SESSION[$this->userkey];
        }
        else
        
            if(!empty($_SESSION[$this->userkey]->$key));
            {
                return $_SESSION[$this->userkey]->$key;
            }

            return $default;
        
    }

    /** Returns data form a key and deletes it **/

    public function pop(string $key,mixed $default = ''): mixed
    {
        $this->start_session();

        if(!empty($_SESSION[$this->mainkey][$key]))
        {
            $value = $_SESSION[$this->mainkey][$key];
            unset($_SESSION[$this->mainkey][$key]);
            return $value;
        }
        return $default;
    }


    /* Returns all data from the APP array **/
    public function all(): mixed
    {
        $this->start_session();
        if(isset($_SESSION[$this->mainkey]))
        {
            return $_SESSION[$this->mainkey];
        }

        return [];
    }
 }