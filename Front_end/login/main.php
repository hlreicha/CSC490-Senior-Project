<?php
    session_start();

    if(isset($_SESSION['User']))
    {
        echo ' Welcome '.'<br/>';
        echo '<a href="logout.php?logout">Logout</a>';
    }
    else
    {
        header("location:index.php");
    }
?>