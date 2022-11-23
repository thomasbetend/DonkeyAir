<?php

class UserController
{
    public static function getLogin()
    {
        if($_POST){
            $users = UserRepository::getList(
                [
                    "id" => '', 
                    "firstname" => '', 
                    "lastname" => '', 
                    "email" => '',
                    "password" => '',
                ]
            ); 
    
            $errorMessage = [];
    
            if(empty($_POST['user_email']) || empty($_POST['user_password'])){
                $errorMessage['fields'] = "Remplissez tous les champs";
            } else {
                foreach($users as $user){
                    if(($user->getEmail() === $_POST['user_email']) && (password_verify($_POST['user_password'], $user->getPassword()))){
                        Session::login($user);
                        if($_POST['user_email'] === 'admin@gmail.com'){
                            Session::loginAdmin($user);
                        }
                        header('location:./accueil');
                        exit;
                    } else {
                        $errorMessage['incorrect'] = "Renseignements incorrects";
                    }
                }
            }
        }

        include("./View/login.html.php");
    }

    public static function getLogout()
    {
        header("location:../accueil");
    }

    public static function getSignup()
    {
        if($_POST){

            $errorMessage = [];
        
            /* Mail already existing ? */
        
            $user = UserRepository::getList(
                [
                    "id" => '', 
                    "firstname" => '', 
                    "lastname" => '', 
                    "email" => $_POST['user_email'],
                    "password" => '',
                ]
            );
        
            if(!empty($_POST['user_email']) && !empty($user)){
        
                $errorMessage['mail_used'] = true;
        
            }
        
            /* mail security */
        
            if((!empty($_POST['user_email'])) && (filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL) === false)){
        
                $errorMessage['mail_incorrect'] = true;
        
            }
        
            /* Empty fields */
        
            if(empty($_POST['user_lastname']) || empty($_POST['user_firstname']) || empty($_POST['user_email']) || empty($_POST['user_password'])){
        
                $errorMessage['fields']  = true;
        
            }
        
            if(empty($errorMessage)){
        
                /* insert new user */
        
                Database::insertUser(
                    [
                        "firstname" => $_POST['user_firstname'], 
                        "lastname" => $_POST['user_lastname'], 
                        "email" => $_POST['user_email'],
                        "password" => password_hash($_POST['user_password'], PASSWORD_DEFAULT),
                    ]
                );
        
                /* create session id */
        
                $user = UserRepository::getList(
                    [
                        "id" => '', 
                        "firstname" => '', 
                        "lastname" => '', 
                        "email" => $_POST['user_email'],
                        "password" => '',
                    ]
                );
        
                Session::login($user[0]);
        
        
                header('location:/accueil');
                exit;
            }
        }

        include("./View/signup.html.php");
    }

}