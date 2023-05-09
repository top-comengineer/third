<?php
 
    function isLoggedIn(){
        if(isset($_SESSION['user_id'])){
            return true;
        } else {
            return false;
        }
    }

    function isAdmin(){
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
            return true;
        }
        return false;
    }


?>