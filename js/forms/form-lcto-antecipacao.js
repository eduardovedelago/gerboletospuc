var files = [];
var countFiles = 0;

$('[name="chkAntecipar"]').click(function () {
    if ($(this).is(':checked')) {
        executeCheckAntecipar($(this))
    } else {
        executeUnCheckAntecipar($(this))
    }
});

$('.anexar').click(function () {
    files = [];
    countFiles = 0;
    $(".list-files").html("")
    $('#transcaoUpload').val($(this).attr("data-transacao"));
    form_func_execute_ShowModal('#modalUpload');
});

$('#form-antecipacao').bind('submit', function () {
    var data = $('#form-antecipacao').serialize();

    var wURL = wUrlCtrl;
    var wData = data;
    var wRedirect = "../../form-lcto-antecip.php";
    var wModalName = "#modalCadastro";

    $.ajax({
        type: 'post',
        url: wURL,
        data: wData,
        beforeSend: function () {
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
                    window.location.href = '../../form-lcto-antecip.php';
                }, 1500);
                $(wModalName).modal("hide");
            } else {
                $(wModalName).modal("hide");
                $.bigBox({
                    title: "Gravação de Dados",
                    content: "Falha ao Gravar dados \n\r" + retornoAjax,
                    color: "#C46A69",
                    timeout: 3000,
                    icon: "fa fa-warning shake animated",
                    number: ""
                });
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $(wModalName).modal("hide");
            avisoErro("Falha ao Gravar Dados " + textStatus, wRedirect);
        }
    });
    return false;
});


function executeCheckAntecipar(checkbox) {
    var spnCountAntecipar = $('#spnCountAntecipar');
    var spnValorBruto = $('#spnValorBruto');
    var spnValorPrevisto = $('#spnValorPrevisto');
    var spnDataPrev = $('#spnDataPrev');
    var lblOperacoes = $('#operacoes-form-cadastro');

    var dt = new Date();
    dt.setDate(dt.getDate() + 2);
    spnDataPrev.html(dt.toLocaleDateString());

    var i = Number.parseInt(spnCountAntecipar.html());
    i = i + 1;
    spnCountAntecipar.html(i.toString());
    controlaFooter(i);

    var operacao = checkbox.attr("data-key");
    var valor = parseFloat(checkbox.attr("data-valor"));
    var valorPrev = parseFloat(checkbox.attr("data-prev"));
    var valorAtual = parseValor(spnValorBruto.html());
    var valorPrevAtual = parseValor(spnValorPrevisto.html());

    var valorBruto = valorAtual + valor;
    var valorLiquido = valorPrevAtual + valorPrev;
    setValueModais(valorBruto, valorLiquido);

    spnValorBruto.html(formatFloatToStr(valorBruto));
    spnValorPrevisto.html(formatFloatToStr(valorLiquido));
    lblOperacoes.val(lblOperacoes.val() + "," + operacao + ",");
    lblOperacoes.val(lblOperacoes.val().replace(",,", ","));
}

function executeUnCheckAntecipar(checkbox) {
    var spnCountAntecipar = $('#spnCountAntecipar');
    var spnValorBruto = $('#spnValorBruto');
    var spnValorPrevisto = $('#spnValorPrevisto');
    var lblOperacoes = $('#operacoes-form-cadastro');

    var i = Number.parseInt(spnCountAntecipar.html());
    i = i - 1;
    spnCountAntecipar.html(i.toString());
    controlaFooter(i);

    var operacao = checkbox.attr("data-key")
    var valor = parseFloat(checkbox.attr("data-valor"));
    var valorPrev = parseFloat(checkbox.attr("data-prev"));
    var valorAtual = parseValor(spnValorBruto.html());
    var valorPrevAtual = parseValor(spnValorPrevisto.html());

    var valorBruto = valorAtual - valor;
    var valorLiquido = valorPrevAtual - valorPrev;
    setValueModais(valorBruto, valorLiquido);

    spnValorBruto.html(formatFloatToStr(valorBruto));
    spnValorPrevisto.html(formatFloatToStr(valorLiquido));
    lblOperacoes.val(lblOperacoes.val().replace(operacao, ""))
    lblOperacoes.val(lblOperacoes.val().replace(",,", ","));
}

function setValueModais(valorBruto, valorPrev) {
    $('#edValorBruto').val(formatFloatToStr(valorBruto));
    $('#edValorPrev').val(formatFloatToStr(valorPrev));
    $('#edDataPrev').val($('#spnDataPrev').html());
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


function form_func_execute_ShowModal(wModalName) {
    $(wModalName).modal('toggle');
}


function form_func_execute_CloseModal(wModalName) {
    $(wModalName).modal("hide");
}

function controlaFooter(countMvtos) {
    if (countMvtos <= 0) {
        $('#footer-antecip-totais').hide();
    } else {
        $('#footer-antecip-totais').show();
    }
}

//Init
function handleFileSelect(evt, ffff) {
    var template = "";
    $.each(ffff, function (index, file) {
        countFiles = countFiles + 1;
        file.countFile = countFiles;
        template = template +
            "<div id=\"file--" + file.countFile + "\" class=\"file file--" + file.countFile + "\">\n     " +
            "   <div class=\"name\">" +
            "      <span>" + file.name + "</span>" +
            "   </div>\n     " +
            "   <div class=\"progress active\"></div>\n     " +
            "   <div class=\"done\">\n\t<a href=\"\" target=\"_blank\">\n      " +
            "      <svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" version=\"1.1\" x=\"0px\" y=\"0px\" viewBox=\"0 0 1000 1000\">\n\t\t<g>" +
            "      <path id=\"path\" d=\"M500,10C229.4,10,10,229.4,10,500c0,270.6,219.4,490,490,490c270.6,0,490-219.4,490-490C990,229.4,770.6,10,500,10z M500,967.7C241.7,967.7,32.3,758.3,32.3,500C32.3,241.7,241.7,32.3,500,32.3c258.3,0,467.7,209.4,467.7,467.7C967.7,758.3,758.3,967.7,500,967.7z M748.4,325L448,623.1L301.6,477.9c-4.4-4.3-11.4-4.3-15.8,0c-4.4,4.3-4.4,11.3,0,15.6l151.2,150c0.5,1.3,1.4,2.6,2.5,3.7c4.4,4.3,11.4,4.3,15.8,0l308.9-306.5c4.4-4.3,4.4-11.3,0-15.6C759.8,320.7,752.7,320.7,748.4,325z\"</g>\n\t\t</svg>\n\t\t\t\t\t\t</a>\n     " +
            "   </div>\n    " +
            "</div>";
    });

    $("#drop").hide();
    $("#footerUpload").addClass("hasFiles");
    $(".list-files").html($(".list-files").html() + template);

    function controlaStatusUploadFile(strfile, ok) {
        setTimeout(function () {
            $(strfile).find('.progress').removeClass("active");
            if (ok) {
                $(strfile).find('.done').addClass("anim");
            }
        }, 500);
    }

    $.each(ffff, function (index, file) {
        var form;
        form = new FormData();
        //form.append('fileUpload', file);
        form.append('action', "UPLOAD_FILE");
        form.append("upload_file", true);
        form.append("transacao", $('#transcaoUpload').val());
        form.append("file", file, file.name);
        //var name = event.target.files[0].content.name; // para capturar o nome do arquivo com sua extenção

        $.ajax({
            url: "../../controller/form-lcto-antecipacao-ctrl.php",
            data: form,
            processData: false,
            contentType: false,
            type: 'POST',
            beforeSend: function () {
            },
            success: function (data) {
                if (data == "OK") {
                    controlaStatusUploadFile("#file--" + file.countFile, true);
                } else {
                    controlaStatusUploadFile("#file--" + file.countFile, false);
                    avisoErro("Falha ao Realizar Upload do aqruivo:  " + file.name);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                controlaStatusUploadFile("#file--" + file.countFile, false);
                avisoErro("Falha ao Realizar Upload do aqruivo " + textStatus, wRedirect);
            }
        });
    });
}

// trigger input
$("#triggerFile").click(function (evt) {
    evt.preventDefault();
    evt.stopPropagation();
    $("input[type=file]").click();
});

$('#modalUpload').on('hidden.bs.modal', function () {
    reloadExitModalUpload();
});
$('#modalUpload').on('hidden', function () {
    reloadExitModalUpload();
});

function reloadExitModalUpload() {
    if (files.length > 0) {
        location.reload();
        files = [];
        $(".importar").removeClass("active");
    }
}

// drop events
// $("#upload-files").on("dragleave", function (evt) {
//     $("#drop").hide();
//     evt.preventDefault();
//     evt.stopPropagation();
// });

'use strict';

(function ($, window, document, undefined) {

    var $form = $(this);
    $form
        .on('drag dragstart dragend dragover dragenter dragleave drop', function (e) {
            e.preventDefault();
            e.stopPropagation();
        })
        .on("dragover", function (evt) {
            $("#drop").hide();
        })
        .on("drop", function (evt) {
            executeDropFileFunc(evt, false);
        });
    $("#drop").on("dragleave", function (evt) {
        $("#drop").show();
    });


// input change
    $("#edFileAntecip").on("change", function (evt) {
        executeDropFileFunc(evt, true);
        evt.preventDefault();
        evt.stopPropagation();
    });

    $(".importar").on("click", function () {

        form_func_execute_CloseModal("#modalUpload");
    });

    function executeDropFileFunc(evt, onChange) {
        var ff = null;
        if (onChange) {
            var ff = $('#edFileAntecip')[0].files;
        } else {
            var ff = evt.originalEvent.dataTransfer.files;
        }
        $.each(ff, function (index, fFile) {
            files.push(fFile);
        });
        //$("input[type=file]").files = files;
        $("#footerUpload").addClass("hasFiles");
        $("#drop").hide();
        if (onChange) {
            handleFileSelect(evt, $('#edFileAntecip')[0].files);
        } else {
            handleFileSelect(evt, evt.originalEvent.dataTransfer.files);
        }
        $(".importar").addClass("active");
    }

})(jQuery, window, document);