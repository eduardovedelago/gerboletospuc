$(document).ready(function() {
    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
});

var files = [];

// Add events
$('input[type=file]').on('change', prepareUpload);

function prepareUpload(event) {
    $.each(event.target.files,function(index,fFile){
        files.push(fFile);
    });
}


var inputs = document.querySelectorAll( '.inputfile' );
Array.prototype.forEach.call( inputs, function( input )
{
    var label	 = input.nextElementSibling,
        labelVal = label.innerHTML;

    input.addEventListener( 'change', function( e )
    {
        var fileName = '';
        var fileNamesList = '';
        if( files && files.length > 1 )
            fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', files.length );
        else
            fileName = e.target.value.split( '\\' ).pop();

        if( fileName ) {
            label.querySelector('span').innerHTML = fileName;
        }else {
            label.innerHTML = labelVal;
        }
        $.each(files, function(i,ff){
            fileNamesList += ''+ff.name+'<br>';
        });
        $('.filesName').html( fileNamesList);
        if (files.length>1) {
            $(".filesName").show()
        } else {
            $(".filesName").hide();
        }
    });
});

$('#wizard-1').bind('submit', uploadFiles);


function uploadFiles(event) {
    event.stopPropagation();
    event.preventDefault();

    var wURL = "/controller/" + wClassCtrl + "-ctrl.php";
    var formData = new FormData();
    $.each(files, function (key, value) {
        formData.append(key, value);
    });
    var wData = $('form').serializeArray();
    $.each(wData, function (key, field) {
        formData.append(field.name, field.value);
    });


    $.ajax({
        type: 'post',
        url: wURL,
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $('body').loadingModal({text: 'Aguarde, Gerando Movimento...'}).loadingModal('animation', 'foldingCube');
        },
        success: function (retornoAjax) {
            if (retornoAjax == null || retornoAjax == "" || retornoAjax.substr(0,7) == "success") {
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
                    window.location.href = 'form-print-pendfin.php?transacao='+retornoAjax.substr(8);
                }, 1500);
                files.clear();
                $('body').loadingModal('hide');
                $('body').loadingModal('destroy')
            } else {
                $.bigBox({
                    title: "Gravação de Dados",
                    content: "Falha ao Gravar dados \n\r" + retornoAjax,
                    color: "#C46A69",
                    timeout: 3000,
                    icon: "fa fa-warning shake animated",
                    number: ""
                });
                $('body').loadingModal('hide');
                $('body').loadingModal('destroy')
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $.bigBox({
                title: "Gravação de Dados",
                content: "Falha ao Gravar dados \n\r" + textStatus,
                color: "#C46A69",
                timeout: 3000,
                icon: "fa fa-warning shake animated",
                number: ""
            });
            $('body').loadingModal('hide');
            $('body').loadingModal('destroy')
        }
    });
}

$(function () {

    /* -----------------------------------------------------------
    * #### Funções Especificas do formulário, Alterar Conforme necessidade
    * -----------------------------------------------------------*/

    //$('.toggle').bootstrapToggle();

    $("#ed_clie_codigo").selectpicker();

    $('#pfin_statusantecipacao').click(function () {
        if ($('#pfin_statusantecipacao').is(':checked')) {
            $('#fsSelectFiles').show();
        } else {
            $('#fsSelectFiles').hide();
        }
    });

    var dtNow = new Date();

    var edDataMvto = $("#ed_pfin_datamvto");
    edDataMvto.val(dtNow.toDateInputValue());

    // dtNow.setDate(dtNow.getDate() + 1);
    // var edDataVcto = $("#ed_pfin_datavcto");
    // edDataVcto.val(dtNow.toDateInputValue());

    //var dtVcto = $("#ed_pfin_datavcto");
    // var tomorrow = new Date();
    // tomorrow.setDate(tomorrow.getDate() + 1);
    // $("#ed_pfin_datavcto").val(tomorrow.toDateInputValue());

    $(document).ready(function () {

        $.validator.addMethod(
            "validaParcelasValor",
            function (a, b) {
                var vlParc = getTotalInformadoParcelas();
                var valorTotal = parseFloat($('#ed_pfin_valor').val().replace('.', '').replace(',', '.'));                
                return vlParc == valorTotal;
            },
            "Valor Informado nas Parcelas Diferente do Valor do Movimento"
        );

        var $validator = $("#wizard-1").validate({

            rules: {
                edCliente: {
                    required: true
                },
                ed_pfin_valor: {
                    required: true
                },
                ed_pfin_datamvto: {
                    required: true
                },
                ed_pfin_datavcto: {
                    required: true
                },
                ed_pfin_observacao: {
                    required: true
                },
                ed_pfin_numeroDcto: {
                    required: true
                },
                ed_parc_diferenca: {
                    validaParcelasValor: true
                }
            },

            messages: {
                edCliente: "Cliente Inválido",
                ed_pfin_valor: "Valor Inválido",
                ed_pfin_datamvto: "Data de Movimento Inválida",
                ed_pfin_datavcto: "Vencimento Inválido",
                ed_pfin_observacao: "Descrição Inválida",
                ed_pfin_numeroDcto: "Número do Documento Inválido"
            },

            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });

        $('#bootstrap-wizard-1').bootstrapWizard({
            'tabClass': 'form-wizard',
            'onNext': function (tab, navigation, index) {
                var $valid = $("#wizard-1").valid();
                if (!$valid) {
                    $validator.focusInvalid();
                    return false;
                } else {
                    $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).addClass(
                        'complete');
                    $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).find('.step')
                        .html('<i class="fa fa-check"></i>');
                    if (index == 2) {
                        if ($('#ed_pfin_parcela').val() == 1) {
                            $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(2).addClass(
                                'complete');
                            $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(2).find('.step')
                                .html('<i class="fa fa-check"></i>');
                            $('#bootstrap-wizard-1').bootstrapWizard('show', 2);
                            MontaResumo();
                            ControlaBotoesFinalizar(true);
                        } else {
                            MontaParcelamento();
                        }
                    } else if (index == 3) {
                        MontaResumo();                        
                        ControlaBotoesFinalizar(true);
                    }                                    
                }
            },
            'onPrevious': function (tab, navigation, index) {
                if (index==3){
                    ControlaBotoesFinalizar(true);
                }  else {
                    ControlaBotoesFinalizar(false);
                }
                //alert(index);
                if (index == 2) {
                    if ($('#ed_pfin_parcela').val() == 1) {
                        $('#bootstrap-wizard-1').bootstrapWizard('show', 2);
                        $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(2).removeClass();
                        $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(2).find('.step')
                            .html('3');
                    }
                }
            },
            onTabClick: function (tab, navigation, index) {
                 avisoErro("Operação Não Permitida, Preencha as Informações e Click em Prosseguir")
                 return false;
            }
        });        

        // fuelux wizard
        var wizard = $('.wizard').wizard();

        $('#bootstrap-wizard-1 .finish').click(function () {

            var dataForm = $('form').serialize();

            $.ajax({
                type: 'post',
                url: '../controller/form-lcto-pendfin-ctrl.php',
                data: dataForm,
                beforeSend: function () {
                },
                success: function (retornoAjax) {
                    //form_func_execute_CloseModal(wModalName);
                    if (retornoAjax == null || retornoAjax == "" || retornoAjax == "success") {

                        $.bigBox({
                            title: "Gravação de Dados",
                            content: "Transação Gravada com sucesso!",
                            color: "#5F895F",
                            timeout: 3000,
                            icon: "fa fa-check bounce animated",
                            number: "001391239933"
                        });
                        setTimeout(function () {
                            window.location.reload(1);
                        }, 3000);
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
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $.bigBox({
                        title: "Gravação de Dados",
                        content: "Falha ao Gravar dados \n\r" + textStatus,
                        color: "#C46A69",
                        timeout: 3000,
                        icon: "fa fa-warning shake animated",
                        number: ""
                    });

                }
            });
        });
    });

    $('.selectpicker').change(function (e) {
        //alert(e.target.value);
        $.getJSON(window.location.protocol + '//' + window.location.host + '/controller/form-cad-cliente-ctrl.php', {
            'action': 'findEntidade',
            'primarikey': e.target.value
        }, function (result) {
            if (!("erro" in result)) {
                $("#ed_clie_nome").val(result.nome);
                $("#ed_clie_cnpjcpf").val(result.cnpjCpf);
                $("#ed_clie_email").val(result.email);
                if (result.tipo == "J") {
                    $("#div_clie_razaosocial").show();
                    $("#ed_clie_razaosocial").val(result.razaoSocial);
                } else {
                    $("#div_clie_razaosocial").hide();
                    $("#ed_clie_razaosocial").val("");
                }
            } else {
                alert('erro');
            }
        });
    });


    function getRowParcela(parcela, valor) {
        var str = '<div class="row">\n' +
            '<div class="col-sm-2">\n <div class="form-group">\n <div class="flex">\n' +
            '   <span class="dadosmvto fa fa-code-fork"></span>\n' +
            '      <input class="inputsPF" type="text" value="' + parcela + '" disabled/>\n' +
            '</div>\n </div>\n </div>\n' +
            '<div class="col-sm-4">\n <div class="form-group">\n <div class="flex">\n' +
            '   <span class="dadosmvto">R$</span>\n' +
            '     <input class="eventValor padding-7 align-right-txt inputsPF" id="ed_parcela_' + parcela + '" value="' + valor + '" name="ed_parcela_' + parcela + '" type="text" maxlength="15"/>\n' +
            '</div>\n </div>\n </div>\n' +
            '\n' +
            '<div class="col-sm-4">\n <div class="form-group">\n <div class="flex">\n' +
            '   <span class="dadosmvto fa fa-calendar"></span>\n' +
            '      <input class="inputsPF" id="ed_vcto_' + parcela + '"\n name="ed_vcto_' + parcela + '"\n type="date"/>\n' +
            '</div>\n </div>\n </div>\n' +
            '</div>';
        return str;
    }

    function getScriptParcelamento(strDataVcto, numParcelas) {
        var script = '<script>' +
            ' $(\'.eventValor\').on("keypress", function (ev) {\n' +
            '                        if (ev.keyCode < 48 || ev.keyCode > 57) {\n' +
            '                            ev.preventDefault();\n' +
            '                            return;\n' +
            '                        }\n' +
            '                    }\n' +
            '                );\n' +
            '\n' +
            '                $(\'.eventValor\').on("keyup", function (event) {\n' +
            '                    var selection = window.getSelection().toString();\n' +
            '                    if (selection !== \'\') {\n' +
            '                        return;\n' +
            '                    }\n' +
            '                    if ($.inArray(event.keyCode, [38, 40, 37, 39]) !== -1) {\n' +
            '                        return;\n' +
            '                    }\n' +
            '                    var $this = $(this);\n' +
            '                    var input = $this.val();\n' +
            '                    input = input.replace(\',\', \'\');\n' +
            '                    input = input.replace(\'.\', \'\');\n' +
            '                    input = formatReal(input);\n' +
            '                    //input = input ? parseInt(input, 10) : 0;\n' +
            '                    $this.val(function () {\n' +
            '                        return input;// === 0) ? "0,00" : input.toLocaleString("pt-BR");\n' +
            '                    });\n' +
            '                });\n' +
            '                \n';
        script = script + '</script>';
        return script;
    }

    function MontaResumo(){
        $('#tab5').find('label').each(function (e, a) {
            var nameOrigem = a.attributes["data-value"];
            if (nameOrigem != undefined) {
                var value = $("#" + nameOrigem.value).val();
                if (value != undefined) {
                    a.innerText = value;
                }
            }
        });
    }

    function ControlaBotoesFinalizar(show){
        if (show){
            $('#liSubmitFormFinalizar').show();
            $('#liSubmitFormNext').hide();
        }  else {
            $('#liSubmitFormFinalizar').hide();
            $('#liSubmitFormNext').show();
        }
    }

    function MontaParcelamento() {
        var numParcelas = parseInt($('#ed_pfin_parcela').val());
        var valorTotal = parseFloat($('#ed_pfin_valor').val().replace('.', '').replace(',', '.'));
        var strDataVcto = $('#ed_pfin_datavcto').val();

        var valorParcela = Math.round((parseFloat(valorTotal) / numParcelas) * 100) / 100;
        var lastParcela = Math.round((valorParcela + (valorTotal - (valorParcela * numParcelas))) * 100) / 100;
        var strHTML = "";
        $('#div_parcelas').empty();
        for (i = 0; i < numParcelas; i++) {
            if (i + 1 == numParcelas) {
                strHTML = strHTML + getRowParcela(i + 1, formatFloatToStr(lastParcela, true).toString().trim());
            } else {
                strHTML = strHTML + getRowParcela(i + 1, formatFloatToStr(valorParcela, true).toString().trim());
            }
        }
        strHTML = strHTML + getScriptParcelamento(strDataVcto, numParcelas);
        $('#div_parcelas').html(strHTML);
        $('#ed_parc_valortotal').val(formatFloatToStr(valorTotal, true));
        $('#ed_parc_valorinfo').val(formatFloatToStr(valorTotal, true));
        var dataVcto = new Date(strDataVcto);
        var edDataMvtoParc = null;
        for (i = 0; i < numParcelas; i++) {
            if (i > 0) {
                dataVcto = getProximaDataVctoMes(dataVcto);
            }
            var edName = 'ed_vcto_' + (i + 1);
            edDataMvtoParc = $("#" + edName);
            if (edDataMvtoParc != null) {
                edDataMvtoParc.val(dataVcto.toDateInputValue());
            }
        }

        $('.eventValor').on("keyup", function (ev, a) {
            CalculaInformadoDiferencaParcelas();
        });
    }

    function CalculaInformadoDiferencaParcelas() {
        var valorTotalInfo = getTotalInformadoParcelas();
        var valorTotal = parseFloat($('#ed_pfin_valor').val().replace('.', '').replace(',', '.'));
        $('#ed_parc_valorinfo').val(formatFloatToStr(valorTotalInfo, true));
        valorTotal = valorTotal - valorTotalInfo;
        $('#ed_parc_diferenca').val(formatFloatToStr(valorTotal, true));
    }

    function getTotalInformadoParcelas() {
        var valorTotalInfo = 0;
        var numParcelas = parseInt($('#ed_pfin_parcela').val());
        for (i = 0; i < numParcelas; i++) {
            var edName = '#ed_parcela_' + (i + 1);
            var strValor = $(edName).val().replace('.', '').replace(',', '.')
            var valueParsed = parseFloat(strValor);
            valueParsed = Math.round(valueParsed *100)/100;
            valorTotalInfo = valorTotalInfo + valueParsed;
        }
        if (valorTotalInfo > 0) {
            return Math.round(valorTotalInfo *100)/100 ;
        } else {
            return 0;
        }
    }

    $("input[type='text']").on("click", function () {
        $(this).select();
    });


});

