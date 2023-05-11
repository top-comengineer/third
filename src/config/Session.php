<?php

session_start();    // This starts the session. Since included in bootstrap.php it will run on all pages, no need to rerun on every page

// Flash Message helper
// EXAMPLE: flash('register_success','You are now registered. Log in to continue.', 'alert alert-danger');
// DISPLAY IN VIEW: <?php echo flash('register_success'); 

function flash($name = '', $message = '', $class = 'alert alert-success'){
    if(!empty($name)){
        // If msg is passed in and not already set in a session, we want to set that session
        if(!empty($message) && empty($_SESSION[$name])){
            if(!empty($_SESSION[$name])){
                unset($_SESSION[$name]);
            }
            if(!empty($_SESSION[$name.'_class'])){
                unset($_SESSION[$name.'_class']);
            }
            
            $_SESSION[$name] = $message;    // Kind of key/value combo implementation
            $_SESSION[$name. '_class'] = $class;
        } elseif(empty($message) && !empty($_SESSION[$name])){
            $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
            echo '<div class="'.$class.'" id="msg-flash">' . $_SESSION[$name] . '</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name.'_class']);
            
        }
    }
}