<?php

	include 'dataBaseConstants.php';

	$response=array();

	$link=mysqli_connect('localhost',$user,$pass,$db);

	if(mysqli_connect_error()){
		$response['error']=true;
		$response['message']="Error Connecting to Database!";
		$response['phone']="";
	}else{
		//SUCCESSFULLLY CONNECTED TO DB
		if(array_key_exists('phone', $_POST) AND array_key_exists('message', $_POST)){
				//received the data from the android mobile server
				$arr = explode(' ',trim($_POST['message']));
				//$arr[0]; //Will get first word of the sms

				if(strtolower($arr[0])=="register" OR strtolower($arr[0])=="Register"){
					//FARMER WANTS TO REGISTER
					$query="SELECT * FROM farmers WHERE phone='".mysqli_real_escape_string($link,$_POST['phone'])."'";
					$result=mysqli_query($link,$query);//query to select farmers with the entered phone

					if(mysqli_num_rows($result)>0){
						//Farmer is already registered
						//send json stating that users is already registered
						$response['error']=true;
						$response['message']="You are already registered on our portal with Phone No. : ".$_POST['phone'];
						$response['phone']=$_POST['phone'];

					}else{
						//User is not registered
						$password=rand(10001,99999);
						$nameOfFarmer="";
						$noOfWordsInArr=count($arr);
						for($i=1; $i < $noOfWordsInArr; $i++){
							$nameOfFarmer=$nameOfFarmer.$arr[$i]." ";
						}

						$query="INSERT INTO farmers (phone,password,name) VALUES ('".$_POST['phone']."','".$password."','".ucwords($nameOfFarmer)."')";
							//*********SQL PROTECTION REQUIRED******

						if(mysqli_query($link,$query)){
							//send JSON WITH PASSWORD
							$response['error']=false;
							$response['message']="Thankyou ".ucwords($nameOfFarmer)."for registering on FarmFresh.com! Your Password is : ".$password.". SMS: ADD <productname> <noOfKgs> <PricePerKg> Eg. ADD Onion 20 80";
							// $response['message']="Thankyou ".ucwords($nameOfFarmer)."for registering on FarmFresh.com! Your Password is : ".$password.". Add a product by sending SMS: ADD <productname> <noOfKgs> <PricePerKg> Eg.ADD Onion 20 80";
							$response['phone']=$_POST['phone'];

						}else{
							//Unable to register the farmer
							$response['error']=true;
							$response['message']="An Error occured while registering you! Please try again!";
							$response['phone']=$_POST['phone'];
						}
					}

			}elseif (strtolower($arr[0])=="add" OR strtolower($arr[0])=="Add") {
				$query="SELECT * FROM farmers WHERE phone='".mysqli_real_escape_string($link,$_POST['phone'])."'";
				$result=mysqli_query($link,$query);//query to select farmers with the entered phone

					if(mysqli_num_rows($result)>0){
						//Farmer is registered so we can add products
						if(count($arr)==4){
						$row=mysqli_fetch_array($result);
						$farmername=$row['name'];

	                    $farmerid=$row['id'];
	                    $productname=$arr[1];
	                    $quantityinkg=$arr[2];
	                    $priceperkg=$arr[3];

	                    $query="INSERT INTO products (farmerid,productname,quantityinkg,priceperkg) VALUES ('".$farmerid."','".ucwords($productname)."','".$quantityinkg."','".$priceperkg."')";

		                    if(mysqli_query($link,$query)){
	                        	//successfully added the product
	                        	$response['error']=false;
								$response['message']="Hey ".$farmername."! You have successfully added ".$quantityinkg."kg of ".ucwords($productname)." at Rs.".$priceperkg." per Kg.";
								$response['phone']=$_POST['phone'];
	                        
		                    }else{
		                        //Unable to add the product
		                        $response['error']=true;
								$response['message']="Hey ".$farmername."! An error occured while adding ".$quantityinkg."kg of ".$productname." at ".$priceperkg." Rs. per Kg.";
								$response['phone']=$_POST['phone'];
		                    }
	                	}else{
	                		//FARMER HAS ENTERED ADD BUT NOT THE OTHER 3 VARIABLES products,price,kg in SMS
	                		$response['error']=true;
							$response['message']="The correct format to add a product is: ADD <productname> <noOfKgs> <PricePerKg> Eg. ADD Tomato 20 80";
							$response['phone']=$_POST['phone'];
	                	}

					}else{
						//CANNOT ADD PRODUCT UNTIL YOU SINGUP as farmer
						$response['error']=true;
						$response['message']="Before adding a product on FarmFresh, You have to register! SMS: Register<space><Name> Eg. Register Gopal Shinde";
						$response['phone']=$_POST['phone'];
					}
			}
			else{
				$response['error']=true;
				$response['message']="Error! SMS should be in the form: Register<space><Name> (Eg. Register Gopal Shinde)";
				$response['phone']=$_POST['phone'];
			}
		}else{
			//PHONE OR MESSAGE IS MISSING IN POST METHOD
			$response['error']=true;
			$response['message']="Message or Phone number is missing!";
			$response['phone']="";
		}
	}

		header('Content-Type: application/json');
		echo json_encode($response);

?>
