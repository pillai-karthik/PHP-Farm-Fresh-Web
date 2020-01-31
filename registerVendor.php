<?php

    session_start();

    include 'dataBaseConstants.php';
    $link=mysqli_connect('localhost',$user,$pass,$db);
    $error=null;

    if(mysqli_connect_error()){
        $error="There was an error connecting to DB!";
    }else{
        //SUCCESSFULLLY CONNECTED TO DB
        if(array_key_exists("name", $_POST) AND array_key_exists("phone", $_POST) AND array_key_exists("password", $_POST) AND array_key_exists("cpassword", $_POST) AND array_key_exists("gender", $_POST)){
            //user has eneter everything or blank page is submitted
            if($_POST['phone']=="" OR $_POST['password']=="" OR $_POST['cpassword']=="" OR $_POST['name']=="" OR $_POST['gender']==""){
                $error="Please enter all the fields!";
            }else if($_POST['password']!=$_POST['cpassword']){//TO CHECK IF PASSWORD AND CONFIRM PASSWORD MATCH
                $error="Password and confirm password does not match.";
            }else{
                //user has entered everthing
                $query="SELECT * FROM vendors WHERE phone='".mysqli_real_escape_string($link,$_POST['phone'])."'";
                $result=mysqli_query($link,$query);//query to select users with the entered phone

                if(mysqli_num_rows($result)>0){
                    $error="Phone number already registered.";//cant keep 2 or more same phone ids
                }else{
                    //EVERTHNG IS VALID, ADD THE USER INTO THE DATABASE
                    $phoneEntered="+91".$_POST['phone'];
                    $query="INSERT INTO vendors (name,phone,password,gender) VALUES ('".ucwords($_POST['name'])."','".$phoneEntered."','".$_POST['password']."','".$_POST['gender']."')";//*********SQL PROTECTION REQUIRED*******

                    if(mysqli_query($link,$query)){
                        // echo "<p>YOU HAVE BEEN SIGNED UP</p>";

                        header("Location: loginVendor.php");
                        
                    }else{
                        $error="There was a problem signing you up!";
                    }
                }
            }
        }
    }

?>


<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, intial-scale=1">
    <title>Vendor | Register</title>
    <link rel = "stylesheet" type = "text/css" href = "registerVendor.css">
    </head>
    <body>
    <section>
        <div class="signup-box">
            <div class="form-c">
                <h1>Welcome to FarmFresh</h1>
                    <p align="center">Agriculture has become essential to life; the forest, the lake, and the ocean cannot sustain the increasing family of man; population declines with a declining cultivation, and nations have ceased to be with the extinction of their agriculture.</p><p align="center">Already Registered?</p>
                <center><a href = "loginVendor.php">Login</a></center>
            </div>
            <div class = "signup-form">
                <h2>VENDOR | REGISTER</h2>
                  <form method="post">
                      <p id = "errorPara">
                          <?php
                            echo $error;
                          ?>
                      </p>
                      <input id="text" type="text" name="name" placeholder="Name" required="" autocomplete="off"><br>
                      Gender :
                      <input type="radio" name="gender" value="Male" checked>Male
                      <input type="radio" name="gender" value="Female">Female<br><br>
                      <input id="text" type="number" name="phone" placeholder="Phone number" autocomplete="off">
                      <input id="text" type="password" name="password" placeholder="Password">
                      <input id="text" type="Password" name="cpassword" placeholder="Confirm password">
                      <center><input type="submit"></center>
                  </form>
            </div>
        </div>
        </section>
    </body>
</html>