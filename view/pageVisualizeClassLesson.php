<?php
	$sUserName = new Sessao();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link href="../css/Principal.css" rel="stylesheet" type="text/css" />
    <link href="../css/StyleSheet.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
</head>
<body>
    <form action="" method="post">
		<?php
			$aAllClassLesson = ClassLesson::allUserClassLesson();
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
							<li><a href=""><i class="glyphicon glyphicon-file"></i> Aula da Turma</a></li>
							<li><a href=""><i class="glyphicon glyphicon-file"></i> Aula Individual</a></li>
							<li><a href=""><i class="glyphicon glyphicon-file"></i> Evento</a></li>
							<li><a href=""><i class="glyphicon glyphicon-file"></i> Ingresso</a></li>
							<li><a href=""><i class="glyphicon glyphicon-file"></i> Lugar</a></li>
							<li><a href=""><i class="glyphicon glyphicon-file"></i> Pagamento</a></li>
                            <li><a href=""><i class="glyphicon glyphicon-file"></i> Turma</a></li>
                        </ul>
                    </li>
            </div>
			
			 <!-- /col-3 -->
            <div class="col-sm-9">
                <!-- column 2 -->
                <ul class="list-inline pull-right">
                    <li><a href="#"><i class="glyphicon glyphicon-cog"></i></a></li>
                </ul>
                
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <i class="glyphicon glyphicon-wrench pull-right"></i>
                                    <h4 id="head_pagina">
                                        GERENCIAR AULA COMUM</h4>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="control-group col-md-10" >
                                    <table border="1" class="table">

			<tr>
				<th colspan="10" align="center">AULA COMUM</th>
			</tr>


			<tr>
				<td  align="center">ID</td>
				<td  align="center">Turma</td>
				<td  align="center">Lugar</td>
				<td  align="center">Data</td>
				<td  align="center">Horario Inicial</td>
				<td  align="center">Horario Final </td>
				<td  align="center">Opcoes </td>
			</tr>

			<tr>
				<?php

				    if(!empty($aAllClassLesson))
				    {
						foreach ($aAllClassLesson as $aClassLesson) 
						{	
							$aClass = StudentsClass::findClass($aClassLesson['Turma_idTurma']);
							$aLocal = Local::findLocal($aClassLesson['Lugar_idLugar']);
							
				?>	
							<tr>
								<td align="center"> <?= $aClassLesson['idAulaComum'];?> </td>
								<td align="center"> <?= $aClass['nomeTurma'];?> </td>
								<td align="center"> <?= $aLocal['nomeLugar'];?> </td>
								<td align="center"> <?= $aClassLesson['dataAulaComum'];?> </td>
								<td align="center"> <?= $aClassLesson['horarioInicioAulaComum'];?> </td>
								<td align="center"> <?= $aClassLesson['horarioTerminoAulaComum'];?> </td>
								<td align="center"> <a href="/sapd/lesson/editclasslesson/<?= $aClassLesson['idAulaComum']?>">Editar  </a>
								<a  href="/sapd/lesson/removeclasslesson/<?= $aClassLesson['idAulaComum'] ?> ">Deletar</a> </td>
							</tr>
				<?php
						}
					}					
				?>
		 	</tr>
		</table>
       
                                </div>
                                
                            <!--/panel content-->
                        </div>
						
						<!-- Small modal -->




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
			
			
          