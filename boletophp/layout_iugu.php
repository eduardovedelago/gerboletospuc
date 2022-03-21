<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 12/11/2018
 * Time: 23:32
 */
?>


<html class="js ready desktop chrome chrome_70 os_windows mediaquery">
<head>
    <title>Fatura a62c6cba-03d1-4721-894b-b125cd5168d6</title>
    <script async="" src="//www.googletagmanager.com/gtm.js?id=GTM-5R6JDK"></script>
    <script src="https://faturas.iugu.com/assets/vendor-1810b420d963ce2e76b8354342cfe315.js"
            type="text/javascript"></script>
    <script src="https://faturas.iugu.com/assets/invoice-031cdec505abad885f3894712dccd58e.js"
            type="text/javascript"></script>
    <script src="//code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://js.iugu.com/v2" type="text/javascript"></script>
    <script src="https://faturas.iugu.com/assets/iugu_credit_card-c79f3519ddbd447b8fb0b8b3875ee3fa.js"
            type="text/javascript"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" media="all" rel="stylesheet"
          type="text/css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" media="all" rel="stylesheet"
          type="text/css">
    <link href="https://faturas.iugu.com/assets/invoice-20ba73809a09e949b71d106b6ce7aa11.css" media="all"
          rel="stylesheet" type="text/css">
    <link href="https://faturas.iugu.com/assets/invoice-20ba73809a09e949b71d106b6ce7aa11.css" media="all"
          rel="stylesheet" type="text/css">
    <link href="https://faturas.iugu.com/assets/iugu_credit_card-9851903931a8f4f0fff12bd4d2945891.css" media="all"
          rel="stylesheet"
          type="text/css">
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <meta content="on" http-equiv="cleartype">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta content="authenticity_token" name="csrf-param">
    <meta content="kRqqXU07J9MI0pV0qkr5OUxcgmc7swLwQtWiayeh6PU=" name="csrf-token">
    <link href="/favicon.ico" rel="shortcut icon">
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <meta content="True" name="HandheldFriendly">
    <meta content="320" name="MobileOptimized">
    <meta content="telephone=no" name="format-detection">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
</head>
<body style="">
<div class="hidden-print" id="testmode-flag">
<span>
Fatura Teste
</span>
</div>
<div class="invoice">
    <div class="header">
        <div class="rotated-badge hidden-print" id="status-badge">
            <div class="invoice-badge-yellow">
                <span>Pendente</span>
                <script>
                    $(document).ready(function () {
                        $('#pay').show()
                    })
                </script>
            </div>

        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-sm-6">
                    <div class="client_name">
                        <h6>Cliente</h6>
                        <h5>Eduardo Vedelago</h5>
                    </div>
                    <div class="client_document">
                        <h6>
                            CPF/CNPJ
                        </h6>
                        <h5>073.399.579-95</h5>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs print-visible">
                    <div class="account_name">
<span>
SS FACTOR
</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="container">
            <!-- BASIC INFORMATION -->
            <div class="row">
                <div class="col-sm-12 hidden-xs hidden-print">
                    <div class="qr-code">
                        <!-- %img{ src: invoice_qr_code_path(@invoice.to_secure_id), class: 'hidden-print' } -->
                        <h6>IDENTIFICAÇÃO DA FATURA</h6>
                        <h5>a62c6cba03d14721894bb125cd5168d6</h5>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="invoice-details">
                        <div class="row">
                            <div class="col-xs-7">
                                <h3 class="bigger">Detalhes da Fatura</h3>
                            </div>
                            <div class="col-xs-5">
                                <h6>Vencimento </h6>
                                <h3>14/11/2018</h3>
                            </div>
                        </div>
                        <table class="custom_table">
                            <thead>
                            <tr>
                                <th>Descrição</th>
                                <th></th>
                                <th>Valor</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td></td>
                                <td style="text-align: right">R$ 115,00</td>
                            </tr>
                            <tr class="additional-tr">
                                <td></td>
                                <td>Subtotal</td>
                                <td>R$ 115,00</td>
                            </tr>
                            <tr class="additional-tr">
                                <td></td>
                                <td>Desconto</td>
                                <td>R$ 0,00</td>
                            </tr>
                            <tr class="total-tr bold">
                                <td></td>
                                <td>Total</td>
                                <td>R$ 115,00</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- MAJOR POINTED LINE -->
            <svg height="40" width="100%">
                <g fill="none" stroke-width="6" stroke="#EDEAE3">
                    <path d="M0 22 800 22" stroke-dasharray="0.05, 9.05" stroke-linecap="round"></path>
                </g>
            </svg>
            <!-- PAYMENT METHODS -->
            <div class="bank_slip_form">
                <div class="default_bank_slip_form">
                    <div class="screen hidden-print">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form_header">
                                    <h4>Boleto Bancário</h4>
                                    <div class="hidden-xs">
                                        <img alt="Iugu_pdf_logo"
                                             src="https://faturas.iugu.com/assets/iugu_pdf_logo-16849ed1364d67fcb976167cced65fd5.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bank_slip_info hidden-xs">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="rel" style="position: relative;">
                                        <div class="bank_slip_icon">
                                            <img alt="Itau_logo"
                                                 src="https://faturas.iugu.com/assets/itau_logo-c647495e2e3f2c64037b56a8e66d887c.png"
                                                 style="max-width: 40px; max-height: 40px;">
                                        </div>
                                        <div class="bank_slip_label icon_space">
                                            <div class="bank-info">
                                                <h5>BANCO ITAÚ UNIBANCO S.A.</h5>
                                                <span>341</span>
                                            </div>
                                            <h5>00000000000000000000000000000000000000000000000</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 left_bank_info">
                                    <div class="row transferor-line">
                                        <div class="col-sm-12">
                                            <div class="bank_slip_label">
                                                <span style="margin-top: 8px;">LOCAL DE PAGAMENTO</span>
                                                <h5>Pagável em qualquer banco até o vencimento. Após o vencimento
                                                    pagável somente no banco Bradesco.</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row transferor-line">
                                        <div class="col-sm-6">
                                            <div class="bank_slip_label">
                                                <span>Cedente</span>
                                                <h5>SS FACTOR</h5>
                                                <div class="cpf_or_cnpj">
                                                    <span>CNPJ: 31.110.683/0001-63</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="bank_slip_label">
                                                <span>INTERMEDIADO POR</span>
                                                <h5 class="iugu-name">Iugu Serviços na Internet SA</h5>
                                                <div class="cpf_or_cnpj">
                                                    <span>CNPJ: 15.111.975/0001-64</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row transferor-line">
                                        <div class="col-sm-12">
                                            <div class="bank_slip_label instruction_div">
                                                <span>INSTRUÇÕES</span>
                                                <h5 class="after_due_date">Após o vencimento cobrar: Multa por atraso de
                                                    R$ 5,75 e Mora diária de R$ 0,03</h5>
                                                <h5>Não receber após o dia 29/11/2018.</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="bank_slip_label">
                                                <span>Cliente</span>
                                                <h5>Eduardo Vedelago</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2 right_bank_slip_info">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="bank_slip_label reverse">
                                                <span>Nosso Número</span>
                                                <h5>1111</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="bank_slip_label reverse">
                                                <span>Vencimento </span>
                                                <h5>14/11/2018</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="bank_slip_label reverse">
                                                <span>Valor do Doc.</span>
                                                <h5>R$ 115,00</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="bank_slip_label reverse">
                                                <span>Multa/Juros</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="bank_slip_label reverse last_label">
                                                <span>Valor a Pagar</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="barcode_info">
                            <div class="row">
                                <div class="col-sm-9" style="margin-top: 10px;">
                                    <h6>Use este código de barras para pagamentos no bankline</h6>
                                    <h5>00000000000000000000000000000000000000000000000</h5>
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-9 hidden-xs">
                                <div class="barcode-html">
                                    <div style="width: 500px; height: 50px; display: block;">
                                        <div style="width: 500px;height:50px;">
                                            <img src=""
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="relative">
                                    <div class="visible-xs" style="height: 15px;"></div>
                                    <a class="btn print-button btn-default"
                                       href="/a62c6cba-03d1-4721-894b-b125cd5168d6-5f43.pdf"
                                       target="_blank">Imprimir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="printer">
                        <div class="page-break" style=""></div>
                        <div class="row print-bs-header">
                            <div class="col-xs-6">
                                <h5>Boleto Bancário</h5>
                            </div>
                            <div class="col-xs-6 reverse">
                                <h5 class="mechanical-aut">AUTENTICAÇÃO MECÂNICA</h5>
                            </div>
                        </div>
                        <div class="row cut-this-line">
                            <div class="col-xs-12">
                                <span class="gray">CORTE NESTA LINHA PONTILHADA</span>
                            </div>
                            <div class="col-xs-12">
                                <svg height="15" width="100%">
                                    <g fill="none" stroke-width="4" stroke="#EDEAE3">
                                        <path d="M0 0 800 1" stroke-dasharray="1.05, 8.05"
                                              stroke-linecap="round"></path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div class="row">
                            <div class="bank-slip-info">
                                <img alt="Itau_logo" class="bank-slip-icon"
                                     src="https://faturas.iugu.com/assets/itau_logo-c647495e2e3f2c64037b56a8e66d887c.png"
                                     style="max-width: 40px; max-height: 40px;">
                                <img alt="Iugu_pdf_logo" class="iugu-icon"
                                     src="https://faturas.iugu.com/assets/iugu_pdf_logo-16849ed1364d67fcb976167cced65fd5.png">
                                <div class="col-xs-12">
                                    <div class="bank-slip-label">
                                        <div class="line bank-info">
                                            <h5>BANCO ITAÚ UNIBANCO S.A.</h5>
                                            <span class="gray">341</span>
                                        </div>
                                        <div>
                                            <h5>00000000000000000000000000000000000000000000000</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-10 no-padding-left">
                                    <div class="col-xs-12">
                                        <div class="bank-slip-label no-space-right">
                                            <span class="gray">LOCAL DE PAGAMENTO</span>
                                            <h5>Pagável em qualquer banco até o vencimento. Após o vencimento pagável
                                                somente no banco Bradesco.</h5>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="bank-slip-label no-space-right">
                                            <span>Cedente</span>
                                            <h5>SS FACTOR</h5>
                                            <div class="cpf_or_cnpj">
                                                <span>CNPJ: 31.110.683/0001-63</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 no-padding-left">
                                        <div class="bank-slip-label no-space-left">
                                            <span>INTERMEDIADO POR</span>
                                            <h5 class="iugu-name">Iugu Serviços na Internet SA</h5>
                                            <div class="cpf_or_cnpj">
                                                <span>15.111.975/0001-64</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="bank-slip-label no-space-right instruction-div">
                                            <span class="gray">INSTRUÇÕES</span>
                                            <h5 class="after_due_date">Após o vencimento cobrar: Multa por atraso de R$
                                                5,75 e Mora diária de R$ 0,03</h5>
                                            <h5>Não receber após o dia 29/11/2018.</h5>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="bank-slip-label">
                                            <span>Cliente</span>
                                            <h5>Eduardo Vedelago</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-2 right-bank-slip-info">
                                    <div class="row">
                                        <div class="col-xs-12 no-padding-left">
                                            <div class="bank-slip-label reverse no-space-left">
                                                <span>Nosso Número</span>
                                                <h5>1111</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 no-padding-left">
                                            <div class="bank-slip-label reverse no-space-left">
                                                <span>Vencimento </span>
                                                <h5>14/11/2018</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 no-padding-left">
                                            <div class="bank-slip-label reverse no-space-left">
                                                <span>Valor do Doc.</span>
                                                <h5>R$ 115,00</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 no-padding-left">
                                            <div class="bank-slip-label reverse no-space-left">
                                                <span>Multa/Juros</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 no-padding-left">
                                            <div class="bank-slip-label reverse no-space-left last-label">
                                                <span>Valor a Pagar</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bot-div">
                                    <div class="col-xs-10 no-padding-left">
                                        <div class="barcode_info">
                                            <div class="digitable-line" style="text-align: center;">
                                                <div class="row">
                                                    <div class="col-xs-9" style="margin-top: 10px;">
                                                        <h6>Linha Digitável</h6>
                                                        <h5>00000000000000000000000000000000000000000000000</h5>
                                                    </div>
                                                    <div class="col-xs-3"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <img src="https://faturas.iugu.com/barcode/a62c6cba-03d1-4721-894b-b125cd5168d6-5f43">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bank-slip-aut-label">
                                <span>AUTENTICAÇÃO MECÂNICA</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Google Tag Manager -->
<noscript>
    <iframe height='0' src='//www.googletagmanager.com/ns.html?id=GTM-5R6JDK' style='display:none;visibility:hidden'
            width='0'></iframe>
</noscript>
<script>
    (function (w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({'gtm.start': new Date().getTime(), event: 'gtm.js'});
        var f = d.getElementsByTagName(s)[0], j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src = '//www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-5R6JDK');
</script>
<!-- End Google Tag Manager -->


</body>
</html>