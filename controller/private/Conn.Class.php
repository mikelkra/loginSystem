<?php
class Conn {
	public $isConn;
	protected $datab;
	private $username = "username";
	private $password = "password";
	private $host = "hostname";
	private $dbname = "database name";
	private $options = [];
	
	// connect to db
	public function __construct() {
		$this->connected = TRUE;
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
		$this->connected = FALSE;
	}
	
	//get last id (only for incremented id)
	public function getLastId(){
		$id = $this->datab->lastInsertId();
		return $id;
	}
	// get one row
	public function getRow($query, $values = []) {
		try {
			$stmt = $this->datab->prepare ( $query );
			$stmt->execute ( $values );
			return $stmt->fetch ();
		} catch ( PDOException $e ) {
			throw new Exception ( $e->getMessage () );
		}
	}
	// get rows
	public function getRows($query, $values = []) {
		try {
			$stmt = $this->datab->prepare ( $query );
			$stmt->execute ( $values );
			return $stmt->fetchAll ();
		} catch ( PDOException $e ) {
			throw new Exception ( $e->getMessage () );
		}
	}
	// insert row
	public function insertRow($query, $values = []) {
		try {
			$stmt = $this->datab->prepare ( $query );
			$stmt->execute ( $values );
			return TRUE;
		} catch ( PDOException $e ) {
			throw new Exception ( $e->getMessage () );
		}
	}

}
