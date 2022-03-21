String.prototype.replaceAt = function (index, replacement) {
    return this.substr(0, index) + replacement + this.substr(index + replacement.length);
}


function formatFloatToStr(n, replaceSIFRA) {
    // Create our number formatter.
    var formatter = new Intl.NumberFormat('pt-BR', { style: 'currency', currency:  'BRL'});
    var value = formatter.format(n);
    if (replaceSIFRA!=null && replaceSIFRA == true){
        value = value.replace('R$','');
    }
    return value;
}


function redirectPost(url, data) {
    var form = document.createElement('form');
    document.body.appendChild(form);
    form.method = 'post';
    form.action = url;
    for (var name in data) {
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = data[name];
        form.appendChild(input);
    }
    form.submit();
}