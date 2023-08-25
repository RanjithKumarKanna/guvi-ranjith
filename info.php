<?php
   include("config.php");
session_start();
$USERID = $_SESSION["login_user"];

if(isset($_SESSION["login_user"])){

$query = "SELECT uname,mail,pass,age,gender,dob,phone,edu,con,sta,exp,det FROM user WHERE uname= '$USERID'";

$result = mysqli_query($db,$query);

if($result)
{

   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

   $name = $row["uname"];
   $mail = $row["mail"];
   $pass = $row["pass"];
   $age = $row["age"];
   $gender = $row["gender"];
   $dob = $row["dob"];
   $phone = $row["phone"];
   $edu = $row["edu"];
   $con = $row["con"];
   $sta = $row["sta"];
   $exp = $row["exp"];
   $det = $row["det"];
}
else
{
    echo "<script> alert('Unexpected Error'); </script>";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guvi</title>
    <link rel="stylesheet" href="style1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
 
     <body>
     <form id="updateStudent">
     <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">Edogaru</span><span class="text-black-50">..........@mail.com.my</span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Name</label>
                    <input type="text"name="name" id="name" class="form-control" placeholder="first name" value="<?php echo $name ?>"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Email ID</label>
                    <input type="text"name="mail" id="mail" class="form-control" placeholder=" email id" value="<?php echo $mail ?>"></div>
                    <div class="col-md-12"><label class="labels">password</label>
                    <input type="text"name="pass" id="pass" class="form-control" placeholder=" password" value="<?php echo $pass ?>"></div>
                    <div class="col-md-12"><label class="labels">age</label>
                    <input type="text"name="age" id="age" class="form-control" placeholder=" Age" value="<?php echo $age ?>"></div>
                    <div class="col-md-12"><label class="labels">GENDER</label>
                    <input type="text"name="gender" id="gender" class="form-control" placeholder=" GENDER" value="<?php echo $gender ?>"></div>
                    <div class="col-md-12"><label class="labels">Dob</label>
                    <input type="text"name="dob" id="dob" class="form-control" placeholder=" date of birth" value="<?php echo $dob ?>"></div>
                    <div class="col-md-12"><label class="labels">Mobile Number</label>
                    <input type="text"name="phone" id="phone" class="form-control" placeholder=" phone" value="<?php echo $phone ?>"></div>
                    <div class="col-md-12"><label class="labels">Education</label>
                    <input type="text"name="edu" id="edu" class="form-control" placeholder="education" value="<?php echo $edu ?>"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><label class="labels">Country</label>
                    <input type="text"name="con" id="con" class="form-control" placeholder="country" value="<?php echo $con ?>"></div>
                    <div class="col-md-6"><label class="labels">State/Region</label>
                    <input type="text"name="sta" id="sta" class="form-control" value="<?php echo $sta ?>" placeholder="state"></div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-primary type="submit">update</button></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span>
                <span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span>
            </div>
            <br>
                <div class="col-md-12"><label class="labels">Experience in Designing</label>
                <input type="text"name="exp" id="exp" class="form-control" placeholder="experience" value="<?php echo $exp ?>"></div> <br>
                <div class="col-md-12"><label class="labels">Additional Details</label>
                <input type="text"name="det" id="det" class="form-control" placeholder="additional details" value="<?php echo $det ?>"></div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</form>
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
		  	      <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script>
                    $(document).on('submit', '#updateStudent', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_student", true);
			console.log(formData);

            $.ajax({
                type: "POST",
                url: "update.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessageUpdate').addClass('d-none');

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
                        
                        $('#studentEditModal').modal('hide');
                        $('#updateStudent')[0].reset();

                       location.reload();

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

</script>
     </body>
</html>