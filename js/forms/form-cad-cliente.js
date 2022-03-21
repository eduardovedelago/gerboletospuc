$(function () {

    /* -----------------------------------------------------------
    * #### Funções Especificas do formulário, Alterar Conforme necessidade
    * -----------------------------------------------------------*/

    $('[name="edCelular"]').focusout(function () {
        var phone, element;
        element = $(this);
        element.unmask();
        phone = element.val().replace(/\D/g, '');
        if (phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    }).trigger('focusout');

    $('[name="edTipo"]').on('click', function (e) {
        if ($(this) != null) {
            var dataValue = this.attributes["value"];
            if ((dataValue != null) && (dataValue.value != null)) {
                if (dataValue.value == "F") {
                    $('[name="edCnpjCpf"]').mask("999.999.999-99");
                    $('[name="edRazaoSocial"]').val("");
                    $('[name="edRazaoSocial"]').prop('disabled', true);
                    // $('[name="lbl_edRazaoSocial"]').hide();
                }
                else if (dataValue.value == "J") {
                    $('[name="edCnpjCpf"]').mask("99.999.999/9999-99");
                    $('[name="edRazaoSocial"]').prop('disabled', false);
                    // $('[name="lbl_edRazaoSocial"]').show();

                }
            }
        }
    });

    $(document).ready(function () {

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#ed_endereco").val("");
            $("#ed_enderecobairro").val("");
        }

        //Quando o campo cep perde o foco.
        $("#ed_cep").blur(function () {

            if (($('#action-form-cadastro').val()).toUpperCase()!='EDIT') {
                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if (validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#ed_endereco").val("...");
                        $("#ed_enderecobairro").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#ed_endereco").val(dados.logradouro);
                                $("#ed_enderecobairro").val(dados.bairro);
                                $.getJSON(window.location.protocol + '//' + window.location.host + '/controller/form-cad-municipios-ctrl.php', {
                                    'nome': dados.localidade,
                                    'uf': dados.uf
                                }, function (municipio) {
                                    if (!("erro" in municipio)) {
                                        if (municipio != null) {
                                            var codigoMuni = municipio.codigo;
                                            if (codigoMuni > 0) {
                                                $("#ed_municipio").val(codigoMuni).change();
                                            }
                                        }
                                    }
                                });
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            }
        });
    });

});