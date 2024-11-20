<?php

namespace Model;

// use \Model\User as User;

use PDOException;

defined('ROOTPATH') or exit('No direct script acces allowed');
/**
 * Main Model class
 */
Trait ModelResponses
{   
    use Database;


 
    protected $tableResponses = 'responses';
    protected $limit                = 10;
    protected $offset               = 0;
    protected $order_type           = "desc";
    protected $order_column         = "id";
    public $errors                  = [];

    /**
     * First Function
     */
    public function firstResponses($data,$data_not = [])
        {
            $keys = array_keys($data);
            $keys_not = array_keys($data_not);
            $query = "select * from $this->tableResponses where ";

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
     * Insert financial Data Function
     */
    public function insertResponses($data)
        {   
            if(!empty($this->allowedColumsResponses))
            {
                foreach($data as $key => $value )
                {
                    if(!in_array($key, $this->allowedColumsResponses))
                    {
                        unset($data[$key]);
                    }
                }
            }

            $keys = array_keys($data);
    
            $query = "Insert into $this->tableResponses (".implode(",",$keys).") values (:".implode(",:",$keys).")";
            $this->query($query,$data);
        }


    /**
    * Validate function
    */
    public function validateResponses($data)
        {
            $this->errors = [];

            if(!empty($data))
                {
                    $validationRules = $this->onInsertValidationRulesResponses;

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
                                                $this->errors[$column] = ucfirst($column). " zadejte prosím";
                                                break;

                                        case 'check':
                                            if(empty($data[$column]))
                                                $this->errors[$column] = " Akceptujte podmínky";
                                                break;

                                        case 'email':
                                            if(!filter_var(trim($data[$column]),FILTER_VALIDATE_EMAIL))
                                                $this->errors[$column] = " Tento email není validní";
                                                break;

                                        case 'alpha':
                                            if(!preg_match("/^[a-zA-Zá-žÁ-Ž]+$/",trim($data[$column])))
                                                $this->errors[$column] = ucfirst($column). " muže mít pouze písmena";
                                                break;

                                        case 'alpha_space':
                                            if(!preg_match("/^[a-zA-Zá-žÁ-Ž ]+$/",trim($data[$column])))
                                                $this->errors[$column] = ucfirst($column). " může mít pouze písmena a mezery";                     
                                                break;

                                        case 'numeric':
                                            if(!preg_match("/^[0-9]+$/",trim($data[$column])))
                                                $this->errors[$column] = ucfirst($column). " může mít pouze čísla";
                                                break;
                                        case 'alpha_numeric_space':
                                            if(!preg_match("/^[a-zA-Zá-žÁ-Ž0-9 ]+$/",trim($data[$column])))
                                                $this->errors[$column] = ucfirst($column). " může obsahovat pouze písmena číslice nebo mezery";
                                                break;
                                        case 'alpha_numeric_space_dot':
                                            if(!preg_match("/^[a-zA-Zá-žÁ-Ž0-9. ]+$/",trim($data[$column])))
                                                $this->errors[$column] = ucfirst($column). " může obsahovat pouze písmena, čísla nebo tečku";
                                                break;

                                        case 'alpha_numeric_symbol':
                                            if(!preg_match("/^[a-zA-Zá-žÁ-Ž0-9\-\_\$\%\*\[\]\(\)\&\. ]+$/",trim($data[$column])))
                                                $this->errors[$column] = ucfirst($column). "může mít pouze písmena, číslice a některé symboly";
                                                break;

                                        case 'alpha_symbol':
                                            if(!preg_match("/^[a-zA-Zá-žÁ-Ž\-\_\$\%\*\[\]\(\)\& ]+$/",trim($data[$column])))
                                                $this->errors[$column] = ucfirst($column). "může mít pouze písmena nebo některé symboly";
                                                break;

                                        case 'not_less_than_8_chars':
                                            if(strlen(trim($data[$column])) < 8)
                                                $this->errors[$column] = ucfirst($column). " nesmí obsahovat míň než 8 symbolů";
                                                break;

                                        case 'unique':
                                            $key = $this->getPrimaryKey();
                                            if(!empty($data[$key]))
                                                {   
                                                    //edit mode
                                                    if($this->firstResponses([$column=>$data[$column]],[$key=>$data[$key]]))
                                                    {
                                                        $this->errors[$column] = ucfirst($column). " musí být unikátní";
                                                    }
                                                }
                                                else
                                                {   
                                                    //insert mode
                                                    if($this->firstResponses([$column=>$data[$column]]))
                                                    {
                                                        $this->errors[$column] = ucfirst($column). " musí být unikátní";
                                                    }
                                                }
                                                break;

                                        default:
                                            $this->errors['rules'] = "Pravidlo" . $rule ." nebylo nalezeno";
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
}
