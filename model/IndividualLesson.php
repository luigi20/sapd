<?php
	
	class IndividualLesson extends Lesson
	{
		private $iIdIndividualLesson;
		private $iIdStudent;
		private $sLessonType;
		
		function __construct($iIdStudent,$sLessonType,$sLessonDate,$sStartTimeLesson,$sFinalTimeLesson,$sLessonDescription)
		{
			parent::__construct($sLessonDate,$sStartTimeLesson,$sFinalTimeLesson,$sLessonDescription);
			$this->iIdStudent	= $iIdStudent;
			$this->sLessonType	= $sLessonType;
		}
		
		public function getIdIndividualLesson()
		{
			return $this->iIdIndividualLesson;
		}
		
		public function getIdStudent()
		{
			return $this->iIdStudent;
		}
		
		public function getLessonType()
		{
			return $this->sLessonType;
		}
		
		public function setIdStudent($iIdStudent)
		{
			$this->iIdStudent = $iIdStudent;
		}
		
		public function setLessonType($sLessonType)
		{
			$this->sLessonType = $sLessonType;
		}
		
		public static function researchIndividualLessonExist($oAddIndividualLesson)
		{
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$sQuery = "SELECT * FROM Aula_Individual WHERE dataAulaIndividual = ? AND horarioInicioAulaIndividual = ? ";
				$aArrayParam = [$oAddIndividualLesson->getLessonDate(),$oAddIndividualLesson->getStartTimeLesson()];
				$aExistIndividualLesson = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,true);
				if (!empty($aExistIndividualLesson))
				{
					echo "<script> 
								alert('Aula Individual Ja Foi Cadastrada !!!');
								window.location.href = '/sapd/login/pageaddindividuallesson';
						 </script>";
				}
			}
			catch(PDOException $e)
			{
				echo "Erro: ".$e->getMessage();
			}
		}
		
		public static function addIndividualLesson($oAddIndividualLesson)
		{
			self::researchIndividualLessonExist($oAddIndividualLesson);
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "INSERT INTO Aula_Individual( Aluno_idAluno,Usuario_idUsuario,
														dataAulaIndividual,horarioInicioAulaIndividual,
														horarioTerminoAulaIndividual,descricaoAulaIndividual,tipoAulaIndividual) 
							VALUES (?,?,?,?,?,?,?) ";
				$oAddIndividualLesson->setIdUser(User::returnUserId());
				$aArrayParam = [$oAddIndividualLesson->getIdStudent(),$oAddIndividualLesson->getIdUser(),
								$oAddIndividualLesson->getLessonDate(),$oAddIndividualLesson->getStartTimeLesson(),
								$oAddIndividualLesson->getFinalTimeLesson(),$oAddIndividualLesson->getLessonDescription(),
								$oAddIndividualLesson->getLessonType()];
				$rDatabaseHandler->add($sQuery,$rConnection,$aArrayParam);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
							alert('Cadastro Feito Com Sucesso !!!');
							window.location.href = '/sapd/login/pagevisualizeindividuallesson';
					  </script>";
			}
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Cadastrar: ".$e->getMessage();
			}
		}
		
		public static function updateIndividualLesson($oIndividualLesson)
		{
			try
			{   
				$iEdit = new Sessao();
				$iId = $iEdit->getSessao("editClassLesson"); 
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "UPDATE Aula_Individual SET 
										Aluno_idAluno = ?,
										tipoAulaIndividual = ?,
										dataAulaIndividual = ?, 
										horarioInicioAulaIndividual = ?,
										horarioTerminoAulaIndividual = ?, 
										descricaoAulaIndividual = ?  
							WHERE idAulaIndividual = ? ";
				$aArrayParam = [$oIndividualLesson->getIdStudent(),$oIndividualLesson->getLessonType(),$oIndividualLesson->getLessonDate(),
								$oIndividualLesson->getStartTimeLesson(),$oIndividualLesson->getFinalTimeLesson(),$oIndividualLesson->getLessonDescription()];
				$aArrayCondicao = [$iId];
				$rDatabaseHandler->update($sQuery,$rConnection,$aArrayParam,$aArrayCondicao);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Aula Individual Alterada Com Sucesso !!!');
						window.location.href = '/sapd/login/pagevisualizeindividuallesson';
					</script>";		
			}	
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Atualizar: ".$e->getMessage();
			}	
		}
		
		public static function removeIndividualLesson($iIdIndividualLesson)
		{
			
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$rDatabaseHandler->begin($rConnection);
			$sQuery = "DELETE FROM Aula_Individual WHERE idAulaIndividual = ? ";
			$aArrayParam = [$iIdIndividualLesson];
			$lDeleted = $rDatabaseHandler->deleteDate($sQuery,$rConnection,$aArrayParam);
			if($lDeleted)
			{
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Aula Individual Deletada Com Sucesso !!!');
						window.location.href = '/sapd/login/pagevisualizeindividuallesson';
					</script>";
			}
		}
		
		public static function allUserIndividualLesson()
		{	
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Aula_Individual WHERE Usuario_idUsuario = ? order by idAulaIndividual desc";
			$aArrayParam = [User::returnUserId()];
			$allUserIndividualLesson = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam ,true);	
			return $allUserIndividualLesson;	
		}
		
		public static function findEditIndividualLesson()
		{
			$iEdit = new Sessao();
			$iId = $iEdit->getSessao("editIndividualLesson");
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Aula_Individual WHERE idAulaIndividual = ?  ";
			$aArrayParam = [$iId];
			$aIndividualClass = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
			return $aIndividualClass;		
		}
	}
	
	