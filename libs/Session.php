<?php
/**
 * @author Javier Luque Rodríguez
 */
 require_once 'User.php';

 /**
  * Session
  */
class Session
{
    private const EXPIRE_TIME = 300; // 5 minutes
    private static $session = null;

    private function __clone()
    {
    }
    public function __construct()
    {
    }

    /**
     * Return only one Session instance
     * @return Session
     */
    public static function getSession():Session
    {
        session_start() ;

        if (isset($_SESSION["session"])) {
            self::$session = unserialize($_SESSION["session"]);
        } elseif (self::$session==null) {
            self::$session = new Session ;
        }
        
        
        return self::$session ;
    }

    /**
     * Checks if the email and password introduced are correct
     * and starts the session.
     *
     * @param  string $email
     * @param  string $password
     * @return void
     */
    public function login(String $email, string $password)
    {
        if (User::checkLogin($email, $password)) {
            $_SESSION["started"] = time();
            $_SESSION["user"] = User::getUserByEmail($email);
            $_SESSION["session"] = serialize(self::$session);
            $this->loggedToLanding();
        }
        
    }

    /**
     * loggedToLanding
     * Checks if is logged and redirects the user to the corresponding landing page
     *
     * @return void
     */
    public function loggedToLanding()
    {
        if ($this->logged()) {
            switch ($_SESSION["user"]->getUserType()) {
                case 1:
                    self::redirect("/admin/");
                    break;
                case 10:
                    self::redirect("/librarian/");
                    break;
                case 20:
                    self::redirect("/student/");
                    break;
            }
        }
    }

    /**
     * checkAdmin
     * Checks if the user is an admin
     *
     * @return bool
     */
    public function checkAdmin():bool
    {
        return $_SESSION["user"]->getUserType() == 1;
    }
            
    /**
     * Checks if the user is a librarian or an admin
     *
     * @return bool
     */
    public function checkLibrarian():bool
    {
        return $_SESSION["user"]->getUserType() < 11;
    }

    /**
     * Check if the user is logged and the session hasn't expired
     *
     * @return bool
     */
    public function logged():bool
    {
        if (!empty($_SESSION)) {
            $time_log = $_SESSION["started"] ?? 0;
            $time_now = time();
            return ($time_now - $time_log) < self::EXPIRE_TIME;
        } else {
            return false;
        }
    }

    /**
     * Redirect to the URL indicated
     * @param string $url
     * @return void
     */
    public function redirect($url = "/")
    {
        header("location: $url");
        die();
    }

    /**
     * Closes the sessión and redirect to index.html
     * @return void
     */
    public function logout()
    {
        $_SESSION = [];
        session_destroy();
        self::redirect("/");
    }

    /**
     * Refresh when the session started
     * 
     * @return void
     */
    public function __wakeup()
    {
        $_SESSION["started"] = time();
    }
    
    /**
     * __toString
     *
     * @return string
     */
    public function __toString():string
    {
        return "<pre>" . print_r($_SESSION) . "</pre>";
    }
}
