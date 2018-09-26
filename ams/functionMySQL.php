<?php
//
//Zabrani otvoreniu súboru pramým zadaním url
defined('IN_PAGE') or die('Nemôžete pristupovať k súboru priamo');
class MySQL{
	private $user = DB_UZIVATEL;
	private $pass = DB_HESLO;
	private $host = DB_HOST;
	private $database = DB_DATABAZA;

	private $mysqli;

	public function __construct(){
		$this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->database);
		$error = $this->mysqli->connect_error;
		if (isset($error)){
			Debug::error($message,true);
		}
		$this->mysqli->set_charset("utf8");
	}

	public function __destruct(){
		$this->mysqli->close();
	}
	public function query($query){
		if(empty($query)){
			Debug::warning("Nemôže byť spustený prázdny dotaz");
			return false;
		}
		$result = $this->mysqli->query($query);
		if($this->mysqli->error){
			Debug::error("Nemôže byť spustený dotaz (".$query.").");
			die ('Nasala chyba pripojenia ku databáze');
		}
		return $result;
	}
	public function lastID(){
		return $this->mysqli->insert_id;
	}
	public function serverVersion(){
		return $this->mysqli->server_info;
	}
	public function values($result){
		return mysqli_fetch_array($result);
	}
	public function rows($result){
		return mysqli_num_rows($result);
	}
}
