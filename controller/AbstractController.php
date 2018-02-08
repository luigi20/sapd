<?php
abstract class AbstractController{

	private $POST = array();
	private $GET = array();
	private $FILES = array();
	private $SESSION = array();

	public function setGetData($aData){
		foreach($aData as $key => $value){
			$this->GET[$key] = $value;
		}
	}

	public function setPostData($aData){
		foreach($aData as $key => $value){
			$this->POST[$key] = $value;
		}
	}

	public function setFilesData($aData){
		foreach($aData as $key => $value){
			$this->FILES[$key] = $value;
		}
	}
	
	public function setSessionData($aData)
	{
		foreach($aData as $key => $value)
		{
			$this->SESSION[$key] = $value;
		}
	}

	public function get($sKey){
		return $this->GET[$sKey];
	}
	
	public function post($sKey){
		return $this->POST[$sKey];
	}

	public function files($sKey){
		return $this->FILES[$sKey];
	}

	public function session($sKey)
	{
		return $this->SESSION[$sKey];
	}
	
	public function pageLogin()
	{
		include 'view/pageLogin.php';
	}
	
	public function pageRememberPassword()
	{
		include 'view/pageRememberPassword.php';	
	}
	
	public function redirect($sController,$sPagina)
	{
		header ('Location:/sapd/'.$sController.'/'.$sPagina);
	}
		
	public function pageDefaultMaster()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bMaster"))
		{
			include 'view/pageDefaultMaster.php';
		}
	}

	public function pageDefault()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageDefault.php';
		}
	}
	
	public function pageAddUser()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bMaster"))
		{
			include 'view/pageAddUser.php';
		}
	}
		
	public function pageAddLocal()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageAddLocal.php';
		}
	}
	
	public function pageAddClass()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageAddClass.php';
		}
	}
	
	public function pageAddStudent()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageAddStudent.php';
		}
	}
	
	public function pageAddPayment()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageAddPayment.php';
		}
	}
	
	public function pageAddClassLesson()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageAddClassLesson.php';
		}
	}
	
	public function pageAddIndividualLesson()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageAddIndividualLesson.php';
		}
	}
	
	public function pageAddEvent()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageAddEvent.php';
		}
	}
	
	public function pageAddTicket()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageAddTicket.php';
		}
	}
	
	public function pageVisualizeLocal()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageVisualizeLocal.php';
		}
	}
	
	public function pageVisualizeClass()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageVisualizeClass.php';
		}
	}
	
	public function pageVisualizePayment()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageVisualizePayment.php';
		}
	}
	
	public function pageVisualizeStudent()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageVisualizeStudent.php';
		}
	}
	
	public function pageVisualizeIndividualLesson()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageVisualizeIndividualLesson.php';
		}
	}
	
	public function pageVisualizeClassLesson()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageVisualizeClassLesson.php';
		}
	}
	
	public function pageVisualizeEvent()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageVisualizeEvent.php';
		}
	}
	
	public function pageVisualizeTicket()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageVisualizeTicket.php';
		}
	}
	
	public function pageVisualizeTicketEvent()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageVisualizeTicketEvent.php';
		}
	}
	
	public function pageEditLocal()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageEditLocal.php';
		}
	}
	
	public function pageEditClass()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageEditClass.php';
		}
	}
	
	public function pageEditStudent()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageEditStudent.php';
		}
	}
	
	public function pageEditPayment()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageEditPayment.php';
		}
	}
	
	public function pageEditClassLesson()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageEditClassLesson.php';
		}
	}
	
	public function pageEditIndividualLesson()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageEditIndividualLesson.php';
		}
	}

	public function pageEditEvent()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageEditEvent.php';
		}
	}
	
	public function pageEditTicket()
	{
		$bLogged = new Sessao();
		$bUser = new Sessao();
		if($bLogged->getSessao("bLogged") && $bUser->getSessao("bTeacher"))
		{
			include 'view/pageEditTicket.php';
		}
	}
	
	public function deslogar()
	{
	//	$bLogado = new Sessao();
	//	$bAdministrador = new Sessao();
		session_destroy();

		$this->redirectLogin('pagelogin');
	}
	
	public function redirectLogin($sPagina)
	{
		header ('Location:/sapd/login/'.$sPagina);
	}
	
}
