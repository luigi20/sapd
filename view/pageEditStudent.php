<?php
	$sUserName = new Sessao();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link href="../css/Principal.css" rel="stylesheet" type="text/css" />
    <link href="../css/StyleSheet.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="JS/Mascara.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/Mascara.js"></script>
</head>
<body>
    <form action="/sapd/student/updatestudent" method="post">
		<?php
			$aStudent = Student::findEditStudent();
			$aAllStudentsClass = StudentsClass::allStudentsClassUser();
		?>
     <div id="top-nav" class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar">
                    </span>
                </button>
                <p class="navbar-brand" >SAPD - Sistema De Apoio A Professores De Danca</p>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown"><a  role="button" 
                        ><i class="glyphicon glyphicon-user"></i><?php echo $sUserName->getSessao("sUserName");?>
                    </a>
                        <ul id="g-account-menu" class="dropdown-menu" role="menu">
                            <li><a href="#">My Profile</a></li>
                        </ul>
                    </li>
                    <li><a href="/sapd/login/deslogar">Logout</a></li>
                </ul>
            </div>
        </div>
        <!-- /container -->
    </div>
    <!-- /Header -->
    <!-- Main -->
     <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                <!-- Left column -->
                <hr />
                <ul class="list-unstyled">
                    <li class="nav-header">
                        <h5>
                            Cadastros 
                        </h5>
                    
                        <ul class="list-unstyled collapse in" id="userMenu">
						    <li class="active"><a href="/sapd/login/pagedefault"><i class="glyphicon glyphicon-home"></i> Home</a></li>
                            <li class="active"><a href="/sapd/login/pageaddstudent"><i class="glyphicon glyphicon-user"></i> Aluno</a></li>
							<li><a href="/sapd/login/pageaddclasslesson"><i class="glyphicon glyphicon-education"></i> Aula da Turma</a></li>
							<li><a href="/sapd/login/pageaddindividuallesson"><i class="glyphicon glyphicon-education"></i> Aula Individual</a></li>
							<li><a href="/sapd/login/pageaddevent"><i class="glyphicon glyphicon-music"></i> Evento</a></li>
							<li><a href="/sapd/login/pageaddticket"><i class="glyphicon glyphicon-file"></i> Ingresso</a></li>
							<li><a href="/sapd/login/pageaddlocal"><i class="glyphicon glyphicon-road"></i> Lugar</a></li>
							<li><a href="/sapd/login/pageaddpayment"><i class="glyphicon glyphicon-shopping-cart"></i> Pagamento</a></li>
                            <li><a href="/sapd/login/pageaddclass"><i class="glyphicon glyphicon-list-alt"></i> Turma</a></li>	
                        </ul>
                    </li>
                    <hr />
                    
                    <hr />
                    <li class="nav-header">
                        <h5>
                            Gerenciar <i class="glyphicon glyphicon-chevron-down"></i>
                        </h5>
                    
                        <ul class="list-unstyled collapse in" id="Ul1">

                            <li class="active"><a href="/sapd/login/pagevisualizestudent"><i class="glyphicon glyphicon-user"></i> Aluno</a></li>
							<li><a href="/sapd/login/pagevisualizeclasslesson"><i class="glyphicon glyphicon-education"></i> Aula da Turma</a></li>
							<li><a href="/sapd/login/pagevisualizeindividuallesson"><i class="glyphicon glyphicon-education"></i> Aula Individual</a></li>
							<li><a href="/sapd/login/pagevisualizeevent"><i class="glyphicon glyphicon-music"></i> Evento</a></li>
							<li><a href="/sapd/login/pagevisualizeticketevent"><i class="glyphicon glyphicon-file"></i> Ingresso</a></li>
							<li><a href="/sapd/login/pagevisualizelocal"><i class="glyphicon glyphicon-road"></i> Lugar</a></li>
							<li><a href="/sapd/login/pagevisualizepayment"><i class="glyphicon glyphicon-shopping-cart"></i> Pagamento</a></li>
                            <li><a href="/sapd/login/pagevisualizeclass"><i class="glyphicon glyphicon-list-alt"></i> Turma</a></li>
							
                        </ul>
                    </li>
					
					<hr />
                    
                    <hr />
					  <li class="nav-header">
                        <h5>
                            Relatorios <i class="glyphicon glyphicon-chevron-down"></i>
                        </h5>
                    
                        <ul class="list-unstyled collapse in" id="Ul1">
                           
                            <li class="active"><a href=""><i class="glyphicon glyphicon-folder-open"></i> Aluno</a></li>
                            <li><a href=""><i class="glyphicon glyphicon-file"></i> Turma</a></li>
							<li><a href=""><i class="glyphicon glyphicon-file"></i> Pagamento</a></li>
							<li><a href=""><i class="glyphicon glyphicon-file"></i> Aula da Turma</a></li>
							<li><a href=""><i class="glyphicon glyphicon-file"></i> Aula Individual</a></li>
							<li><a href=""><i class="glyphicon glyphicon-file"></i> Evento</a></li>
							<li><a href=""><i class="glyphicon glyphicon-file"></i> Lugar</a></li>
                        </ul>
                    </li>
				</ul>
            </div>
            <!-- /col-3 -->
            <div class="col-sm-9">
                <!-- column 2 -->
                <ul class="list-inline pull-right">
                    <li><a href="#"><i class="glyphicon glyphicon-cog"></i></a></li>
                </ul>
                <a href="#"><strong><i class="glyphicon glyphicon-dashboard"></i>Aluno</strong></a>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <i class="glyphicon glyphicon-wrench pull-right"></i>
                                    <h4 id="head_pagina">
                                        Editar Aluno</h4>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="control-group col-md-6">
                                    <label>
                                        Nome</label>
                                    <div class="controls">
										<input type="text" name ="sStudentName" autocomplete = "off" required class="form-control"  value= "<?=$aStudent['nomeAluno']?>"/>
                                    </div>
                                </div>
								
								 <div class="control-group col-md-6">
                                    <label>
                                        Turma</label>
                                    <div class="controls">
                                        <select name = "iClassId" autocomplete = "off" class="form-control">
											<?php
												foreach($aAllStudentsClass as $aStudentsClass)
												{
											?>		
											 <option <?php echo $aStudent['Turma_idTurma'] == $aStudentsClass['idTurma']? 'selected':''; ?> value= '<?=  $aStudentsClass['idTurma'] ?>'><?=  $aStudentsClass['nomeTurma'] ?></option>
											<?php
												}
											?>

										</select>
                                        <br />
                                    </div>
                                </div>
								
								 <div class="control-group col-md-7">
                                    <label>
                                        Endereco</label>
                                    <div class="controls">
										<input type="text" name ="sStudentAddress" autocomplete = "off" required class="form-control" value= "<?=$aStudent['enderecoAluno']?>"/>
                                    </div>
                                </div>
								
								 <div class="control-group col-md-4">
                                    <label>
                                        Data de Nascimento</label>
                                    <div class="controls">
                                        <input type="text" name ="sStudentDateBirth" autocomplete = "off" class="form-control" value= "<?=$aStudent['dataNascAluno']?>" maxlength= "10" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$"  id= "dataNasc" onKeyUp="formataData(dataNasc,event)" required/>
                                        <br />
                                    </div>
                                </div>
								
								 <div class="control-group col-md-4">
                                    <label>
                                        Email</label>
                                    <div class="controls">
                                        <input type="email" name ="sStudentEmail" autocomplete = "off" class="form-control" value= "<?=$aStudent['emailAluno']?>" id= "studentEmail"  required/>
                                        <br />
                                    </div>
                                </div>
								
								 <div class="control-group col-md-4">
                                    <label>
                                        Celular</label>
                                    <div class="controls">
                                        <input type="text" name ="sStudentCell" autocomplete = "off" class="form-control" maxlength="14" id= "celular" value= "<?=$aStudent['celularAluno']?>" onKeyUp="formataTelefone(celular,event)" required/>
                                        <br />
                                    </div>
                                </div>
								
								 <div class="control-group col-md-4">
                                    <label>
                                        Dia de Vencimento(OPCIONAL) </label>
                                    <div class="controls">
                                        <input type="number" name ="sStudentDayMaturity" autocomplete = "off" class="form-control" value= "<?=$aStudent['diaVencimentoAluno']?>"   id= "dataVencimento" min="1" max="31" maxlength="2" />
                                        <br />
                                    </div>
                                </div>
                              <div class="control-group col-md-6">
                                    <label>
                                        Tipo do Aluno</label>
                                    <div class="controls">
                                        <select name = "sStudentType"  class="form-control">
											<option value="Pagante" <?php echo $aStudent["tipoAluno"]=='Pagante'?'selected':'';?>>Pagante</option>
											<option value="Bolsista" <?php echo $aStudent["tipoAluno"]=='Bolsista'?'selected':'';?>>Bolsista</option>									
										</select>
                                        <br />
                                    </div>
                                </div>
								
								<div class="control-group col-md-6">
                                    <label>
                                        Nivel do Aluno</label>
                                    <div class="controls">
                                        <select name = "sLevelStudent"  class="form-control">
											<option value="Iniciante" <?php echo $aStudent["nivelAluno"]=='Iniciante'?'selected':'';?>>Iniciante</option>
											<option value="Iniciado" <?php echo $aStudent["nivelAluno"]=='Iniciado'?'selected':'';?>>Iniciado</option>
											<option value="Intermediario" <?php echo $aStudent["nivelAluno"]=='Intermediario'?'selected':'';?>>Intermediario</option>
											<option value="Avancado" <?php echo $aStudent["nivelAluno"]=='Avancado'?'selected':'';?>>Avancado</option>								
										</select>
                                        <br />
                                    </div>
                                </div>
                                
								</br>
								<div class="control-group col-md-3">
                                    <label>
                                        Motivo Para Fazer Danca de Salao</label>
                                    <div class="controls">
                                       <select name = "sStudentMotivation"  class="form-control">
											<option value="Saude" <?php echo $aStudent["motivoAluno"]=='Saude'?'selected':'';?>>Saude</option>
											<option value="Lazer" <?php echo $aStudent["motivoAluno"]=='Lazer'?'selected':'';?>>Lazer</option>
											<option value="Faz Parte Do Meu Trabalho" <?php echo $aStudent["motivoAluno"]=='Faz Parte Do Meu Trabalho'?'selected':'';?>>Faz Parte do meu Trabalho</option>
											<option value="Outros" <?php echo $aStudent["motivoAluno"]=='Outros'?'selected':'';?>>Outros</option>								
										</select>
                                        <br />
                                    </div>
                                </div>
							
								<div class="controls">
                                        <div class="control-group col-md-12">
                                   
											<div class="controls">
												<input type="submit" name = "btnAdd" class="btn btn-primary" value="Editar"/>
									
										</div>
                                    </div>
                                </div>
								</div>
                            </div>
                            <br />
                            <br />
                    
							
                            </div>
                            <!--/panel content-->
                        </div>
                        <!--/panel-->
                    </div>
                    <!--/col-span-12-->
                </div>
                <!--/row-->
                <hr />
            </div>
            <!--/col-span-9-->
        </div>
    </div>

    <!-- /Main -->
    <footer class="text-center">Desenvolvido Por <strong> Luis Antonio dos Santos Silva</strong>.</footer>
    <div class="modal" id="addWidgetModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        Ã—</button>
                    <h4 class="modal-title">
                        Add Widget</h4>
                </div>
                <div class="modal-body">
                    <p>
                        Add a widget stuff here..</p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a> <a href="#" class="btn btn-primary">
                        Save changes</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dalog -->
    </div>
    <!-- /.modal -->
    <!-- script references -->
    </form>

</body>
</html>