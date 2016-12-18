<?php  
	require_once 'session.php';
	require_once 'class.user.php';
	$user_logout = new User();

	if ($user_logout->is_logged_in() != "") 
		$user_logout->redirect('home.php');
	if (isset($_GET['logout']) && $_GET['logout'] == "true") {
		$user_logout->logout();
		$user_logout->redirect('index.php');	
	}
