<?php

 class Users extends Controller{

   public function __construct(){
    $this->userModel = $this->model('User');
   }

    public function index(){

        $data = [
          'title' => '404 - Page Does not Exit',  
          'description'=>''
        ];
        $this->view('Not_Found/404', $data);
    }
    
   

    public function register(){

        // Check the Post
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process the from

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Init Data
            $data = [
            'username' => trim($_POST['username']),
            'email' => trim($_POST['email']),
            'password'=> trim($_POST['password']),
            'confirm_password' => trim($_POST['confirm_password']),
            'username_error'=>'',
            'email_error' =>'',
            'password_error'=>'',
            'confirm_password_error'=>''
            ];

            // Validate Email
            if(empty($data['email'])){
                $data['email_error'] = 'Pleae enter email';    
            }else {
                // Check email
                if($this->userModel->findUserByEmail($data['email'])){
                  $data['email_error'] = 'Email is already taken';
                }
            }

            // Validate Name
            if(empty($data['username'])){
            $data['username_error'] = 'Pleae enter name';
            }

            // Validate Password
            if(empty($data['password'])){
                $data['password_error'] = 'Pleae enter password';
            } elseif(strlen($data['password']) < 6){
                $data['password_error'] = 'Password must be at least 6 characters';
            }

            
            // Validate Confirm Password
            if(empty($data['confirm_password'])){
                $data['confirm_password_error'] = 'Pleae confirm password';
            } else {
                if($data['password'] != $data['confirm_password']){
                $data['confirm_password_error'] = 'Passwords do not match';
                }
            }

            // Make sure errors are empty
            if(empty($data['email_error']) && empty($data['name_err']) && empty($data['password_error']) && empty($data['confirm_password_error'])){
                
                // Validated save the data

                //Hash the password Uusing PHP: password_hashing_function using bcrypt_blowfish:
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);


                // Register User
                if($this->userModel->register($data)){
                   
                   flash('register_success', 'Your now registred -> can login');

                   redirect('/users/login');
                } 
                else{
                    die('Something went wrong'); // or redirect('Not_Found/"--Something"')
                }


            } else {
                // Load view with errors
                $this->view('auth/register', $data);
            }





        }else{

            //Init Data
            $data = [
                'username' => '',
                'email' =>'',
                'password'=>'',
                'confirm_password' =>'',
                'username_error'=>'',
                'email_error' =>'',
                'password_error'=>'',
                'confirm_password_error'=>''
            ];

            $this->view('auth/register', $data);
            
        }

    }

    public function login(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Init Data
            $data = [
            
            'email' => trim($_POST['email']),
            'password'=> trim($_POST['password']),
            'email_error' =>'',
            'password_error'=>'',
          
            ];

            // Validate Email
             if(empty($data['email'])){
                $data['email_error'] = 'Pleae enter email';
            }

            // Validate Password
            if(empty($data['password'])){
                $data['password_error'] = 'Pleae enter password';
            } 
            
            // Check for user/email
            if($this->userModel->findUserByEmail($data['email'])){
                // User found
            } else {
                // User not found
                $data['email_error'] = 'No user found';
            }


            // Make sure errors are empty
            if(empty($data['email_error'])  && empty($data['password_error'])){
              
              // Validated 
              // Check and set logged in user
              $loggedInUser = $this->userModel->login($data['email'], $data['password']);

              if($loggedInUser){

               // Create Session
               $this->createUserSession($loggedInUser);
                
              } else {
                $data['password_error'] = 'Password incorrect';
                $this->view('auth/login', $data);
              }

            } else {
                // Load view with errors
                $this->view('auth/login', $data);
            }

        } else {
          // Init data
          $data =[    
            'email' => '',
            'password' => '',
            'email_error' => '',
            'password_error' => '',        
          ];
  
          // Load view
          $this->view('auth/login', $data);
        }
    }

    public function update(){
      // Check for POST request
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
          'name'      => trim($_POST['uname']),
          'email'     => trim($_POST['email']),
          'password'  => trim($_POST['pswd']),
        ];

        if($this->userModel->update($data)){
          flash('update_sccuss', 'Your profile is updated successfully!');
        //   $_SESSION['user_id'] = $user->id;
        //   $_SESSION['user_email'] = $user->email;
        //   $_SESSION['user_name'] = $user->username;
          $this->createUserSession($data);
        //   redirect("/users/profile");
        }
      }
    }

    public function createUserSession($user){
        var_dump($user);
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->username;
        redirect('entities/');
    }
    
    public function profile(){
        $this->view("auth/profile");
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }



 }





?>