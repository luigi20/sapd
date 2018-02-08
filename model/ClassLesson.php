<?php
	
	class ClassLesson extends Lesson
	{
		private $iIdClassLesson;
		private $iIdClass;
		private $iIdLocal;
		
		function __construct($iIdClass,$iIdLocal,$sLessonDate,$sStartTimeLesson,$sFinalTimeLesson,$sLessonDescription)
		{
			parent::__construct($sLessonDate,$sStartTimeLesson,$sFinalTimeLesson,$sLessonDescription);
			$this->iIdClass	= $iIdClass;
			$this->iIdLocal	= $iIdLocal;
		}
		
		public function getIdClassLesson()
		{
			return $this->iIdClassLesson;
		}
		
		public function getIdLocal()
		{
			return $this->iIdLocal;
		}
		
		public function getIdClass()
		{
			return $this->iIdClass;
		}
		
		public function setIdClass($iIdClass)
		{
			$this->iIdClass = $iIdClass;
		}
		
		public function setIdLocal($iIdLocal)
		{
			$this->iIdLocal = $iIdLocal;
		}
		
		public static function researchClassLessonExist($oAddClassLesson)
		{
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$sQuery = "SELECT * FROM Aula_Comum WHERE dataAulaComum = ? AND horarioInicioAulaComum = ? ";
				$aArrayParam = [$oAddClassLesson->getLessonDate(),$oAddClassLesson->getStartTimeLesson()];
				$aExistClassLesson = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,true);
				if (!empty($aExistClassLesson))
				{
					echo "<script> 
									alert('Aula da Turma Ja Foi Cadastrada !!!');
									window.location.href = '/sapd/login/pageaddclasslesson';
						 </script>";
				}
			}
			catch(PDOException $e)
			{
				echo "Erro: ".$e->getMessage();
			}
		}
		
		public static function addClassLesson($oAddClassLesson)
		{
			self::researchClassLessonExist($oAddClassLesson);
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "INSERT INTO Aula_Comum(Turma_idTurma,Usuario_idUsuario,Lugar_idLugar,
												  dataAulaComum,horarioInicioAulaComum,horarioTerminoAulaComum,descricaoAulaComum) 
							VALUES (?,?,?,?,?,?,?) ";
				$oAddClassLesson->setIdUser(User::returnUserId());
				$aArrayParam = [$oAddClassLesson->getIdClass(),$oAddClassLesson->getIdUser(),$oAddClassLesson->getIdLocal(),
								$oAddClassLesson->getLessonDate(),$oAddClassLesson->getStartTimeLesson(),
								$oAddClassLesson->getFinalTimeLesson(),$oAddClassLesson->getLessonDescription()];
				$rDatabaseHandler->add($sQuery,$rConnection,$aArrayParam);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
							alert('Cadastro Feito Com Sucesso !!!');
							window.location.href = '/sapd/login/pagevisualizeclasslesson';
					  </script>";
			}
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Cadastrar: ".$e->getMessage();
			}
		}
		
		public static function updateClassLesson($oClassLesson)
		{
			try
			{   
				$iEdit = new Sessao();
				$iId = $iEdit->getSessao("editClassLesson"); 
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "UPDATE Aula_Comum SET 
										Turma_idTurma = ?,
										Lugar_idLugar = ?,
										dataAulaComum = ?, 
										horarioInicioAulaComum = ?,
										horarioTerminoAulaComum = ?, 
										descricaoAulaComum = ?  
							WHERE idAulaComum = ? ";
				$aArrayParam = [$oClassLesson->getIdClass(),$oClassLesson->getIdLocal(),$oClassLesson->getLessonDate(),
								$oClassLesson->getStartTimeLesson(),$oClassLesson->getFinalTimeLesson(),$oClassLesson->getLessonDescription()];
				$aArrayCondicao = [$iId];
				$rDatabaseHandler->update($sQuery,$rConnection,$aArrayParam,$aArrayCondicao);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Aula Comum Alterado Com Sucesso !!!');
						window.location.href = '/sapd/login/pagevisualizeclasslesson';
					</script>";		
			}	
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Atualizar: ".$e->getMessage();
			}	
		}
		
		public static function removeClassLesson($iIdClassLesson)
		{
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$rDatabaseHandler->begin($rConnection);
			$sQuery = "DELETE FROM Aula_Comum WHERE idAulaComum = ? ";
			$aArrayParam = [$iIdClassLesson];
			$lDeleted = $rDatabaseHandler->deleteDate($sQuery,$rConnection,$aArrayParam);
			if($lDeleted)
			{
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Aula Comum Deletada Com Sucesso !!!');
						window.location.href = '/sapd/login/pagevisualizeclasslesson';
					</script>";
			}
		}
		
		public static function allUserClassLesson()
		{
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Aula_Comum WHERE Usuario_idUsuario = ? order by idAulaComum desc ";
			$aArrayParam = [User::returnUserId()];
			$aAllUserClassLesson = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,true);
			return $aAllUserClassLesson;		
		}
		
		public static function findEditClassLesson()
		{
			$iEdit = new Sessao();
			$iId = $iEdit->getSessao("editClassLesson");
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Aula_Comum WHERE idAulaComum = ?  ";
			$aArrayParam = [$iId];
			$aLessonClass = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
			return $aLessonClass;		
		}
	}
	
	