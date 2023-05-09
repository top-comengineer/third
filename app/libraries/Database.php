<?php

 /***
  * PDO Database Class 
  * Connect to db
  * Bind Values
  * Return rows and All/Single results
  */

  class Database{

    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){
        //Set DSN
        $dsn ="mysql:host=". $this->host . ';dbname='. $this->dbname;
        $options = array(
          PDO::ATTR_PERSISTENT => true,
          PDO:: ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION
        );

        try {
            
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);

        } catch (PDOException $e){

            $this->error = $e->getMessage();
            echo $this->error;
        }
    }


    //Prepare statement with query
    public function query($sql){
       
       $this->stmt = $this->dbh->prepare($sql);
    }

    //Bind values
    public function bind($params, $value, $type=null){
       
        if(is_null($type)){
 
           switch(true){
            case is_int($value):
             $type = PDO::PARAM_INT;
            break;
            case is_bool($value):
              $type = PDO::PARAM_BOOL;
            break;
            case is_null($value):
              $type = PDO::PARAM_NULL;
            break;
             default:
              $type = PDO::PARAM_STR;
            
           }

        }

        $this->stmt->bindValue($params, $value, $type);   
    }

    // Execute the prepared statement
    public function execute(){
        return $this->stmt->execute();
    }

    // Get result set as array of objects
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single record as object
    public function single(){
        
        if( $this->execute()){
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }else{
            return false;
        }

    }

    // Get row count
    public function rowCount(){
        return $this->stmt->rowCount();
    }



}// end of class

