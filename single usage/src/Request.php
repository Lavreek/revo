<?php
	require_once __DIR__."/ApiController.php";
	
	if (isset($_POST['add']))
	{
		unset($_POST['add']);

		$Api = new ApiController();
		echo $Api->add($_POST);
	}

	if (isset($_POST['delete']))
	{
		unset($_POST['delete']);

		$Api = new ApiController();
		echo $Api->delete($_POST);
	}

	if (isset($_POST['revo_settings']))
	{
		unset($_POST['revo_settings']);

		$Api = new ApiController();
		echo $Api->revo_change_settings($_POST);
	}

	if (isset($_POST['fluid_settings']))
	{
		unset($_POST['fluid_settings']);

		$Api = new ApiController();
		echo $Api->fluid_change_settings($_POST);
	}