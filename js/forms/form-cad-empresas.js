$(function () {

    /* -----------------------------------------------------------
    * #### Funções Especificas do formulário, Alterar Conforme necessidade
    * -----------------------------------------------------------*/


    $('[name="btnConfig"]').on('click', function (e) {
        if ($(this) != null) {
            var codigo = $(this).attr("data");
            $("#btnSaveConfig").attr("data", codigo);
            if (codigo > 0) {
                var tagInputs = "#ed_";
                form_func_execute_LoadDadosInputs(codigo, wUrlCtrl, tagInputs, "#modalConfig"); //Executa Load dos Dados nos Edits
                //form_func_execute_ShowModal("#modalConfig");
            }
        }
    });

    $('#btnSaveConfig').on('click', function (e) {
        if ($(this) != null) {
            var codigo = $(this).attr("data");
            var serielizedForm = $('#form-config').serialize();
            serielizedForm = serielizedForm+'&action=updateConfig&primarikey='+codigo;
            if (codigo > 0) {
                $.ajax({
                        type: 'post',
                        url: wUrlCtrl,
                        data: serielizedForm,
                        dataType:
                            "html",
                        beforeSend:

                            function () {
                            }

                        ,
                        success: function (retornoAjax) {
                            if (retornoAjax == null || retornoAjax == "" || retornoAjax == "success") {
                                aviso("Configuração Gravada com Sucesso", wClassCtrl + ".php");
                            } else {
                                avisoErro("Falha ao Gravar Dados <br>" + retornoAjax, null);
                            }
                        }
                        ,
                        error: function (jqXHR, textStatus, errorThrown) {
                            avisoErro("Falha ao Gravar Dados " + textStatus, wClassCtrl + ".php");
                        }
                    }
                )
                ;
            }
        }
    })
    ;


})
;