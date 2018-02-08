<?php

	class UserController extends AbstractController
	{
		public function addUser()
		{
			if($this->post("sUserType") == "Professor")
			{
				$oUser = new Teacher($this->post("sUserName"),$this->post("sUserCellPhone"),
							  $this->post("sUserAddress"), $this->post("sUserEmail"),
								$this->post("sUserPassword"),$this->post("sUserType"));		
				Teacher::addUser($oUser);
			}
			else
			{
				$oUser = new Teacher($this->post("sUserName"),$this->post("sUserCellPhone"),
							  $this->post("sUserAddress"), $this->post("sUserEmail"),
								$this->post("sUserPassword"),$this->post("sUserType"));		
				Master::addUser($oUser);
			}
		}
		
		/*public function removeTeacher()
		{
			$iIdRequirement = $this->get("id");
			Requirement::removeRequirement($iIdRequirement);
		}
		
		public function editRequirement()
		{
			$iEditProject = new Sessao("editRequirement",$this->get("id"));
			$this->redirect("pageeditrequirement");		
		}
		
		public function updateRequirement()
		{
			if( !empty($this->post("sRequirementName")) && !empty($this->post("sRequirementDateFinish"))
				 && !empty($this->post("sDescriptionRequirement")) )
			{	
				$year= substr($this->post("sRequirementDateFinish"), 0, 4);
				$month = substr($this->post("sRequirementDateFinish"), 5,-3);
				$day = substr($this->post("sRequirementDateFinish"), 8);
				$date =$day."/".$month."/".$year;
				$oRequirement = new Requirement($this->post("iRequirementTask"),$this->post("iRequirementProject"),
												$this->post("iRequirementType"),$this->post("sRequirementName"),
												$this->post("sImportanceRequirement"),$this->post("sRequirementDateStart"),
												$date,$this->post("sDescriptionRequirement"));				
				Requirement::updateRequirement($oRequirement);	
			}
			else
			{
				echo "<script> 
						alert('Visao Geral do Projeto Deve Ser Preenchida !!!');
						window.location.href = 'pageaddproject';
			     </script>";
			}
		}*/
	}