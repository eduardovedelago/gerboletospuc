$(function () {

    var wUrlCtrl = "../../controller/login-ctrl.php";

    $("#form-login").validate({
        // Rules for form validation
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 3,
                maxlength: 20
            }
        },
        // Messages for form validation
        messages: {
            email: {
                required: 'Favor Informar um E-Mail',
                email: 'E-Mail Informado é inválido'
            },
            password: {
                required: 'Favor Informar sua Senha',
                minlength: 'Favor Informar no Minimo 3 Caracteres'
            }
        },
        // Do not change code below
        errorPlacement: function (error, element) {
            error.insertAfter(element.parent());
        }
    });
    $("#form-login").bind('submit', function () {
        //$('#btnLogin').on('click', function (e) {
        var data = $('#form-login').serialize();
        if ($(this) != null) {
            $.ajax({
                type: 'post',
                url: wUrlCtrl,
                data: data,
                dataType: "html",
                beforeSend:
                    function () {
                    }
                , success: function (retornoAjax) {
                    if (retornoAjax == null || retornoAjax == "" || retornoAjax == "success") {
                        window.location = "index.php";
                    } else {
                        avisoErro(retornoAjax, null);
                    }
                }
                , error: function (jqXHR, textStatus, errorThrown) {
                    avisoErro("Falha ao Efetuar Login " + textStatus, "login.php");
                }
            });
        }
        return false;
    });
});