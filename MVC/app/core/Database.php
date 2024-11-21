<?php

namespace Model;

use PDO;

defined('ROOTPATH') or exit('No direct script acces allowed');
Trait Database
{


    private function connect()
        {
            $string = "mysql:hostname=".DBHOST.";dbname=".DBNAME;
            $con = new PDO($string,DBUSER,DBPASS);
            return $con;
        }

    public function query($query, $data = [])
        {
            $con = $this->connect();
            $stm = $con ->prepare($query);


            $check = $stm->execute($data);
            if($check)
            {
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                if(is_array($result) && count($result))
                {
                    return $result;
                }
            }

            return false;
        }

    public function tableCreate(string $dbname)
    {
        $con = $this->connect();
    }

    public function get_row($query, $data = [])
        {
            $con = $this->connect();
            $stm = $con ->prepare($query);

            

            $check = $stm->execute($data);
            if($check)
            {
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                if(is_array($result) && count($result))
                {
                    return $result[0];
                }
            }

            return false;
        }

}


