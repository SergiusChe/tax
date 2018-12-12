<?php
	require_once __DIR__ . '/api.php';
	require_once __DIR__ . '/model.php';
	require_once __DIR__ . '/cnfg.php';
	
	try
	{
		$API = new API();
		echo $API->processAPI();
	}
	catch (Exception $e)
	{
		echo json_encode(Array('error' => $e->getMessage()));
	}
?>
