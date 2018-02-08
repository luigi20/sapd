<?php
	
	class Local
	{
		private $iIdLocal;
		private $sLocalName;
		private $sLocalAddress;
		private $iLocalTel;
		private $iIdUser;
		
		function __construct($sLocalName,$sLocalAddress,$iLocalTel)
		{
			$this->sLocalName 	  = $sLocalName;
			$this->sLocalAddress  = $sLocalAddress;
			$this->iLocalTel  	  = $iLocalTel;
		}
		
		public function getIdLocal()
		{
			return $this->iIdLocal;
		}
	
		public function getLocalName()
		{
			return $this->sLocalName;
		}
		
		public function getLocalAddress()
		{
			return $this->sLocalAddress;
		}
		
		public function getLocalTel()
		{
			return $this->iLocalTel;
		}
		
		public function getIdUser()
		{
			return $this->iIdUser;
		}

		public function setLocalName($sLocalName)
		{
			$this->sLocalName = $sLocalName;
		}

		public function setLocalAddress($sLocalAddress)
		{
			$this->sLocalAddress = $sLocalAddress;
		}
		
		public function setLocalTel($iLocalTel)
		{
			$this->iLocalTel = $iLocalTel;
		}
		
		public function setIdUser($iIdUser)
		{
			$this->iIdUser = $iIdUser;
		}
		
		public static function researchLocalExist($oLocal)
		{
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$sQuery = "SELECT * FROM Lugar WHERE nomeLugar = ? ";
				$aArrayParam = [$oLocal->getLocalName()];
				$aExistLocal = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
				if (!empty($aExistLocal))
				{
					echo "<script> 
									alert('Lugar Ja Foi Cadastrado !!!');
									window.location.href = '/sapd/login/pageaddlocal';
						 </script>";
				}
			
			}
			catch(PDOException $e)
			{
				echo "Erro: ".$e->getMessage();
			}
		
		}
		
		public static function addLocal($oLocal)
		{
			self::researchLocalExist($oLocal);
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "INSERT INTO Lugar(nomeLugar,enderecoLugar,telLugar,Usuario_idUsuario) 
							VALUES (?,?,?,?) ";
				$oLocal->setIdUser(User::returnUserId());
				$aArrayParam = [$oLocal->getLocalName(),$oLocal->getLocalAddress(),$oLocal->getLocalTel(),$oLocal->getIdUser()];
				$rDatabaseHandler->add($sQuery,$rConnection,$aArrayParam);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
							alert('Cadastro Feito Com Sucesso !!!');
							window.location.href = '/sapd/login/pagevisualizelocal';
					  </script>";
			}
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Cadastrar: ".$e->getMessage();
			}
		}
	
		public static function findEditLocal()
		{
			$iEdit = new Sessao();
			$iId = $iEdit->getSessao("editLocal");
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Lugar WHERE idLugar = ?  ";
			$aArrayParam = [$iId];
			$aLugar = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
			return $aLugar;		
		}
		
		public static function removeLocal($iIdLocal)
		{
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$rDatabaseHandler->begin($rConnection);
			$sQuery = "DELETE FROM Lugar WHERE idLugar = ? ";
			$aArrayParam = [$iIdLocal];
			$lDeleted = $rDatabaseHandler->deleteDate($sQuery,$rConnection,$aArrayParam);
			if($lDeleted)
			{
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Lugar Deletado Com Sucesso !!!');
						window.location.href = '/sapd/login/pagevisualizelocal';
					</script>";
			}	
		}
		
		public static function allUserLocal()
		{	
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Lugar order by nomeLugar  ";
			$aAllLocal = $rDatabaseHandler->query($sQuery,$rConnection,null,true);	
			return $aAllLocal;
		}
		
		public static function findLocal($iIdLocal)
		{
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Lugar WHERE idLugar = ?  ";
			$aArrayParam = [$iIdLocal];
			$aLocal = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
			return $aLocal;		
		}
		
		public static function updateLocal($oLocal)
		{
			try
			{   
				$iEdit = new Sessao();
				$iId = $iEdit->getSessao("editLocal"); 
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "UPDATE Lugar SET 
									   nomeLugar = ?,
									   enderecoLugar = ?,
									   telLugar = ?
							WHERE idLugar = ? ";
				$aArrayParam = [$oLocal->getLocalName(),$oLocal->getLocalAddress(),$oLocal->getLocalTel()];
				$aArrayCondicao = [$iId];
				$rDatabaseHandler->update($sQuery,$rConnection,$aArrayParam,$aArrayCondicao);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Local Alterado Com Sucesso !!!');
						window.location.href = '/sapd/login/pagevisualizelocal';
					</script>";		
			}	
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Atualizar: ".$e->getMessage();
			}	
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
	
		
		
		public static function allTypeRequirement()
		{	
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM tipoRequisito order by nomeTipoRequisito  ";
			$aAllTypeRequirement = $rDatabaseHandler->query($sQuery,$rConnection,null,true);	
			return $aAllTypeRequirement;
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