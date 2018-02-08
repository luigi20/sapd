<?php

	class TicketController extends AbstractController
	{
		public function addTicket()
		{
			if( !empty($this->post("sTicketName")) && !empty($this->post("iIdEvent")) && !empty($this->post("fTicketValue"))  )
			{
				$oTicket = new Ticket($this->post("iIdEvent"),$this->post("fTicketValue"),$this->post("sTicketName"),
									$this->post("fTicketQtd"),$this->post("fTicketProfit"));		
				Ticket::addTicket($oTicket);
			}
		}
		
		public function removeTicket()
		{
			$iIdTicket = $this->get("id");
			Ticket::removeTicket($iIdTicket);
		}
		
		public function editTicket()
		{
			$iEditProject = new Sessao("editTicket",$this->get("id"));
			$this->redirect("login","pageeditticket");		
		}
		
		public function updateTicket()
		{
			if( !empty($this->post("sTicketName")) && !empty($this->post("iIdEvent")) && !empty($this->post("fTicketValue"))  )
			{
				$oTicket = new Ticket($this->post("iIdEvent"),$this->post("fTicketValue"),$this->post("sTicketName"),
									$this->post("fTicketQtd"),$this->post("fTicketProfit"));		
				Ticket::updateTicket($oTicket);
			}
		}
		/*
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