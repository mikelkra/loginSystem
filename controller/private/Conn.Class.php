<?php
// $db = new Conn();

// $getRow = $db->getRow("SELECT * FROM users WHERE username = ?", ["admin"]);
// $getRows = $db->getRows("SELECT * FROM users");
// $insertRow = $db->insertRow("INSERT INTO users(username, password, email) VALUE(?, ?, ?)", ["Arthur", "102030", "arthur@localhost"]);
// $updateRow = $db->updateRow("UPDATE users SET username = ?, password = ? WHERE id = ?", ["ArthurMann", "a123456", "7"]);
// $deleteRow = $db->deleteRow("DELETE FROM users WHERE id = ?", [8]);


// $db->Disconnect();


class Conn {
	public $isConn;
	protected $datab;
	private $username = "root";
	private $password = "";
	private $host = "localhost";
	private $dbname = "loginsystem";
	private $options = [];
	
	// connect to db
	public function __construct() {
		$this->isConn = TRUE;
		try {
			$this->datab = new PDO ( "mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password, $this->options );
			$this->datab->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$this->datab->setAttribute ( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
		} catch ( PDOException $e ) {
			throw new Exception ( $e->getMessage () );
		}
	}
	
	// disconnect from db
	public function Disconnect() {
		$this->datab = NULL;
		$this->isConn = FALSE;
	}
	
	//get last id
	public function getLastId(){
		$id = $this->datab->lastInsertId();
		return $id;
	}
	// get row
	public function getRow($query, $params = []) {
		try {
			$stmt = $this->datab->prepare ( $query );
			$stmt->execute ( $params );
			return $stmt->fetch ();
		} catch ( PDOException $e ) {
			throw new Exception ( $e->getMessage () );
		}
	}
	// get rows
	public function getRows($query, $params = []) {
		try {
			$stmt = $this->datab->prepare ( $query );
			$stmt->execute ( $params );
			return $stmt->fetchAll ();
		} catch ( PDOException $e ) {
			throw new Exception ( $e->getMessage () );
		}
	}
	// insert row
	public function insertRow($query, $params = []) {
		try {
			$stmt = $this->datab->prepare ( $query );
			$stmt->execute ( $params );
			return TRUE;
		} catch ( PDOException $e ) {
			throw new Exception ( $e->getMessage () );
		}
	}
	// update row
	public function updateRow($query, $params = []) {
		$this->insertRow ( $query, $params );
	}
	// delete row
	public function deleteRow($query, $params = []) {
		$this->insertRow ( $query, $params );
	}
}