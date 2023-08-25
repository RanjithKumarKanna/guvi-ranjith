<?php 
include("config.php");

if(isset($_POST['save_reg']))
{
	$name = mysqli_real_escape_string($db, $_POST['name']);
    $pass = mysqli_real_escape_string($db, $_POST['pass']);
    $mail = mysqli_real_escape_string($db, $_POST['mail']);
	
    if($name == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
	
    $query = "INSERT INTO user (uname,pass,mail) VALUES('$name','$pass','$mail')";
    $query_run = mysqli_query($db, $query);

       if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated
                         check you connection
                               (or)
                        username alrady taken'
        ];
        echo json_encode($res);
        return;
    }
	
}

	  
?>