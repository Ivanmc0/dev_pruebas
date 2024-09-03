<?php
require_once $_SESSION['_CLASS'] . 'Cookies.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

define('JWT_SECRET', $_ENV['JWTOKEN']);
define('COOKIE_TIME', $_ENV['COOKIE_TIME']);
define('WORKER', $_ENV['SESSION_ID_WORKER']);
define('COMPANY', $_ENV['SESSION_ID_COMPANY']);

class JwTokens
{
    private $_COOKIES;

    public function __construct()
    {
        $this->_COOKIES = new Cookies();
    }

    public function NewSessionId($DataToken, $CookieName)
    {
        try {
              $NewToken = self::CreateNewToken($DataToken);
              $this->_COOKIES->Set($CookieName, $NewToken, COOKIE_TIME);
        } catch (\Throwable $e) {
            return $e;
        }

    }

    public function CookiesExists()
    {
        if (self::TokenExists(WORKER) === true) {
            $_SESSION["WORKER"] = self::TokenDecode(WORKER);
            $_SESSION["COMPANY"] = self::TokenDecode(COMPANY);
            return true;
        }
        return false;
    }

    public function TokenExists()
    {
        try {
            $Token = $this->_COOKIES->get(WORKER);
            $decoded = JWT::decode($Token, new Key(JWT_SECRET, 'HS256'));
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    private function TokenDecode($TokenName)
    {
        try {
            $Token = $this->_COOKIES->get($TokenName);
            $decoded = JWT::decode($Token, new Key(JWT_SECRET, 'HS256'));
            $decoded = json_decode(json_encode($decoded), true);
            return $decoded['data'];
        } catch (Exception $e) {
            return false;
        }
    }

    private function CreateNewToken($DataToken)
    {
        $payload = array("data" => $DataToken);
        return JWT::encode($payload, JWT_SECRET, 'HS256');
    }

}
