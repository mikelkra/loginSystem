<?php

class UserData{
	private $logId;
	private $logE;
	private $logP;
	private $errMes;
public function getUserData($email) {
	$db = new Conn ();
	$getRow = $db->getRow ( "SELECT ep.id AS id,e.user_em AS user_em,p.user_pas AS user_pas
								FROM 	user_em AS e,
										user_pas AS p,
										user_em_pas AS ep
								WHERE 	e.id = ep.user_em_id
								AND 	p.id = ep.user_pas_id
								AND 	e.user_em = ?", [ $email ] );
	$user = new UserData ();
	if (empty ( $getRow )) {
		$user->setErrMes ("No user is found with email:  $email");
	} else {
		$logId = $getRow ['id'];
		$logEmail = $getRow ['user_em'];
		$logPass = $getRow ['user_pas'];
			
		$user->setLogId ( $logId );
		$user->setLogE ( $logEmail );
		$user->setLogP ( $logPass );
	}return $user;
}

/**
 * ****************************LOGIN setters & getters***************************
 */
public function setLogId($logId) {
	$this->logId = $logId;
}
public function getLogId() {
	return $this->logId;
}
public function getLogE() {
	return $this->logE;
}
public function setLogE($logE) {
	$this->logE = $logE;
}
public function getLogP() {
	return $this->logP;
}
public function setLogP($logP) {
	$this->logP = $logP;
}
public function getErrMes() {
	return $this->errMes;
}
public function setErrMes($errMes) {
	$this->errMes = $errMes;
}

}