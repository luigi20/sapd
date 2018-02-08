<?php
	
	abstract class User
	{
		private $iIdUser;
		private $sUserName;
		private $iUserCellPhone;
		private $sUserAddress;
		private $sUserEmail;
		private $sUserPassword;
		private $sUserType;
		
		function __construct($sUserName,$iUserCellPhone,$sUserAddress,$sUserEmail,$sUserPassword,$sUserType)
		{
			$this->sUserName  		= $sUserName;
			$this->iUserCellPhone	= $iUserCellPhone;
			$this->sUserAddress  	= $sUserAddress;
			$this->sUserEmail		= $sUserEmail;
			$this->sUserPassword 	= $sUserPassword;
			$this->sUserType		= $sUserType;
		}
		
		public function getIdUser()
		{
			return $this->iIdUser;
		}
	
		public function getUserName()
		{
			return $this->sUserName;
		}
		
		public function getUserCellphone()
		{
			return $this->iUserCellPhone;
		}
		
		public function getUserAddress()
		{
			return $this->sUserAddress;
		}
		
		public function getUserEmail()
		{
			return $this->sUserEmail;
		}
		
		public function getUserPassword()
		{
			return $this->sUserPassword;
		}

		public function getUserType()
		{
			return $this->sUserType;
		}
		
		public function setUserName($sUserName)
		{
			$this->sUserName = $sUserName;
		}

		public function setUserCellphone($iUserCellPhone)
		{
			$this->iUserCellPhone = $iUserCellPhone;
		}
		
		public function setUserAddress($sUserAddress)
		{
			$this->sUserAddress  = $sUserAddress;
		}
		
		public function setUserEmail($sUserEmail)
		{
			$this->sUserEmail = $sUserEmail;
		}
		
		public function setUserPassword($sUserPassword)
		{
			$this->sUserPassword = $sUserPassword;
		}
		
		public function setUserType($sUserType)
		{
			$this->sUserType = $sUserType;
		}
		public static function authenticate($sUserEmail,$sUserPassword)
		{
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$sQuery = "SELECT * FROM Usuario WHERE emailUsuario = ? AND senhaUsuario = ?";
				$aArrayParam = [$sUserEmail,md5($sUserPassword)];
				$aLogged = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
				if (empty($aLogged))
				{
					echo "<script> 
								alert('Login/Senha Invalidos !!!');
								window.location.href = '/sapd/login/pagelogin';
						 </script>";
				}
				return $aLogged;
			}
			catch (PDOException $e)
			{
				echo "Erro ao tentar autenticar: ".$e;
			}
		}
		
		public static function researchUserExist($oUser)
		{
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$sQuery = "SELECT * FROM Usuario WHERE nomeUsuario = ? ";
				$aArrayParam = [$oUser->getUserName()];
				$aExistUser = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
				if (!empty($aExistUser))
				{
					throw new Exception('Usuario Ja Foi Cadastrado !!!');
				}
			
			}
			catch(PDOException $e)
			{
				echo "Erro: ".$e->getMessage();
			}
		
		}
		
		public static function addUser($oUser)
		{
			self::researchUserExist($oUser);
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "INSERT INTO Usuario(nomeUsuario,celularUsuario,enderecoUsuario,emailUsuario,senhaUsuario,tipoUsuario) 
							VALUES (?,?,?,?,?,?) ";
				$aArrayParam = [$oUser->getUserName(),$oUser->getUserCellPhone(),$oUser->getUserAddress(),
								$oUser->getUserEmail(),md5($oUser->getUserPassword()),$oUser->getUserType()];
				$rDatabaseHandler->add($sQuery,$rConnection,$aArrayParam);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
							alert('Cadastro Feito Com Sucesso !!!');
							window.location.href = '/sapd/login/pageadduser';
					  </script>";
			}
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Cadastrar: ".$e->getMessage();
			}
		}
		
		public static function returnUserId()
		{
			$iIdUser = new Sessao();
			return $iIdUser->getSessao("iIdUser");
		}
		
		/*public static function updateDiagram($oDiagram)
		{
			try
			{   
				$iEdit = new Sessao();
				$iId = $iEdit->getSessao("editDiagram"); 
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "UPDATE Diagrama SET 
									   Projeto_idProjeto = ?,
									   Ator_idAtor = ?,
									   nomeDiagrama = ?,
									   imgDiagrama = ?
							WHERE idDiagrama = ? ";
				$aArrayParam = [$oDiagram->getIdProject(),$oDiagram->getIdActor(),$oDiagram->getDiagramName(),$oDiagram->getDiagramPath()];
				$aArrayCondicao = [$iId];
				$rDatabaseHandler->update($sQuery,$rConnection,$aArrayParam,$aArrayCondicao);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Diagrama Alterado Com Sucesso !!!');
						window.location.href = '/ser/login/pagevisualizediagram';
					</script>";		
			}	
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Atualizar: ".$e->getMessage();
			}	
		}
	
		public static function removeDiagram($iIdDiagram)
		{
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "DELETE FROM Diagrama WHERE idDiagrama = ? ";
				$aArrayParam = [$iIdDiagram];
				$rDatabaseHandler->deleteDate($sQuery,$rConnection,$aArrayParam);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Tipo de Requisito Deletado Com Sucesso !!!');
						window.location.href = '/ser/login/pagevisualizediagram';
					</script>";
			}
			catch(PDOException $e)
			{
				echo "Erro ao Deletar: ".$e->getMessage();
			}	
		}
		
		public static function allDiagram()
		{	
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Diagrama order by idDiagrama";
			$aAllDiagram = $rDatabaseHandler->query($sQuery,$rConnection,null,true);	
			return $aAllDiagram;
		}
		
		public static function findEditDiagram()
		{
			$iEdit = new Sessao();
			$iId = $iEdit->getSessao("editDiagram");
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Diagrama where idDiagrama = ?  ";
			$aArrayParam = [$iId];
			$aDiagram = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
			return $aDiagram;		
		}*/
	}