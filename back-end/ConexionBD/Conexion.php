<?php
// Connecting, selecting database
   
   session_start();
   

   error_reporting(E_ALL);

class Conexion {

    var $db, $connection;
    
    private $server     = "18.191.168.53" ;
    private $database   = "domiready_db" ;
    private  $username  = "domiready_u" ;
    private  $password  = "/*-domiready_pw";
    
    private $link ;

    public function __construct() {    }
    
    
    public function conectar() {
        
        if ( isset($_REQUEST['un'])  && isset($_REQUEST['pw']) ) {
    
    $user = $_REQUEST['un'];
    $pass = $_REQUEST['pw'];
}else{

    $user = "domiready_u";
    $pass = "/*-domiready_pw";
    
}
        
        
        $stringConnection="host=".$this->server." dbname=".$this->database." user=".$user." password=".$pass;
        $this->connection = pg_connect($stringConnection)
        or die('No es posible la conexion: ' . pg_last_error());
        
        //var_dump($stringConnection);
        
    }
    
     public function insertSQL($table, $insertValues) {

        foreach($insertValues as $key=>$value) {
            $keys[] = $key;
            $insertArray[] = '\''.$value.'\'';
        }

        $keys = implode(',', $keys);
        $insertArray = implode(',', $insertArray);

        $sql = "INSERT INTO $table ($keys) VALUES ($insertArray)";
        $this->executeQuery($sql);

    }
   
    public function executePL($pl,$insertValues){
    	
         foreach($insertValues as $key=>$value) {
           $insertArray[] = '\''.$value.'\'';
        }
        $insertArray = implode(',', $insertArray);
        
    	  $sql = "SELECT * from $pl($insertArray)";

        $result = $this->executeQuery($sql);
        
        $i=0;
        while ($row = pg_fetch_assoc($result)){
        	  $array[$i]=$row;
        	  $i++;
        	}

          #var_dump($array);
		return $array;    	
    	
    	}


      public function executePLoutParam($pl){
      
       
        
        $sql = "SELECT * from $pl()";

        $result = $this->executeQuery($sql);
        
        $i=0;
        while ($row = pg_fetch_assoc($result)){
            $array[$i]=$row;
            $i++;
          }

          #var_dump($array);
    return $array;      
      
      }

       
        
    public function executeSql($table, $keyColumnName, $idComparator, $fields) {
        
        $sql = "SELECT $fields FROM $table WHERE upper($keyColumnName) = upper('$idComparator')";

        $result = $this->executeQuery($sql);
        
        $i=0;
        while ($row = pg_fetch_assoc($result)){
        	  $array[$i]=$row;
        	  $i++;
        	}
		return $array;    
        
    }

    public function sql($table,$fields){

         $sql = "SELECT $fields FROM $table";

        $result = $this->executeQuery($sql);
        
        $i=0;
        while ($row = pg_fetch_assoc($result)){

              $array[$i]=$row;
              $i++;
            }

        return $array;    

    }

      
    
    
    public function getObjectsByID($table, $keyColumnName, $idComparator, $fields){

        $sql = "SELECT $fields FROM $table WHERE upper($keyColumnName) = upper('$idComparator')";

        $result = $this->executeQuery($sql);
        
        return pg_fetch_assoc($result);

    }

    public function getObjectsBy2ID($table, $keyColumnName,$keyColumnName2, $idComparator,$idComparator2, $fields){

        $sql = "SELECT $fields FROM $table WHERE $keyColumnName = '$idComparator' and $keyColumnName2 = '$idComparator2'";

        $result = $this->executeQuery($sql);
     
        return pg_fetch_assoc($result);

    }
    
     private function executeQuery($sql) {
        
		  
      $result = pg_query($this->connection,$sql);        
        
        if($result) {
            return $result;
            #|var_dump($result);
        } else {
            echo json_encode(array(
                "success" => false,
                "data" => $this->getSQLError()
                ));
        }
    }

    private function getSQLError() {
       echo json_encode(array(
            "success" => false,
            "message" => 'Ha ocurrido un error: '. pg_last_error()
            ));
    }

 
  public function executeView($sqlq){

      $resultaado = $this->executeQuery($sqlq);

    return pg_fetch_assoc($resultaado);

  }

  public function query($sqlq){

    $resultaado = $this->executeQuery($sqlq);

     $i=0;
        while ($row = pg_fetch_assoc($resultaado)){
              $array[$i]=$row;

            
              $i++;
            }

           

        return $array; 
  }


 
    
}

?>