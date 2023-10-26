<?php
    require "functions.php";
    if(delete($_GET['id']) > 0){
        header("Location: index.php");
    } else {
        echo "data gagal dihapus";
    }

?>