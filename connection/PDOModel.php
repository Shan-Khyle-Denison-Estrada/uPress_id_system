<?php
date_default_timezone_set('Asia/Kolkata');
class PDOModel{
	public $db;
	public $config=array();
	function PDOModel(){
		try
		{
			$this->db = new PDO('mysql:host=localhost;dbname=db_troj8n;charset=utf8','root','');
		}
		catch(PDOException $e)
		{
			echo  "<h1>Error establishing a database connection</h1>";
			die();
		}
			//$aquery = $this->db->prepare("SELECT * FROM `web_config` WHERE `configId` = '1'");
			//$aquery->execute();

			//$arow = $aquery->fetch(PDO::FETCH_ASSOC);
	}
}
?>