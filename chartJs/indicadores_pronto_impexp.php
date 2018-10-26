<!-- CABEÇALHO -->
<?php
require_once("esteira_cabecalho.php");
//require_once("data\carrega_realize_2018.php");
//$lg1="CONSULTA";
//$lg2="REALIZE 2018";
include("data\cadastrar_acesso.php");
include("data\carrega_indicadores_antecipados.php");
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
			</style>
    </head>
	
    <body class="hold-transition skin-blue sidebar-mini">
<!-- /CABEÇALHO -->

		<div class="wrapper">
			<!-- HEADER -->
			<?php
			require_once("esteira_header.php");
			?>
			<!-- /HEADER -->	
			
			<!-- MENU LATERAL -->
			<?php
			require_once("esteira_menu_lateral.php");
			?>
			<!-- /MENU LATERAL -->

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h4 class="animated bounceInLeft">
						Indicadores Antecipado | <small>Acompanhamento dos resultados dos contratos antecipados</small>
					</h4>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Gerencial</a></li>
						<li class="active">Indicadores</li>
					</ol>
					<section class="content">
						  
						<!--
						###########################################################################################
						############################          INICIO DA PÁGINA         ############################
						###########################################################################################
						<--></-->

						<canvas id="bar-chart-grouped" width="800" height="220"></canvas>
						
						<br> 	&nbsp

	<!--	____________________________Primeiro Card - Volume Contratos Antecipados __________________________________ -->			

			<div class="row"> <!-- essa class só fecha depois do card 02, pois coloca eles lado a lado -->
				
				<div class="col-md-6">	
					<div class="box box-primary collapsed-box" id ="volumeContratos">
						<div class="box-header with-border">
						 	<h2 class="box-title"><strong>Volume Contratos Antecipados</strong></h2>

								<div class="box-tools pull-right">
									<button type="button" id="exibirVolumeContratos" class="btn btn-box-tool" ><i class="fa fa-plus"></i>
									</button>
								</div>
						</div>
						
						<div class="box-body">
															
															
								<div class="col-md-12">
									<table id="tabelaLista" class="table  compact" style="background: white;"></table>
									
								</div>
						</div>         
							
					</div>
				</div>
			
		
					
<!--	____________________________Segundo Card - Demandas Canceladas __________________________________ -->	

			
				<div class="col-md-6">	
					<div class="box box-primary collapsed-box" id ="divDemandasCanceladas">
						<div class="box-header with-border">
						 	<h2 class="box-title"><strong>Demandas Canceladas</strong></h2>

								<div class="box-tools pull-right">
									<button type="button" id="exibirDemandasCanceladas" class="btn btn-box-tool"><i class="fa fa-plus"></i>
									</button>
								</div>
						</div>
						
						<div class="box-body">
															
															
								<div class="col-md-12">
									<table id="tabelaDois" class="table  compact" style="background: white;"></table>
									
								</div>
						</div>         
							
					</div>
				</div>
			</div>
<!--	___________________________Card - Demandas por analistas __________________________________ -->	


					<div class="box box-warning collapsed-box" id ="demandasAnalistas">
						<div class="box-header with-border ">
						 	<h2 class="box-title"><strong>Quantidade Mensal de Demandas Tratadas por Analistas</strong></h2>

								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" id ="exibirDemandasAnalistas"><i class="fa fa-plus"></i>
									</button>
									</div>
							</div>
						
						<div class="box-body">
							<h5> Selecione o mês que deseja visualizar</h5>
								
								<div class="col-md-12">
										<select id="mesesDosEmpregados" class="form-control">
										<option value=" ">Selecione um mês ...</option>
										<option value="3/2018">Março/2018</option>
										<option value="4/2018">Abril/2018</option>
										<option value="5/2018">Maio/2018</option>
										<option value="6/2018">Junho/2018</option>
										<option value="7/2018">Julho/2018</option>
										<option value="8/2018">Agosto/2018</option>
										<<option value="9/2018">Setembro/2018</option>
										<option value="10/2018">Outubro/2018</option>
										<!-- option value="11/2018">Novembro/2018</option> -->
										</select>
									</div>
									&nbsp &nbsp
									
									<div class="col-md-12">
									<table id="tabelaListaEmp" class="table  compact" style="background: white;"></table>
									
									</div>
						</div>         
							
					</div>
				

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
		require_once("esteira_rodape.php");
		?>
		</div>
		<!-- /.content-wrapper -->
		<!-- RODAPÉ -->
		<!-- /RODAPÉ -->
		<!-- SCRIPTS DA PÁGINA-->
		<script src="chart/Chart.js"></script>
		<script src="chart/Chart.bundle.js"></script>
		<script src="js/listar_indicadores_antecipados.js"></script>
      
        <!-- /SCRIPTS DA PÁGINA-->
	</body>
</html>