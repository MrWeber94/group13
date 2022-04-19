<?php 
########################################################################################################
require '../helpers/db.php';
require '../helpers/functions.php';

require '../helpers/checklogin.php';
require '../helpers/checkAdmin.php';

# Fetch Id .... 
$id = $_GET['id']; 

# Validate Id .... 

if(!validate($id,'int')){
    $message = ["Error" => "Invalid Id"];
}else{
    # Fetch image name .... 
    $sql  = "select image from users where id = $id"; 
    $op   = doQuery($sql); 
    $data =  mysqli_fetch_assoc($op); 


    $sql = "delete from users where id = $id"; 

    $op = doQuery($sql); 

    if($op){

        removeFile( $data['image']);
        $message = ["Success" => "Raw Removed"];
    }else{
        $message = ["Error" => "Error Try Again"];
    }

}

# Set Session ... 
$_SESSION['Message'] = $message; 

header("Location: index.php"); 




?>