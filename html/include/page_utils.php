<?php
/*  PAGE UTILITY
 *
 *  Class for dynamically get some of the page elements.
 *
 */

require_once(__DIR__.'/db.php');
require_once(__DIR__.'/page_elements.php');

class PageUtil{

    /* the file name of the page that has to be rendered */
    private $page;

    /* a connection to the database */
    private $db;

    /* all kind of metadata about the page */
    private $data;

    public function __construct($page){
        global $DB_TYPE, $DB_HOST, $DB_PORT, $DB_NAME, $DB_USER, $DB_PASS;
        $this->page = $page;
        $this->db = new DB($DB_USER, $DB_PASS, $DB_TYPE, $DB_HOST, $DB_PORT, $DB_NAME);
        //TODO create table
        //$this->data = $this->db->fetch('SELECT * FROM site.pages WHERE name=?;', array($page));
    }

    public function getTitle(){
        //TODO
        return "Very very welcome.";
    }

    public function getJavascripts(){
        return "<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>";
    }

    public function getStylesheets(){
        return "<link href='main.css' rel='stylesheet' type='text/css'>";
    }
    
    public function getError($errorStr){
        global $ERROR_BOX;
        return preg_replace('{ERROR_STR}', $errorStr, $ERROR_BOX)."\n</body>\n</html>";
    }

    public function getTable(array $table=array()){
        if(empty($table)){
            return null;
        }

        $result = "<table>\n";
        foreach($table[0] as $k=>$v){
            $result .= '<th>' . $k . "</th>\n";
        }
        foreach($table as $row){
            $result .= "<tr>\n";
            foreach($row as $cell){
                $result .= '<td>' . $cell . "</td>\n";
            }
            $result .= "</tr>\n";
        }
        $result .= "</table>\n";

        return $result;
    }
}


