<?php

require_once $_SESSION['_CLASS'] . 'Debug.php';
require_once $_SESSION['_CLASS'] . 'ReaderPaths.php';

$_RP = new ReaderPaths();
ReaderPaths::loadPaths();

require_once $_SESSION['_ROOT'] . $_SESSION['_ZENDOR'] . 'autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable($_SESSION['_ROOT']);
$dotenv->load();


require_once $_SESSION['_CLASS'] . 'Cookies.php';
require_once $_SESSION['_CLASS'] . 'JwTokens.php';
require_once $_SESSION['_CLASS'] . 'Mails.php';
require_once $_SESSION['_CLASS'] . 'OLC-Company.php';
require_once $_SESSION['_CLASS'] . 'OLC-Leletog.php';
require_once $_SESSION['_CLASS'] . 'OLC-Okr.php';
require_once $_SESSION['_CLASS'] . 'OLC-Platform.php';
require_once $_SESSION['_CLASS'] . 'OLC-Tucoach.php';
require_once $_SESSION['_CLASS'] . 'OLC-Valora.php';
require_once $_SESSION['_CLASS'] . 'OLC-Workers.php';
require_once $_SESSION['_CLASS'] . 'OLC-Growi.php';
require_once $_SESSION['_CLASS'] . 'OLC.php';

$_COOKIES  = new Cookies();
$_TOKENS   = new JwTokens();
$_MAILS    = new Mails();
$_WORKERS  = new Workers();
$_COMPANY  = new Company();
$_ZOOM     = new Zoom();
$_GROWI    = new Growi();
$_PLATFORM = new Platform();
$_TUCOACH  = new Tucoach();
$_LELE     = new Lele();
$_OKR      = new OKR();
$_VALORA   = new Valora();