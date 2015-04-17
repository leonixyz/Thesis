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
                /* prompt the user to log in if not authentified */
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
        <?php
        $tables = $db->fetch("
            SELECT table_name as \"Available Tables\"
            FROM information_schema.tables
            WHERE table_catalog='{$DB_NAME}'
                AND table_schema='{$DB_IMPORT_SCHEMA}';
        ");
    
        /*for($i=0; $i<count($tables); $i++){
            $tables[$i]['Columns'] = 'none';
        }*/

            echo $page->getTable($tables);
        ?>
    </body>
</html>




<?php
/*
select proname, proargs, prosrc
from pg_catalog.pg_namespace n
join pg_catalog.pg_proc p
on pronamespace = n.oid
where nspname = 'public'
and proname like 'st\_%';
 */
?>
