<!-- CABEÇALHO -->
<?php

//variaveis para teste
$badget_cadastrada_antecipados_usuario = '15';
$badget_usuario = '25';
$badget_cadastrada ='0';
$badget_cadastrada_antecipados = '0';
$badget_cadastrada = '0';


require_once('templates/esteira_cabecalho.php');

// MONITORA OS ACESSOS NA ESTEIRA
$tipoAcesso = "CONSULTA";
$nomePagina = "CADASTRO E-MAIL CLIENTE COMEX";
// CRIA O OBJETO DE REGISTRO DE ACESSO
$acesso = new Acesso($tipoAcesso, $nomePagina);

// CHAMA O MÉTODO DE REGISTRO DE ACESSO
$acesso->registraAcessoPagina($user);

// if($perfil_user <'700'){	
// 			header("location:sem_acesso.php");
// 		exit;
// 	}


?>




		<!-- FOLHAS DE ESTILO DA PÁGINA -->
		<!-- /FOLHAS DE ESTILO DA PÁGINA -->
		<style>
			@media (max-height:500px) {
			.content-wrapper {
			min-height: 750px !important;
			}
			}
			.well, .box-title{
				text-align: center;
			}
			.modal-header{
				background-color: #ed6b18;
				color: #FFF;
			}

			/*#testeTamanho{
				height: 1000px;
			}*/

			
			</style>
    </head>
	
    <body class="hold-transition skin-blue sidebar-mini">
<!-- /CABEÇALHO -->

		<div class="wrapper">
			<!-- HEADER -->
			<?php
			require_once("templates/esteira_header.php");
			?>
			<!-- /HEADER -->	
			
			<!-- MENU LATERAL -->
			<?php
			require_once("templates/esteira_menu_lateral.php");
			?>
			<!-- /MENU LATERAL -->

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h4 class="animated bounceInLeft">
						Gerenciador de email externos | <small>Lista de emails externos cadastrados na esteira</small>
					</h4>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Controles</a></li>
						<li class="active">Envio de Ordens</li>
					</ol>
					<section class="content">
						  
						<!--
						###########################################################################################
						############################          INICIO DA PÁGINA         ############################
						###########################################################################################
						!-->

					<div class="col-sm-12">
						<h2> Atualização de e-mails Corporativo </h2>
						<p>	O propósito desta página é o de agilizar a comunicação entre a CAIXA e o cliente corporativo (COMEX). </p>
					</div>





					<div class="alert alert-warning col-md-12" role="alert">
						<p>
							<strong> ## ATENÇÃO ## </strong>
							<br>
							Declaro estar ciente de que a inclusão ou alteração do e-mail precede a expressa manifestação do cliente para recepção de avisos de ordens de pagamento recebidas pela CAIXA através deste canal de comunicação. 
							
							A não observância deste procedimento pode ocasionar em risco de imagem para CAIXA e apuração de responsabilidade nos moldes do AE079.
						</p>
					
					</div>
					




					<!-- <h1> Cadastro e-mail COMEX </h1> -->

										<!-- DATATABLE -->					
															
								<div class="col-md-12">
									<table id="tabelaEmail" class="table table-striped compact" ></table>
									
								</div>

						<!-- Modal Alterar e Visualizar--> 

					<div class="modal fade" id="EmailModal" tabindex="-1" role="dialog" aria-labelledby="EmailModalLabel">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="EmailModalLabel">Visualizar Informações - Dados Cadastrados</h4>
								</div>

							<div class="modal-body with-padding">
							
							<div class="tabbable">                             
														
                                                                       
							<form method="post" action="email_cliente_esteira/altera_cadastro.php" name="formCadastro">         
							<div class="row">  
									   <div id="modalEmail"></div>
							   
									<div class="col-sm-12">
											<label class="control-label">Nome da Empresa</label>
											<input placeholder="..." name="nomeEmpresa" id="nomeEmpresa" class="form-control" type="text" readonly>
									</div>

									<div class="col-sm-6">
										<label class="control-label">CNPJ</label>
										<input placeholder="..." name="cnpjEmpresa" id="cnpjEmpresa" class="form-control" type="text" readonly >
									</div>
									
								
										<div class="col-sm-2">
											<label class="control-label">Agencia</label>
											<input placeholder="..." id="pvEmpresa" class="form-control" type="text" readonly >
										</div>

										<div class="col-sm-4">
											<label class="control-label">Nome da Agencia</label>
											<input placeholder="..."  id="nomeAgencia"class="form-control" type="text" readonly >
										</div>

							    </div> <!--fecha div row -->
							   <br>

							   <div class="row">    
							   <div class="col-sm-12">
								   <label class="control-label">Email Principal</label>
									<input placeholder="..." name="emailPrincipal" id="emailPrincipal"class="form-control" type="email" readonly>
							   </div>
							   <div class="col-sm-12">
								   <label class="control-label">Email Secundário</label>
									<input placeholder="..." name="emailSecundario" id="emailSecundario"class="form-control" type="email" readonly>
							   </div>
							   <div class="col-sm-12">
								   <label class="control-label">Email Reserva</label>
									<input placeholder="..." name="emailReserva" id="emailReserva"class="form-control" type="email" readonly>
							   </div> <!--fecha div row -->
							   </div> <!--fecha div tabbable -->
						 								   
								

<!--       </div> -->
					<div class="modal-footer">
						<button type="submit" id="salvarAltera" class="btn btn-primary" >Salvar Alterações</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
						</form>
					 </div> <!-- footer -->
				</div><!-- footer modal-body with-padding -->
		 </div> 
      </div>
    </div>
	</div>
  


<!-- Modal Historico--> 

			<div class="modal fade" id="modalHistorico" tabindex="-1" role="dialog" aria-labelledby="EmailModalLabel">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Histórico de alterações</h4>
						</div>
						<div class="modal-body with-padding">
							<p>Estão listadas abaixo cinco últimas alterações realizadas&hellip;</p>
								<div class="row">  
									   
									<div class="col-sm-12">
										<label class="control-label">Nome da Empresa</label>
										<input placeholder="..." name="nomeEmpresaHistorico" id="nomeEmpresaHistorico" class="form-control" type="text" readonly>
									</div>
									
									<br>
									
											<div class="panel-body">
												<table id="tabelaHistorico" class="table table-bordered table-striped datatable">
													<thead>
														<tr>
															<th>Data e Hora</th>
															<th> Ação </th>
															<th> Histórico </th>
															<th> Alterado Por </th>			
														</tr>
													</thead>
													<tbody> </tbody>
													
												</table>
											</div>

								

							    </div> <!--fecha div row -->
							</div> <!--fecha div modal-body with-padding -->

						
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Fechar Consulta</button>
							
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
										

				

						<!--
						###########################################################################################
						############################           FIM DA PÁGINA           ############################
						###########################################################################################
						-->
					</section>
					<!-- /.content -->
				</section>
			</div>
		<?php
		require_once("templates/esteira_rodape.php");
		?>
		</div>
		<!-- /.content-wrapper -->
		<!-- RODAPÉ -->
		<!-- /RODAPÉ -->
		<!-- SCRIPTS DA PÁGINA-->
		<script src="chart/Chart.js"></script>
		<script src="chart/Chart.bundle.js"></script>
		<script src="js/envia_email_cliente.js"></script>
		      
        <!-- /SCRIPTS DA PÁGINA-->
	</body>
</html>