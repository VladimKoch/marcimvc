CREATE DATABASE MSUCTO;


DROP TABLE IF EXISTS users;

 CREATE TABLE `users` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `Name` varchar(100) NOT NULL,
    `Email` varchar(255) NOT NULL,
    `Password` varchar(255) NOT NULL,
    `CreatedOn` datetime NOT NULL,
    PRIMARY KEY (`Id`)
   ) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
   
    
    
DROP TABLE IF EXISTS responses;

    CREATE TABLE `responses` (
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci