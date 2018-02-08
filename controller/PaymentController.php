<?php

	class PaymentController extends AbstractController
	{
		public function addPayment()
		{
			if( !empty($this->post("iStudentId")) && !empty($this->post("sPaymentDay")) && !empty($this->post("iPaymentMonth"))
				 && !empty($this->post("sPaymentLocal"))  && !empty($this->post("iPaymentValue")) )
			{	
				$oPayment  = new Payment($this->post("iStudentId"),$this->post("sPaymentDay"),substr($this->post("iPaymentMonth"),5,6),
									substr($this->post("iPaymentMonth"),0,4),$this->post("sPaymentLocal"),$this->post("iPaymentValue"));
									
				Payment::addPayment($oPayment);
			}
		}
		
		public function removePayment()
		{
			$iIdPayment = $this->get("id");
			Payment::removePayment($iIdPayment);
		}
		
		public function editPayment()
		{
			$iEditTask = new Sessao("editPayment",$this->get("id"));
			$this->redirect("login","pageeditpayment");
			
		}
		
		public function updatePayment()
		{
		
			if( !empty($this->post("iStudentId")) && !empty($this->post("sPaymentDay")) && !empty($this->post("iPaymentMonth"))
				 && !empty($this->post("sPaymentLocal"))  && !empty($this->post("iPaymentValue")) )
			{	
				$oPayment  = new Payment($this->post("iStudentId"),$this->post("sPaymentDay"),substr($this->post("iPaymentMonth"),5,6),
									substr($this->post("iPaymentMonth"),0,4),$this->post("sPaymentLocal"),$this->post("iPaymentValue"));
									
				Payment::updatePayment($oPayment);
			}
		}
	/*	public function editTask()
		{
			$iEditTask = new Sessao("editTask",$this->get("id"));
			$this->redirect("pageedittask");
			
		}
		
		public function updateTask()
		{
		
			if( !empty($this->post("sProjectId")) && !empty($this->post("sUserId")) && !empty($this->post("sTaskName"))
				 && !empty($this->post("sTaskDateConclusion"))   )
			{	
				$timeZone = new DateTimeZone('UTC');
				$dDateStart = DateTime::createFromFormat ('d/m/Y', date('d/m/Y'), $timeZone);
				$dDateFinish = DateTime::createFromFormat ('d/m/Y', $this->post("sProjectDateConclusion"), $timeZone);
				if($dDateFinish > $dDateStart )
				{
					$oTask  = new Task($this->post("sProjectId"),$this->post("sUserId"),$this->post("sTaskDateStart"),
								   $this->post("sTaskName"),$sDate, $this->post("sTaskObs"),$this->post("sTaskNameDepend"));
					Task::updateTask($oTask);	
				}
				else
				{
					echo "<script> 
								alert('Data De Conclusao Não Deve Ser Menor Que A Data Inicial Da Tarefa !!!');
								window.location.href = '/ser/login/pageedittask';
						</script>";
				}
			}
		}
		
		*/
	}