$('[name="btnExecuteLcto"]').on('click', function (e) {
    if ($(this) != null) {
        form_func_execute_ShowModal("#modalExecuteLcto");
    }
});

$('[name="btnVisParamEmpr"]').on('click', function (e) {
    if ($(this) != null) {
        form_func_execute_ShowModal("#modalParametroEmpr");
    }
});

$('[name="btnExecuteRelBlt"]').on('click', function (e) {
    if ($(this) != null) {
        form_func_execute_ShowModal("#modalRelPendFin");
    }
});

