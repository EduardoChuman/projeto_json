
/* 
    Há uma pagina php chamada data\listar_antecipados_stephanie.php 
    inclusa no inicio da pagina stephanie_layout.php que alimenta
     as vaiaiveis _lista e _listadois
*/
var _lista;
var _listadois;

var _tabelaVolumeContratos;
var _tabelaDemandasCanceladas;
var _tabelaListaEmp;

$(document).ready(function () {
    desenhaTabelaVolume();
    desenhaTabelaCanceladas();
    InicializarChart();
    AplicaEventoComboMeses();
    inicializarTabelaEmpregados();
    AtualizarTabelaEmpregados();
    atribuirAcaoExibir("#exibirDemandasCanceladas", "#divDemandasCanceladas", _tabelaDemandasCanceladas);  
    atribuirAcaoExibir("#exibirVolumeContratos", "#volumeContratos", _tabelaVolumeContratos); 
    atribuirAcaoExibir("#exibirDemandasAnalistas", "#demandasAnalistas", _tabelaListaEmp);   
});

function atribuirAcaoExibir(_botao, _div, _tabela) {
    $(_botao).on("click", function () {
        if ($(_div).hasClass("collapsed-box")) {
            
            $(`${_botao} i`).addClass("fa-minus")
            $(`${_botao} i`).removeClass("fa-plus")
            $(_div).removeClass("collapsed-box")
            _tabela.draw(false);

        } else {
            
            $(`${_botao} i`).removeClass("fa-minus")
            $(`${_botao} i`).addClass("fa-plus")
            $(_div).addClass("collapsed-box")
        }

    });
}


function desenhaTabelaVolume() {
    _tabelaVolumeContratos = $('#tabelaLista').DataTable({
        //Posiciona o campo pesquiar acima da datatable
        // sDom: '<"top">rt<"bottom"ifp><"clear">',
        scrollY: "160",
        scrollCollapse: true,
        paging: false,
        lengthChange: false,
        pageLength: 5,
        bSort: true,
        order: [0, "asc"],
        data: _lista,
        columns: [

            { data: "Mes", title: "Mês", width: "20%", class: "dt-center" },
            { data: "Cadastrada", title: "Cadastradas", width: "20%", class: "dt-center" },
            { data: "Tratada", title: "Analisadas", width: "20%", class: "dt-center" },
            { data: "Inconforme", title: "Inconforme Canceladas", width: "20%", class: "dt-center" }
        ]
    });

}

function botao() {
    return "<buto";
}

function desenhaTabelaCanceladas() {
    _tabelaDemandasCanceladas = $('#tabelaDois').DataTable({
        //Posiciona o campo pesquiar acima da datatable
        //sDom: '<"top">rt<"bottom"ifp><"clear">',
        scrollY: "160",
        scrollCollapse: true,
        paging: false,
        lengthChange: false,
        pageLength: 5,
        bSort: true,
        order: [1, "desc"],
        data: _listadois,
        columns: [
            // {
            //     data: "DocId",
            //     title: "Mapa",
            //     width: "10%",
            //     class: "dt-center",
            //     render: function (data, type, full, meta) {
            //         return '<input type="checkbox" name="mapaSelecionada[]" class="mapaSelecionado" value="' + full.DocId + '" />';
            //     }
            // },
            // { data: "NO_RAZAO_SOCIAL", title: "NO_RAZAO_SOCIAL", width:"40%" },
            { data: "CLIENTE", title: "Empresa", width: "85%", class: "dt-center" },
            { data: "total", title: "Total Canceladas", width: "15%", class: "dt-center" }

        ]
    });

}

function desenhaLinks(data) {
    return "oie";
}

function InicializarChart() {
    //console.log(_lista);

    var _labels = new Array();
    var _Cadastradas = new Array();
    var _Analisadas = new Array();
    var _Canceladas = new Array();

    $.each(_lista, function (idx, item) {
        _labels.push(item.Mes);
        _Cadastradas.push(item.Cadastrada);
        _Analisadas.push(item.Tratada);
        _Canceladas.push(item.Inconforme);

    });

    new Chart(document.getElementById("bar-chart-grouped"), {
        type: 'bar',
        data: {
            labels: _labels,
            datasets: [
                {
                    label: "Cadastradas",
                    backgroundColor: "#0067B2",
                    data: _Cadastradas
                }, {
                    label: "Analisadas",
                    backgroundColor: "#0093FF",
                    data: _Analisadas
                },
                {
                    label: "Canceladas",
                    backgroundColor: "#FF9800",
                    data: _Canceladas
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: 'Volume de Demandas - Antecipados'
            }
        }
    });
}


function AplicaEventoComboMeses() {
    $("#mesesDosEmpregados").on("change", function () {
        var mes = $(this).val();

        _produtividade = new Array();

        $.each(_listaEmp, function (idx, item) {
            if (item.LOTE == mes) {
                _produtividade.push(item);
            }
        }); console.log(_produtividade);

        AtualizarTabelaEmpregados(_produtividade);

    });
}


function AtualizarTabelaEmpregados(_produtividade) {
    _tabelaListaEmp.clear().draw(false);
            if (_produtividade != undefined && _produtividade != "") {
        _tabelaListaEmp.rows.add(_produtividade).draw(false);
            }
}


function inicializarTabelaEmpregados() {
    _tabelaListaEmp = $('#tabelaListaEmp').DataTable({
        //Posiciona o campo pesquiar acima da datatable
        //sDom: '<"top">rt<"bottom"ifp><"clear">',
        scrollY: "200px",
        scrollCollapse: true,
        paging: false,
        lengthChange: false,
        pageLength: 6,
        bSort: true,
        bAutoWidth: false,
        //data: _listaEmp,
        columns: [
            // {
            //     data: "DocId",
            //     title: "Mapa",
            //     width: "10%",
            //     class: "dt-center",
            //     render: function (data, type, full, meta) {
            //         return '<input type="checkbox" name="mapaSelecionada[]" class="mapaSelecionado" value="' + full.DocId + '" />';
            //     }
            // },
            { data: "LOTE", title: "Mês", width: "9%", class: "dt-center" },
            { data: "EMPREGADO", title: "Analista", width: "37%",  class: "dt-center"},
            { data: "CONFORME", title: "Conforme", width: "10%", class: "dt-center" },
            { data: "INCONFORME", title: "Inconforme", width: "10%", class: "dt-center" },
            { data: "CANCELADA", title: "Cancelada", width: "10%", class: "dt-center" },
            { data: "DATA OK", title: "Data OK", width: "10%", class: "dt-center" },
            { data: "TOTAL", title: "Total Demandas Mês", width: "12%", class: "dt-center" }

        ]
    });

}