<?php

namespace Model;

use PDO;

use PDOException;

defined('ROOTPATH') or exit('No direct script acces allowed');


class Dbcreator
{
   

    protected $tableUsers = 'users';
    protected $tableResponses = 'responses';

    protected $tableUsersQuery = 

     "CREATE TABLE IF NOT EXISTS `users` (
        `Id` int(11) NOT NULL AUTO_INCREMENT,
        `Name` varchar(100) NOT NULL,
        `Email` varchar(255) NOT NULL,
        `Password` varchar(255) NOT NULL,
        `CreatedOn` datetime NOT NULL,
        PRIMARY KEY (`Id`)
       ) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
    
    protected $tableResponsesQuery =  "CREATE TABLE IF NOT EXISTS `responses` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `time_date` datetime NOT NULL DEFAULT current_timestamp(),
        `Username_post` varchar(255) NOT NULL,
        `Email` varchar(255) NOT NULL,
        `Phone` varchar(255) NOT NULL,
        `Annual_turnover` decimal(10,0) NOT NULL,
        `Property_cards` int(11) NOT NULL,
        `Employe` int(11) NOT NULL,
        `Documents` int(11) NOT NULL,
        `Legal_form` varchar(255) NOT NULL,
        `Business` varchar(255) NOT NULL,
        `Interest` varchar(255) NOT NULL,
        `TaxPay` varchar(255) NOT NULL,
        `Info` varchar(1000) DEFAULT NULL,
        PRIMARY KEY (`id`)
       ) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";    
        

    public function __construct()
  
    {   
        try{

            $string = "mysql:hostname=".DBHOST;
            $con = new PDO($string,DBUSER,DBPASS);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE DATABASE IF NOT EXISTS ".DBNAME;
            $con -> exec($sql);
            
          
        }
        catch(PDOException $e)
        {
            die( "Chyba ve vytvoření databáze: " . $e->getMessage());
        }




    }

    public function tablecreate()
    {   
        try
        {
            $string = "mysql:hostname=".DBHOST.";dbname=".DBNAME;
            $con = new PDO($string,DBUSER,DBPASS);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $con-> exec($this->tableUsersQuery);
            $con-> exec($this->tableResponsesQuery);
            
        }
        catch (PDOException $e)
        {
            die("Chyba ve vytvoření tabulek " . $e->getMessage());
        }
    }

    

}

