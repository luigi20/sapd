<?php

	class EventController extends AbstractController
	{
		public function addEvent()
		{
			if( !empty($this->post("sEventAddress")) && !empty($this->post("sEventName"))
				&& !empty($this->post("fIncomeCost"))  && !empty($this->post("fEventCost"))
				&& !empty($this->post("fProfitCost"))  && !empty($this->post("sDescriptionEvent")) && !empty($this->post("sEventGuestList")))
			{
				$oEvent = new Event($this->post("sEventName"),$this->post("sDescriptionEvent"),$this->post("sEventGuestList"),
									$this->post("fEventCost"),$this->post("fIncomeCost"), 
									$this->post("fProfitCost"),$this->post("sEventAddress"));		
				Event::addEvent($oEvent);
			}
		}
		
		public function removeEvent()
		{
			$iIdEvent = $this->get("id");
			Event::removeEvent($iIdEvent);
		}
		
		public function visualizeTicket()
		{
			$iIdEvent = new Sessao("idEvent",$this->get("id"));
			$this->redirect("event","pagevisualizeticket");
		}
		
		public function editEvent()
		{
			$iEditEvent = new Sessao("editEvent",$this->get("id"));
			$this->redirect("login","pageeditevent");		
		}
		
		public function updateEvent()
		{
			if( !empty($this->post("sEventAddress")) && !empty($this->post("sEventName"))
				&& !empty($this->post("fIncomeCost"))  && !empty($this->post("fEventCost"))
				&& !empty($this->post("fProfitCost"))  && !empty($this->post("sDescriptionEvent")) && !empty($this->post("sEventGuestList")))
			{
				$oEvent = new Event($this->post("sEventName"),$this->post("sDescriptionEvent"),$this->post("sEventGuestList"),
									$this->post("fEventCost"),$this->post("fIncomeCost"), 
									$this->post("fProfitCost"),$this->post("sEventAddress"));		
				Event::updateEvent($oEvent);
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