<?php
	
	class Ticket
	{
		private $iIdTicket;
		private $iIdEvent;
		private $fTicketValue;
		private $sTicketName;
		private $fTicketQtd;
		private $fTicketProfit;
		
		function __construct($iIdEvent,$fTicketValue,$sTicketName,$fTicketQtd,$fTicketProfit)
		{
			$this->iIdEvent 	 = $iIdEvent;
			$this->fTicketValue  = $fTicketValue;
			$this->sTicketName   = $sTicketName;
			$this->fTicketQtd  	 = $fTicketQtd;
			$this->fTicketProfit = $fTicketProfit;
		}
		
		public function getTicketName()
		{
			return $this->sTicketName;
		}
	
		public function getTicketValue()
		{
			return $this->fTicketValue;
		}
		
		public function getIdEvent()
		{
			return $this->iIdEvent;
		}
		
		public function getTicketQtd()
		{
			return $this->fTicketQtd;
		}
		
		public function getTicketProfit()
		{
			return $this->fTicketProfit;
		}
		
		public function getIdTicket()
		{
			return $this->iIdTicket;
		}

		public function setTicketName($sTicketName)
		{
			$this->sTicketName = $sTicketName;
		}

		public function setTicketValue($sTicketValue)
		{
			$this->sTicketValue = $sTicketValue;
		}
		
		public function setIdEvent($iIdEvent)
		{
			$this->iIdEvent = $iIdEvent;
		}
		
		public function setTicketQtd($fTicketQtd)
		{
			$this->fTicketQtd = $fTicketQtd;
		}
		
		public function setTicketProfit($fTicketProfit)
		{
			$this->fTicketProfit = $fTicketProfit;
		}
		
		public static function researchTicketExist($oTicket)
		{
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$sQuery = "SELECT * FROM Lugar WHERE nomeLugar = ? ";
				$aArrayParam = [$oTicket->getTicketName()];
				$aExistTicket = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
				if (!empty($aExistTicket))
				{
					echo "<script> 
									alert('Ingresso Ja Foi Cadastrado !!!');
									window.location.href = '/sapd/login/pageaddticket';
						 </script>";
				}
			
			}
			catch(PDOException $e)
			{
				echo "Erro: ".$e->getMessage();
			}
		
		}
		
		public static function addTicket($oTicket)
		{
			self::researchTicketExist($oTicket);
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "INSERT INTO Ingresso(Evento_idEvento,nomeIngresso,valorIngresso,qtdVendIngresso,lucroIngresso) 
							VALUES (?,?,?,?,?) ";
				$aArrayParam = [$oTicket->getIdEvent(),$oTicket->getTicketName(),$oTicket->getTicketValue(),
								$oTicket->getTicketQtd(),str_replace(',','.',$oTicket->getTicketProfit())];
				$rDatabaseHandler->add($sQuery,$rConnection,$aArrayParam);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
							alert('Cadastro Feito Com Sucesso !!!');
							window.location.href = '/sapd/login/pagevisualizeticketevent';
					  </script>";
			}
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Cadastrar: ".$e->getMessage();
			}
		}
		
		public static function updateTicket($oTicket)
		{
			try
			{   
				$iEdit = new Sessao();
				$iId = $iEdit->getSessao("editTicket"); 
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "UPDATE Ingresso SET 
									   Evento_idEvento= ?,
									   nomeIngresso = ?,
									   valorIngresso = ?,
									   qtdVendIngresso = ?,
									   lucroIngresso = ?   
							WHERE idIngresso = ? ";
				$aArrayParam = [$oTicket->getIdEvent(),$oTicket->getTicketName(),$oTicket->getTicketValue(),
								$oTicket->getTicketQtd(),str_replace(',','.',$oTicket->getTicketProfit())];
				$aArrayCondicao = [$iId];
				$rDatabaseHandler->update($sQuery,$rConnection,$aArrayParam,$aArrayCondicao);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Ingresso Alterado Com Sucesso !!!');
						window.location.href = '/sapd/login/pagevisualizeticket';
					</script>";		
			}	
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Atualizar: ".$e->getMessage();
			}	
		}
		
		public static function removeTicket($iIdTicket)
		{
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$rDatabaseHandler->begin($rConnection);
			$sQuery = "DELETE FROM Ingresso WHERE idIngresso = ? ";
			$aArrayParam = [$iIdTicket];
			$lDeleted = $rDatabaseHandler->deleteDate($sQuery,$rConnection,$aArrayParam);
			if($lDeleted)
			{
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Ingresso Deletado Com Sucesso !!!');
						window.location.href = '/sapd/login/pagevisualizeticket';
					</script>";
			}
		}
		
		public static function allUserEvent()
		{	
			$iIdUser = User::returnUserId(); 
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Evento WHERE Usuario_idUsuario = ? order by idEvento desc  ";
			$aArrayParam = [$iIdUser];
			$aAllUserEvent = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam ,true);	
			return $aAllUserEvent;
		}
		
		public static function allTicketEvent()
		{	
			$iIdEvent = new Sessao();
			$iId = $iIdEvent->getSessao("idEvent");
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Ingresso WHERE Evento_idEvento = ?   ";
			$aArrayParam = [$iId];
			$aAllEventTicket = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam ,true);	
			return $aAllEventTicket;
		}
		
		public static function findEditTicket()
		{
			$iEdit = new Sessao();
			$iId = $iEdit->getSessao("editTicket");
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Ingresso WHERE idIngresso = ?  ";
			$aArrayParam = [$iId];
			$aTicket = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
			return $aTicket;		
		}	
		
	/*	public static function updateTypeRequirement($oTypeRequirement)
		{
			try
			{   
				$iEdit = new Sessao();
				$iId = $iEdit->getSessao("editTypeRequirement"); 
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "UPDATE tipoRequisito SET 
									   nomeTipoRequisito = ?,
									   obsTipoRequisito = ?    
							WHERE idTipoRequisito = ? ";
				$aArrayParam = [$oTypeRequirement->getTypeRequirementName(),$oTypeRequirement->getObsTypeRequirement()];
				$aArrayCondicao = [$iId];
				$rDatabaseHandler->update($sQuery,$rConnection,$aArrayParam,$aArrayCondicao);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Tipo de Requisito Alterado Com Sucesso !!!');
						window.location.href = '/ser/login/pagevisualizetyperequirement';
					</script>";		
			}	
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Atualizar: ".$e->getMessage();
			}	
		}
	
		public static function removeTypeRequirement($iIdTypeRequirement)
		{
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "DELETE FROM tipoRequisito WHERE idTipoRequisito = ? ";
				$aArrayParam = [$iIdTypeRequirement];
				$rDatabaseHandler->deleteDate($sQuery,$rConnection,$aArrayParam);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Tipo de Requisito Deletado Com Sucesso !!!');
						window.location.href = '/ser/login/pagevisualizetyperequirement';
					</script>";
			
			}
			catch(PDOException $e)
			{
				echo "Erro ao Deletar: ".$e->getMessage();
			}	
		}
		
		public static function allTypeRequirement()
		{	
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM tipoRequisito order by nomeTipoRequisito  ";
			$aAllTypeRequirement = $rDatabaseHandler->query($sQuery,$rConnection,null,true);	
			return $aAllTypeRequirement;
		}
		
		public static function findTypeRequirement($iIdRequirement)
		{
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM tipoRequisito where idTipoRequisito = ?  ";
			$aArrayParam = [$iIdRequirement];
			$aTypeRequirement = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
			return $aTypeRequirement;		
		}
		
		public static function findEditTypeRequirement()
		{
			$iEdit = new Sessao();
			$iId = $iEdit->getSessao("editTypeRequirement");
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM tipoRequisito where idTipoRequisito = ?  ";
			$aArrayParam = [$iId];
			$aTypeRequirement = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
			return $aTypeRequirement;		
		}*/
	}