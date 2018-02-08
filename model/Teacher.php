<?php
	
	class Teacher extends User
	{
		function __construct($sUserName,$iUserCellPhone,$sUserAddress,$sUserEmail,$sUserPassword,$sUserType)
		{
			parent::__construct($sUserName,$iUserCellPhone,$sUserAddress,$sUserEmail,$sUserPassword,$sUserType);
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