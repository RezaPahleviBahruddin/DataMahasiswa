<?php 
	require_once 'dbconfig.php'; 
	/**
	* Class for user
	*/
	class User
	{
		private $con;

		function __construct()
		{
			$database = new Database();
		}

		public function runQuery($sql)
		{
			$stmt = $this->con->prepare($sql);
			return $stmt;
		}

		public function resgister_user($name, $email, $password)
		{
			try {
				$new_password = password_hash($password, PASSWORD_DEFAULT);
				$sql = "INSERT INTO USERS (USERNAME, PASSOWRD, EMAIL) VALUES (:uname, :mail, :pass)";
				$stmt = $this->runQuery($sql);

				$stmt->bindparam(":uname", $name);
				$stmt->bindparam(":mail", $email);
				$stmt->bindparam(":pass", $password);

				$stmt->execute();

				return $stmt;
			} catch (PDOException $e) {
				echo "Error ".$e->getMessage();
			}
		}

		public function do_login($uname, $mail, $pass)
		{
			try {
				$sql = "SELECT USER_ID, USERNAME, PASSWORD FROM USERS WHERE USERNAME=:uname OR EMAIL=:email";
				$stmt = $this->runQuery($sql);
				$stmt->execute(array(':uname' => $uname, ':email' => $email));
				$user_row = $stmt->fetch(FETCH_ASSOC);
				if ($stmt->rowCount()>1) {
					if (password_verify($pass, $user_row['PASSOWRD'])) {
						$_SESSION['user_session'] = $user_row['USER_ID'];
						return true;
					}else
						return false;	
				}
			} catch (PDOException $e) {
				echo "Error ".$e->getMessage();
			}
		}

		public function is_logged_in()
		{
			if (isset($_SESSION['user_session'])) 
				return true;
		}

		public function redirect($url)
		{
			header("Location: $url");
		}

		public function logout()
		{
			session_destroy();
			unset($_SESSION['user_session']);
			return true;
		}
	}
?>