<?php

	class LessonController extends AbstractController
	{
		public function addClassLesson()
		{
			if( !empty($this->post("iClass")) && !empty($this->post("iLocal")) && !empty($this->post("sDateClassLesson"))
				 && !empty($this->post("sStartingTime")) && !empty($this->post("sFinalTime")) && !empty($this->post("sLessonDescription")))
				{
					$oLesson = new ClassLesson($this->post("iClass"),$this->post("iLocal"),$this->post("sDateClassLesson"),
										$this->post("sStartingTime"),$this->post("sFinalTime"),$this->post("sLessonDescription"));
					ClassLesson::addClassLesson($oLesson);
				}
		}
		
		public function addIndividualLesson()
		{
			if( !empty($this->post("iStudent")) && !empty($this->post("sLessonType")) && !empty($this->post("sDateIndividualLesson"))
				 && !empty($this->post("sStartTimeIndividualLesson")) && !empty($this->post("sFinalTimeIndividualLesson"))
				&& !empty($this->post("sDescriptionIndividualLesson")))
				{
					$oLesson = new IndividualLesson($this->post("iStudent"),$this->post("sLessonType"),$this->post("sDateIndividualLesson"),
													$this->post("sStartTimeIndividualLesson"),$this->post("sFinalTimeIndividualLesson"),
													$this->post("sDescriptionIndividualLesson"));
			
					IndividualLesson::addIndividualLesson($oLesson);
				}
		}
		
		public function removeIndividualLesson()
		{
			$iIndividualLesson = $this->get("id");
			IndividualLesson::removeIndividualLesson($iIndividualLesson);
		}
		
		public function removeClassLesson()
		{
			$iIdClassLesson = $this->get("id");
			ClassLesson::removeClassLesson($iIdClassLesson);
		}
		
		public function editClassLesson()
		{
			$iEditUser = new Sessao("editClassLesson",$this->get("id"));
			$this->redirect("login","pageeditclasslesson");
		}
		
		public function editIndividualLesson()
		{
			$iEditUser = new Sessao("editIndividualLesson",$this->get("id"));
			$this->redirect("login","pageeditindividuallesson");
		}
		
		public function updateClassLesson()
		{
			if( !empty($this->post("iClass")) && !empty($this->post("iLocal")) && !empty($this->post("sDateClassLesson"))
				 && !empty($this->post("sStartingTime")) && !empty($this->post("sFinalTime")) && !empty($this->post("sLessonDescription")))
				{
					$oLesson = new ClassLesson($this->post("iClass"),$this->post("iLocal"),$this->post("sDateClassLesson"),
										$this->post("sStartingTime"),$this->post("sFinalTime"),$this->post("sLessonDescription"));
					ClassLesson::updateClassLesson($oLesson);
				}
		}
		
		public function updateIndividualLesson()
		{
			if( !empty($this->post("iStudent")) && !empty($this->post("sLessonType")) && !empty($this->post("sDateIndividualLesson"))
				 && !empty($this->post("sStartTimeIndividualLesson")) && !empty($this->post("sFinalTimeIndividualLesson"))
				&& !empty($this->post("sDescriptionIndividualLesson")))
				{
					$oLesson = new IndividualLesson($this->post("iStudent"),$this->post("sLessonType"),$this->post("sDateIndividualLesson"),
													$this->post("sStartTimeIndividualLesson"),$this->post("sFinalTimeIndividualLesson"),
													$this->post("sDescriptionIndividualLesson"));
			
					IndividualLesson::updateIndividualLesson($oLesson);
				}
		}
	/*	public function addLink()
		{
			$iLinkProject = new Sessao("linkUser",$this->get("id"));
			User::addLinkProject();	
		}
		
		public function editUser()
		{
			$iEditUser = new Sessao("editUser",$this->get("id"));
			$this->redirect("pageedituser");
		}
		
		public function linkProject()
		{
			$iLinkProject = new Sessao("linkProject",$this->get("id"));
			$this->redirect("pagelinkuser");
		}
		
		public function removeLinkProject()
		{
			$iLinkProject = new Sessao("linkProject",$this->get("id"));
			$this->redirect("pageremovelinkuser");
		}
		
		public function removeLinkUser()
		{
			$iIdUser = $this->get("id");
			User::removeLinkUser($iIdUser);
		}
		
		public function updateUser()
		{
			if( !empty($this->post("sUserName")) && !empty($this->post("sUserType")) && !empty($this->post("sUserCpf"))
				 && !empty($this->post("sUserEmail")) && !empty($this->post("sUserPassword")) )
				{
					$oUser = new User($this->post("sUserCpf"),$this->post("sUserName"),$this->post("sUserEmail"),
										$this->post("sUserType"),$this->post("sUserPassword"));	
					User::updateUser($oUser);
				}		
		}
		
		public function removeUser()
		{
			$iIdUser = $this->get("id");
			User::removeUser($iIdUser);
		}
		
		public function sendEmail()
		{
			User::rememberPassword($this->post("sEmail"));
		}*/
			
	}