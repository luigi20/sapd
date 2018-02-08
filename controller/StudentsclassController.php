<?php

	class StudentsclassController extends AbstractController
	{
		public function addClass()
		{	
			if( !empty($this->post("iLocalId")) && !empty($this->post("sClassName"))
				 && !empty($this->post("sClassRitAndInfo")))
			{	
				$oStudentsClass = new StudentsClass($this->post("iLocalId"),$this->post("sClassName"),$this->post("sClassRitAndInfo"));
				StudentsClass::addClass($oStudentsClass);	
			}
			else
			{
				echo "<script> 
						alert('Campos Devem Ser Preenchidos !!!');
						window.location.href = '/sapd/login/pageaddclass';
					</script>";
			}
		}
		
		public function removeClass()
		{
			$iIdClass = $this->get("id");
			StudentsClass::removeClass($iIdClass);
		}
		
		public function editClass()
		{
			$iEditClass = new Sessao("editClass",$this->get("id"));
			$this->redirect("login","pageeditclass");
		}
		
		public function updateClass()
		{	
			if( !empty($this->post("iLocalId")) && !empty($this->post("sClassName"))
				 && !empty($this->post("sClassRitAndInfo")))
			{	
				$oStudentsClass = new StudentsClass($this->post("iLocalId"),$this->post("sClassName"),$this->post("sClassRitAndInfo"));
				StudentsClass::updateClass($oStudentsClass);	
			}
			else
			{
				echo "<script> 
						alert('Campos Devem Ser Preenchidos !!!');
						window.location.href = '/sapd/login/pageaddclass';
					</script>";
			}
		}
		
	/*	public function removeProject()
		{
			$iIdProject = $this->get("id");
			Project::removeProject($iIdProject);
		}
		
		public function editProject()
		{
			$iEditProject = new Sessao("editProject",$this->get("id"));
			$this->redirect("pageeditproject");
			
		}
		
		public function updateProject()
		{
			if( !empty($this->post("sProjectName")) && !empty($this->post("sProjectDateConclusion"))
				 && !empty($this->post("sProjectStatus"))  && !empty($this->post("sProjectOverview"))  )
			{	
				$timeZone = new DateTimeZone('UTC');
				$dDateStart = DateTime::createFromFormat ('d/m/Y', date('d/m/Y'), $timeZone);
				$dDateFinish = DateTime::createFromFormat ('d/m/Y', $this->post("sProjectDateConclusion"), $timeZone);
				if($dDateFinish > $dDateStart )
				{
					$oProject = new Project($this->post("sProjectName"),$this->post("iManager"),$date,
										$this->post("sProjectOverview"),$this->post("sQuestionnaireProject"),$this->post("sProjectStatus"));
					Project::updateProject($oProject);	
				}
				else
				{
					echo "<script> 
								alert('Data De Conclusao Não Deve Ser Menor Que A Data Inicial Do Projeto !!!');
								window.location.href = '/ser/login/pageeditproject';
						</script>";
				}
			}
			else
			{
				echo "<script> 
						alert('Visao Geral do Projeto Deve Ser Preenchida !!!');
						window.location.href = '/ser/login/pageaddproject';
			     </script>";
			}
		}
		
		public function allStakeHolderRequirementsProject()
		{  
			$iIdProject = $this->get("id");
			$aAllRequirementsProject = Project::findRequirements($iIdProject);
			if(empty($aAllRequirementsProject))
			{
				echo "<script> 
						alert('Nenhum Requisito Vinculado ao Projeto !!!');
						window.location.href = '/ser/login/pagevisualizelifting';
					</script>";	
			}
			else
			{
				$aAllRequirements = new Sessao("allRequirements",$aAllRequirementsProject);
				$this->pageStakeHolderVisualizeAllRequirementsProject();
			}
		}
		
		public function allStakeHolderRequirementsProjectApproved()
		{  
			$iIdProject = $this->get("id");
			$aAllRequirementsProject = Project::findRequirements($iIdProject);
			if(empty($aAllRequirementsProject))
			{
				echo "<script> 
						alert('Nenhum Requisito Vinculado ao Projeto !!!');
						window.location.href = '/ser/login/pagevisualizeliftingmanager';
					</script>";	
			}
			else
			{
				$aAllRequirements = new Sessao("allRequirements",$aAllRequirementsProject);
				$this->pageManagerVisualizeAllRequirementsProject();
			}
		}
		
		public function allKeyUserProjectRequirements()
		{
			$iIdProject = $this->get("id");
			$aAllRequirementsProject = Project::findRequirements($iIdProject);
			if(empty($aAllRequirementsProject))
			{
				echo "<script> 
						alert('Nenhum Requisito Vinculado ao Projeto !!!');
						window.location.href = '/ser/login/pagevisualizelifting';
					</script>";	
			}
			else
			{
				$aAllRequirements = new Sessao("allRequirements",$aAllRequirementsProject);
				$this->pageKeyUserVisualizeAllRequirementsProject();
			}
		}
		
		public function allDeveloperProjectRequirementsApproved()
		{
			$iIdProject = $this->get("id");
			$aAllApprovedRequirementsProject = Project::findApprovedRequirements($iIdProject);
			if(empty($aAllApprovedRequirementsProject))
			{
				echo "<script> 
						alert('Nenhum Requisito Foi Aprovado !!!');
						window.location.href = '/ser/login/pagedevelopervisualizeproject';
					</script>";	
			}
			else
			{
				$aAllRequirements = new Sessao("allApprovedRequirements",$aAllApprovedRequirementsProject);
				$this->pageDeveloperVisualizeAllRequirementsProject();
			}
		}*/
	}