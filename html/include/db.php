<?php
/*  DATABASE
 *
 *  Class for easily access the database.
 *
 */

require_once(__DIR__.'/../config/db.php');

class DB{

    /* PDO for the connection to the database */
    private $pdo;

    /* some error occurred */
    private $error;

    /* state indicating if the object is valid or not */
    private $isValid = false;

    function __construct($user, $password, $pdo_driver='pgsql', $host='127.0.0.1', $port=5432, $dbname='mydb'){
        try{
            $this->pdo = new PDO("{$pdo_driver}:host={$host};port={$port};dbname={$dbname};user={$user};password={$password}");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->isValid = true;
        }
        catch(PDOException $ex) {
            $this->isValid = false;
            $this->error = $ex->getMessage();
        }
    }

    function fetch($sql, array $params=array()){
        $result = array();
        try{
            $stmt = $this->pdo->prepare($sql);
            foreach($params as $k=>$p){
                $stmt->bindParam($k, $p);
            }
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $ex) {
            //TODO change
            die($ex->getMessage());
        }
        
        return $result;
    }

    public function isValid(){
        return $this->isValid;
    }

    public function getError(){
        return $this->error;
    }
}
