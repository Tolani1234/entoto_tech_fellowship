<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dbconnect
 *
 * @author Tolani
 */
class dbconnect {
    //put your code here
    private $conn;
    function __construct() {
        
    }
    function connect(){
        $host='localhost';
        $user='root';
        $pass='';
        $dbname='php4';
        $this->conn=new mysqli($host,$user,$pass,$dbname);
        return $this->conn;
    }
}
