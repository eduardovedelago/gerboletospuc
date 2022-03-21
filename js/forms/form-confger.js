$( function() {

    window.onload = function () {
        form_execute_Load_ConfGer();
    }
});


$("#btnCancelarConfGer").on('click', function(){
   form_execute_Load_ConfGer();
});


function form_execute_Load_ConfGer()  {
    var tagInputs = "#ed_";
    form_func_execute_LoadDadosInputs(1, wUrlCtrl, tagInputs);
};


function form_func_execute_LoadDadosInputs(wPrimariKey, wURL, wTagInputsName) {
    var codigo = 1;
    $("#action-form-cadastro").val("edit");
    $("#codigo-form-cadastro").val(codigo);
    $('form').loadingModal({text: 'Aguarde, Carregando Configuração...'}).loadingModal('animation', 'foldingCube');
    $.ajax({
        type: "POST",
        url: wURL,
        data: ({
            action: "findEntidade",//Execute Find Da Entidade para efetuar o Load dos dados nos Edits
            primarikey: wPrimariKey
        }),
        dataType: "html",
        success: function (data) {
            $("#action-form-cadastro").val("insert");
            $("#codigo-form-cadastro").val("0");
            console.log(data);
            if (data != null && data != "") {
                if (data.toString().toLowerCase().indexOf("erro:") <= 0) {
                    $("#action-form-cadastro").val("edit");
                    $("#codigo-form-cadastro").val(codigo);
                    var json = JSON.parse(data);
                    for (var k in json) {
                        var fieldName = wTagInputsName + k;
                        if ($(fieldName).is("input[type='radio']")) {//Parse para Radio Buttons
                            if (json[k]!= null && json[k] != "") {
                                $(fieldName+ "[value=" + json[k] + "]").attr("checked","checked")
                            }
                        } else if ($(fieldName).is("input[type='date']")) {
                            if (json[k]!= null && json[k] != "") {
                                $(fieldName).val(new Date(json[k].date).toDateInputValue());
                            } else {
                                $(fieldName).val("00-00-00");
                            }
                        } else {
                            $(fieldName).val(json[k]);
                        }
                    }
                } else {
                    avisoErro("Falha ao Carregar dados,  " + data, null);
                }
            } else {
                avisoErro("Falha ao Carregar dados", null);
            }
            $('form').loadingModal('hide');
            $('form').loadingModal('destroy')
        },
        error: function (xhr, status, error) {
            avisoErro("Falha ao Carregar dados", null);
            console.debug(xhr.message)
            console.debug(error)
            $("#action-form-cadastro").val("insert");
            $("#codigo-form-cadastro").val("0");
            $('form').loadingModal('hide');
            $('form').loadingModal('destroy')
        }
    });
}