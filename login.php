<?php
	require_once __DIR__ . '/cnfg.php';

	header("Content-Type: application/json; charset=utf-8");
	if (isset($_GET['login']) && isset($_GET['pass']))
	{
		$hash = md5($_GET['login'] . $_GET['pass']);
		if ($hash === CNFG::$adminToken)
		{
			setcookie('token', $hash);
			$res = Array('msg' => 'Authorized', 'token' => $hash);
		}
		else
		{
			setcookie('token', "", time() - 100);	//удаляем куки
			$res = Array('error' => 'Wrong user');
		}
	}
	else 
		$res = Array('error' => 'login and pass required');
	echo json_encode($res);
?>
