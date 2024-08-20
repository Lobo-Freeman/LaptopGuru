<?php

if(isset($_POST["delete_id"])){
    $delete_id = $_POST["delete_id"];
    $sql = "UPDATE product SET valid = 0 WHERE product_id = $delete_id";
    
    
    if($conn->query($sql)===true){
        echo "success";
    }else{
        echo $sql;
    }
}else{
    echo "fail";
}
?>