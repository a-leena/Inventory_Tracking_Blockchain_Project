<?php
    include 'redirection.php';
    session_start();
    // unset( $_SESSION['role'] );
    // unset( $_SESSION['username'] );
    session_unset();
    session_destroy();
    header("Refresh:0");
    redirect('index.php');
?>
