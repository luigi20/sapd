<?php
class Student
{
	private $iIdStudent;
	private $iIdUser;
	private $iIdStudentClass;
	private $sStudentName;
	private $sStudentCell;
	private $sStudentAddress;
	private $sStudentLevel;
	private $sStudentEmail;
	private $sStudentMotivation;
	private $sStudentDateBirth;
	private $sStudentDayMaturity;
	private $sStudentType;
	
	function __construct($iIdStudentClass,$sStudentName,$sStudentCell,$sStudentAddress,$sStudentLevel,
						$sStudentEmail,$sStudentMotivation,$sStudentDateBirth,$sStudentDayMaturity = null,$sStudentType)
	{
		$this->iIdStudentClass 		 = $iIdStudentClass;
		$this->sStudentName 		 = $sStudentName;
		$this->sStudentCell			 = $sStudentCell;
		$this->sStudentAddress		 = $sStudentAddress;
		$this->sStudentLevel 		 = $sStudentLevel;
		$this->sStudentEmail 		 = $sStudentEmail;
		$this->sStudentMotivation 	 = $sStudentMotivation;
		$this->sStudentDateBirth 	 = $sStudentDateBirth;
		$this->sStudentDayMaturity   = $sStudentDayMaturity;
		$this->sStudentType 		 = $sStudentType;
	}
	
	public function getIdStudent()
	{
		return $this->iIdStudent;
	}
	
	public function getIdUser()
	{
		return $this->iIdUser;
	}
	
	public function getIdStudentClass()
	{
		return $this->iIdStudentClass;
	}
	
	public function getStudentName()
	{
		return $this->sStudentName;
	}
	
	public function getStudentCell()
	{
		return $this->sStudentCell;
	}
		
	public function getStudentAddress()
	{
		return $this->sStudentAddress;
	}
		
	public function getStudentLevel()
	{
		return $this->sStudentLevel;
	}
	
	public function getStudentEmail()
	{
		return $this->sStudentEmail;
	}
	
	public function getStudentMotivation()
	{
		return $this->sStudentMotivation;
	}
	
	public function getStudentDateBirth()
	{
		return $this->sStudentDateBirth;
	}
	
	public function getStudentDayMaturity()
	{
		return $this->sStudentDayMaturity;
	}
	
	public function getStudentType()
	{
		return $this->sStudentType;
	}
	
	public function setIdStudentClass($iIdStudentClass)
	{
		$this->iIdStudentClass = $iIdStudentClass;
	}
	
	public function setIdUser($iIdUser)
	{
		$this->iIdUser = $iIdUser;
	}

	public function setStudentName($sStudentName)
	{
		$this->sStudentName = $sStudentName;
	}
		
	public function setStudentCell($sStudentCell)
	{
		$this->sStudentCell = $sStudentCell;
	}
	
	public function setStudentAddress($sStudentAddress)
	{
		$this->sStudentAddress = $sStudentAddress;
	} 
	
	public function setStudentLevel($sStudentLevel)
	{
		$this->sStudentLevel = $sStudentLevel;
	} 
	
	public function setStudentEmail($sStudentEmail)
	{
		$this->sStudentEmail = $sStudentEmail;
	} 
	
	public function setStudentMotivation($sStudentMotivation)
	{
		$this->sStudentMotivation = $sStudentMotivation;
	} 
	
	public function setStudentDateBirth($sStudentDateBirth)
	{
		$this->sStudentDateBirth = $sStudentDateBirth;
	} 
	
	public function setStudentDayMaturity($sStudentDayMaturity)
	{
		$this->sStudentDayMaturity = $sStudentDayMaturity;
	} 
	
	public function setStudentType($sStudentType)
	{
		$this->sStudentType = $sStudentType;
	} 
	
	public static function researchStudentExist($oAddStudent)
	{
		try
		{
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Aluno WHERE nomeAluno = ? ";
			$aArrayParam = [$oAddStudent->getStudentName()];
			$oAddStudent = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
			if (!empty($oAddStudent))
			{
				echo "<script> 
							alert('Projeto Ja Foi Cadastrado !!!');
							window.location.href = 'pageaddproject';
					 </script>";
			}
		}
		catch(PDOException $e)
		{
			echo "Erro: ".$e->getMessage();
		}
	}
	
	public static function addStudent($oStudent)
	{
		self::researchStudentExist($oStudent);
		try
		{
			if($oStudent->getStudentType() == "Bolsista" && (!empty($oStudent->getStudentDayMaturity())))
			{
				echo "<script> 
							alert('Estudante É Bolsista !!! Por Isso Campo Data de Vencimento Deve Permanecer Vazio !!! ');
							window.location.href = '/sapd/login/pageaddstudent';
					</script>";
			}
			else
			{
				if($oStudent->getStudentType() == "Pagante" && (empty($oStudent->getStudentDayMaturity())))
				{
					echo "<script> 
								alert('Estudante Não É Bolsista !!! Por Isso Campo Data de Vencimento Não Deve Permanecer Vazio !!! ');
								window.location.href = '/sapd/login/pageaddstudent';
						</script>";
				}
				else
				{
					$aJson = CommonFunctions::readJSON("database/.config.json");
					$rDatabaseHandler = new SapdDatabaseHandler($aJson);
					$rConnection = $rDatabaseHandler->getInstance();
					$rDatabaseHandler->begin($rConnection);
					$oStudent->setIdUser(User::returnUserId());	
					if(!empty($oStudent->getStudentDayMaturity))
					{
						$sQuery = "INSERT INTO Aluno(	
											Usuario_idUsuario ,
											Turma_idTurma,
											nomeAluno,
											celularAluno,
											enderecoAluno,
											nivelAluno,
											emailAluno,
											motivoAluno,
											dataNascAluno,
											diaVencimentoAluno,
											tipoAluno) 
						VALUES (?,?,?,?,?,?,?,?,?,?,?) ";
						$aArrayParam = [$oStudent->getIdUser(),$oStudent->getIdStudentClass(),
							$oStudent->getStudentName(),$oStudent->getStudentCell(),$oStudent->getStudentAddress(),
							$oStudent->getStudentLevel(),$oStudent->getStudentEmail(),$oStudent->getStudentMotivation(),
							$oStudent->getStudentDateBirth(),$oStudent->getStudentDayMaturity(),$oStudent->getStudentType()];
					}
					else
					{
						$sQuery = "INSERT INTO Aluno(	
											Usuario_idUsuario ,
											Turma_idTurma,
											nomeAluno,
											celularAluno,
											enderecoAluno,
											nivelAluno,
											emailAluno,
											motivoAluno,
											dataNascAluno,
											tipoAluno) 
						VALUES (?,?,?,?,?,?,?,?,?,?) ";
						$aArrayParam = [$oStudent->getIdUser(),$oStudent->getIdStudentClass(),
							$oStudent->getStudentName(),$oStudent->getStudentCell(),$oStudent->getStudentAddress(),
							$oStudent->getStudentLevel(),$oStudent->getStudentEmail(),$oStudent->getStudentMotivation(),
							$oStudent->getStudentDateBirth(),$oStudent->getStudentType()];
					}
					$rDatabaseHandler->add($sQuery,$rConnection,$aArrayParam);
					$rDatabaseHandler->commit($rConnection);
					$rConnection = $rDatabaseHandler->close($rConnection);
					echo "<script> 
								alert('Cadastro Feito Com Sucesso !!!');
								window.location.href = '/sapd/login/pagevisualizestudent';
					     </script>";
				}
			}
		}
		catch(PDOException $e)
		{
			$rDatabaseHandler->roolBack($rConnection);
			echo "Erro ao Cadastrar: ".$e->getMessage();
		}
	}
	
	public static function updateStudent($oStudent)
	{
		try
		{   
			$iEdit = new Sessao();
			$iId = $iEdit->getSessao("editStudent"); 
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$rDatabaseHandler->begin($rConnection);
			if(!empty($oStudent->getStudentDayMaturity))
			{
				$sQuery = "UPDATE Aluno SET 
								   Turma_idTurma = ?,
								   nomeAluno = ?,
								   celularAluno = ?,
								   enderecoAluno = ?,
								   nivelAluno = ?,
								   emailAluno = ?,
								   motivoAluno = ?,
								   dataNascAluno = ?,
								   diaVencimentoAluno = ?,
								   tipoAluno = ?
						WHERE idAluno = ? ";
				$aArrayParam = [$oStudent->getIdStudentClass(),$oStudent->getStudentName(),$oStudent->getStudentCell(),
							$oStudent->getStudentAddress(),$oStudent->getStudentLevel(),$oStudent->getStudentEmail(),
							$oStudent->getStudentMotivation(),$oStudent->getStudentDateBirth(),$oStudent->getStudentDayMaturity(),
							$oStudent->getStudentType()];
			}
			else
			{
				$sQuery = "UPDATE Aluno SET 
								   Turma_idTurma = ?,
								   nomeAluno = ?,
								   celularAluno = ?,
								   enderecoAluno = ?,
								   nivelAluno = ?,
								   emailAluno = ?,
								   motivoAluno = ?,
								   dataNascAluno = ?,
								   tipoAluno = ?
						WHERE idAluno = ? ";
				$aArrayParam = [$oStudent->getIdStudentClass(),$oStudent->getStudentName(),$oStudent->getStudentCell(),
							$oStudent->getStudentAddress(),$oStudent->getStudentLevel(),$oStudent->getStudentEmail(),
							$oStudent->getStudentMotivation(),$oStudent->getStudentDateBirth(),$oStudent->getStudentType()];
			}
			$aArrayCondicao = [$iId];
			$rDatabaseHandler->update($sQuery,$rConnection,$aArrayParam,$aArrayCondicao);
			$rDatabaseHandler->commit($rConnection);
			$rConnection = $rDatabaseHandler->close($rConnection);
			echo "<script> 
					alert('Aluno Alterada Com Sucesso !!!');
					window.location.href = '/sapd/login/pagevisualizestudent';
				</script>";		
		}	
		catch(PDOException $e)
		{
			$rDatabaseHandler->roolBack($rConnection);
			echo "Erro ao Atualizar: ".$e->getMessage();
		}	
	}

	public static function removeStudent($iIdStudent)
	{
	
		$aJson = CommonFunctions::readJSON("database/.config.json");
		$rDatabaseHandler = new SapdDatabaseHandler($aJson);
		$rConnection = $rDatabaseHandler->getInstance();
		$rDatabaseHandler->begin($rConnection);
		$sQuery = "DELETE FROM Aluno WHERE idAluno = ? ";
		$aArrayParam = [$iIdStudent];
	   	$lDeleted = $rDatabaseHandler->deleteDate($sQuery,$rConnection,$aArrayParam);
		if($lDeleted)
		{
			$rDatabaseHandler->commit($rConnection);
			$rConnection = $rDatabaseHandler->close($rConnection);
			echo "<script> 
						alert('Aluno Deletado Com Sucesso !!!');
						window.location.href = '/sapd/login/pagevisualizestudent';
					</script>";
		}
	}
	
	public static function findStudent($iIdStudent)
	{
		$aJson = CommonFunctions::readJSON("database/.config.json");
		$rDatabaseHandler = new SapdDatabaseHandler($aJson);
		$rConnection = $rDatabaseHandler->getInstance();
    	$sQuery = "SELECT * FROM Aluno WHERE idAluno = ?  ";
		$aArrayParam = [$iIdStudent];
		$aStudent = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
		return $aStudent;		
	}
	
	public static function allUserStudents()
	{
		$aJson = CommonFunctions::readJSON("database/.config.json");
		$rDatabaseHandler = new SapdDatabaseHandler($aJson);
		$rConnection = $rDatabaseHandler->getInstance();
		$sQuery = "SELECT * FROM Aluno WHERE Usuario_idUsuario = ? order by nomeAluno  ";
		$aArrayParam = [User::returnUserId()];
		$aAllStudent = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,true);	
		return $aAllStudent;
	}
	
	public static function allUserPaymentStudent()
	{	
		$aJson = CommonFunctions::readJSON("database/.config.json");
		$rDatabaseHandler = new SapdDatabaseHandler($aJson);
		$rConnection = $rDatabaseHandler->getInstance();
		$sQuery = "SELECT * FROM Aluno WHERE Usuario_idUsuario = ? AND tipoAluno = 'Pagante' ";
		$aArrayParam = [User::returnUserId()];
		$aAllStudent = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam ,true);	
		return $aAllStudent;	
	}
	
	public static function findEditStudent()
	{
		$iEdit = new Sessao();
		$iId = $iEdit->getSessao("editStudent");
		$aJson = CommonFunctions::readJSON("database/.config.json");
		$rDatabaseHandler = new SapdDatabaseHandler($aJson);
		$rConnection = $rDatabaseHandler->getInstance();
		$sQuery = "SELECT * FROM Aluno WHERE idAluno = ?  ";
		$aArrayParam = [$iId];
		$aStudent = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
		return $aStudent;		
	}
	
	
	
	/*public static function removeProject($iIdProject)
	{
		try
		{
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$rDatabaseHandler->begin($rConnection);
			$sQuery = "DELETE FROM Projeto WHERE idProjeto = ? ";
			$aArrayParam = [$iIdProject];
	    	$rDatabaseHandler->deleteDate($sQuery,$rConnection,$aArrayParam);
			$rDatabaseHandler->commit($rConnection);
			$rConnection = $rDatabaseHandler->close($rConnection);
			echo "<script> 
					alert('Projeto Deletado Com Sucesso !!!');
					window.location.href = '/ser/login/pagevisualizeproject';
			     </script>";
		}
		catch(PDOException $e)
		{
			echo "Erro ao Deletar: ".$e->getMessage();
		}
	}
	
	public static function allLinkProject()
	{
		$aJson = CommonFunctions::readJSON("database/.config.json");
		$rDatabaseHandler = new SapdDatabaseHandler($aJson);
		$rConnection = $rDatabaseHandler->getInstance();
    	$sQuery = "SELECT l.Usuario_idUsuario,
						  l.Projeto_idProjeto,
						  p.nomeProjeto
				    FROM linkarprojeto l,
						 usuario u,projeto p 
					WHERE l.Projeto_idProjeto = p.idProjeto AND 
						  l.Usuario_idUsuario = u.idUsuario order by u.idUsuario  ";
		$aProject = $rDatabaseHandler->query($sQuery,$rConnection,null,true);
		return $aProject;		
	}
	
	public static function findAllUserLinkProject($iIdUser)
	{
		$aJson = CommonFunctions::readJSON("database/.config.json");
		$rDatabaseHandler = new SapdDatabaseHandler($aJson);
		$rConnection = $rDatabaseHandler->getInstance();
    	$sQuery = "SELECT l.Usuario_idUsuario,
						  l.Projeto_idProjeto
				    FROM linkarprojeto l 
					WHERE l.Usuario_idUsuario = ? ";
		$aArrayParam = [$iIdUser];
		$aProject = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,true);
		return $aProject;		
	}
	
	public static function findUserLinkProject($iIdUser)
	{
		$aJson = CommonFunctions::readJSON("database/.config.json");
		$rDatabaseHandler = new SapdDatabaseHandler($aJson);
		$rConnection = $rDatabaseHandler->getInstance();
    	$sQuery = "SELECT l.Usuario_idUsuario,
						  l.Projeto_idProjeto
				    FROM linkarprojeto l 
					WHERE l.Usuario_idUsuario = ? ";
		$aArrayParam = [$iIdUser];
		$aProject = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
		return $aProject;		
	}

	
	
	public static function findEditProject()
	{
		$iEdit = new Sessao();
		$iId = $iEdit->getSessao("editProject");
		$aJson = CommonFunctions::readJSON("database/.config.json");
		$rDatabaseHandler = new SapdDatabaseHandler($aJson);
		$rConnection = $rDatabaseHandler->getInstance();
    	$sQuery = "SELECT * FROM Projeto where idProjeto = ?  ";
		$aArrayParam = [$iId];
		$aProject = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
		return $aProject;		
	}

	public static function updateProject($oProject)
	{
		try
		{   
			$iEdit = new Sessao();
			$iId = $iEdit->getSessao("editProject"); 
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$rDatabaseHandler->begin($rConnection);
			$sQuery = "UPDATE Projeto SET 
									   nomeProjeto = ?,
									   Usuario_idUsuario = ? ,
									   dataInicioProjeto = ?,
									   dataTerminoProjeto = ?,
									   visaoGeralProjeto = ?,
									   statusProjeto = ?,
									   questionarioProjeto = ?
							where idProjeto = ? ";
			$aArrayParam = [$oProject->getProjectName(),$oProject->getIdManager(),
							$oProject->getStartDate(),$oProject->getFinishDate(),$oProject->getProjectOverview(),
							$oProject->getStatusProject(),$oProject->getProjectQuestionnaire()];
			$aArrayCondicao = [$iId];
			$rDatabaseHandler->update($sQuery,$rConnection,$aArrayParam,$aArrayCondicao);
			$rDatabaseHandler->commit($rConnection);
			$rConnection = $rDatabaseHandler->close($rConnection);
			echo "<script> 
					alert('Projeto Alterado Com Sucesso !!!');
					window.location.href = '/ser/login/pagevisualizeproject';
				  </script>";		
		}	
		catch(PDOException $e)
		{
			$rDatabaseHandler->roolBack($rConnection);
			echo "Erro ao Atualizar: ".$e->getMessage();
		}
	}	
	
	public static function allUsersLinkProject()
	{
		$iIdProject = new Sessao();
		$iId = $iIdProject->getSessao("linkProject");
		$aJson = CommonFunctions::readJSON("database/.config.json");
		$rDatabaseHandler = new SapdDatabaseHandler($aJson);
		$rConnection = $rDatabaseHandler->getInstance();
		$sQuery = " select * from linkarProjeto l,
								  Usuario u 
						where u.idUsuario = l.Usuario_idUsuario and l.Projeto_idProjeto = ?";
		$aArrayParam = [$iId];
		$aUser = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,true);
		if (empty($aUser))
		{
			echo "<script> 
						alert('Não Há Usuarios Cadastrados !!!');
						window.location.href = '/ser/login/pageremovelinkproject';
				  </script>";	
		}
		return $aUser;
	}

	public static function findManager($iIdUser)
	{
		$aJson = CommonFunctions::readJSON("database/.config.json");
		$rDatabaseHandler = new SapdDatabaseHandler($aJson);
		$rConnection = $rDatabaseHandler->getInstance();
		$sQuery = "SELECT p.nomeProjeto,p.Usuario_idUsuario,u.nomeUsuario,p.idProjeto FROM Projeto p,Usuario u  WHERE p.Usuario_idUsuario = ?";
		$aArrayParam = [$iIdUser];
		$aUser = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
		return $aUser;
	}
	
	public static function findAllProjectManager($iIdUser)
	{
		$aJson = CommonFunctions::readJSON("database/.config.json");
		$rDatabaseHandler = new SapdDatabaseHandler($aJson);
		$rConnection = $rDatabaseHandler->getInstance();
		$sQuery = "SELECT p.nomeProjeto,
						p.Usuario_idUsuario,
						u.nomeUsuario,
						p.idProjeto
					FROM Projeto p,Usuario u
						WHERE u.idUsuario = p.Usuario_idUsuario
							and p.Usuario_idUsuario = ?";
		$aArrayParam = [$iIdUser];
		$aUser = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,true);
		return $aUser;
	}

	public static function findRequirements($iIdProject)
	{
		$aJson = CommonFunctions::readJSON("database/.config.json");
		$rDatabaseHandler = new SapdDatabaseHandler($aJson);
		$rConnection = $rDatabaseHandler->getInstance();
		$sQuery = "SELECT * FROM Requisito WHERE Projeto_idProjeto = ?";
		$aArrayParam = [$iIdProject];
		$aRequirement = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,true);
		return $aRequirement;
	}
	
	public static function findApprovedRequirements($iIdProject)
	{
		$aJson = CommonFunctions::readJSON("database/.config.json");
		$rDatabaseHandler = new SapdDatabaseHandler($aJson);
		$rConnection = $rDatabaseHandler->getInstance();
		$sQuery = "SELECT * FROM Requisito WHERE Projeto_idProjeto = ? AND situacao = 'Aprovado'";
		$aArrayParam = [$iIdProject];
		$aRequirement = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,true);
		return $aRequirement;
	}
		
	public static function researchManagerProject($iIdProject)
	{
		$aJson = CommonFunctions::readJSON("database/.config.json");
		$rDatabaseHandler = new SapdDatabaseHandler($aJson);
		$rConnection = $rDatabaseHandler->getInstance();
		$sQuery = "SELECT * FROM Projeto p WHERE p.idProjeto = ?";
		$aArrayParam = [$iIdProject];
		$aUser = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);				
		return $aUser;
	}*/
}


