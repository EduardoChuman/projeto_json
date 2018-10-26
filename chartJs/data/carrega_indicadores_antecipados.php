<?php 
if(isset($usuario)){
	$conexao = odbc_connect(CONNECTION_STRING,USER,PASSWORD);
	autentica();

//-----------------------------------------------------------------------------------------------------
        $listaPhp;
		$sql_x="SELECT [LOTE] as Mes
			,[QUANTIDADE CADASTRADA] as Cadastrada
			,[QUANTIDADE TRATADA] as Tratada
			,[INCONFORME OU CANCELADA]as Inconforme
			FROM [DB5624_GEOPC_COMPLEMEX].[dbo].[tbl_ANT_RELATORIO_TEMP_API]
										";

																										
		$rs_x = odbc_exec($conexao, $sql_x);	

		while( $row_x = odbc_fetch_array($rs_x) ) {
            $listaPhp[]=$row_x;
        }
        //return  json_encode($listaPhp);
       echo "<script>var _lista =" . json_encode($listaPhp) . ";</script>" ;
//------------------------------------------------------------------------------------------------------

     $listaResumo;
		$sql_x="SELECT [CLIENTE]
		
       			,count([CO_STATUS]) as total
     
					FROM [DB5624_GEOPC_COMPLEMEX].[dbo].[tbl_ANT_RELATORIO_TEMP]
					where [CO_STATUS]='CANCELADA' 
					group by [CLIENTE]
									";
																										
		$rs_x = odbc_exec($conexao, $sql_x);	

		while( $row_x = odbc_fetch_array($rs_x) ) {
            $listaResumo[]=$row_x;
        }
        
        echo "<script>var _listadois =" . json_encode($listaResumo) . ";</script>" ;

//------------------------------------------------------------------------------------------------------

$listaEmp;
		$sql_x="SELECT [LOTE]
		      ,[CO_MATRICULA_CEOPC] 
		      ,[CO_NOME_CEOPC] AS EMPREGADO
		      ,[CONFORME]
		      ,[INCONFORME]
		      ,[CANCELADA]
		      ,[DATA OK]
		      ,[TOTAL]
		  FROM [DB5624_GEOPC_COMPLEMEX].[dbo].[tbl_ANT_RELATORIO_TEMP_PRODUCAO] ";

																										
		$rs_x = odbc_exec($conexao, $sql_x);	

		while( $row_x = odbc_fetch_array($rs_x) ) {
            $listaEmp[]=$row_x;
        }
        
        echo "<script>var _listaEmp =" . json_encode($listaEmp) . ";</script>" ;

//------------------------------------------------------------------------------------------------------
    odbc_close($conexao);
} else {echo "Você não deveria estar aqui !!";}
?>

