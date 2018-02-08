<?php

require 'Sessao.php';
require 'erros.php';
require 'model/User.php';
require 'model/Student.php';
require 'model/StudentsClass.php';
require 'model/Lesson.php';
require 'model/ClassLesson.php';
require 'model/IndividualLesson.php';
require 'model/Local.php';
require 'model/Event.php';
require 'model/Payment.php';
require 'model/Teacher.php';
require 'model/Ticket.php';
require 'model/Master.php';
require 'database/CommonFunctions.php';
require 'database/SapdDatabaseHandler.php';
require 'controller/AbstractController.php';
require 'session.php';


$sController = ucfirst(strtolower($_GET['controller']) . 'Controller');
$sAction = ucfirst(strtolower($_GET['action']));

if (file_exists('controller/' . $sController . '.php')){
	include 'controller/' . $sController . '.php'; 
	$oController = new $sController();
	$oController->setPostData($_POST);
	$oController->setGetData($_GET);
	$oController->setFilesData($_FILES);
	$oController->setSessionData($_SESSION);

	if (method_exists($sController, $sAction)){
		$oController->$sAction();
	}else{
		echo 'Action not found';
	}	
}
else
{
	header ('Location:/sapd/login/pagelogin');
}

