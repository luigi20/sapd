<?php

	class StudentController extends AbstractController
	{
		public function addStudent()
		{
			if( !empty($this->post("sStudentName")) && !empty($this->post("iClassId"))
				&& !empty($this->post("sStudentAddress"))  && !empty($this->post("sStudentDateBirth"))
			&& !empty($this->post("sStudentEmail"))  && !empty($this->post("sStudentCell"))
			 && !empty($this->post("sStudentType")) && !empty($this->post("sLevelStudent"))  && !empty($this->post("sStudentMotivation")))
			{	
		
				$oStudent  = new Student($this->post("iClassId"),$this->post("sStudentName"),$this->post("sStudentCell"),
										$this->post("sStudentAddress"),$this->post("sLevelStudent"),$this->post("sStudentEmail"),
										$this->post("sStudentMotivation"),$this->post("sStudentDateBirth"),$this->post("sStudentDayMaturity"),
										$this->post("sStudentType"));
				Student::addStudent($oStudent);	
			}
		}
		
		public function editStudent()
		{
			$iEditClass = new Sessao("editStudent",$this->get("id"));
			$this->redirect("login","pageeditstudent");
		}
		
		public function updateStudent()
		{
			if( !empty($this->post("sStudentName")) && !empty($this->post("iClassId"))
				&& !empty($this->post("sStudentAddress"))  && !empty($this->post("sStudentDateBirth"))
			&& !empty($this->post("sStudentEmail"))  && !empty($this->post("sStudentCell"))
			 && !empty($this->post("sStudentType")) && !empty($this->post("sLevelStudent"))  && !empty($this->post("sStudentMotivation")))
			{	
		
				$oStudent  = new Student($this->post("iClassId"),$this->post("sStudentName"),$this->post("sStudentCell"),
										$this->post("sStudentAddress"),$this->post("sLevelStudent"),$this->post("sStudentEmail"),
										$this->post("sStudentMotivation"),$this->post("sStudentDateBirth"),$this->post("sStudentDayMaturity"),
										$this->post("sStudentType"));
				Student::updateStudent($oStudent);	
			}
		}
		
		public function removeStudent()
		{
			$iIdStudent = $this->get("id");
			Student::removeStudent($iIdStudent);
		}
		
	/*	public function editActor()
		{
			$iEditActor = new Sessao("editActor",$this->get("id"));
			$this->redirect("pageeditactor");	
		}
		
		public function updateActor()
		{
			if( !empty($this->post("sActorName")) && !empty($this->post("sActorDescription")))
			{			
				$oActor  = new Actor($this->post("sActorName"),$this->post("sActorDescription"));
				Actor::updateActor($oActor);	
			}
		}
		
		public function removeActor()
		{
			$iIdActor = $this->get("id");
			Actor::removeActor($iIdActor);
		}*/
	}