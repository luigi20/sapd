<?php
	
	class Event
	{
		private $iIdEvent;
		private $iIdUser;
		private $sEventName;
		private $sDescriptionEvent;
		private $sEventGuestList;
		private $fEventCost;
		private $fEventIncome;
		private $fEventProfit;
		private $sEventAddress;
		
		function __construct($sEventName,$sDescriptionEvent,$sEventGuestList,$fEventCost,$fEventIncome,$fEventProfit,$sEventAddress)
		{
			$this->sEventName 	  		= $sEventName;
			$this->sDescriptionEvent  	= $sDescriptionEvent;
			$this->sEventGuestList  	= $sEventGuestList;
			$this->fEventCost  	  		= $fEventCost;
			$this->fEventIncome  	  	= $fEventIncome;
			$this->fEventProfit  	  	= $fEventProfit;
			$this->sEventAddress  	  	= $sEventAddress;	
		}
		
		public function getIdEvent()
		{
			return $this->iIdEvent;
		}
		
		public function getIdUser()
		{
			return $this->iIdUser;
		}
	
		public function getEventName()
		{
			return $this->sEventName;
		}
		
		public function getDescriptionEvent()
		{
			return $this->sDescriptionEvent ;
		}
		
		public function getEventGuestList()
		{
			return $this->sEventGuestList;
		}
		
		public function getEventCost()
		{
			return $this->fEventCost;
		}
		
		public function getEventIncome()
		{
			return $this->fEventIncome;
		}
		
		public function getEventProfit()
		{
			return $this->fEventProfit;
		}
		
		public function getEventAddress()
		{
			return $this->sEventAddress;
		}

		public function setEventName($sEventName)
		{
			$this->sEventName = $sEventName;
		}
		
		public function setIdUser($iIdUser)
		{
			$this->iIdUser = $iIdUser;
		}

		public function setDescriptionEvent($sDescriptionEvent)
		{
			$this->sDescriptionEvent = $sDescriptionEvent;
		}
		
		public function setEventGuestList($sEventGuestList)
		{
			$this->sEventGuestList = $sEventGuestList;
		}
		
		public function setEventCost($fEventCost)
		{
			$this->fEventCost = $fEventCost;
		}
		
		public function setEventIncome($fEventIncome)
		{
			$this->fEventIncome = $fEventIncome;
		}
		
		public function setEventProfit($fEventProfit)
		{
			$this->fEventProfit = $fEventProfit;
		}
		
		public function setEventAddress($sEventAddress)
		{
			$this->sEventAddress = $sEventAddress;
		}
		
		public static function researchEventExist($oEvent)
		{
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$sQuery = "SELECT * FROM Evento WHERE nomeEvento = ? ";
				$aArrayParam = [$oEvent->getEventName()];
				$aExistEvent = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
				if (!empty($aExistEvent))
				{
					echo "<script> 
									alert('Evento Ja Foi Cadastrado !!!');
									window.location.href = '/sapd/login/pageaddevent';
						 </script>";
				}
			
			}
			catch(PDOException $e)
			{
				echo "Erro: ".$e->getMessage();
			}
		
		}
		
		public static function addEvent($oEvent)
		{
			self::researchEventExist($oEvent);
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "INSERT INTO Evento(Usuario_idUsuario,
												nomeEvento,
												descricaoEvento,
												listaConvidadosEvento,
												custoEvento,
												rendaEvento,
												lucroEvento,
												enderecoEvento) 
							VALUES (?,?,?,?,?,?,?,?) ";
				$oEvent->setIdUser(User::returnUserId());
				$oEvent->setEventCost(str_replace('.','',$oEvent->getEventCost()));
				$oEvent->setEventIncome(str_replace('.','',$oEvent->getEventIncome()));
				$oEvent->setEventProfit(str_replace('.','',$oEvent->getEventProfit()));
				$aArrayParam = [$oEvent->getIdUser(),$oEvent->getEventName(),
								$oEvent->getDescriptionEvent(),$oEvent->getEventGuestList(),
								str_replace(',','.',$oEvent->getEventCost()),str_replace(',','.',$oEvent->getEventIncome()),
								str_replace(',','.',$oEvent->getEventProfit()),$oEvent->getEventAddress()];
				$rDatabaseHandler->add($sQuery,$rConnection,$aArrayParam);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
							alert('Cadastro Feito Com Sucesso !!!');
							window.location.href = '/sapd/login/pagevisualizeevent';
					  </script>";
			}
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Cadastrar: ".$e->getMessage();
			}
			
		}
		
		public static function updateEvent($oEvent)
		{
			try
			{   
				$iEdit = new Sessao();
				$iId = $iEdit->getSessao("editEvent"); 
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "UPDATE Evento SET 
									   nomeEvento = ?,
										descricaoEvento = ?,
										listaConvidadosEvento = ?,
										custoEvento = ?,
										rendaEvento = ?,
										lucroEvento = ?,
										enderecoEvento = ? 
							WHERE idEvento = ? ";
				$oEvent->setEventCost(str_replace('.','',$oEvent->getEventCost()));
				$oEvent->setEventIncome(str_replace('.','',$oEvent->getEventIncome()));
				$oEvent->setEventProfit(str_replace('.','',$oEvent->getEventProfit()));
				$aArrayParam = [$oEvent->getEventName(),
								$oEvent->getDescriptionEvent(),$oEvent->getEventGuestList(),
								str_replace(',','.',$oEvent->getEventCost()),str_replace(',','.',$oEvent->getEventIncome()),
								str_replace(',','.',$oEvent->getEventProfit()),$oEvent->getEventAddress()];
				$aArrayCondicao = [$iId];
				$rDatabaseHandler->update($sQuery,$rConnection,$aArrayParam,$aArrayCondicao);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Evento Alterado Com Sucesso !!!');
						window.location.href = '/sapd/login/pagevisualizeevent';
					</script>";		
			}	
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Atualizar: ".$e->getMessage();
			}	
		}
		
		public static function removeEvent($iIdEvent)
		{
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$rDatabaseHandler->begin($rConnection);
			$sQuery = "DELETE FROM Evento WHERE idEvento = ? ";
			$aArrayParam = [$iIdEvent];
			$lDeleted = $rDatabaseHandler->deleteDate($sQuery,$rConnection,$aArrayParam);
			if($lDeleted)
			{
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Evento Deletado Com Sucesso !!!');
						window.location.href = '/sapd/login/pagevisualizeevent';
					</script>";
			}
		}
		
		public static function allUserEvent()
		{
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Evento WHERE Usuario_idUsuario = ?  ";
			$aArrayParam = [User::returnUserId()];
			$aAllEvent = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,true);
			return $aAllEvent;		
		}
		
		public static function findEvent($iIdEvent)
		{
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Evento WHERE idEvento = ?  ";
			$aArrayParam = [$iIdEvent];
			$aEvent = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
			return $aEvent;		
		}
		
		public static function findEditEvent()
		{
			$iEdit = new Sessao();
			$iId = $iEdit->getSessao("editEvent");
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Evento WHERE idEvento = ?  ";
			$aArrayParam = [$iId];
			$aEvent = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
			return $aEvent;		
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