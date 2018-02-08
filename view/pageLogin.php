<?php
	$bLogged = new Sessao("bLogged",false);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link href="../css/Principal.css" rel="stylesheet" type="text/css" />
    <link href="../css/StyleSheet.css" rel="stylesheet" type="text/css" />
	
    <script type="text/javascript" src="JS/Mascara.js"></script>
</head>
<body>
    <form action="/sapd/login/logged" method="POST">
    <div id="top-nav" class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar">
                    </span>
                </button>
                <p class="navbar-brand" >SAPD - Sistema de Apoio A Professores De Dança</p>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                  
                </ul>
            </div>
        </div>
        <!-- /container -->
    </div>
    <!-- /Header -->
    <!-- Main -->
    <div class="container-fluid"  >
        <div class="row">
            
            <!-- /col-3 -->
            <div class="col-sm-9">
                <!-- column 2 -->
              
                <div class="row">
                    <div class="col-md-12" style= "margin-left: 480px; width: 500px">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <i class="glyphicon glyphicon-wrench pull-right"></i>
                                    <h4 id="head_pagina">
                                        LOGIN</h4>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="control-group col-md-10">
                                    <label>
                                        Email</label>
                                    <div class="controls">
										<input type="email" name ="sUserEmail" required=""  class="form-control"/>
                                    </div>
                                </div>
                                <div class="control-group col-md-6">
                                    <label>
                                        Senha</label>
                                    <div class="controls">
                                        <input type="password" name ="sUserPassword" required="" autocomplete = "off" class="form-control"  MaxLength="10"  />
                                        
                                        <br />
                                    </div>
                                </div>
								
								
								 <div class="control-group col-md-12">
                                   
                                    <div class="controls">
                                        <a href ="pagerememberpassword" style = "margin-left: 150px"> Lembrar Senha</a>
									</div>
								</div>
                                <div class="control-group col-md-12">
                                   
                                    <div class="controls">
                                        <input type="submit" name = "btnLogin" class="btn btn-success" style = "margin-left: 170px;  " value="Login"
                                             />
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
    <footer class="text-center">Desenvolvido por <strong>Luis Antonio dos Santos Silva</strong>.</footer>
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