<?php
session_start();
if(isset($_SESSION['userid'])){
    $uid=$_SESSION['userid'];
}else{
    header("location:error.php");
}
require_once("fb_con.php");
$res= pg_query($db,"SELECT * FROM fb WHERE id='$uid'");
$ar=pg_fetch_array($res);
if(isset($_POST['btn1'])){
$pwd=$_POST['pass'];
$npwd=$_POST['pass1'];
$cpass=$_POST['cpwd'];
$var=pg_query($db,"UPDATE fb SET  password='$cpass' WHERE id='$uid'");
if($var){
    ?>
    <script>
        alert("Password Changed Successfully !!");
        window.location="changepassword.php"
    </script>
    <?php
    
}else{
    ?>
        <script>
            alert("Old Password not match !!");
        </script>
        <?php
    
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

        <title>Hello, world!</title>
    </head>

    <body>
        <div class="row">
            <div class="col-lg-1" style="height: 80px; background-color: #3b5998;">
                <br>&nbsp;&nbsp;&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-facebook" viewBox="0 0 16 16">
            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
          </svg>
            </div>
            <div class="col-lg-11" style="height: 80px; background-color: #3b5998;">

                <form class="example" action="">
                    <input type="text" placeholder="Search for people,places and things" name="search" style="margin-top: 20px; border-radius: 3px;">
                    <button type="submit" style="width: 50px; height: 48px; margin-top: 20px;border-radius: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                  </svg></button>
                </form>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-3" style="height: 600px;">
                <ul class="list-group">
                    <li class="list-group-item"><img src="user.png" width="30px" alt="">&nbsp;
                        <a href="fbhome.php" class="fblink">
                            <?php echo $ar[1]  ?>
                        </a>
                    </li>
                    </a>
                    </li>
                    <li class="list-group-item"><img src="view.png" width="30px" alt="">&nbsp;<a href="accountview.php" class="fblink">View ????????????????????????????</a></li>

                    <li class="list-group-item"><img src="edit.png" width="30px" alt="">&nbsp;<a href="editprofile.php" class="fblink">???????????????? ????????????????????????????</a></li>
                    <li class="list-group-item"><img src="change.png" width="30px" alt="">&nbsp;<a href="changepassword.php" class="fblink">???????????????????????? ????????????????????????????????</a></li>
                    <li class="list-group-item"><img src="logout.png" width="30px" alt="">&nbsp;<a href="logout.php" class="fblink">????????????????????????</a></li>

                </ul>
            </div>
            <div class="col-lg-9" style="height: 600px; "><br>
                <img src="update.png" width="30px" style="border-radius: 4px;" alt="">&nbsp;&nbsp;<a href="" style="color: black;">???????????????????????? ????????????????????????</a>&nbsp;
                <img src="photo.png" width="30px" style="border-radius: 4px;" alt="">&nbsp;&nbsp;<a href="" style="color: black;">???????????? ????????????????????/????????????????????</a>&nbsp;
                <img src="write.png" width="30px" style="border-radius: 4px;" alt="">&nbsp;&nbsp;<a href="" style="color: black;">???????????????????? ????????????????</a> <br><br>
                <!-- /////content/////// -->
                <!-- //change password// -->
                <div style="width:500px;">
                    <form method="post" id="selectform" name="pwdform" onsubmit="return pwdvalidate()">
                        <table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">

                            <tr>
                                <td width="60%"><input type="password" name="pass" placeholder="???????????????????? ???????????????????????????? ????????????????????????????????" class="txtField" style="width: 400px; border-radius: 4px;"><span id="currentPassword" class="required"></span></td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="password" placeholder="???????????????????? ???????????? ????????????????????????????????" name="pass1" class="txtField" style="width: 400px; border-radius: 4px;"><span id=" newPassword " class="required "></span></td>
                            </tr>
                            <td><input type="password " placeholder="???????????????????????????? ???????????? ???????????????????????????????? " name="cpwd" class="txtField " style="width: 400px; border-radius: 4px;"><span id="confirmPassword " class="required "></span></td>
                            </tr>

                        </table>
                        <button name="btn1" class="btn btn-success" style="width: 200px;">????????????????????????</button>
                        <!-- <input type="submit " name="Change " value="???????????????????????? " class="btn btn-success "> -->
                        <input type="submit " onclick="document.getElementById('selectform').reset();" value="????????????????????????" class="btn btn-success ">
                        
                    </form>
                    <script>
                        function pwdvalidate() {
                            pass = document.forms["pwdform"]["pass"].value
                            pass1 = document.forms["pwdform"]["pass1"].value
                            cpwd = document.forms["pwdform"]["cpwd"].value
                            if (pass == "") {
                                alert("Old Password Field is Empty !!");
                                document.pwdform.pass.focus();
                                return false
                            }  else if(document.pwdform.pass1.value=="") {
                                alert("New Password Field is Empty !!");
                                document.pwdform.pass1.focus();
                                return false
                            }  else if(document.pwdform.cpwd.value=="") {
                                alert("Confirm Password Field is Empty !!");
                                document.pwdform.cpwd.focus();
                                return false;
                            }else if(document.pwdform.pass1.value!= document.pwdform.cpwd.value){
                                alert("New password & confirm password do not match!!");
                                document.pwdform.cpwd.focus();
                                return false;
                            }

                            
                        }
                    </script>
                </div>
                <!-- /// close passowd section/// -->

            </div>



        </div>


        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
    </body>

    </html>