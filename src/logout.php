<?php

include_once ("functions.php");

function logout() {
    // Load the db connect function to pass the link var
        require "connect_db.php";
        $pdo= new PDO($DB_DSN,$DB_USER,$DB_PW);
        
        return $pdo;
    
    }
    

    if(is_array($_SESSION['login'])):
        // Update the logged field to show user as logged out
        $update = mysqli_query($link,"UPDATE web_users SET logged='0' WHERE id='".$_SESSION['login']['id']."'") or die(mysqli_error($link));

        // Free the memory and close the connection
        mysqli_free_result($update);
        mysqli_close($link);

        // Unset all of the session variables.
        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if(isset($_COOKIE[session_name()])):
            setcookie(session_name(), '', time()-7000000, '/');
        endif;

        // Finally, destroy the session.
        session_destroy();

        // Take the user to the successive page if no errors
        header("location: index.php");
    endif;
