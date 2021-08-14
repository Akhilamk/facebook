<?php
require_once("fb_con.php");
$var="";
$err="";
if(isset($_POST['btn'])){
    
   $first= $_POST["first"];
   $surname=$_POST["surname"];
   $email=$_POST["email"];
   $password=$_POST["pwd"];
   $dob=$_POST["date"];
   $gender=$_POST["gender"];
   $qry=pg_query($db,"INSERT INTO fb(firstname,surname,email,password,birthday,gender) VALUES('$first','$surname','$email','$password','$dob','$gender')");
   if($qry){
    ?>
    <script>
        alert("Data inserted Successfull");
        window.location = "fbshow.php";
    </script>
    <?php
    
   }else{
       $var="Data inserted wrongly";
   }

}

if(isset($_POST['logbtn'])){
$mail=$_POST['email'];
$pwd=$_POST['password'];
$a=pg_query($db,"SELECT * FROM fb WHERE email='$mail' AND password='$pwd'");
$x=pg_fetch_array($a);
$id=$x[0];
if(pg_num_rows($a)>0){
    session_start();
    $_SESSION['userid']=$id;
    header("location:fbhome.php");
}else{
    $err="Incorrect username or password";
}

}
?>

        <!doctype html>
        <html lang="en">

        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
            <link rel="stylesheet" href="style.css">
            <title>Fb login Page</title>
        </head>

        <body>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4" style="height: 120px; background-color: #3b5998;">
                        <img src="face.png" height="100px" alt="">
                    </div>
                    <div class="col-sm-3" style="height: 120px; background-color: #3b5998; ">
                        <form method="post" name="validateform" onsubmit="return  validate()" class="form-responsive" style="margin-right: 150px;">
                            <label style="margin-top: 20px;">Email/Phone</label><br>
                            <input type="text" placeholder="Email/Phone" name="email" id="mailid" style=" margin-top: 3%; border-radius: 4px;width: 250px"><br>
                            <input type="checkbox">
                            <small style="color: rgb(255, 250, 250); font-size: small;">Keep me sign In</small>
                        </form>
                    </div>
                    <div class="col-sm-3" style="height: 120px; background-color: #3b5998;">
                        <form method="post" name="validateform" onsubmit="return  validate()" class="form-responsive" style="margin-right: 150px;">
                            <label style="margin-top: 20px;">Password</label><br>
                            <input type="password" placeholder="Password" name="password" id="pass" style=" margin-top: 3%;border-radius: 4px; width: 250px;"><br>
                            <a href="forgotpwd.php" style="color: white; font-size: small;"><u>Forgot Your Password?</u> </a>
                        </form>
                    </div>
                    <div class="col-sm-2" style="height: 120px; background-color: #3b5998;">
                        <form method="POST" name="validateform" onsubmit="return  validate()">
                            <button class="btn btn-success" name="logbtn" style="margin-top: 45px; margin-right: 200px;">Login</button>
                            <p style="color: red;font-size: x-small;"><?php echo $err ?>
                            </p>
                        </form>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block" style="height:600px;width: 1500px; background-color: rgb(241, 244, 247);"><img src="logofb.jpeg" alt="" width="600px" style="margin-top: 90px; margin-left: 90px;"></div>
                        <div class="col-lg-6" style="height: 600px;  background-color: rgb(241, 244, 247);">
                            <form action="" method="POST" name="regform" onsubmit="return register()" class="form-responsive">
                                <h1 style="margin-top: 20px;">Create an account</h1>
                                <h6>It's quick and easy.</h6>
                                <input type="text" placeholder="FirstName" name="first" style="width: 200px;">&nbsp; &nbsp; &nbsp;<input type="text" placeholder="SurName" name="surname" style="width: 200px;"><br><br>

                                <input type="text" placeholder="Email/Phone" name="email" id="mid" style="width: 425px;"><br><br>
                                <input type="password" placeholder="Password" name="pwd" id="passid" style="width: 425px;"><br><br>

                                <label for="birthday" style="color: black;">Birthday :</label>
                                <input type="date" name="date"><a href="Why do i need to provide my birthday" style="font-size: small;">Why do i need to provide my birthday</a><br><br>
                                <label for="gender" style="color: black;">Male</label>
                                <input type="radio" name="gender" value="male">&nbsp; &nbsp;
                                <label for="gender" style="color: black;">Female</label>
                                <input type="radio" name="gender" value="Female">&nbsp; &nbsp;
                                <label for="gender" style="color: black;">Other</label>
                                <input type="radio" name="gender" value="Other">
                                <h6 style="font-size: smaller;">By clicking Sign Up ,You agree to our Terms and that you have read our Data<br> Use policy,including our Cookie Use.</h6>
                                <button class="btn btn-success" name="btn" style="font-family: Verdana, Geneva, Tahoma, sans-serif; text-align-last: center; margin-left: 100px; margin-top: 30PX;"><b>Sign Up</b></button>
                                <?php  echo $var ?>

                            </form>
                            <script>
                                ////// login-  email validation////
                                function validate() {
                                    rt = true
                                    var emailPat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                                    var email = document.getElementById('mailid').value;
                                    var matchArray = email.match(emailPat);

                                    if (email == "") {
                                        alert("Enter Your Email")
                                        document.forms["validateform"]["email"].focus
                                        return false
                                    } else if (matchArray == null) {
                                        alert("Incorrect Email Id !Enter a valid Email Id")
                                        document.forms["validateform"]["email"].focus
                                        return false
                                    }
                                    /////password validation//////
                                    var  password  =  document.getElementById("pass").value;
                                    if  (password  ==  null  ||  password  ==  "")  {                
                                        alert("Please enter the password.");                
                                        return  false;
                                    } else if (password.length < 6) {
                                        alert("Password must be at least 6 characters long.");
                                        return false;
                                    }

                                    return true
                                }
                            </script>

                            <!-- /////registrationform validation///// -->

                            <script>
                                function register() {
                                    //// firstname //////
                                    rt = true
                                    first = document.forms["regform"]["first"].value
                                    if (first == "") {
                                        alert("𝑬𝒏𝒕𝒆𝒓 𝑭𝒊𝒓𝒔𝒕𝑵𝒂𝒎𝒆")
                                        document.forms["regform"]["first"].focus
                                        return false
                                    } else if (/[^a-z]/gi.test(first)) {
                                        alert("𝑬𝒏𝒕𝒆𝒓 𝒂𝒍𝒑𝒉𝒂𝒃𝒆𝒕𝒔 𝑶𝒏𝒍𝒚!")
                                        document.forms["regform"]["first"].focus
                                        return false
                                    }
                                    /////surname////
                                    surname = document.forms["regform"]["surname"].value
                                    if (surname == "") {
                                        alert("𝑬𝒏𝒕𝒆𝒓 𝑺𝒖𝒓𝑵𝒂𝒎𝒆")
                                        document.forms["regform"]["surname"].focus
                                        return false
                                    } else if (/[^a-z]/gi.test(first)) {
                                        alert("𝑬𝒏𝒕𝒆𝒓 𝒂𝒍𝒑𝒉𝒂𝒃𝒆𝒕𝒔 𝑶𝒏𝒍𝒚!")
                                        document.forms["regform"]["surname"].focus
                                        return false
                                    }
                                    /////email/phone validation/////
                                    var emailPat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                                    var email = document.getElementById('mid').value;
                                    var matchArray = email.match(emailPat);
                                    email = document.forms["regform"]["email"].value

                                    if (email == "") {
                                        alert("Enter Your Email")
                                        document.forms["regform"]["email"].focus
                                        return false
                                    } else if (matchArray == null) {
                                        alert("Incorrect Email Id !Enter a valid Email Id")
                                        document.forms["regform"]["email"].focus
                                        return false
                                    }
                                    /////password /////
                                    var  pwd  =  document.getElementById("passid").value;
                                    if  (pwd ==  null  ||  pwd  ==  "")  {                
                                        alert("Please enter the password."); 
                                        document.forms["regform"]["pwd"].focus               
                                        return  false;
                                    } else if (pwd.length < 6) {
                                        alert("Password must be at least 6 characters long.");
                                        return false;
                                    }
                                    return true
                                }
                            </script>
                        </div>
                    </div>

                </div>

            </div>

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        </body>

        </html>