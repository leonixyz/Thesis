<?php 
session_start();

/* load static html elements */
require_once(__DIR__.'/include/page_elements.php');

/* load db utils */
require_once(__DIR__.'/include/db.php'); 

/* load page content loading utils */
require_once(__DIR__.'/include/page_utils.php');

$page = new PageUtil(__FILE__);
$page->checkLogin();
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
            $tables = $db->fetch("
                SELECT table_name as \"Available Layers\"
                FROM information_schema.tables
                WHERE table_catalog='{$DB_NAME}'
                    AND table_schema='{$DB_IMPORT_SCHEMA}';
            ");
            echo $page->getTable($tables);
        ?>
    </body>
</html>
