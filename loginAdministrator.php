<?php

	session_start();

	include 'dataBaseConstants.php';
	$link=mysqli_connect('localhost',$user,$pass,$db);

	$error=null;
	if(mysqli_connect_error()){
		$error="There was an error connecting to DB!";
	}else{
		if(array_key_exists("phone", $_POST) AND array_key_exists("password", $_POST)){
			if($_POST["phone"]=="" OR $_POST["password"]==""){
				$error="Please enter everything!";
			}else{
				//USER HAS ENTERED EVERYTHING
				$phoneEntered="+91".$_POST['phone'];
				$query="SELECT * FROM administrator WHERE phone='".$phoneEntered."'"." AND password='".$_POST['password']."'";
				$result=mysqli_query($link,$query);//IF SUCH USER EXISTS HE WILL BE STORED IN $RESULT

				if(mysqli_num_rows($result)>0){//USER EXISTS WITH GIVE EMAIL AND PASSWORD
					//STORING SESSION VARIABLESS AND REDIRECTING TO productpage.php
					$row=mysqli_fetch_array($result);
					$_SESSION['adminId']=$row['id'];
					$_SESSION['adminPhone']=$row['phone'];
					$_SESSION['adminName']=$row['name'];
					
					header("Location: adminPanel.php?toview=farmers");//TO  BE CHANGE TO ADMIN PANEL

				}else{
					$error="INCORRECT CREDENTIALS";//USER DOES NOT EXITS
				}
			}
		}
	}

?>


<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, intial-scale=1">
    <title>FarmFresh | Admin Login</title>
    <link rel = "stylesheet" type = "text/css" href = "loginAdministrator.css">
</head>
<body>
    <section>
        <div class="login-box">
        	<div class="form_c">
                <h1>Welcome to FarmFresh</h1>
                <p>Administrator Login Panel.</p>            
            </div>
            <div class="login_form">
                <h1>ADMIN | LOGIN</h1>
                <form method="post">

                    <p id="errorPara">
                    <?php
                        echo $error;
                    ?>
                    </p>
                    
                    <input type = "number" name = "phone" required = "" placeholder = "Phone Number" autocomplete="off">
                    <input type = "password" name = "password" required = "" placeholder = "Password"><br>
                    <input type = "submit" name = "" value = "Submit">
                </form>
            </div>
        </div>
    </section>
</body>
</html>