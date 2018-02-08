<?php

	class LocalController extends AbstractController
	{
		public function addLocal()
		{
			if( !empty($this->post("sLocalName")) && !empty($this->post("sLocalAddress"))) 
			{ 	
				$oLocal  = new Local($this->post("sLocalName"),$this->post("sLocalAddress"),
										 $this->post("iLocalTel"));
				Local::addLocal($oLocal);
			}
		}
		
		public function removeLocal()
		{
			$iIdLocal = $this->get("id");
			Local::removeLocal($iIdLocal);
		}
		
		public function editLocal()
		{
			$iEditLocal = new Sessao("editLocal",$this->get("id"));
			$this->redirect("login","pageeditlocal");	
		}
		
		public function updateLocal()
		{
			if( !empty($this->post("sLocalName")) && !empty($this->post("sLocalAddress"))) 
			{ 	
				$oLocal  = new Local($this->post("sLocalName"),$this->post("sLocalAddress"),
										 $this->post("iLocalTel"));
				Local::updateLocal($oLocal);
			}
		}
	/*	public function editUseCase()
		{
			$iEditUseCase = new Sessao("editUseCase",$this->get("id"));
			$this->redirect("pageeditusecase");	
		}
		
		public function updateUseCase()
		{
			if( !empty($this->post("iIdDiagram")) && !empty($this->post("sUseCaseName")) 
				&& !empty($this->post("sUseCaseFlow")) && !empty($this->post("sUseCaseResume"))
				&& !empty($this->post("sUseCasePrecondition")) && !empty($this->post("sUseCaseAlternativeFlow")) )
			{
				$oUseCase  = new UseCase($this->post("iIdDiagram"),$this->post("sUseCaseName"),
										 $this->post("sUseCaseFlow"),$this->post("sUseCaseResume"),
										 $this->post("sUseCasePrecondition"), $this->post("sUseCasePoscondition"),
										 $this->post("sUseCaseAlternativeFlow"),$this->post("sUseCaseException"),
										 $this->post("sUseCaseBusinessRule"));//var_dump($oDiagram);die();
				UseCase::updateUseCase($oUseCase);
				//self::redirect("pageadddiagram");
			}
		}
		
		public function removeUseCase()
		{
			$iIdUseCase = $this->get("id");
			UseCase::removeUseCase($iIdUseCase);
		}*/
	}