function executeFuncionByName(functionName) {
    var func = functionName.toString().substr(0, functionName.toString().indexOf("("));
    switch (func) {
        case "crud_DeleteExecute":
            var codigo = functionName.toString().substr(functionName.toString().indexOf("(") + 1, functionName.toString().indexOf(","));
            crud_DeleteExecute(codigo, "");
            break;
    }
}