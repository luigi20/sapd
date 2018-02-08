<?php
	
	class Payment
	{
		private $iIdPayment;
		private $iIdStudent;
		private $sPayDate;
		private $iMonthPayment;
		private $iYearPayment;
		private $sLocalPayment;
		private $sPaymentAmount;
		
		function __construct($iIdStudent,$sPayDate,$iMonthPayment,$iYearPayment,$sLocalPayment,$sPaymentAmount)
		{
			$this->iIdStudent				= $iIdStudent;
			$this->sPayDate   				= $sPayDate;
			$this->iMonthPayment 			= $iMonthPayment;
			$this->iYearPayment 			= $iYearPayment;
			$this->sLocalPayment 			= $sLocalPayment;
			$this->sPaymentAmount			= $sPaymentAmount;
		}
		
		public function getIdPayment()
		{
			return $this->iIdPayment;
		}
		
		public function getIdStudent()
		{
			return $this->iIdStudent;
		}
		
		public function getPayDate()
		{
			return $this->sPayDate;
		}
		
		public function getMonthPayment()
		{
			return $this->iMonthPayment;
		}
		
		public function getYearPayment()
		{
			return $this->iYearPayment;
		}
		
		public function getLocalPayment()
		{
			return $this->sLocalPayment;
		}
	
		public function getPaymentAmount()
		{
			return $this->sPaymentAmount;
		}

		public function setIdStudent($iIdStudent)
		{
			$this->iIdStudent = $iIdStudent;
		}
		
		public function setPayDate($sPayDate)
		{
			$this->sPayDate = $sPayDate;
		}
		
		public function setMonthPayment($sMonthPayment)
		{
			$this->sMonthPayment = $sMonthPayment;
		}
		
		public function setYearPayment($iYearPayment)
		{
			$this->iYearPayment = $iYearPayment;
		}
		
		public function setLocalPayment($sLocalPayment)
		{
			$this->sLocalPayment = $sLocalPayment;
		}
		
		public function setPaymentAmount($sPaymentAmount)
		{
			$this->sPaymentAmount = $sPaymentAmount;
		}
		
		public static function researchPaymentExist($oAddPayment)
		{
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$sQuery = "SELECT * FROM Pagamento WHERE mesPagamento = ? AND anoPagamento = ? ";
				$aArrayParam = [$oAddPayment->getMonthPayment(),$oAddPayment->getYearPayment()];
				$oAddPayment = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
				if (!empty($oAddPayment))
				{
					echo "<script> 
									alert(' Pagamento Ja Foi Cadastrado !!!');
									window.location.href = '/sapd/login/pageaddpayment';
						 </script>";
				}
			}
			catch(PDOException $e)
			{
				echo "Erro: ".$e->getMessage();
			}
		
		}
		
		public static function addPayment($oPayment)
		{
			self::researchPaymentExist($oPayment);
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "INSERT INTO Pagamento( Aluno_idAluno,
												 dataPagamento,
												 mesPagamento, 
												 localPagamento,
												 valorPagamento, 
												 anoPagamento) 
							VALUES (?,?,?,?,?,?) ";
				$aArrayParam = [$oPayment->getIdStudent(),$oPayment->getPayDate(),$oPayment->getMonthPayment(),
								$oPayment->getLocalPayment(),$oPayment->getPaymentAmount(),$oPayment->getYearPayment()];
				$rDatabaseHandler->add($sQuery,$rConnection,$aArrayParam);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
							alert('Cadastro Feito Com Sucesso !!!');
							window.location.href = '/sapd/login/pagevisualizepayment';
					  </script>";
			}
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Cadastrar: ".$e->getMessage();
			}
		}
		
		public static function updatePayment($oPayment)
		{
			try
			{   
				$iEdit = new Sessao();
				$iId = $iEdit->getSessao("editPayment"); 
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "UPDATE Pagamento SET 
										Aluno_idAluno = ?,
										dataPagamento = ?,
										mesPagamento = ?, 
										localPagamento = ?,
										valorPagamento = ?, 
										anoPagamento = ?  
							WHERE idPagamento = ? ";
				$aArrayParam = [$oPayment->getIdStudent(),$oPayment->getPayDate(),$oPayment->getMonthPayment(),
								$oPayment->getLocalPayment(),$oPayment->getPaymentAmount(),$oPayment->getYearPayment()];
				$aArrayCondicao = [$iId];
				$rDatabaseHandler->update($sQuery,$rConnection,$aArrayParam,$aArrayCondicao);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Pagamento Alterado Com Sucesso !!!');
						window.location.href = '/sapd/login/pagevisualizepayment';
					</script>";		
			}	
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Atualizar: ".$e->getMessage();
			}	
		}
		
		public static function removePayment($iIdPayment)
		{
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$rDatabaseHandler->begin($rConnection);
			$sQuery = "DELETE FROM Pagamento WHERE idPagamento = ? ";
			$aArrayParam = [$iIdPayment];
			$lDeleted = $rDatabaseHandler->deleteDate($sQuery,$rConnection,$aArrayParam);
			if($lDeleted)
			{
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Pagamento Deletado Com Sucesso !!!');
						window.location.href = '/sapd/login/pagevisualizepayment';
					</script>";
			}
		}
		
		public static function allUserPayment()
		{	
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Aluno a, Pagamento p WHERE a.Usuario_idUsuario = ? and a.idAluno = p.Aluno_idAluno order by a.nomeAluno,p.dataPagamento desc ";
			$aArrayParam = [User::returnUserId()];
			$aAllUserPayment = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,true);
			return $aAllUserPayment;	
		}
		
		public static function findEditPayment()
		{
			$iEdit = new Sessao();
			$iId = $iEdit->getSessao("editPayment");
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Pagamento WHERE idPagamento = ?  ";
			$aArrayParam = [$iId];
			$aPayment = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
			return $aPayment;		
		}
	/*	public static function updateRequirement($oRequirement)
		{
			try
			{   
				$iEdit = new Sessao();
				$iId = $iEdit->getSessao("editRequirement"); 
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "UPDATE Requisito SET 
										TipoRequisito_idTipoRequisito = ?,
										Tarefa_idTarefa = ?,
										Projeto_idProjeto = ?,
										nomeRequisito = ?,
										descricaoRequisito = ?,
										dataInicioRequisito = ?,
										dataTerminoRequisito = ?,
										importanciaRequisito = ?    
							WHERE idRequisito = ? ";
				$aArrayParam = [$oRequirement->getIdTypeRequirement(),$oRequirement->getIdTask(),$oRequirement->getIdProject(),
								$oRequirement->getRequirementName(),$oRequirement->getDescriptionRequirement(),$oRequirement->getStartDate(),
								$oRequirement->getFinishDate(),$oRequirement->getImportance()];
				$aArrayCondicao = [$iId];
				$rDatabaseHandler->update($sQuery,$rConnection,$aArrayParam,$aArrayCondicao);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Requisito Alterado Com Sucesso !!!');
						window.location.href = '/ser/login/pagevisualizerequirement';
					</script>";		
			}	
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Atualizar: ".$e->getMessage();
			}	
		}
		
		public static function situationUpdateRequirement($sSituationRequirement)
		{
			try
			{   
				$iRequirement = new Sessao();
				$iId = $iRequirement->getSessao("keyUserRequirement");
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "UPDATE Requisito SET 
										situacao = ?    
							WHERE idRequisito = ? ";
				$aArrayParam = [$sSituationRequirement];
				$aArrayCondicao = [$iId];
				$rDatabaseHandler->update($sQuery,$rConnection,$aArrayParam,$aArrayCondicao);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Requisito Alterado Com Sucesso !!!');
						window.location.href = '/ser/login/pagekeyuservisualizeallrequirementsproject';
					</script>";		
			}	
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Atualizar: ".$e->getMessage();
			}	
		}
		
		public static function removeRequirement($iIdRequirement)
		{
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "DELETE FROM Requisito WHERE idRequisito = ? ";
				$aArrayParam = [$iIdRequirement];
				$rDatabaseHandler->deleteDate($sQuery,$rConnection,$aArrayParam);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Requisito Deletado Com Sucesso !!!');
						window.location.href = '/ser/login/pagevisualizerequirement';
					</script>";
			}
			catch(PDOException $e)
			{
				echo "Erro ao Deletar: ".$e->getMessage();
			}	
		}
		
		public static function allRequirement()
		{	
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Requisito order by nomeRequisito  ";
			$aAllRequirement = $rDatabaseHandler->query($sQuery,$rConnection,null,true);	
			return $aAllRequirement;
		}
		
		public static function findRequirement($iIdRequirement)
		{
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Requisito where idRequisito = ?  ";
			$aArrayParam = [$iIdRequirement];
			$aRequirement = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
			return $aRequirement;		
		}
		
		public static function findEditRequirement()
		{
			$iEdit = new Sessao();
			$iId = $iEdit->getSessao("editRequirement");
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Requisito where idRequisito = ?  ";
			$aArrayParam = [$iId];
			$aRequirement = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
			return $aRequirement;		
		}
		
		public static function findKeyUserRequirement()
		{
			$iRequirement = new Sessao();
			$iId = $iRequirement->getSessao("keyUserRequirement");
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Requisito where idRequisito = ?  ";
			$aArrayParam = [$iId];
			$aRequirement = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
			return $aRequirement;		
		}*/
	}