<?php 
include("config.php");
session_start();
if(isset($_POST['update_student']))
{
    $studentid = $_SESSION['login_user'];
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $pass = mysqli_real_escape_string($db, $_POST['pass']);
    $mail = mysqli_real_escape_string($db, $_POST['mail']);
	$phone = mysqli_real_escape_string($db, $_POST['phone']);
    $dob = mysqli_real_escape_string($db, $_POST['dob']);
    $age = mysqli_real_escape_string($db, $_POST['age']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);
    $edu = mysqli_real_escape_string($db, $_POST['edu']);
    $con = mysqli_real_escape_string($db, $_POST['con']);
    $sta = mysqli_real_escape_string($db, $_POST['sta']);
    $exp = mysqli_real_escape_string($db, $_POST['exp']);
    $det = mysqli_real_escape_string($db, $_POST['det']);
    
    if($name == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
	

    $query = "UPDATE user  SET uname = '$name',mail='$mail',pass='$pass',age='$age',gender='$gender',dob='$dob',phone='$phone',edu='$edu',con='$con',sta='$sta',exp='$exp',det='$det' WHERE uname = '$studentid'"; 
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
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}
?>

