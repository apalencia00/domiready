<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

  if ( isset($_REQUEST['un'])) {
	
	$user = $_REQUEST['un'];
	$pass = $_REQUEST['pw'];
}else if(isset($_SESSION['un'])){
	$user=$_SESSION['un'];
	$pass=$_SESSION['pw'];
}else{
	$user="mandaos";
	$pass="m4nd40s";
	
}

        $bd_name = "mandaos_db";

    define('DB_HOST','localhost'); 
    define('DB_USER',$user); 
    define('DB_PASS',$pass); 
    define('DB_NAME','mandaos_db'); 
    define('DB_CHARSET','utf-8'); 
