$(document).ready(function () {
    $(window).keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
});


$("#ed_operacao").keydown(function () {
    closeAndClearOperacao2();
});

$("#btnValidaOpCanc").click(function (event) {
    event.stopImmediatePropagation();
    executeCallValidateOperacao();
});

$("#btnExecuteBaixa").click(function (event) {
    event.stopImmediatePropagation();
    if (executaValidacaoDadosTela()) {
        executeCallBaixa();
    } else {
        invalidateDadosDigitadosOpe2();
    }
});

function closeAndClearOperacao2() {
    $("#ed_operacao2").val("");
    $("#section_operacao_2").hide();
}

function invalidateDadosDigitadosOpe2() {
    $.bigBox({
        title: "Verifique os dados Digitados:",
        content: "Dados Digitados não conferem",
        color: "#C46A69",
        timeout: 5000,
        icon: "fa fa-warning shake animated",
        number: ""
    });
    $("#ed_operacao2").val("");
    $("#ed_operacao2").focus();
}

function executaValidacaoDadosTela() {
    return $("#ed_operacao2").val() == $("#ed_operacao").val();
}

function executeCallBaixa() {
    var ope = $("#ed_operacao").val();
    var ope2 = $("#ed_operacao2").val();
    var mbx = $("#ed_motivobx").val();
    var baixaManual = $("#ed_BaixaManual").val();

    if (ope.trim() != "" && ope2 == ope) {
        var dataForm = {
            action: "executeBaixa",
            operacao: ope,
            operacao2: ope2,
            motivobx: mbx,
            baixaManual: baixaManual
        };
        $.ajax({
            type: 'post',
            url: '../controller/form-proc-baixar-blt-ctrl.php',
            data: dataForm,
            beforeSend: function () {
                $('body').loadingModal({text: 'Aguarde, Baixar Movimento...'}).loadingModal('animation', 'foldingCube');
            },
            success: function (retornoAjax) {
                if (retornoAjax != null && retornoAjax == "OK") {
                    closeAndClearOperacao2()
                    $("#ed_operacao").val("");
                    $("#ed_operacao").focus();
                    $.bigBox({
                        title: "Baixar Operação",
                        content: "Operação Baixada com sucesso!",
                        color: "#5F895F",
                        timeout: 3000,
                        icon: "fa fa-check bounce animated",
                        number: ""
                    });
                } else {
                    $.bigBox({
                        title: "Validação da Baixa:",
                        content: retornoAjax,
                        color: "#C46A69",
                        timeout: 5000,
                        icon: "fa fa-warning shake animated",
                        number: ""
                    });
                    closeAndClearOperacao2();
                }
                $('body').loadingModal('hide');
                $('body').loadingModal('destroy')
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $.bigBox({
                    title: "Erro ao buscar Operação",
                    content: "Falha ao buscar dados \n\r" + textStatus,
                    color: "#C46A69",
                    timeout: 4000,
                    icon: "fa fa-warning shake animated",
                    number: ""
                });
                closeAndClearOperacao2();
                $('body').loadingModal('hide');
                $('body').loadingModal('destroy')
            }
        });
    } else {
        invalidateDadosDigitadosOpe2();
    }
}

function executeCallValidateOperacao() {
    var ope = $("#ed_operacao").val();
    if (ope.trim() != "") {
        var dataForm = {
            action: "findOperacaoBaixa",
            operacao: ope
        };
        $.ajax({
            type: 'post',
            url: '../controller/form-proc-baixar-blt-ctrl.php',
            data: dataForm,
            beforeSend: function () {
            },
            success: function (retornoAjax) {
                if (retornoAjax != null && retornoAjax.substr(0, 2) == "OK") {
                    var json = JSON.parse(retornoAjax.substr(3));
                    $("#ed_pfin_valor").text(json[0].valor);
                    $("#ed_pfin_parcela").text(json[0].parcela);
                    $("#ed_pfin_numerodcto").text(json[0].numeroDcto);
                    $("#ed_pfin_observacao").text(json[0].observacao);
                    $("#ed_pfin_datavcto").text(new Date(json[0].dataVcto.date).toLocaleDateString());
                    $("#ed_pfin_datamvto").text(new Date(json[0].dataMvto.date).toLocaleDateString());
                    if (json[1] != undefined) {
                        $("#ed_clie_nome").text(json[1].codigo + " - " + json[1].nome);
                        $("#ed_clie_email").text(json[1].email);
                    }
                    if (json[2] != undefined) {
                        $("#ed_pblt_invoiceid").text(json[2].invoice_id);
                    }
                    $("#section_operacao_2").show();
                    $("#ed_operacao2").val("");
                    $("#ed_operacao2").focus();
                } else {
                    $.bigBox({
                        title: "Validação da baixa:",
                        content: retornoAjax,
                        color: "#C46A69",
                        timeout: 5000,
                        icon: "fa fa-warning shake animated",
                        number: ""
                    });
                    closeAndClearOperacao2();
                }
            }
            ,
            error: function (jqXHR, textStatus, errorThrown) {
                $.bigBox({
                    title: "Erro ao buscar Operação",
                    content: "Falha ao buscar dados \n\r" + textStatus,
                    color: "#C46A69",
                    timeout: 4000,
                    icon: "fa fa-warning shake animated",
                    number: ""
                });
                closeAndClearOperacao2();
            }
        });
    }
}
