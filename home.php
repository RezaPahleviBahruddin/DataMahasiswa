<?php 

	require_once 'session.php';
	require_once 'class.user.php';
	$auth_user = new User();

	$user_id = $_SESSION['user_session'];

	$sql = "SELECT * FROM USERS WHERE USER_ID=:userid";
	$stmt = $auth_user->run_query($sql);
	$stmt->execute(array(":userid" => $user_id));

	$user_row = $stmt->fetch(PDO::FETCH_ASSOC);
	echo "hahahhaha bisa :)";
	echo "</br>Hai ".$user_row['USERNAME']."</br>";

?>
<a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a>