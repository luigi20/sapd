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
    <form action="/sapd/user/adduser" method="post">
	
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
						    <li class="active"><a href="/sapd/login/pagedefaultmaster"><i class="glyphicon glyphicon-home"></i> Home</a></li>
                            <li class="active"><a href=""><i class="glyphicon glyphicon-folder-open"></i> Aluno</a></li>
                            <li><a href="/sapd/login/pageadduser"><i class="glyphicon glyphicon-user"></i> Usuario</a></li>
                            <li><a href=""><i class="glyphicon glyphicon-file"></i> </a></li>
							<li><a href=""><i class="glyphicon glyphicon-file"></i> </a></li>
							<li><a href=""><i class="glyphicon glyphicon-file"></i>  </a></li>
							<li><a href=""><i class="glyphicon glyphicon-file"></i> </a></li>
							<li><a href=""><i class="glyphicon glyphicon-file"></i> </a></li>
							<li><a href=""><i class="glyphicon glyphicon-file"></i> </a></li>
                        </ul>
                    </li>
                    <hr />
                    
                    <hr />
                    <li class="nav-header">
                        <h5>
                            Gerenciar <i class="glyphicon glyphicon-chevron-down"></i>
                        </h5>
                    
                        <ul class="list-unstyled collapse in" id="Ul1">
                             
                            <li class="active"><a href=""><i class="glyphicon glyphicon-folder-open"></i> Aluno</a></li>
                            <li><a href=""><i class="glyphicon glyphicon-user"></i> Usuario</a></li>
                            <li><a href=""><i class="glyphicon glyphicon-file"></i> Turma</a></li>
							<li><a href=""><i class="glyphicon glyphicon-file"></i> Pagamento</a></li>
							<li><a href=""><i class="glyphicon glyphicon-file"></i> Aula Comum</a></li>
							<li><a href=""><i class="glyphicon glyphicon-file"></i> Aula Individual</a></li>
							<li><a href=""><i class="glyphicon glyphicon-file"></i> Evento</a></li>
							<li><a href=""><i class="glyphicon glyphicon-file"></i> Lugar</a></li>
							
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
                            <li><a href=""><i class="glyphicon glyphicon-user"></i> Usuario</a></li>
                            <li><a href=""><i class="glyphicon glyphicon-file"></i> Turma</a></li>
							<li><a href=""><i class="glyphicon glyphicon-file"></i> Pagamento</a></li>
							<li><a href=""><i class="glyphicon glyphicon-file"></i> Aula Comum</a></li>
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
                <a href="#"><strong><i class="glyphicon glyphicon-dashboard"></i>Usuario</strong></a>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <i class="glyphicon glyphicon-wrench pull-right"></i>
                                    <h4 id="head_pagina">
                                        Cadastrar Usuario</h4>
                                </div>
                            </div>
                           <div class="panel-body">
							   <div class="control-group col-md-6">
                                    <label>
                                        Nome</label>
                                    <div class="controls">
                                        <input type="text" name ="sUserName" autocomplete = "off" required class="form-control"/>
                                        <br />
                                    </div>
                                </div>
                                <div class="control-group col-md-7">
                                    <label>
                                        Endereco</label>
                                    <div class="controls">
										<input type="text" name ="sUserAddress" autocomplete = "off" required class="form-control"/>
										
                                    </div>
                                </div>
								

								 <div class="control-group col-md-4">
                                    <label>
                                        Celular</label>
                                       <div class="controls">
											<input type="phone" name ="sUserCellPhone" autocomplete = "off" maxlength= "14" onKeyUp = "formataTelefone(sUserCellPhone, event)" required class="form-control"/>
											<br />
										</div>
								</div>
								
								 <div class="control-group col-md-4">
                                    <label>
                                        Email</label>
                                       <div class="controls">
											<input type="email" name ="sUserEmail" autocomplete = "off" required class="form-control"/>
											<br />
										</div>
								</div>
								
								 <div class="control-group col-md-4">
                                    <label>
                                        Senha</label>
                                       <div class="controls">
											<input type="password" name ="sUserPassword" maxlength= "10" autocomplete = "off" required class="form-control"/>
											<br />
										</div>
								</div>
								
								<div class="control-group col-md-4">
                                    <label>
                                        Tipo de Usuario</label>
                                       <div class="controls">
											<select name = "sUserType" autocomplete = "off" class="form-control">
											
												<option value="Master">Master</option>
												<option value="Professor">Professor</option>
											</select>
										</div>
								</div>
								
								<div class="controls">
                                        <div class="control-group col-md-12">
                                    
                                    <br />
											<div class="controls">
												<input type="submit" name = "btnAdd" class="btn btn-success" value="Cadastrar"/>
									
											</div>
										</div>
								</div>
                               
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