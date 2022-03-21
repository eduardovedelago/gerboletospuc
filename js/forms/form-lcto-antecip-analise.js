$('.analisar').click(function (a, b) {
    var transacaoValue = $(this).attr("data-transacao");
    redirectPost('../../form-lcto-antecip-analise-det.php', {transacao: transacaoValue});
});
