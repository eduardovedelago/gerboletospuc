function aviso(msg, location) {

    function b() {
        if (location != null && location.toString().trim().length > 0) {
            window.location = location;
        }
    }

    var msg = $.SmartMessageBox({
        "title": "<i class='glyphicon glyphicon-info-sign txt-color-orangeDark'></i> Informações: <br> <span class='txt-color-orangeDark'><strong>" + "</strong></span>",
        "content": msg,
        "buttons": "[OK]"
    }, function (a) {
        if (location != null && location.toString().trim().length > 0) {
            ($.root_.addClass("animated fadeOutUp"), setTimeout(b, 1e3))
        }
    });
    msg;
}


function avisoErro(msg, location) {

    function b() {
        if (location != null && location.toString().trim().length > 0) {
            window.location = location;
        }
    }

    var msg = $.SmartMessageBox({
        "title": "<i class='glyphicon glyphicon-fire txt-color-orangeDark'></i> Aviso Erro: <br> <span class='txt-color-orangeDark'><strong>" + "</strong></span>",
        "content": msg,
        "buttons": "[OK]"
    }, function (a) {
        if (location != null && location.toString().trim().length > 0) {
            ($.root_.addClass("animated fadeOutUp"), setTimeout(b, 1e3))
        }
    });
    msg;
}


function confirmar(msg, locationSim, locationNao, jsSim, jsNao) {

    function lSim() {
        if (locationSim != null && locationSim.toString().trim().length > 0) {
            window.location = locationSim;
        }
    }

    function lNao() {
        if (locationNao != null && locationNao.toString().trim().length > 0) {
            window.location = locationNao;
        }
    }

    $.SmartMessageBox({
        "title": "<i class='fa fa-question-circle txt-color-orangeDark'></i> Confirmar? <br> <span class='txt-color-orangeDark'><strong>" + "</strong></span>",
        "content": msg,
        "buttons": "[Não][Sim]"
    }, function (a) {
        if ("Sim" == a) {
            if (jsSim != null && jsSim != "") {
                var fn = new Function(jsSim);
                fn();
            }
            if (locationSim != null && locationSim.toString().trim().length > 0) {
                $.root_.addClass("animated fadeOutUp"), setTimeout(lSim, 1e3);
            }
        } else if ("Não" == a) {
            if (jsNao != null && jsNao != "") {
                var fn = new Function(jsNao);
                fn();
            }
            if (locationNao != null && locationNao.toString().trim().length > 0) {
                $.root_.addClass("animated fadeOutUp"), setTimeout(lNao, 1e3);
            }
        }
    });
}
