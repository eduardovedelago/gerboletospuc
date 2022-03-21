<?php //initilize the page
require_once("inc/init.php");
require_once("inc/config.ui.php");
include_once 'database.php';
require_once("sessionIsAuthenticated.php");
include_once("./boletophp/include/funcoes_sicredi.php");
include_once("./src/models/Empresa.php");
include_once("./src/models/Municipio.php");
INCLUDE_once("./controller/UserCtrl.php");
include_once("./controller/CalcAntecipacaoCtrl.php");

//include_once("/controller/AccessUserCtrl.php");

$page_title = "Impressão Mvto. Financeiro";
$page_title_sub = "Financeiro";
$classPHPNameController = 'form-lcto-pendfin';
$wEntityName = "modelas\PendFin";

use models\Cliente;
use models\PendFin;
use models\PendFinBlt;

use Doctrine\ORM\Query\ResultSetMapping;

/* -----------------------------------------------------------
 *  ####                  Validação Acesso Grupos
 * -----------------------------------------------------------*/
//include "./controller/UserCtrl.php";

$_acessoForm = \Ctrl\AccessUserCtrl::$Acess_Rel;

$_acessoCopy = 0;
$_acessoPDF = 0;
$_acessoExcel = 0;
$_acessoPrinter = 0;

use ctrl\UserCtrl;

UserCtrl::validateAcessAuthorizedForm($_acessoForm);
/* -----------------------------------------------------------
 *  ####                  ./Validação Acesso Grupo
 * -----------------------------------------------------------*/


/* -----------------------------------------------------------
 *  ####                  Zera Properties Fatura
 * -----------------------------------------------------------*/
$fatura_clie_nome = '';
$fatura_clie_cnpjcpf = '';
$fatura_clie_email = '';
$fatura_clie_endereco = '';
$fatura_valorTotal = '';
$fatura_totalparcelas = '';
$fatura_numerodcto = '';
$fatura_descricao = '';
$fatura_datamvto = '';
$fatura_clie_fone = '';
$fatura_empresa = getDadosEmpresa();
$listPendFin = null;

$transacao = isset($_GET['transacao']) ? $_GET['transacao'] : null;
if ($transacao == null) {
    $transacao = isset($_POST['transacao']) ? $_POST['transacao'] : null;
}
if ($transacao != null) {
    try {
        $transacao = (int)$transacao;
    } catch (Exception $exception) {
        $transacao = null;
    }
}
if ($transacao == null) {
    header('location: index.php');
    exit(0);
}
/* -----------------------------------------------------------
 *  ####                ./Zera Properties Fatura
 * -----------------------------------------------------------*/

function getDadosEmpresa()
{
    try {
        return ctrl\UserCtrl::getObjetoEmpresa_Login();
    } catch (Exception $exception) {
        return null;
    } catch (Error $error) {
        return null;
    }
}

$page_css[] = "your_style.css";
$page_css[] = "print-pendfin.css";

include("inc/header.php");

$page_nav["relatorios"]["active"] = true;


include("inc/nav.php");
?>

    <!-- ==========================CONTENT STARTS HERE ========================== -->
    <!-- MAIN PANEL -->
    <div id="main" role="main">

        <?php
        $breadcrumbs["Financeiro"] = "";
        include("inc/ribbon.php");
        ?>

        <!-- MAIN CONTENT -->
        <div id="content">

            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">
                    <h1 class="page-title txt-color-blueDark">
                        <i class="fa fa-table fa-fw "></i>
                        Financeiro / <span>Impressão de Antecipação  / <?php echo $page_title_sub ?>
                    </span>
                    </h1>
                </div>
            </div>

            <!-- widget grid -->
            <section id="widget-grid" class="">

                <!-- row -->
                <div class="row">

                    <!-- NEW WIDGET START -->
                    <article class="col-sm-12 col-md-12 col-lg-12">

                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false"
                             data-widget-deletebutton="false">

                            <!-- widget div-->
                            <div>

                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                    <!-- This area used as dropdown edit box -->

                                </div>
                                <!-- end widget edit box -->

                                <div class="widget-body no-padding">

                                    <?php
                                    $movAntAnalise = $entityManager->getRepository('models\MovAntecipacaoAnalise')->findOneBy(['transacao' => $transacao]);
                                    if ($movAntAnalise != null) {
                                        $codigoEmpresa = $movAntAnalise->getEmprCodigo();
                                        $empresa = $entityManager->find('models\Empresa', $codigoEmpresa);
                                    } else {
                                        header("location: index.php");
                                    }
                                    ?>
                                    <div
                                            class="jarviswidget jarviswidget-color-darken" id="wid-id-0"
                                            data-widget-editbutton="false"
                                            data-widget-deletebutton="false">
                                        <header>
                                            <a onclick="printfatura()"
                                               class="btn btn-primary fa fa-print margin-left-10 align-text-center">Imprimir Fatura</a>
                                            <span class="widget-icon"> <i class="fa fa-print"></i> </span>
                                            <h2>Transação de Antecipação de Recebíveis</h2>
                                        </header>

                                        <!-- widget div-->
                                        <div>

                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox">
                                                <!-- This area used as dropdown edit box -->

                                            </div>
                                            <!-- end widget edit box -->

                                            <!-- Cabeçalho Transação -->
                                            <div class="widget-body no-padding">

                                                <!--                                            <div style="padding:10px; height: 300px; overflow-y:scroll">-->
                                                <div name="faturacliente" id="faturacliente" style="padding:10px;">

                                                    <table class="tg"
                                                           style="undefined;table-layout: fixed; width: 923px; padding: 0px">
                                                        <colgroup>
                                                            <col style="width: 462px">
                                                            <col style="width: 461px">
                                                        </colgroup>

                                                        <tr>
                                                            <th class="tg-n1hl" colspan="2"><span
                                                                        style="font-weight:bold">Borderô de Operação -- SS Factor Factoring e Gestão Financeira Ltda</span>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-3f5b"><?php echo $fatura_empresa->getRazaosocial() ?></td>
                                                            <td class="tg-62ie">Dados da Fatura
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-s764">
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "CNPJ: " . $fatura_empresa->getCnpj() ?></td>
                                                            <td class="tg-icit"><span style="font-weight:bold"></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-s764">
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Endereço: <?php echo $fatura_empresa->getEndereco() . ", " . $fatura_empresa->getEnderecoNumero() ?></td>
                                                            <td class="tg-4uwb">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fatura
                                                                Nº <?php echo $transacao; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-s764">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <?php
                                                                $municipio = $entityManager->find('models\Municipio', $fatura_empresa->getMunicipio());
                                                                echo "Cidade: " . $municipio->getNome() . " - " . $municipio->getUF();
                                                                ?>
                                                            </td>
                                                            <td class="tg-4uwb">&nbsp;&nbsp;&nbsp;&nbsp; Data de Emissão: <?php echo $movAntAnalise->getDataMvto()->format('d/m/y'); ?></td>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-s764">
                                                                &nbsp;&nbsp;&nbsp;&nbsp; <?php echo "Endereço: " . $fatura_empresa->getEndereco() ?></td>
                                                            <td class="tg-04ob"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-s764">
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "E-Mail: " . $fatura_empresa->getEmail() ?></td>
                                                            <td class="tg-04ob"></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="tg-n1hl"> Cliente</th>
                                                            <th class="tg-n1hl"></th>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-x0692 txt-color-red" style="font-size: 13px" colspan="2"> <?php echo $empresa->getNome(); ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-x0692" colspan="2"> Operação de Fornecimento de Serviços e Produtos com faturamento direto ao cliente Final, pagador da
                                                                obrigação
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-x0692" colspan="1">
                                                                CNPJ: <?php echo $empresa->getCNPJ() ?>
                                                            </td>
                                                            <td class="tg-x0692" colspan="1"> Data
                                                                Base: <?php echo str_pad($movAntAnalise->getDataMvto()->format('d/m/y'), 55, ".", STR_PAD_LEFT); ?></td>

                                                        </tr>
                                                        <tr>
                                                            <td class="tg-x0692" colspan="1">
                                                            </td>
                                                            <td class="tg-x0692" colspan="1"> Fator de
                                                                Compra: <?php echo str_pad(formatFloat($empresa->getFatorCompra()), 49, ".", STR_PAD_LEFT); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-x0692" colspan="1">
                                                            </td>
                                                            <td class="tg-x0692" colspan="1"> Ad Valoren: <?php echo str_pad(formatFloat($empresa->getPercAdValoren()), 54, ".", STR_PAD_LEFT); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-x0692" colspan="1">
                                                            </td>
                                                            <td class="tg-x0692" colspan="1"> IOF: <?php echo str_pad(formatFloat($empresa->getPercIOF()), 61, ".", STR_PAD_LEFT); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-x0692" colspan="1">
                                                            </td>
                                                            <td class="tg-x0692" colspan="1">
                                                                IOF Diario: <?php echo str_pad($empresa->getPercIOFDiario(), 54, ".", STR_PAD_LEFT); ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" class="no-padding no-margin">
                                                                <style type="text/css">
                                                                    .tg {
                                                                        border-collapse: collapse;
                                                                        border-spacing: 0;
                                                                        border-color: #93a1a1;
                                                                    }

                                                                    .tg td {
                                                                        font-family: Arial, sans-serif;
                                                                        font-size: 14px;
                                                                        padding: 10px 5px;
                                                                        border-style: solid;
                                                                        border-width: 0px;
                                                                        overflow: hidden;
                                                                        word-break: normal;
                                                                        border-color: #93a1a1;
                                                                        color: #002b36;
                                                                        background-color: #fdf6e3;
                                                                    }

                                                                    .tg th {
                                                                        font-family: Arial, sans-serif;
                                                                        font-size: 14px;
                                                                        font-weight: normal;
                                                                        padding: 10px 5px;
                                                                        border-style: solid;
                                                                        border-width: 0px;
                                                                        overflow: hidden;
                                                                        word-break: normal;
                                                                        border-color: #93a1a1;
                                                                        color: #fdf6e3;
                                                                        background-color: #657b83;
                                                                    }

                                                                </style>
                                                                <table class="tg" style="no-margin; table-layout: fixed; width: 922px">
                                                                    <colgroup>
                                                                        <col style="width: 90px">
                                                                        <col style="width: 90px">
                                                                        <col style="width: 115px">
                                                                        <col style="width: 90px">
                                                                        <col style="width: 80px">
                                                                        <col style="width: 100px">
                                                                        <col style="width: 80px">
                                                                        <col style="width: 100px">
                                                                        <col style="width: 70px">
                                                                        <col style="width: 81px">
                                                                    </colgroup>
                                                                    <tr>
                                                                        <th class="tg-n1hl">Operação</th>
                                                                        <th class="tg-vsq8">Valor</th>
                                                                        <th class="tg-jfzd">Data Emissão</th>
                                                                        <th class="tg-jfzd">Vencimento</th>
                                                                        <th class="tg-vsq8">Fator</th>
                                                                        <th class="tg-vsq8">Ad Valoren</th>
                                                                        <th class="tg-vsq8">IOF</th>
                                                                        <th class="tg-vsq8">IOF Diário</th>
                                                                        <th class="tg-vsq8">Boleto</th>
                                                                        <th class="tg-vsq8">Líquido</th>
                                                                    </tr>
                                                                    <?php
                                                                    $listPendFin = $entityManager->getRepository('models\PendFin');
                                                                    //findBy(['transacao' => $transacao]);
                                                                    $listPendFin = $listPendFin->findBy(['transacaoAvaliacaoAntecipacao' => $movAntAnalise->getTransacao()]);
                                                                    foreach ($listPendFin as $pendFin) {
                                                                        $dtvcto = $pendFin->getDataVcto();
                                                                        $dtantecipacao = $movAntAnalise->getDataMvto();
                                                                        $calc = new CalcAntecipacaoCtrl();
                                                                        $percAdValore = $empresa->getPercAdValoren();
                                                                        $percIOF = $empresa->getPercIOF();
                                                                        $percIOFDiario = $empresa->getPercIOFDiario();
                                                                        $taxaBoleto = $empresa->getTaxaboleto();
                                                                        $fatorCompra = $empresa->getFatorCompra();

                                                                        $dadosCalc = $calc->executeCalculo($pendFin->getValor(), $dtvcto, $dtantecipacao, $fatorCompra, $percAdValore, $percIOF, $percIOFDiario, $taxaBoleto);

                                                                        $totValor += $pendFin->getValor();
                                                                        $totFator += $dadosCalc['fator_calculado'];
                                                                        $totAd_Valoren += $dadosCalc['ad_valoren'];
                                                                        $totIOF += $dadosCalc['iof_calc'];
                                                                        $totIOF_Diário += $dadosCalc['iof_diaria_calc'];
                                                                        $totBoleto += $dadosCalc['boleto'];
                                                                        $totLiquido += $dadosCalc['liquido'];
                                                                        ?>
                                                                        <tr>
                                                                            <td class="tg-x069"><?php echo $pendFin->getOperacao() ?></td>
                                                                            <td class="tg-ot5y"><?php echo formatFloat($pendFin->getValor()) ?></td>
                                                                            <td class="tg-hwur"><?php echo $pendFin->getDataMvto()->format('d/m/y') ?></td>
                                                                            <td class="tg-hwur"><?php echo $pendFin->getDataVcto()->format('d/m/y') ?></td>
                                                                            <td class="tg-ot5y"><?php echo formatFloat($dadosCalc['fator_calculado']) ?></td>
                                                                            <td class="tg-ot5y"><?php echo formatFloat($dadosCalc['ad_valoren']) ?></td>
                                                                            <td class="tg-ot5y"><?php echo formatFloat($dadosCalc['iof_calc']) ?></td>
                                                                            <td class="tg-ot5y"><?php echo formatFloat($dadosCalc['iof_diaria_calc']) ?></td>
                                                                            <td class="tg-ot5y"><?php echo formatFloat($dadosCalc['boleto']) ?></td>
                                                                            <td class="tg-ot5y"><?php echo formatFloat($dadosCalc['liquido']) ?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <tr>
                                                                        <td class="tg-7qzrll">Totais</td>
                                                                        <td class="tg-7qzr"><?php echo formatFloat($totValor) ?></td>
                                                                        <td class="tg-7qzr"></td>
                                                                        <td class="tg-7qzr"></td>
                                                                        <td class="tg-7qzr"><?php echo formatFloat($totFator) ?></td>
                                                                        <td class="tg-7qzr"><?php echo formatFloat($totAd_Valoren) ?></td>
                                                                        <td class="tg-7qzr"><?php echo formatFloat($totIOF) ?></td>
                                                                        <td class="tg-7qzr"><?php echo formatFloat($totIOF_Diário) ?></td>
                                                                        <td class="tg-7qzr"><?php echo formatFloat($totBoleto) ?></td>
                                                                        <td class="tg-7qzr"><?php echo formatFloat($totLiquido) ?></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-x0692" colspan="2">
                                                                Líquido Calculado: <?php echo str_pad(formatFloat($totLiquido), 21, ".", STR_PAD_LEFT); ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-x0692" colspan="2">
                                                                Custo Repasse: <?php echo str_pad(formatFloat(10.50), 25, ".", STR_PAD_LEFT); ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-x0692" colspan="2">
                                                                Líquido Repasse: <?php echo str_pad(formatFloat($totLiquido - 10.50), 23, ".", STR_PAD_LEFT); ?>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="tg-13ft" colspan="2"><span
                                                                        style="font-weight:bold">www.gerboletos.com.br</span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                </div>

        </div>
        <!-- end widget -->

        </article>
        <!-- WIDGET END -->


    </div>
    <!-- end row -->

    </section>
    <!-- end widget grid -->

    </div>

    <!-- END MAIN PANEL -->
    <!-- ==========================CONTENT ENDS HERE ========================== -->

    <!-- PAGE FOOTER -->
<?php // include page footer
include("inc/footer.php");
?>
    <!-- END PAGE FOOTER -->

<?php //include required scripts
include("inc/scripts.php");
?>
    <!-- Funções do Formulário de Cadastro -->
    <script src="<?php echo ASSETS_URL; ?>/js/forms.functions.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/printblt.js"></script>
    <script src="http://cdn.rawgit.com/MrRio/jsPDF/master/dist/jspdf.min.js"></script>
    <script src="http://html2canvas.hertzen.com/build/html2canvas.js"></script>
    <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous"></script>-->
    <!-- ./Funções do Formulário de Cadastro -->

    <!-- JS FORM -->
<?php
if (file_exists("js/forms/" . $classPHPNameController . '.js')) {
    $fileJsFormulario = ASSETS_URL . '/js/forms/' . $classPHPNameController . '.js';
    echo '<script src="' . $fileJsFormulario . '"></script>';
}
?>
    <!-- ./JS FORM -->

    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.colVis.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.tableTools.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>


<?php

//Botão Incluir Está Dentro do JSTableTools - Include Button , Incluir"
//Caso Necessário Alteração Copiar o Código do JSTableTools para este Ponto...
//include_once("./src/app/JSTableTools.php")

?>


    <script type="text/javascript">
        /* -----------------------------------------------------------
        *  Seta as Variáveis Globais que são utilizadas no js "forms.functions.js"
        * -----------------------------------------------------------*/
        function loadVarsGlobaisFormulario(classCtrl) {
            wClassCtrl = classCtrl;
            wUrlCtrl = "../../controller/" + wClassCtrl + "-ctrl.php";
        }

        loadVarsGlobaisFormulario(<?php echo '"' . $classPHPNameController . '"' ?>);
    </script>


    <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>-->
    <!--    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />-->
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/fuelux/wizard/wizard.min.js"></script>
    <!--    <script src="js/libs/bootstrap-select.min.js"></script>-->
    <link href="css/bootstrap-select.css" rel="stylesheet"/>
    <link href="css/pendfin.css" rel="stylesheet"/>

    <script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
    <script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
    <script>
        webshims.setOptions('waitReady', false);
        webshims.setOptions('forms-ext', {type: 'date'});
        webshims.setOptions('forms-ext', {type: 'time'});
        webshims.polyfill('forms forms-ext');
    </script>


<?php
//include footer
include("inc/google-analytics.php");
?>