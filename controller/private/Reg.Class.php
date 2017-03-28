<?php
require_once 'Conn.Class.php';
require_once 'UserData.Class.php';

	function cleanData($data) {
		// if data is array then do this
		if (is_array ( $data )) {
			$returnValue = array_map ( 'check', $data );
		} else {
			// if data is string then do this
			$returnValue = trim ( $data ); // delete the first and last whitespace
			$returnValue = strip_tags ( $data ); // delete all the html,js tags
		}
		return $returnValue;
	}
	$_POST = array_map ( 'cleanData', $_POST );
	
	$email = cleanData ( $_POST ['regE'] );
	$pass = cleanData ( $_POST ['regP'] );
	$confirmedPass = cleanData ( $_POST ['regConfP'] );
	
	$regNewUser = new Register ();
	$regNewUser->registerNewUser ( $email, $pass, $confirmedPass );

class Register {
	private $regE;
	private $regP;
	private $regConfP;
	public function registerNewUser($email, $pass, $confirmedPass) {
		$dbUserData = new UserData ();
		$data = $dbUserData->getUserData ( $email );
		$dbEmail = $data->getLogE ();
		$date = date ( "Y-m-d" );
		//check if the email field is empty
		if($email == ""){
			$errorMessage = "Email field is empty !";
		}
		//check if the password field is empty
		elseif($pass == ""){
			$errorMessage = "Password field is empty !";
		}
		//check if the confirmed password field is empty
		elseif($confirmedPass == ""){
			$errorMessage ="Confirmed password field is empty";
		}
		//check if email is taken
		elseif($dbEmail == $email) {
			$errorMessage = "This email is allready taken !";
		} 
		//valideate is email is real email
		elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
			$errorMessage = "This is not a valid Email !"; 
		}
		//check if password and confirmed pass do match
		elseif ($confirmedPass != $pass) {
			$errorMessage = "Password do not match !";
		} 
		//check if the password is longer then 5 chars
		elseif(mb_strlen($pass, 'UTF-8') < 5){
			$errorMessage = "Password must be longer then 5 chartacters !";
		}
		else {
			// connect to database
			$db = new Conn ();
			
			//hashing the password
			$hashedPass = password_hash($pass , PASSWORD_DEFAULT);
			
			//insert the user email to email table 
			$insertUser_em = $db->insertRow ( "INSERT INTO user_em(user_em, user_em_date) 
										       VALUE(?, ?)", [ $email, $date ] );
			$NewUserEmId = $db->getLastId ();//get the last inserted ID from user email table
			$emailId = ( int ) $NewUserEmId;// convert the last ID to int
			
			//insert the user pass to pass table
			$insertUser_pas = $db->insertRow ( "INSERT INTO user_pas(user_pas, user_pas_date) 
										        VALUE(?, ?)", [ $hashedPass, $date ] );
			$NewUserPId = $db->getLastId ();//get the last ID from user pass table
			$passId = ( int ) $NewUserPId;//convert the ID to int
			
			//insert the user email id and user pass Id to user email and pass table
			$insertUser_em_pas = $db->insertRow ( "INSERT INTO user_em_pas(user_em_id, user_pas_id, user_em_pas_date) 
										           VALUE(?, ?, ?)", [ $emailId, $passId, $date ] );
			
			
			
			if ($insertUser_em && $insertUser_pas && $insertUser_em_pas) {
				$errorMessage = "ok";
			} else {
				$errorMessage =  "Something went wrong please try again!!";
			}
			
			
		}
		//convert all to json format so it can be echoed in js modul message
		echo json_encode ( $errorMessage );
	}
	/* **************************REGISTER setters and getters************************** */
	// email
	public function getRegE() {
		return $this->regE;
	}
	public function setRegE($regE) {
		$this->regE = $regE;
	}
	// pass
	public function getRegP() {
		return $this->regP;
	}
	public function setRegP($regP) {
		$this->regP = $regP;
	}
	// confirmed pass
	public function getRegConfP() {
		return $this->regConfP;
	}
	public function setRegConfP($regConfP) {
		$this->regConfP = $regConfP;
	}
}
/* *************************************************************/