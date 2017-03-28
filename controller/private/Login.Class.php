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
	// reinigung von $_POST
	$_POST = array_map ( 'cleanData', $_POST );
	// check the data and clean them
	$em = cleanData ( $_POST ['logE'] );
	$ps = cleanData ( $_POST ['logP'] );
	$newLogin = new Login ();
	$newLogin->loginUser ( $em, $ps );

class Login {
	public function loginUser($userEmail, $userPas) {
		$login = new UserData ();
		$data = $login->getUserData ( $userEmail );
		$dbId = $data->getLogId ();
		$dbEmail = $data->getLogE ();
		$dbPass = $data->getLogP ();
		
		//check if email field is empty
		if($userEmail == ""){
			$errorMessage = "Email field is empty !";
		}
		//check if password field is empty
		elseif($userPas == ""){
			$errorMessage = "Password field is empty !";
		}
		// check for valid email
		elseif(filter_var ( $userEmail, FILTER_VALIDATE_EMAIL ) === false) {
			$errorMessage = "This Email is not the valid Email ! ";
		}
		// check for password length
		elseif (mb_strlen ( $userPas, 'UTF-8' ) < 5) {
			$errorMessage = "Ihre Password muss länger als 5 Buchstaben sein!!!";
		}
		//check for email and password
		elseif ($dbEmail == $userEmail && password_verify ( $userPas, $dbPass )) {
			// if everything is ok !!
			//header ( 'location: ../../view/welcome.php' );
			$errorMessage = "ok";
		} 
		// if username or pass are wrong
		else {
			$errorMessage = "Falsche pass oder email !";
		}
		//convert all to json format so it can be echoed in js modul message
		echo json_encode( $errorMessage );
	}
}

