<?php
require_once("fb_con.php");
$var="";
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
        window.location = "facebookpage.php";
    </script>
    <?php
    
   }else{
       $var="Data inserted wrongly";
   }

}
////login code//////
$err="";
if(isset($_POST['logbtn'])){
$mail=$_POST['mail'];
$pwd=$_POST['password'];
$x=pg_query($db,"SELECT *  FROM fb  WHERE email='$mail' AND password='$pwd'");
$b=pg_fetch_array($x);

if(pg_num_rows($x)>0){
    $id=$b[0];
    session_start();
    $_SESSION['userid']=$id;
    header("location:fbhome.php");
}
else
{
    $err="Incorrect username or password";
}

}
?>


        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">

            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>facebook</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        </head>
        <style>
            #header_container {
                background-color: #3b5998;
                color: #ffffff;
            }
            
            @media (max-width:1199px) {
                #login_form {
                    background: #ffffff;
                    color: #808080;
                }
            }
        </style>


        <body>
            <div class="container-fluid" id="header_container">
                <div class="row">
                    <div class="col-lg-6 col-sm-12 col-xs-12 col-md-12">
                        <img src="face.png" alt="" style="width: 200px;height: 75px;" class="img-responsive">
                    </div>
                    <!-- login section -->
                    <div class="col-lg-6 col-sm-12 col-xs-12 col-md-12" id="login_form">
                        <form class="form-inline" method="post" name="validateform" onsubmit="return  validate()">
                            <div class="col-lg-4 col-sm-12 col-md-12 col-xs-12 form-group">
                                <label for="">Email</label>
                                <input type="text" name="mail" id="mailid" style="display: block;width: 100%;">
                                <input type="checkbox" name="" id=""><small>Keep Sign in</small>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-12 col-xs-12 form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" id="pass" style="display: block;width: 100%;">
                                <a href="" style="color:white;"><small>Forgot Password?</small></a>
                            </div>
                            <div class="col-lg-2 col-sm-12 col-md-12 col-xs-12 form-group">
                                <button type="submit" class="btn btn-success" style="margin-top: 10px; " name="logbtn">Login</button>
                                <p style="color: red; font-size: small;">
                                    <?php echo $err?>
                                </p>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- body -->
            <div class="container-fluid" style="background: linear-gradient(#ffffff,#edf0f5);">
                <div class="row container-fluid">
                    <div class="col-lg-6  d-none d-lg-block d-xl-none d-none d-xl-block ">
                        <h3 style="padding-left: 100px;padding-top: 10px;"> </h3><br><br>
                        <img src="logofb.jpeg" alt="" style="padding-left: 100px ; width: 700px;" class="img-fluid">
                    </div>

                    <!-- create an account -->

                    <div class="col-lg-6 col-sm-12 col-md-12 col-xs-12 ">
                        <h3 style="text-align: center;">Create an account <br>
                            <small>It's free and always will be</small></h3>
                        <hr style="width: 100%;color:lightblack;">

                        <form class="form-inline" onsubmit="return register()" name="regform" method="post">
                            <div class=" form-group col-lg-6 col-sm-12 col-md-12 col-xs-12 ">
                                <input type="text" name="first" id="" placeholder="FirstName" style="display: block;width: 100%;"><br>

                            </div>
                            <div class=" form-group col-lg-6 col-sm-12 col-md-12 col-xs-12 ">
                                <input type="text" name="surname" id="" placeholder="SurName" style="display: block;width: 100%;"><br>

                            </div>


                            <br><br>
                            <div class=" form-group col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
                                <input type="text" name="email" id="mid" placeholder="E-mail " style="display: block;width: 100%;"><br>

                            </div>
                            <br><br>
                            <div class=" form-group col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
                                <input type="text" name="pwd" id="passid" placeholder="Password" style="display: block;width: 100%;"><br>

                            </div>
                            <br><br>
                            <div style="padding-left: 20px;">Birth day
                                <input type="date" name="date">

                                <span><small><a href=""> Why do i need to provide my date of birth</a></small></span>
                                </p>
                                <input type="radio" name="gender" value="male">Male
                                <input type="radio" name="gender" value="female">Female
                                <p class="col-lg-8" style="line-height: 90%;padding-top: 10px;"><small>By clicking sign up,you agree to your terms and conditions that you have to read 
                        our Data policy,including our cookie use policy.You may recieve sms from facebook and can opt out at any time
                    </small></p>
                            </div>
                            <div class=" form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                <button type="submit" class="btn btn-success btn-block " name="btn">Sign up</button>


                            </div>
                            <!-- end creat an account -->
                        </form>
                        <!-- end form -->
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

                    <!-- end row -->
                </div>
                <!-- end container fluid -->
            </div>