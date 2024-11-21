<?php 

// session_start();

// use \Model\Functions as Functions;

use \Model\Dbcreator;
use \Core\App;

// echo phpversion();


// echo $this->check_extensions();

/** Valid PHP Version? **/

$minPHPVersion = '8.0';
if(phpversion() < $minPHPVersion)
{
    die("Your PHP version must be {$minPHPversion} or higher to run this app");
}


/** Path to this file **/
define ('ROOTPATH',__DIR__.DIRECTORY_SEPARATOR);


require "../app/core/init.php";

// DEBUG ? ini_Set('display_errors',1) : ini_Set('display_errors',0);


$app = new App;
$app->loadController();



$db = new Dbcreator;
$db->tablecreate();




