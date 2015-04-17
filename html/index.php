<?php 
session_start();

/* load static html elements */
require_once(__DIR__.'/include/page_elements.php');

/* load db utils */
require_once(__DIR__.'/include/db.php'); 

/* load page content loading utils */
require_once(__DIR__.'/include/page_utils.php');

$page = new PageUtil(__FILE__);
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title><?php $page->getTitle(); ?></title>
        <?php echo $page->getJavascripts(); ?>
        <?php echo $page->getStylesheets(); ?>
    </head>
    <body>
        <?php
            if(!isset($_REQUEST['user']) || !isset($_REQUEST['password'])) {
                /* prompt the user to log in if not authenticated */
                die($LOGIN_BOX."\n</body>\n</html>");
            }
            else{
                $db = new DB($_REQUEST['user'], $_REQUEST['password']);
                if(!$db->isValid()){
                    /* the user couldn't connect to the database with the credentials supplied */
                    die($page->getError($db->getError()));
                }
                else{
                    //TODO improve security
                    $_SESSION['user'] = array('name'=>$_REQUEST['user'], 'password'=>$_REQUEST['password']);
                }
            }
        ?>

        <h2 class='centered'>Welcome!</h2>
        <ul>
            <li>import</li>
            <li><a href='rules.php'>rules</a></li>
            <li>analysis</li>
        </ul>
    </body>
</html>
