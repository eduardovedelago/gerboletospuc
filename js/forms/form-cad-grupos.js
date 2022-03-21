$(function () {

    /* -----------------------------------------------------------
    * #### Funções Especificas do formulário, Alterar Conforme necessidade
    * -----------------------------------------------------------*/

    $('.treeview input[type="checkbox"]').change(checkboxChanged);

    function checkboxChanged() {
        var $this = $(this),
            checked = $this.prop("checked"),
            container = $this.parent(),
            siblings = container.siblings();

        container.find('input[type="checkbox"]')
            .prop({
                indeterminate: false,
                checked: checked
            })
            .siblings('label')
            .removeClass('custom-checked custom-unchecked custom-indeterminate')
            .addClass(checked ? 'custom-checked' : 'custom-unchecked');

        checkSiblings(container, checked);
    }

    function checkSiblings($el, checked) {
        var parent = $el.parent().parent(),
            all = true,
            indeterminate = false;

        $el.siblings().each(function () {
            return all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);
        });

        if (all && checked) {
            parent.children('input[type="checkbox"]')
                .prop({
                    indeterminate: false,
                    checked: checked
                })
                .siblings('label')
                .removeClass('custom-checked custom-unchecked custom-indeterminate')
                .addClass(checked ? 'custom-checked' : 'custom-unchecked');

            checkSiblings(parent, checked);
        } else if (all && !checked) {
            indeterminate = parent.find('input[type="checkbox"]:checked').length > 0;

            parent.children('input[type="checkbox"]')
                .prop("checked", checked)
                .prop("indeterminate", indeterminate)
                .siblings('label')
                .removeClass('custom-checked custom-unchecked custom-indeterminate')
                .addClass(indeterminate ? 'custom-indeterminate' : (checked ? 'custom-checked' : 'custom-unchecked'));

            checkSiblings(parent, checked);
        } else {
            $el.parents("li").children('input[type="checkbox"]')
                .prop({
                    indeterminate: true,
                    checked: true
                })
                .siblings('label')
                .removeClass('custom-checked custom-unchecked custom-indeterminate')
                .addClass('custom-indeterminate');
        }
    }

    $('#btnSaveAcessos').on('click', function (e) {
        if ($(this) != null) {
            var codigo = $(this).attr("data");
            if (codigo > 0) {
                var wacessos = "N".repeat(2000);
                $('[name="treeAcessos"]').each(function (index, item) {
                    var object = $(this);
                    var codAcess = parseInt(object.attr("id").trim());
                    if (object.prop("checked")) {
                        wacessos = wacessos.replaceAt(codAcess - 1, "S");
                    }
                });
                $.ajax({
                    type: 'post',
                    url: wUrlCtrl,
                    data: ({
                        action: "updateAcessos",
                        primarikey: codigo,
                        acessos: wacessos
                    }),
                    dataType: "html",
                    beforeSend: function () {
                    },
                    success: function (retornoAjax) {
                        if (retornoAjax == null || retornoAjax == "" || retornoAjax == "success") {
                            aviso("Acessos Gravados com Sucesso", wClassCtrl + ".php");
                        } else {
                            avisoErro("Falha ao Gravar Dados <br>" + retornoAjax, null);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        avisoErro("Falha ao Gravar Dados " + textStatus, wClassCtrl + ".php");
                    }
                });
            }
        }
    });

    $('[name="btnEditAcessos"]').on('click', function (e) {
        if ($(this) != null) {
            var codigo = $(this).attr("data");
            $("#btnSaveAcessos").attr("data", codigo);
            var acessos = $(this).attr("acessos");
            if (codigo > 0) {
                form_func_execute_ShowModal("#modalAcessos");
                $('[name="treeAcessos"]').each(function (index, item) {
                    var object = $(this);
                    var codAcess = parseInt(object.attr("id").trim());
                    if (acessos.charAt(codAcess - 1) == "S") {
                        object.prop("checked", true);
                    } else {
                        object.prop("checked", false);
                    }
                });
            }
        }
    });

});