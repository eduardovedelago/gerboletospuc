$('[name="btnPrinBlt"]').on('click', function (e) {
    printBlt();
});

function printBlt() {
    var conteudo = $('[name="divBoleto"]')[0].innerHTML,
        tela_impressao = window.open('about:blank');
    tela_impressao.document.write(conteudo);
    tela_impressao.window.print();
    tela_impressao.window.close();
}

function printfatura() {
    //var conteudo = $('[name="faturacliente"]')[0],
    var conteudo = $('<div/>').append($('[name="faturacliente"]').clone()).html()
    printWindow = window.open('', 'Fatura', '');
    printWindow.document.write('<html><head><title>Fatura</title>');
    printWindow.document.write('<link rel="stylesheet" type="text/css" href="./css/print-pendfin.css" media="all">');
    printWindow.document.write('</head><body >');
    printWindow.document.write(conteudo);
    printWindow.document.write('</body></html>');
    setTimeout(function () {
        printWindow.print();
        printWindow.close();
    }, 250);
}

$('[name="btnToPDF"]').on('click', function (e) {
    geraPDF('#divBoleto');
});

function geraPDF(divName) {

    $('#divBlt1').height(1250);

    html2canvas(document.getElementById('divBlt1')).then(function (canvas) {
        var wid = 0;
        var hgt = 0;
        var img = canvas.toDataURL("image/png", wid = canvas.width, hgt = canvas.height);
        var hratio = hgt / wid
        var doc = new jsPDF('p', 'pt', 'a4');
        var width = doc.internal.pageSize.getWidth() - 100;
        var height = ( width * hratio) - 100;
        doc.addImage(img, 'JPEG', 20, 20, width, height);
        doc.save('Test.pdf');
    });
    $('#divBlt1').height(125);
}

// var content = document.getElementById(divId).innerHTML;
// var mywindow = window.open('', 'Print', 'height=600,width=800');
//
// mywindow.document.write('<html><head><title>Print</title>');
// mywindow.document.write('</head><body >');
// mywindow.document.write(content);
// mywindow.document.write('</body></html>');
//
// mywindow.document.close();
// mywindow.focus()
// mywindow.print();
// mywindow.close();
// return true;
// }