<?php
 
 class Posts extends Controller {


    public function __construct(){
        
        //Validate iof the user is loggedIn
        if(!isLoggedIn()){
            redirect('users/login');
        }
        //get all Posts&User data from the database from the model
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    // the post index-method
    public function index(){
       // Get posts
       $posts = $this->postModel->getPosts();

       $data = [
         'posts' => $posts
       ];
      $this->view('post/index', $data);

    }

   //the post add-method
    public function add(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

          // Sanitize POST array
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  
          $data = [
            'title' => trim($_POST['title']),
            'body' => trim($_POST['body']),
            'user_id' => $_SESSION['user_id'],
            'title_err' => '',
            'body_err' => ''
          ];
  
          // Validate data
          if(empty($data['title'])){
            $data['title_err'] = 'Please enter title';
          }
          if(empty($data['body'])){
            $data['body_err'] = 'Please enter body text';
          }
  
          // Make sure no errors
          if(empty($data['title_err']) && empty($data['body_err'])){
            // Validated
            if($this->postModel->addPost($data)){
              flash('post_message', 'Your Post as been added!..');
              redirect('posts');

            } else {
              die('Something went wrong');
            }
          } else {
            // Load view with errors
            $this->view('post/add', $data);
          }
  
        } else {
          $data = [
            'title' => '',
            'body' => ''
          ];
    
          $this->view('post/add', $data);
        }
        
    }
    
    //show single Post-data method
    public function show($id = null){

        if($id == null){
            redirect('posts/'); 
        }
        //validate if the id passed is number
        $value = (int) $id;
        if(is_numeric($value) && $value > 0 && $value == round($value, 0)){
            
            if($this->postModel->getPostById($id)){

                $post = $this->postModel->getPostById($id);
                $user = $this->userModel->getUserById($post->user_id);

                $data = [
                  'post' => $post,
                  'user' => $user
                ];
    
                $this->view('post/show', $data);

            }else{
               redirect('posts/');
            }
        }
        else{
            redirect('posts/');
        }        
    }
    
    //the post delete-method
    public function delete($id=null){

        if(!is_numeric($id) && $id < 0 && !$id == round($id, 0)){
            redirect('posts');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Get existing post from model

          //validate if the id passed is number
            $value = (int) $id;
            if(is_numeric($value) && $value > 0 && $value == round($value, 0)){
                    
               
                if($this->postModel->getPostById($value)){

                    $post = $this->postModel->getPostById($value);

                    // Check for owner
                    if($post->user_id != $_SESSION['user_id']){
                        redirect('posts');
                    }

                    if($this->postModel->deletePost($value)){

                        flash('post_message', 'Post Removed', 'alert alert-info');
                        redirect('posts');

                    }else {
                        
                        die('Something went wrong');
                    }
                }else{
                    redirect('posts');         
                }

            }else{
                redirect('posts');     
            }


        } else {
          redirect('posts');
        }
    }

    //the post edit method
    public function edit($id=null){

        if(!is_numeric($id) && $id < 0 && !$id == round($id, 0)){
            redirect('posts');
        }

        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

         
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            $data = [
              'id' => $id,
              'title' => trim($_POST['title']),
              'body' => trim($_POST['body']),
              'user_id' => $_SESSION['user_id'],
              'title_err' => '',
              'body_err' => ''
            ];
    
            // Validate data
            if(empty($data['title'])){
              $data['title_err'] = 'Please enter title';
            }
            if(empty($data['body'])){
              $data['body_err'] = 'Please enter body text';
            }
    
            // Make sure no errors
             if(empty($data['title_err']) && empty($data['body_err'])){
              // Validated
              if($this->postModel->updatePost($data)){
               
                flash('post_message', 'Post Updated');
                redirect('posts');

              } else {
                die('Something went wrong');
              }

              
           
            } else {
              // Load view with errors
              $this->view('post/edit', $data);
            }  
        } 
        else {
            // Get existing post from model
            $post = $this->postModel->getPostById($id);
    
            // Check for owner
            if($post->user_id != $_SESSION['user_id']){
              redirect('posts');
            }
    
            $data = [
              'id' => $id,
              'title' => $post->title,
              'body' => $post->body
            ];
      
            $this->view('post/edit', $data);
        }
        
    }

  




















} //end-of-post-class





?>