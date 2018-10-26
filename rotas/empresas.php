<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app  = new Slim\App;


$app->get('/cnpj/', function(Request $request, Response $response){
     
     

      $sql = "SELECT *
	          FROM [DB5624_GEOPC_COMPLEMEX].[dbo].[tbl_SIEXC_OPES_ENVIADAS]";

    
  try{
        // capturar os dados do banco montado no mysql
        $db = new db();
        // conectar
        $db = $db->connect();

        // variavel de uso coringa para query
        $stmt = $db->query($sql); // stmt ele chama de statment ou declaração então né 
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;
        echo json_encode($customers, JSON_BIGINT_AS_STRING | JSON_UNESCAPED_SLASHES |JSON_NUMERIC_CHECK );


 } catch (PDOException  $e){
        echo '{"error": {"text":' .$e->getMessage().'}';
    }

});


// PEGAR/CONSULTAR SOMENTE UM DADO

$app->get('/cnpj/{id}', function(Request $request, Response $response){
    
    $id = $request->getAttribute('id');
    $sql = "SELECT *
    FROM [DB5624_GEOPC_COMPLEMEX].[dbo].[tbl_SIEXC_OPES_ENVIADAS]
    WHERE replace(replace(replace([CPF/CNPJ do Cliente],'.',''),'/',''),'-','') = $id";

    try{
        // capturar os dados do banco montado no mysql
        $db = new db();
        // conectar
        $db = $db->connect();

        // variavel de uso coringa para query
        $stmt = $db->query($sql);
        $customer = $stmt->fetchAll(PDO::FETCH_OBJ); // ajustou aqui a variavel customer
        $db = null;
        echo json_encode($customer, JSON_BIGINT_AS_STRING | JSON_UNESCAPED_SLASHES |JSON_NUMERIC_CHECK); // ajustou aqui a variavel


    } catch (PDOException  $e){
        echo '{"error": {"text":' .$e->getMessage().'}';
    }

});

