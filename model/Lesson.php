<?php
	
	abstract class Lesson
	{
		private $iIdUser;
		private $sLessonDate;
		private $sStartTimeLesson;
		private $sFinalTimeLesson;
		private $sLessonDescription;
		
		function __construct($sLessonDate,$sStartTimeLesson,$sFinalTimeLesson,$sLessonDescription)
		{
			$this->sLessonDate 			= $sLessonDate;
			$this->sStartTimeLesson 	= $sStartTimeLesson;
			$this->sFinalTimeLesson		= $sFinalTimeLesson;
			$this->sLessonDescription 	= $sLessonDescription;
		}
		
		public function getIdUser()
		{
			return $this->iIdUser;
		}
		
		public function getLessonDate()
		{
			return $this->sLessonDate;
		}
	
		public function getStartTimeLesson()
		{
			return $this->sStartTimeLesson;
		}
		
		public function getFinalTimeLesson()
		{
			return $this->sFinalTimeLesson;
		}
		
		public function getLessonDescription()
		{
			return $this->sLessonDescription;
		}
	
		public function setIdUser($iIdUser)
		{
			$this->iIdUser = $iIdUser;
		}
		
		public function setLessonDate($sLessonDate)
		{
			$this->sLessonDate = $sLessonDate;
		}

		public function setStartTimeLesson($sStartTimeLesson)
		{
			$this->sStartTimeLesson = $sStartTimeLesson;
		}
		
		public function setFinalTimeLesson($sFinalTimeLesson)
		{
			$this->sFinalTimeLesson = $sFinalTimeLesson;
		}

		public function setLessonDescription($sLessonDescription)
		{
			$this->sLessonDescription = $sLessonDescription;
		}
		
	/*	public static function allTask()
		{
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT * FROM Tarefa order by nomeTarefa ";
			$aAllTarefa = $rDatabaseHandler->query($sQuery,$rConnection,null,true);	
			return $aAllTarefa;
		}
		
		public static function allTaskDepEdit()
		{
			$iEdit = new Sessao();
			$iId = $iEdit->getSessao("editTask"); 
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT nomeTarefa,idTarefa FROM Tarefa  WHERE idTarefa <> ? order by nomeTarefa   ";
			$aArrayParam = [$iId];
			$aAllTarefa = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,true);	
			return $aAllTarefa;
		}
		
		public static function depTask($iIdDepTask)
		{
			$aJson = CommonFunctions::readJSON("database/.config.json");
			$rDatabaseHandler = new SapdDatabaseHandler($aJson);
			$rConnection = $rDatabaseHandler->getInstance();
			$sQuery = "SELECT nomeTarefa FROM Tarefa WHERE idTarefa = ?";
			$aArrayParam = [$iIdDepTask];
			$sNameTask = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
			return $sNameTask;
		}
		
		public static function researchTaskExist($oAddTask)
		{
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$sQuery = "SELECT * FROM Tarefa WHERE nomeTarefa = ? ";
				$aArrayParam = [$oAddTask->getTaskName()];
				$aExistTask = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,true);
				if (!empty($aExistTask))
				{
					echo "<script> 
									alert('Tarefa Ja Foi Cadastrada !!!');
									window.location.href = 'pageaddtask';
						 </script>";
					throw new Exception();
				}
			}
			catch(PDOException $e)
			{
				echo "Erro: ".$e->getMessage();
			}
		}
		
		public static function addTask($oTask)
		{
			self::researchTaskExist($oTask);
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "INSERT INTO tarefa(Projeto_idProjeto,Usuario_idUsuario,nomeTarefa,dataInicioTarefa,
											  dataTerminoTarefa,obsTarefa,Tarefa_idTarefa) 
										VALUES (?,?,?,?,?,?,?) ";
						
				if(!empty($oTask->getTaskPend()))
				{
					$aArrayParam = [$oTask->getTaskProjectId(),$oTask->getTaskUserId(),
									$oTask->getTaskName(),$oTask->getTaskStartDate(),
									$oTask->getTaskFinishDate(),$oTask->getTaskObs(),$oTask->getTaskPend()];
				}
				else
				{
					$aArrayParam = [$oTask->getTaskProjectId(),$oTask->getTaskUserId(),
									$oTask->getTaskName(),$oTask->getTaskStartDate(),
									$oTask->getTaskFinishDate(),$oTask->getTaskObs(),null];
				}
				$rDatabaseHandler->add($sQuery,$rConnection,$aArrayParam);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
							alert('Cadastro Feito Com Sucesso !!!');
							window.location.href = '/ser/login/pagedefaultmanager';
					  </script>";
			}
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Cadastrar: ".$e->getMessage();
			}
		}
		
		public static function findEditTask()
		{
			try
			{
				$iEdit = new Sessao();
				$iId = $iEdit->getSessao("editTask");
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$sQuery = "SELECT * FROM Tarefa WHERE idTarefa = ? ";
				$aArrayParam = [$iId];
				$aTaskEdit = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
				if (empty($aTaskEdit))
				{
					echo "<script> 
							alert('Tarefa Não Encontrada !!!');
							window.location.href = '/ser/login/pagevisualizetask';
					  </script>";
				
				}
				return $aTaskEdit;
			
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}
		
		public static function findTask($iIdTask)
		{
			try
			{
				$iEdit = new Sessao();
				$iId = $iEdit->getSessao("editTask");
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$sQuery = "SELECT * FROM Tarefa WHERE idTarefa = ? ";
				$aArrayParam = [$iIdTask];
				$aTask = $rDatabaseHandler->query($sQuery,$rConnection,$aArrayParam,false);
				if (empty($aTask))
				{
					echo "<script> 
							alert('Tarefa Não Encontrada !!!');
							window.location.href = '/ser/login/pagevisualizetask';
					  </script>";
				
				}
				return $aTask;
			
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}
		
		public static function updateTask($oTask)
		{
			try
			{   
				$iEdit = new Sessao();
				$iId = $iEdit->getSessao("editTask"); 
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "UPDATE Tarefa SET 
										   Projeto_idProjeto = ?,
						       			   Usuario_idUsuario =?,
						       			   nomeTarefa = ?,
										   dataInicioTarefa = ?,
										   dataTerminoTarefa = ?,
										   obsTarefa = ?,
										   Tarefa_idTarefa = ?
								where idTarefa = ? ";
				if(!empty($oTask->getTaskPend()))
				{
					$aArrayParam = [$oTask->getTaskProjectId(),$oTask->getTaskUserId(),
									$oTask->getTaskName(),$oTask->getTaskStartDate(),
									$oTask->getTaskFinishDate(),$oTask->getTaskObs(),$oTask->getTaskPend()];
				}
				else
				{
					$aArrayParam = [$oTask->getTaskProjectId(),$oTask->getTaskUserId(),
									$oTask->getTaskName(),$oTask->getTaskStartDate(),
									$oTask->getTaskFinishDate(),$oTask->getTaskObs(),null];
				}
							
				$aArrayCondicao = [$iId];
				$rDatabaseHandler->update($sQuery,$rConnection,$aArrayParam,$aArrayCondicao);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Tarefa Alterada Com Sucesso !!!');
						window.location.href = '/ser/login/pagevisualizetask';
					  </script>";		
			}	
			catch(PDOException $e)
			{
				$rDatabaseHandler->roolBack($rConnection);
				echo "Erro ao Atualizar: ".$e->getMessage();
			}
		}	
		
		public static function removeTask($iIdTask)
		{
			try
			{
				$aJson = CommonFunctions::readJSON("database/.config.json");
				$rDatabaseHandler = new SapdDatabaseHandler($aJson);
				$rConnection = $rDatabaseHandler->getInstance();
				$rDatabaseHandler->begin($rConnection);
				$sQuery = "DELETE FROM Tarefa WHERE idTarefa = ? ";
				$aArrayParam = [$iIdTask];
				$rDatabaseHandler->deleteDate($sQuery,$rConnection,$aArrayParam);
				$rDatabaseHandler->commit($rConnection);
				$rConnection = $rDatabaseHandler->close($rConnection);
				echo "<script> 
						alert('Tarefa Deletada Com Sucesso !!!');
						window.location.href = '/ser/login/pagevisualizetask';
					  </script>";
		
			}
			catch(PDOException $e)
			{
				echo "Erro ao Deletar: ".$e->getMessage();
			}
		}*/	
	}