<?php  
	/**
		* 
		*/
		class Database
		{
			private $host = "localhost";
			private $db_name = "DATAMAHASISWA";
			private $username = "root";
			private $password = "@reza27#";
			public $con;

			public function db_connection()
			{
				$this->con = null;
				try {
					$this->con = new PDO("mysql:host=".$this->host.";dbname=".$db_name, $this->username, $this->password);
					$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				} catch (PDOException $e) {
					echo "Connection error: ".$e->getMessage();
				}
			}
			return $this->con;
		}	
?>