
var _tabelaListaEmail;
var _tabelaEmail;


$(document).ready(function () {
    inicializarTabelaEmails();
    atualizarDataTable();
    carregaAPI();
    atribuirAcaoAlterar();
    atribuirAcaoVisualizar();
    atribuirAcaoHistorico();
   
    

});


function carregaAPI() {

 
   $.ajax({
        method: "GET",
        url: "http://www.ceopc.sp.caixa/esteiracomex2/api/public/index.php/lista_empresa/",
        dataType: "json",
        // async: false
    }).done(function (json) {

       atualizarDataTable(json);
        criarMapa(json);
                    
    }).fail(function (jqXHR, textStatus, errorThrown) {

        console.log("deu erro");
        alert('Problemas ao tentar salvar!\n' + jqXHR.status + ' ' + jqXHR.statusText + errorThrown);

    });
}

function criarMapa(json){
   
   _tabelaEmail = new Map();

    $.each(json, function(i, item){
        _tabelaEmail.set(item.ID_EMPRESA, item);
    });
    
}


function atualizarDataTable(lista) {
    _tabelaListaEmail.clear().draw(false);
    if (lista != undefined && lista != "") {
        
        _tabelaListaEmail.rows.add(lista).draw(true);
    }
} 

function atribuirAcaoVisualizar() {
    
    $('#tabelaEmail').on('click', 'tbody .btn-visualizar', function () {
        //pega a TR na datatable
        var linha = _tabelaListaEmail.row($(this).closest("tr")).data();

        if (linha === undefined) return;

               var empresa = _tabelaEmail.get(linha.ID_EMPRESA);

        var empresa = _tabelaEmail.get(linha.ID_EMPRESA);
        var tituloModal = document.querySelector("#EmailModalLabel");
        tituloModal.textContent = "Visualizar Informações - Dados Cadastrados"; 
        
        
       $("#nomeEmpresa").val(empresa.NOME_CLIENTE);
       $("#cnpjEmpresa").val(empresa.CNPJ);
       $("#nomeAgencia").val(empresa.NO_PV);
       $("#pvEmpresa").val(empresa.CO_PV);       

       $("#emailPrincipal").val(empresa.EMAIL_PRINCIPAL);
       $("#emailPrincipal").attr("readonly", true); 
     
       $("#emailSecundario").val(empresa.EMAIL_SECUNDARIO);
       $("#emailSecundario").attr("readonly", true); 

       $("#emailReserva").val(empresa.EMAIL_RESERVA);
       $("#emailReserva").attr("readonly", true); 

       $("#salvarAltera").hide(); // esconde o botão
    
        $("#EmailModal").modal("show");

    });
} 


// vai usar isso depois de cada campo
//   $("#nomeEmpresa").attr("disabled", "disabled"); //use paara ; //use paara visaualizar -- como assim?

function atribuirAcaoAlterar() {
    $('#tabelaEmail').on('click', 'tbody .btn-alterar', function () {
        //pega a TR na datatable
        var linha = _tabelaListaEmail.row($(this).closest("tr")).data();

        if (linha === undefined) return;

        var empresa = _tabelaEmail.get(linha.ID_EMPRESA);
        //altera o titulo do modal
        var tituloModal = document.querySelector("#EmailModalLabel");
        tituloModal.textContent = "Alterar Emails Cadastrados"; 

    $("#nomeEmpresa").val(empresa.NOME_CLIENTE);
    $("#cnpjEmpresa").val(empresa.CNPJ);
    $("#nomeAgencia").val(empresa.NO_PV);
    $("#pvEmpresa").val(empresa.CO_PV);

    $("#emailPrincipal").val(empresa.EMAIL_PRINCIPAL);
    $("#emailPrincipal").removeAttr("readonly"); 

    $("#emailSecundario").val(empresa.EMAIL_SECUNDARIO);
    $("#emailSecundario").removeAttr("readonly");

    $("#emailReserva").val(empresa.EMAIL_RESERVA);
    $("#emailReserva").removeAttr("readonly");

    $("#salvarAltera").show(); //mostra o botao
        
    $("#EmailModal").modal("show");

    });
} 

function atribuirAcaoHistorico() {
    $('#tabelaEmail').on('click', 'tbody .btn-historico', function () {
        
         var linha = _tabelaListaEmail.row($(this).closest("tr")).data();
        
         if (linha === undefined) return;

        var empresa = _tabelaEmail.get(linha.ID_EMPRESA);
               
        $("#nomeEmpresaHistorico").val(empresa.NOME_CLIENTE);
        console.log(empresa.CNPJ);
        
        $('#modalHistorico').modal('show'); 
        //aqui teria que ir o ajax

        $.ajax({
            method: "GET",
            url: "http://www.ceopc.sp.caixa/esteiracomex2/api/public/index.php/historico_empresa/ ?cnpjEmpresa=" + empresa.CNPJ,
            dataType: "json",
            // async: false
        }).done(function (json) {

            $('#tabelaHistorico tbody').html(""); //essa linha que limpa a tabela para não deixar acumular históricos;
            if(json.length == 0 ){
                $('#tabelaHistorico tbody').append("<tr><td colspan='4'>Não existe histórico de alteração para esse cliente.</td></tr>");
                return;
            }



            json.forEach(function(consultaHistorico, indice) {

              var dia_alterado  = new Date (consultaHistorico.DATA);
              
                $('#tabelaHistorico tbody').append(`
                    <tr><td>${dia_alterado.toLocaleString()}</td> +
                    <td> ${consultaHistorico.ACAO}</td> +
                    <td> ${consultaHistorico.HISTORICO}</td> +
                    <td> ${consultaHistorico.COD_MATRICULA}</td></tr> 
                `);
            })

                        
        }).fail(function (jqXHR, textStatus, errorThrown) {
    
            console.log("deu erro")
            alert('Problemas ao tentar salvar!\n' + jqXHR.status + ' ' + jqXHR.statusText + errorThrown);
    
        });





    });
} 

function inicializarTabelaEmails() {
    _tabelaListaEmail = $('#tabelaEmail').DataTable({
        //Posiciona o campo pesquiar acima da datatable
        // sDom: '<"top">rt<"bottom"ifp><"clear">',
        scrollY: "350px",
        scrollCollapse: false,
        paging: true,
        lengthChange: true,
        pageLength: 10,
        bSort: true,
        order: [0, "asc"],
        bAutoWidth: true,
        responsive: true,
        //data: listaComApi,
        //segunda forma: - Mas testa a primeira antes
        //ajax : "http://www.ceopc.sp.caixa/api/public/index.php/antecipadosTabela2/",
        columns: [

            { data: "NOME_CLIENTE", title: "Nome", width: "32%"},
            { data: "CNPJ", title: "CNPJ", width: "10%", class: "dt-center" },
            { data: "EMAIL_PRINCIPAL", title: "E-mail Principal", width: "16%", class: "dt-center" },
                        { data: "CO_PV", title: "Ag", width: "6%", class: "dt-center" },
            //aqui vamos criar a coluna de ação
            { data: "Acao", // esse não influencia nada
                    title: "Ação",
                    
                    render: function()
                    {
                        var retorno = ""; 
                        //botao alterar
                        btAlterar = "<a rel='tooltip' class='btn btn-default btn-xs btn-alterar' title='Alterar'><span class='glyphicon glyphicon-pencil' ></span></a>&nbsp;";
                       
                        btHistorico = "<a rel='tooltip' class='btn btn-default btn-xs btn-historico' title='Histórico'><span  class='glyphicon glyphicon-book' ></span></a>&nbsp;";
                        
                        btVisualizar = "<a rel='tooltip' class='btn btn-default btn-xs btn-visualizar' title='Visualizar'><span class='glyphicon glyphicon-search' ></span></a>&nbsp;"; 
                        //Coloca a ordem
                        retorno =  btVisualizar +btAlterar +btHistorico; 
                        //deve funcionar :) testa..
                         return retorno;
                    },
                     width: "10%",
                     class: "dt-center"
            }
            
        ]
    });

}


// avisa que o registro foi salvo antes de recarregar a página e impede cadastramento de emails duplicados;

var input = document.querySelector('input'),
    form = document.querySelector('form');

form.addEventListener('submit', validateAndSubmit, false);

function validateAndSubmit(event) {
  // Prevenindo o comportamento padrão.
  event.preventDefault();

  let emailPrincipal = formCadastro.emailPrincipal.value;
  let emailSecundario = formCadastro.emailSecundario.value;
  let emailReserva = formCadastro.emailReserva.value;

  if((emailPrincipal === emailSecundario && emailPrincipal!="")||(emailPrincipal===emailReserva&&emailPrincipal!="")||(emailSecundario===emailReserva&&emailSecundario!="")){
    formCadastro.emailPrincipal.focus();
    alert('Por favor indicar apenas emails exclusivos');
    return false();
  } else {
    form.submit();
    alert('Alteração feita com sucesso!');
  }
}












