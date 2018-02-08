<?php

	class LoginController extends AbstractController
	{
		public function logged()
		{
			$bLogged = new Sessao();
			$bUser = new Sessao("bUser",false);
			if(!empty($this->post("sUserEmail")) && !empty($this->post("sUserPassword")) && $bLogged->getSessao("bLogged") == false) 
			{
				$aUser = (array)User::authenticate($this->post("sUserEmail"),$this->post("sUserPassword")); 
			    $sUserName = new Sessao("sUserName",$aUser["nomeUsuario"]);
				$iIdUser = new Sessao("iIdUser", $aUser["idUsuario"]);
				switch ($aUser["tipoUsuario"]) 
				{
					case "Master":
						$bLogged->setSessao("bLogged",true);
						$bUser->setSessao("bMaster",true);
						$this->pageDefaultMaster();
						break;
					
					case "Professor":
					
						$bLogged->setSessao("bLogged",true);
						$bUser->setSessao("bTeacher",true);
						$this->pageDefault();
					    break;
					
					default:
					
						echo "<script> 
									alert('Login/Senha Invalidos !!!');
									window.location.href = '/sapd/login/pagelogin';
							  </script>";
				}
			}
		}
		
	}
		
		
		
