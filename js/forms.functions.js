/* -----------------------------------------------------------
 *  QUALQUER ALTERAÇÃO NESTE JS AFETA TODOS OS FORMULÁRIOS DE
 *  CADASTRO, CUIDADO PFV
 -----------------------------------------------------------*/

function form_func_execute_submit(wURL, wData, wRedirect, wModalName) {
    $.ajax({
        type: 'post',
        url: wURL,
        data: wData,
        beforeSend: function () {
        },
        success: function (retornoAjax) {
            form_func_execute_CloseModal(wModalName);
            if (retornoAjax == null || retornoAjax == "" || retornoAjax == "success") {
                aviso("Dados Gravados Com Sucesso", wRedirect);
            } else {
                avisoErro("Falha ao Gravar Dados <br>" + retornoAjax, null);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            avisoErro("Falha ao Gravar Dados " + textStatus, wRedirect);
        }
    });
}


function form_func_execute_LoadDadosInputs(wPrimariKey, wURL, wTagInputsName, wModalName) {
    $.ajax({
        type: "POST",
        url: wURL,
        data: ({
            action: "findEntidade",//Execute Find Da Entidade para efetuar o Load dos dados nos Edits
            primarikey: wPrimariKey
        }),
        dataType: "html",
        success: function (data) {
            console.log(data);
            if (data != null && data != "") {
                if (data.toString().toLowerCase().indexOf("erro:") <= 0) {
                    var json = JSON.parse(data);
                    for (var k in json) {
                        var fieldName = wTagInputsName + k;
                        if ($(fieldName).is("input[type='radio']")) {//Parse para Radio Buttons
                            if (json[k]!= null && json[k] != "") {
                                $(fieldName+ "[value=" + json[k] + "]").attr("checked","checked")
                            }
                        } else if ($(fieldName).is("input[type='date']")) {
                            if (json[k] != null && json[k] != "") {
                                $(fieldName).val(new Date(json[k].date).toDateInputValue());
                            } else {
                                $(fieldName).val("00-00-00");
                            }
                        } else {
                            $(fieldName).val(json[k]);
                        }
                    }
                    form_func_execute_ShowModal(wModalName);
                } else {
                    avisoErro("Falha ao Carregar dados para Edição,  " + data, null);
                }
            } else {
                avisoErro("Falha ao Carregar dados para Edição", null);
            }
        },
        error: function (xhr, status, error) {
            avisoErro("Falha ao Carregar dados para Edição", null);
            console.debug(xhr.message)
            console.debug(error)
        }
    });
}


function form_func_execute_Delete(codigo, controller) {
    var wURL = "controller/" + controller + "-ctrl.php";
    var wRedirect = controller + ".php";
    $.ajax({
        url: wURL,
        type: "POST",
        data: ({
            action: "delete",
            primarikey: codigo
        }),
        dataType: "html",
        success: function (retornoAjax) {
            console.log(wRedirect);
            if (retornoAjax != null && retornoAjax != "" && retornoAjax != "success") {
                if (retornoAjax != null) {
                    avisoErro("Falha efetuar exclusão " + retornoAjax, wRedirect);
                } else {
                    avisoErro("Falha efetuar exclusão", wRedirect);
                }
            } else {
                window.location.reload();
            }
        },
        error: function (xhr, status, error) {
            avisoErro("Falha efetuar exclusão " + status + "<br>" + error, wRedirect);
        }
    });
}


function form_func_execute_ShowModal(wModalName) {
    $(wModalName).modal('toggle');
}

function form_func_execute_CloseModal(wModalName) {
    $(wModalName).modal("hide");
}


//Insert or Update Data
$('form, #form-cadastro').not('.nsubmit').bind('submit', function () {
    var data = $('form').serialize();
    form_func_execute_submit(wUrlCtrl, data, "../" + wClassCtrl + ".php", "#modalCadastro");
    return false;
});

//Insert or Update Data
$('.nsubmit').bind('submit', function () {
    $('$frmModalRelFin').submit();
    return false;
});

$('[name="btnEdit"]').on('click', function (e) {
    if ($(this) != null) {
        var codigo = $(this).attr("data");
        if (codigo > 0) {
            $("#action-form-cadastro").val("edit");
            $("#codigo-form-cadastro").val(codigo);
            var tagInputs = "#ed_";
            form_func_execute_LoadDadosInputs(codigo, wUrlCtrl, tagInputs, "#modalCadastro");
        }
    }
});

$('[name="btnDelete"]').on('click', function (e) {
    if ($(this) != null) {
        var codigo = $(this).attr("data");
        if (codigo > 0) {
            var controller = wClassCtrl
            var wStrFuncao = "form_func_execute_Delete(" + String(+codigo + ",'" + controller + "'").replace(" ", "a") + ")";
            confirmar("Confirma Exclusão dos dados", null, null, wStrFuncao, null);
        }
    }
});

