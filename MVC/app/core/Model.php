<?php

namespace Model;

// use \Model\User as User;

use PDOException;

defined('ROOTPATH') or exit('No direct script acces allowed');
/**
 * Main Model class
 */
Trait Model
{   
    use Database;
    // use User;

    protected $table = 'users';
    protected $limit                = 10;
    protected $offset               = 0;
    protected $order_type           = "desc";
    protected $order_column         = "id";
    public $errors                  = [];


    /**
     * FindAll Function
     */
    public function findAll()
        {
            
            $query = "select * from $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
            return $this->query($query);
        }

    /**
     * Where Function
     */
    public function where($data, $data_not = [])
        {
            $keys = array_keys($data);
            $keys_not = array_keys($data_not);
            $query = "select * from $this->table where ";

            foreach ($keys as $key)
            {
            $query .= $key . " = :" . $key . " && "; 
            }
            foreach ($keys_not as $key_not)
            {
            $query .= $key_not . " != :" . $key_not . " && "; 
            }
            $query = trim($query," && ");
        
            $query .= "order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
            $data = array_merge($data,$data_not);
            return $this->query($query,$data); 
        }

    /**
     * First Function
     */
    public function first($data,$data_not = [])
        {
          
            $keys = array_keys($data);
            $keys_not = array_keys($data_not);
            $query = "select * from $this->table where ";

            foreach ($keys as $key)
            {
            $query .= $key . " = :" . $key . " && "; 
            }
            foreach ($keys_not as $key_not)
            {
            $query .= $key_not . " != :" . $key_not . " && ";
            }

            $query = trim($query," && ");
            $query .= " limit $this->limit offset $this->offset";
            $data = array_merge($data,$data_not);
            $result = $this->query($query,$data); 
            if($result)
            {
                return $result[0];
            }
            return false; 
        }

    /**
     * Insert Function
     */
    public function insert($data)
        {   
          
            if(!empty($this->allowedColumns))
            {
                foreach($data as $key => $value )
                {
                    if(!in_array($key, $this->allowedColumns))
                    {
                        unset($data[$key]);
                    }
                }
            }

            $keys = array_keys($data);
    
               
                    $query = "Insert into $this->table (".implode(",",$keys).") values (:".implode(",:",$keys).")";
                $this->query($query,$data);

            
        }
 

    /**
     * Update Function
     */
    public function update($id,$data,$id_column = 'id')
        {  
            // Remove unwanted data //

            if(!empty($this->allowedColumns))
            {
                foreach($data as $key => $value )
                {
                    if(!in_array($key, $this->allowedColumns))
                    {
                        unset($data[$key]);
                    }
                }
            }

            $keys = array_keys($data);
            $query = "update $this->table set ";
            
            foreach ($keys as $key)
            {
                $query .= $key . " = :" . $key . ", "; 
            }
        
            $query = trim($query,", ");
            $query .= " where $id_column = :$id_column";


            $data[$id_column] = $id;    
            $this->query($query,$data);
            return false;
        }

    /**
     * Delete function
     */
    public function delete($id,$id_column = 'id')
        {
            $data[$id_column] = $id;
            
            $query = "delete from $this->table where $id_column = :$id_column";
            $this->query($query,$data);
            return false; 
        }



    /**
     * Get error function
     */
    public function getError($key)
    {
        if(!empty($this->errors[$key]))
            {
                return $this->errors[$key];
            }

        return "";
    }

     /**
     * Protected function PrimaryKey for validator
     */
    protected function getPrimaryKey()
        {
            return $this->primaryKey ?? 'id';
        }


    /**
    * Validate function
    */
    public function validate($data)
        {
            $this->errors = [];

                if(!empty($this->primaryKey) && !empty($data[$this->primaryKey]))
                {

                    $validationRules = $this->onUpdateValidationRules;
                }
                else
                {

                    $validationRules = $this->onInsertValidationRules;
                }

                if(!empty($validationRules))
                    {
                        foreach($validationRules as $column => $rules)
                        {   
                            if(!isset($data[$column]))
                                continue;

                            foreach($rules as $rule)
                            {
                                switch($rule)
                                {
                                    case 'required':
                                        if(empty($data[$column]))
                                            $this->errors[$column] = " The ".ucfirst($column). " is required";
                                            break;

                                    case 'check':
                                        if(empty($data[$column]))
                                            $this->errors[$column] = " Accpets terms and condition";
                                            break;

                                    case 'email':
                                        if(!filter_var(trim($data[$column]),FILTER_VALIDATE_EMAIL))
                                            $this->errors[$column] = " Email není validní";
                                            break;

                                    case 'alpha':
                                        if(!preg_match("/^[a-zA-Zá-žÁ-Ž]+$/",trim($data[$column])))
                                            $this->errors[$column] = ucfirst($column). " musí obsahovat pouze písmena";
                                            break;

                                    case 'alpha_space':
                                        if(!preg_match("/^[a-zA-Zá-žÁ-Ž ]+$/",trim($data[$column])))
                                            $this->errors[$column] = ucfirst($column). " musí obsahovat pouze písmena nebo mezery";                     
                                            break;

                                    case 'alpha_numeric_space':
                                        if(!preg_match("/^[a-zA-Zá-žÁ-Ž0-9 ]+$/",trim($data[$column])))
                                            $this->errors[$column] = ucfirst($column). " může obsahovat pouze písmena číslice a mezery";
                                            break;
                                    case 'alpha_numeric':
                                        if(!preg_match("/^a-zA-Zá-žÁ-Ž0-9]+$/",trim($data[$column])))
                                            $this->errors[$column] = ucfirst($column). " musí obsahovat pouze písmena a číslice";
                                            break;

                                    case 'alpha_numeric_symbol':
                                        if(!preg_match("/^[a-zA-Zá-žÁ-Ž0-9\-\_\$\%\*\[\]\(\)\& ]+$/",trim($data[$column])))
                                            $this->errors[$column] = ucfirst($column). "musí osbsahovat pouze písmena čislice nebo určité symboly";
                                            break;

                                    case 'alpha_symbol':
                                        if(!preg_match("/^[a-zA-Zá-žÁ-Ž\-\_\$\%\*\[\]\(\)\& ]+$/",trim($data[$column])))
                                            $this->errors[$column] = ucfirst($column). "musí obsahovat jenom písmena nebo určité symboly";
                                            break;

                                    case 'not_less_than_8_chars':
                                        if(strlen(trim($data[$column])) < 8)
                                            $this->errors[$column] = ucfirst($column). " nesmí mít míň než 8 znaků";
                                            break;

                                    case 'unique':
                                        $key = $this->getPrimaryKey();
                                        if(!empty($data[$key]))
                                            {   
                                                //edit mode
                                                if($this->first([$column=>$data[$column]],[$key=>$data[$key]]))
                                                {
                                                    $this->errors[$column] = ucfirst($column). " musí být unikátní";
                                                }
                                            }
                                            else
                                            {   
                                                //insert mode
                                                if($this->first([$column=>$data[$column]]))
                                                {
                                                    $this->errors[$column] = ucfirst($column). " musí být uníkátní";
                                                }
                                            }
                                            break;

                                    default:
                                        $this->errors['rules'] = "The rule " . $rule ." was not found";
                                        break;
    
                                }
                            }
                        }
                    }
                
                if(empty($this->errors))
                    {
                        return true;
                    }
            
                return false;
        }
}
