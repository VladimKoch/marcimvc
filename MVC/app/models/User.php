<?php 
/**
 * User Class
 */


namespace Model;

use Core\Session;

defined('ROOTPATH') or exit('No direct script acces allowed');



class User
{

    use Model;
    use ModelResponses;

    // protected $tableResponses = 'responses';
    // protected $table = 'users';
    protected $primaryKey = 'id';
    protected $loginUniqueColumn = 'Email';
    public $answers = [];
    
    protected $allowedColums = [

        'username',
        'email',
        'password',
        'terms',
    

    ];
    protected $allowedColumsResponses = [

        'Username_post',
        'Email',
        'Phone',
        'Roční_obrat',
        'Property_cards',
        'Employe',
        'Documents',
        'Legal_form',
        'Business',
        'Interest',
        'TaxPay',
        'Info',
    

    ];
    /*******************************
     *  
     *   rules inlcude:
            required
            alpha
            email
            numeric
            unique
            symbol
            alpha_space
            longer_than_8_chars
            alpha_numeric_symbol
            alpha_numeric
            alpha_symbol
     * 
     ********************************/
    protected $onInsertValidationRules = [

        'name'=>[
            'alpha_space',
            'unique',
            'required',
        ],
        'email'=>[
            'email',
            'unique',
            'required',
        ],
        'password'=>[
            'not_less_than_8_chars',
            'required',
        ],

        // 'terms'=>[
        //     // 'required',
        //     'check',
        // ]

        ];


        protected $onInsertValidationRulesResponses = [

            // 'Username_post',
            // 'Email',
            // 'Phone',
            // 'Annual_turnover',
            // 'Property_cards',
            // 'Employe',
            // 'Documents',
            // 'Legal_form',
            // 'Bussiness',
            // 'Interest',
            // 'TexPay',
            // 'Info',

            'Username_post'=>[
                'alpha_space',
                'unique',
                'required',
            ],
            'Email'=>[
                'email',
                'unique',
                'required',
            ],
            'Phone'=>[
                'numeric',
                'required',
            ],
    
            'Annual_turnover'=>[
                'required',
                'numeric',
            ],
    
            'Property_cards'=>[
                'required',
                'numeric',
            ],
    
            'Employe'=>[
                'required',
                
                'numeric',
            ],
    
            'Documents'=>[
                'required',
                'numeric',
            ],
    
            'Legal_form'=>[
                'required',
                'alpha_numeric_space_dot',
            ],
            'Business'=>[
                'required',
                'alpha_space',
            ],
            'Interest'=>[
                'required',
                // 'alpha_space',
            ],
            'TaxPay'=>[
                'required',
                // 'alpha_space',
            ],
            'Info'=>[
                // 'required',
                'alpha_numeric_space_dot',
            ],
    
            ];

        protected $onUpdateValidationRules = [

            'username'=>[
                'alpha_space',
                'unique',
                'required',
            ],
            'email'=>[
                'email',
                'unique',
                'required',
            ],
            'password'=>[
                'not_less_than_8_chars',
                'required',
            ],
    
            'terms'=>[
                // 'required',
                'check',
            ]
    
            ];


public function deleteUser($data)
{

    $row = $this->first([$this->loginUniqueColumn => $data[$this->loginUniqueColumn]]);
    if($row)
        {
           if(password_verify($data['password'],$row->Password))
           {
            //    $this->answers['delete'] = "Váš účet byl úspěšně smazán";
               $ses = new Session;
               $ses->logout();
            //    setcookie('flash_message','Váš účet byl úspěšně smazán.',time()+60,'/');
               $this->delete($row->Id);
                // show($this->answers);
                // die;
                // redirect('land');
                return true;
                
           }
           else
           {
             $this->errors[$this->loginUniqueColumn] = "Špatný " .$this->loginUniqueColumn." nebo Heslo";
                return false;
            }

        }
        else
        {
            $this->errors[$this->loginUniqueColumn] = "Špatný " .$this->loginUniqueColumn." nebo Heslo";
            return false;
        }
   
}

public function signUp($data)
{         
    if($this->validate($data))
    {   
        //add extra user column here
        $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);
        $data['CreatedOn'] = date("Y-m-d H:i:S");
        
        // unset($data['terms']);
        $this->insert($data);
        redirect('login');  
    }
}

public function logIn($data)
{         
       
        $row = $this->first([$this->loginUniqueColumn => $data[$this->loginUniqueColumn]]);
      
        if($row)
        {   
        
            //confirm password
            if(password_verify($data['password'],$row->Password))
            { 
                
                $ses = new Session;
                $ses->auth($row);
        
                redirect('home');  
                return true;
            }
            else
            {
                $this->errors[$this->loginUniqueColumn] = "Špatný " .$this->loginUniqueColumn." nebo Heslo";
                return false;
            }
            
        }
        else
        {
            $this->errors[$this->loginUniqueColumn] = "Špatný " .$this->loginUniqueColumn." nebo Heslo";
            return false;
        }

         
}
 







}



    // public function validate($data)
    //     {
    //         $this->errors = [];
    
    //         if(empty($data['email']))
    //             {
    //                 $this->errors['email'] = "Email nebyl vyplněn";
    //             }
    //             else
    //             {
    //                 if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL))
    //                 {
    //                     $this->errors['email'] = "Email je neplatný";
    //                 }
    //             }
        
    //         if(empty($data['password']))
    //             {
    //                 $this->errors['password'] = "Heslo nebylo vyplněno";
    //             }

    //         if(empty($data['terms']))
    //             {
    //                 $this->errors['terms'] = "Prosím akceptujte podmínky";
    //             }

    //         if(empty($this->PDOcatch_disable))
        
    //         if(empty($this->errors))
    //             {
    //                 return true;
    //             }
    //                 return false;
    //     }