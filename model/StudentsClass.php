<?php
	
	class StudentsClass
	{
		private $iIdClass;
		private $iIdUser;
		private $iIdLocal;
		private $sClassName;
		private $sDancePace;
		
		function __construct($iIdLocal,$sClassName,$sDancePace = null)
		{
			$this->iIdLocal 	= $iIdLocal;
			$this->sClassName	= $sClassName;
			$this->sDancePace	= $sDancePace;
		}
		
		public function getIdClass()
		{
			return $this->iIdClass;
		}
		
		public function getIdUser()
		{
			return $this->iIdUser;
		}
		
		public function getIdLocal()
		{
			return $this->iIdLocal;
		}
		
		public function getClassName()
		{
			return $this->sClassName;
		}
		
		public function getDancePace()
		{
			return $this->sDancePace;
		}

		public function setIdUser($iIdUser)
		{
			$this->iIdUser = $iIdUser;
		}
		
		public function setIdLocal($iIdLocal)
		{
			$this->iIdLocal = $iIdLocal;
		}
	
		public function setClassName($sClassName)
		{
			$this->sClassName = $sClassName;
		}
		
		public function setDancePace($sDancePace)
		{
			$this->sDancePace = $sDancePace;
		}
		
		public static function researchStudentsClassExist($oAddStudentsClass)
		{
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$sQuery = "SELECT * FROM Turma WHERE nomeTurma = ? ";
				$aArrayParam = [$oAddStudentsClass->getClassName()];
				$oAddStudentsClass = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
				if (!empty($oAddStudentsClass))
				{
					echo "<script> 
								alert('Turma Ja Foi Cadastrada !!!');
								window.location.href = '/sapd/login/pageaddclass';
						  </script>";
				 
				}
			}
			catch(PDOException $e)
			{
				echo "Erro: ".$e->getMessage();
			}
		}
		
		public static function addClass($oClass)
		{
			self::researchStudentsClassExist($oClass);
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "INSERT INTO Turma(Usuario_idUsuario,
											   Lugar_idLugar,
											   nomeTurma,
											   obsTurma) 
						   VALUES (?,?,?,?) ";	
				$oClass->setIdUser(User::returnUserId());
				$aArrayParam = [$oClass->getIdUser(),$oClass->getIdLocal(),
								$oClass->getClassName(),$oClass->getDancePace()];				
				$rDatabaseHandler->add($sQuery,$rConnection,$aArrayParam);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
			    			alert('Cadastro Feito Com Sucesso !!!');
							window.location.href = '/sapd/login/pageaddclass';
					 </script>";
			}
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Cadastrar: ".$e->getMessage();
			}
		}
		
		public static function updateClass($oClass)
		{
			try
			{   
				$iEdit = new Sessao();
				$iId = $iEdit->getSessao("editClass"); 
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "UPDATE Turma SET 
									   Lugar_idLugar = ?,
									   nomeTurma = ?,
									   obsTurma = ?
							WHERE idTurma = ? ";
				$aArrayParam = [$oClass->getIdLocal(),$oClass->getClassName(),$oClass->getDancePace()];
				$aArrayCondicao = [$iId];
				$rDatabaseHandler->update($sQuery,$rConnection,$aArrayParam,$aArrayCondicao);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Turma Alterada Com Sucesso !!!');
						window.location.href = '/sapd/login/pagevisualizeclass';
					</script>";		
			}	
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Atualizar: ".$e->getMessage();
			}	
		}
		
		public static function removeClass($iIdClass)
		{
		
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$rDatabaseHandler->begin($rConnection);
			$sQuery = "DELETE FROM Turma WHERE idTurma = ? ";
			$aArrayParam = [$iIdClass];
			$lDeleted = $rDatabaseHandler->deleteDate($sQuery,$rConnection,$aArrayParam);
			if($lDeleted)
			{
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Turma Deletada Com Sucesso !!!');
						window.location.href = '/sapd/login/pagevisualizeclass';
					</script>";
			}
		}
		
		public static function allStudentsClassUser()
		{		
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Turma t, Usuario u WHERE u.idUsuario = ? order by t.idTurma ";
			$aArrayParam = [User::returnUserId()];
			$aAllStudentsClassUser = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,true);
			return $aAllStudentsClassUser;		
		}
		
		public static function findClass($iIdClass)
		{
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Turma WHERE idTurma = ?  ";
			$aArrayParam = [$iIdClass];
			$aClass = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
			return $aClass;		
		}
		
		public static function findEditClass()
		{
			$iEdit = new Sessao();
			$iId = $iEdit->getSessao("editClass");
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Turma WHERE idTurma = ?  ";
			$aArrayParam = [$iId];
			$aClass = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
			return $aClass;		
		}
		
		
		/*public static function findUserName($sUserName)
		{
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Usuario WHERE nomeUsuario = ?  ";
			$aArrayParam = [$sUserName];
			$aManager = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
			return $aManager;		
		}
		
		public static function addLinkProject()
		{
			try
			{
				$iIdLinkProject = new Sessao();
				$iIdLinkUser = new Sessao();
				$iIdLinkUser = $iIdLinkUser->getSessao("linkUser"); 
				$iIdLinkProject = $iIdLinkProject->getSessao("linkProject"); 
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "INSERT INTO linkarProjeto(Usuario_idUsuario,Projeto_idProjeto) 
						VALUES (?,?) ";
						
				$aArrayParam = [$iIdLinkUser,$iIdLinkProject];
				$rDatabaseHandler->add($sQuery,$rConnection,$aArrayParam);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
							alert('Usuario Linkado ao Projeto Com Sucesso !!!');
							window.location.href = '/ser/login/pagelinkproject';
					  </script>";
			}
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Cadastrar: ".$e->getMessage();
			}
		}
		
		public static function findLinkProject($iIdUser)
		{
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM linkarProjeto WHERE Usuario_idUsuario = ?  ";
			$aArrayParam = [$iIdUser];
			$aUser = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
			return $aUser;		
		}
		
		public static function removeLinkUser($iIdUser)
		{
			try
			{
				$iId = new Sessao();
				$iIdProject = $iId->getSessao("linkProject");
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "DELETE FROM linkarProjeto 
							WHERE Usuario_idUsuario = ? and Projeto_idProjeto = ? ";
						
				$aArrayParam = [$iIdUser,$iIdProject];
				$rDatabaseHandler->deleteDate($sQuery,$rConnection,$aArrayParam);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
			    			alert('Usuario Desvinculado Com Sucesso !!!');
							window.location.href = '/ser/login/pageremovelinkproject';
					 </script>";
			}
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Cadastrar: ".$e->getMessage();
			}
		}
		
		
		
		public static function updateUser($oUser)
		{
			$iId =  $iIdUser->getSessao("iIdUser"); 
			$aManager = Project::findManager($iId);
			if(empty($aManager))
			{
				try
				{
					$iEdit = new Sessao();
					$iIdUser = $iEdit->getSessao("editUser"); 
					$aJson = CommonFunctions::readJSON("database/.config.json");
					$rDatabaseHandler = new SapdDatabaseHandler($aJson);
					$rConnection = $rDatabaseHandler->getInstance();
					$rDatabaseHandler->begin($rConnection);
					$sQuery = "UPDATE Usuario SET 
											cpfUsuario  = ?,
											nomeUsuario = ?,
											senhaUsuario = ?,
											tipoUsuario = ?,
											dataInclusaoUsuario = ?,
											emailUsuario = ?
									WHERE idUsuario = ? ";				
					$aArrayParam = [$oUser->getCpf(),$oUser->getUserName(),
									md5($oUser->getPassword()),$oUser->getUserType(),
									$oUser->getDateInclusion(),$oUser->getEmail()];
					$aArrayCondicao = [$iIdUser];
					$rDatabaseHandler->update($sQuery,$rConnection,$aArrayParam,$aArrayCondicao);
					$rDatabaseHandler->commit($rConnection);	
					echo "<script> 
								alert('Atualizacao Feita Com Sucesso !!!');
								window.location.href = '/ser/login/pagevisualizeuser';
						</script>";
				}
				catch(PDOException $e)
				{
					$rDatabaseHandler->roolBack($rConnection);
					echo "Erro ao Cadastrar: ".$e->getMessage();
				}
			}
			else
			{
				echo "<script> 
								alert('Usuario Está Vinculado Como Gerente a um Projeto. Nao Foi Possivel a Atualizacao !!!');
								window.location.href = '/ser/login/pagevisualizeuser';
						</script>";
			}
		}
		
		public static function viewAllManager()
		{
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Usuario WHERE tipoUsuario = ? order by idUsuario ";
			$aArrayParam = ["gerente"];
			$aAllManager = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,true);
			return $aAllManager;
		}
		
		public static function removeUser($iIdUser)
		{
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "DELETE FROM Usuario WHERE idUsuario = ? ";
				$aArrayParam = [$iIdUser];
				$rDatabaseHandler->deleteDate($sQuery,$rConnection,$aArrayParam);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
					alert('Usuario Deletado Com Sucesso !!!');
					window.location.href = '/ser/login/pagevisualizeuser';
			     </script>";
		
			}
			catch(PDOException $e)
			{
				echo "Erro ao Deletar: ".$e->getMessage();
			}
		}

		public static function findUser($iIdUser)
		{
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Usuario WHERE idUsuario = ?  ";
			$aArrayParam = [$iIdUser];
			$aUser = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
			return $aUser;		
		}
	
		public static function findEditUser()
		{
			try
			{
				$iEdit = new Sessao();
				$iId = $iEdit->getSessao("editUser");
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$sQuery = "SELECT * FROM Usuario WHERE idUsuario = ? ";
				$aArrayParam = [$iId];
				$aUserEdit = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
				if (empty($aUserEdit))
				{
					echo "<script> 
							alert('Usuario Nao Encontrado !!!');
							window.location.href = '/ser/login/pagevisualizeproject';
					</script>";			
				}
				return $aUserEdit;
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}	
	
		public static function findEditManager()
		{
			try
			{
				$iEdit = new Sessao();
				$iId = $iEdit->getSessao("editManager");
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$sQuery = "SELECT * FROM Usuario WHERE idUsuario = ? ";
				$aArrayParam = [$iId];
				$aUserEdit = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
				if (empty($aUserEdit))
				{
					echo "<script> 
							alert('Usuario Nao Encontrado !!!');
							window.location.href = '/ser/login/pagevisualizeproject';
					</script>";
				
				}
				return $aUserEdit;	
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}	
		
		public static function allUser()
		{		
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Usuario order by idUsuario ";
			$aAllUser = $rDatabaseHandler->query($sQuery,$rConnection,null,true);
			return $aAllUser;		
		}
	
		public static function allUserNotManager()
		{		
			$iIdProject = new Sessao();
			$iId = $iIdProject->getSessao("linkProject");
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "select * from usuario u
							WHERE u.idUsuario not in ( select Usuario_idUsuario
															from linkarprojeto l
                                WHERE l.Projeto_idprojeto = ? ) and u.tipoUsuario <> 'gerente' ";
			$aArrayParam = [$iId];
			$aAllUser = $rDatabaseHandler->query($sQuery,$rConnection,null,true);
			return $aAllUser;		
		}

		public static function rememberPassword($sEmail)
		{
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$sQuery = "SELECT * FROM Usuario WHERE emailUsuario = ?  ";
				$aArrayParam = [$sEmail];
				$aUser = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
				if(!empty($aUser))
				{
					
				}
				else
				{
					echo "<script> 
							alert('Email Nao Encontrado !!!');
							window.location.href = '/ser/login/pagerememberpassword';
					</script>";
				}
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}*/
	}