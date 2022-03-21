$('#btnSubmit').click(function () {

    var data = $('#form-lcto-analise-antecip').serialize();
    $.ajax({
        type: 'post',
        url: "../../controller/form-lcto-antecip-analise-ctrl.php",
        data: data,
        beforeSend: function () {
            $('body').loadingModal({text: 'Aguarde, Gerando Movimento...'}).loadingModal('animation', 'foldingCube');
        },
        success: function (retornoAjax) {
            if (retornoAjax != null && retornoAjax.substr(0, 7) == "success") {
                var transacao = retornoAjax.substr(8);
                $.bigBox({
                    title: "Gravação de Dados",
                    content: "Transação Gravada com sucesso!",
                    color: "#5F895F",
                    timeout: 3000,
                    icon: "fa fa-check bounce animated",
                    number: transacao
                });
                setTimeout(function () {
                    window.location.href = '../../form-print-antecipacao.php?transacao=' + transacao;
                }, 1500);
            } else {
                $.bigBox({
                    title: "Gravação de Dados",
                    content: "Falha ao Gravar dados \n\r" + retornoAjax,
                    color: "#C46A69",
                    timeout: 3000,
                    icon: "fa fa-warning shake animated",
                    number: ""
                });
            }
            $('body').loadingModal('hide');
            $('body').loadingModal('destroy')
        },
        error: function (jqXHR, textStatus, errorThrown) {
            avisoErro("Falha ao Gravar Dados " + textStatus, wRedirect);
            $('body').loadingModal('hide');
            $('body').loadingModal('destroy')
        }
    });

});


$('li').click(function (e, obj) {
    var operacao = $(this).attr("data-value");
    var opcao = $(this).val();
    var btn = $('#btnStatusOP_' + operacao);
    var spn = $('#spanStatusOp_' + operacao);
    var input = $('#inputStatusOP_' + operacao);
    var opcaoAtual = getOpcaoAtual(spn.text());
    var inputOperacoes = $('#operacoes');
    btn.removeClass("btn-info");
    btn.removeClass("btn-success");
    btn.removeClass("btn-danger");
    var valorBruto = parseFloat(btn.attr("data-bruto"));
    var valorCusto = parseFloat(btn.attr("data-custo"));
    var valorLiquido = parseFloat(btn.attr("data-liquido"));
    if (opcao == 9) {
        btn.addClass("btn-info");
        spn.text("Pendente");
        inputOperacoes.val(inputOperacoes.val().replace(operacao, ""))
    } else if (opcao == 1) {
        btn.addClass("btn-success");
        spn.text("Aprovado");
        inputOperacoes.val(inputOperacoes.val() + "," + operacao + ",");
    } else if (opcao == 2) {
        btn.addClass("btn-danger");
        spn.text("Rejeitado");
        inputOperacoes.val(inputOperacoes.val() + "," + operacao + ",");
    }
    inputOperacoes.val(inputOperacoes.val().replace(",,", ","));
    input.val(opcao);
    controlaSituacao(opcaoAtual, opcao, valorBruto, valorCusto, valorLiquido);
});


$('#btnReloadForm').click(function () {
    var transacaoValue = $("#btnReloadForm").attr("data-transacao");
    var dtmvto = $("#dataMvto").val();
    redirectPost('../../form-lcto-antecip-analise-det.php', {transacao: transacaoValue, dtmvto: dtmvto});
});


function controlaSituacao(atual, newOpcao, valorBruto, valorCusto, valorLiquido) {
    if (atual != newOpcao) {
        var spnCountAprovadas = $('#spnCountAprovadas');
        var spnCountRejeitadas = $('#spnCountRejeitadas');
        var spnValorBruto = $('#spnValorBruto');
        var spnValorDesc = $('#spnValorDesc');
        var spnValorLiquido = $('#spnValorLiquido');
        var countAprovadas = Number.parseInt(spnCountAprovadas.html());
        var countRejeitadas = Number.parseInt(spnCountRejeitadas.html());
        var vlBrutoAtual = parseValor(spnValorBruto.html());
        var vlDescAtual = parseValor(spnValorDesc.html());
        var vlLiquidoAtual = parseValor(spnValorLiquido.html());
        if (atual != 9) {
            if (atual == 1) {
                countAprovadas = countAprovadas - 1;
                spnValorBruto.html(formatFloatToStr(vlBrutoAtual - valorBruto));
                spnValorDesc.html(formatFloatToStr(vlDescAtual - valorCusto));
                spnValorLiquido.html(formatFloatToStr(vlLiquidoAtual - valorLiquido));
            } else if (atual == 2) {
                countRejeitadas = countRejeitadas - 1;
            }
        }
        if (newOpcao == 1) {
            countAprovadas = countAprovadas + 1;
            spnValorBruto.html(formatFloatToStr(vlBrutoAtual + valorBruto));
            spnValorDesc.html(formatFloatToStr(vlDescAtual + valorCusto));
            spnValorLiquido.html(formatFloatToStr(vlLiquidoAtual + valorLiquido));
        } else if (newOpcao == 2) {
            countRejeitadas = countRejeitadas + 1;
        }
        spnCountAprovadas.html(countAprovadas.toString());
        spnCountRejeitadas.html(countRejeitadas.toString());

        $('#numOcorrencias').val((countAprovadas + countRejeitadas).toString());
        $('#numAprovados').val((countAprovadas).toString());
        $('#numRejeitados').val((countRejeitadas).toString());
        $('#valorRepasse').val(formatFloatToStr(vlLiquidoAtual + valorLiquido));
        $('#valorMvto').val(formatFloatToStr(vlBrutoAtual + valorBruto));
        if (countAprovadas + countRejeitadas > 0) {
            $('#divBtnSubmit').show();
        } else {
            $('#divBtnSubmit').hide();
        }
    }
}

function getOpcaoAtual(text) {
    if (text == "Aprovado") {
        return 1;
    } else if (text == "Rejeitado") {
        return 2;
    }
    return 9;
}

function parseValor(strValue) {
    var valorAtual = 0.00;
    if (strValue != null && strValue != "") {
        strValue = strValue.replace("R$ ", "");
        strValue = strValue.replace("R$&nbsp;", "");
        strValue = strValue.replace(".", "");
        strValue = strValue.replace(",", ".");
        valorAtual = parseFloat(strValue);
        if (valorAtual == NaN) {
            valorAtual = 0.00;
        }
    }
    return valorAtual;
}
