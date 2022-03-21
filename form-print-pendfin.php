<?php //initilize the page
require_once("inc/init.php");
require_once("inc/config.ui.php");
include_once 'database.php';
require_once("sessionIsAuthenticated.php");
include_once("./boletophp/include/funcoes_sicredi.php");
include_once("./src/models/Empresa.php");
include_once("./src/models/Municipio.php");
INCLUDE_once("./controller/UserCtrl.php");

//include_once("/controller/AccessUserCtrl.php");
include_once 'database.php';

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
$fatura_transacao = '';
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
/* -----------------------------------------------------------
 *  ####                ./Zera Properties Fatura
 * -----------------------------------------------------------*/

function getDadosEmpresa()
{
    try {
        return ctrl\UserCtrl::getObjetoEmpresa_Login();
    } catch (Exception $exception) {
    } catch (Error $error) {
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
                        Financeiro / <span>Impressão de Movimentos  / <?php echo $page_title_sub ?>
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

                            <header>
                                <span class="widget-icon"> <i class="fa fa-check"></i> </span>
                                <?php echo "<h2>Impressão de Movimentos</h2>" ?>
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
                                    <table id="datatable_cadastro"
                                           class="table table-striped table-bordered table-hover"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <!--/* ------------------------------------------------------------->
                                            <!--* ####[alteracao] Filtros das Colunas do Grid ()-->
                                            <!--* -----------------------------------------------------------*/-->
                                            <th class="hasinput" style="width:40px">Cliente</th>
                                            <th class="hasinput" style="width:40px">Num. Parcelas</th>
                                            <th class="text-align-right hasinput" style="width:40px">Valor Bruto</th>
                                            <th class="text-align-right hasinput" style="width:40px">Valor Líquido</th>
                                            <th class="text-align-center hasinput" style="width:40px">Data Lcto</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $transacao = $_GET['transacao'];
                                        if ($transacao != null && $transacao != '') {

                                            $sql =
                                                " select max(pfin_numparcelas) as numparc, " .
                                                " sum(pfin_valor) as brt,  " .
                                                " sum(pfin_valor+pfin_juros+pfin_multa+pfin_mora+pfin_acrescimos-pfin_descontos-pfin_txadm+pfin_corrmonet) as liq,  " .
                                                " min(pblt_banco) as bco, " .
                                                " min(pfin_numeroDcto) as fnumerodcto, " .
                                                " min(pfin_observacao) as fobs," .
                                                " to_char(min(pfin_datalcto),'DD/MM/YYYY' ) as datalcto,  " .
                                                " min(clie_nome) as cliet, min(clie_cnpjCpf) as fcnpjcpf, min(clie_email) as femail, min(clie_endereco) as fendereco, min(clie_enderecoNumero) as fenderecoNumero, min(clie_fone) as ffone, min(clie_celular) as fcelular," .
                                                " min(muni_nome) as fmunicipio," .
                                                " min(muni_uf) as fmuniuf" .
                                                " from pendfin " .
                                                " left join clientes on (pfin_codentidade=clie_codigo) " .
                                                " left join municipio on (clie_muni_codigo=muni_codigo) " .
                                                " left join pendfinblt on (pfin_Operacao=pblt_operacao) " .
                                                " where pfin_transacao=? ";
                                            $rsm = new ResultSetMapping();
                                            $rsm->addScalarResult('numparc', 'parcela');
                                            $rsm->addScalarResult('brt', 'bruto');
                                            $rsm->addScalarResult('liq', 'liquido');
                                            $rsm->addScalarResult('bco', 'banco');
                                            $rsm->addScalarResult('datalcto', 'data');
                                            $rsm->addScalarResult('cliet', 'cliente');
                                            $rsm->addScalarResult('fcnpjcpf', 'cnpjcpf');
                                            $rsm->addScalarResult('femail', 'email');
                                            $rsm->addScalarResult('fendereco', 'endereco');
                                            $rsm->addScalarResult('fenderecoNumero', 'enderecoNumero');
                                            $rsm->addScalarResult('fenderecoBairro', 'enderecoBairro');
                                            $rsm->addScalarResult('fmunicipio', 'municipio');
                                            $rsm->addScalarResult('fmuniuf', 'uf_municipio');
                                            $rsm->addScalarResult('ffone', 'fone');
                                            $rsm->addScalarResult('fcelular', 'celular');
                                            $rsm->addScalarResult('fnumerodcto', 'numerodcto');
                                            $rsm->addScalarResult('fobs', 'obs');
                                            $query = $entityManager->createNativeQuery($sql, $rsm);
                                            $query->setParameter(1, $transacao);
                                            $result = $query->getResult();
                                            if (sizeof($result) > 0) {
                                                $result = $result[0];
                                                $fatura_transacao = $transacao;
                                                $fatura_clie_nome = $result['cliente'];
                                                $fatura_clie_cnpjcpf = $result['cnpjcpf'];
                                                $fatura_clie_email = strtolower($result['email']);
                                                $fatura_clie_endereco = $result['endereco'] . ' - ' . $result['enderecoNumero'] . ' ' . $result['municipio'];
                                                $fatura_clie_fone = $result['fone'] . ' ' . $result['celular'];
                                                $fatura_valorTotal = $result['bruto'];
                                                $fatura_datamvto = $result['data'];
                                                $fatura_totalparcelas = $result['parcela'];
                                                $fatura_numerodcto = $result['numerodcto'];
                                                $fatura_descricao = $result['obs'];
                                                $fatura_municipio = $result['municipio'];
                                                $fatura_municipio_uf = $result['uf_municipio'];
                                            }
                                            ?>
                                            <tr>
                                                <td class="text-align-left"> <?php echo $result['cliente'] ?> </td>
                                                <td class="text-align-left"> <?php echo $result['parcela'] ?> </td>
                                                <td class="text-align-right"> <?php echo formatFloat($result['bruto']) ?> </td>
                                                <td class="text-align-right"> <?php echo formatFloat($result['liquido']) ?> </td>
                                                <td class="text-align-center"> <?php echo $result['data'] ?> </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="widget-body no-padding">
                                    <table id="datatable_cadastro"
                                           class="table table-striped table-bordered table-hover"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <!--/* ------------------------------------------------------------->
                                            <!--* ####[alteracao] Filtros das Colunas do Grid ()-->
                                            <!--* -----------------------------------------------------------*/-->
                                            <th class="hasinput" style="width:40px">N. Dcto</th>
                                            <th class="hasinput" style="width:40px">Vencimento</th>
                                            <th class="hasinput" style="width:40px">Parcela</th>
                                            <th class="hasinput" style="width:40px">Valor</th>
                                            <!--/* ------------------------------------------------------------->
                                            <!--* #### Filtros da Coluna Opções está Hidden-->
                                            <!--* -----------------------------------------------------------*/-->
                                            <th class="hasinput" style="width:40px">Opções</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $transacao = $_GET['transacao'];
                                        if ($transacao != null && $transacao != '') {
                                            $listPendFin = $entityManager->getRepository('models\PendFin')->findBy(['transacao' => $transacao]);
                                            if ($listPendFin != null && sizeof($listPendFin) > 0) {
                                                foreach ($listPendFin as $pendfin) {
                                                    $pendFinBlt = $entityManager->getRepository('models\PendFinBlt')->findOneBy(['operacao' => $pendfin->getOperacao()]);
                                                    if ($pendFinBlt != null) {
                                                        ?>
                                                        <tr>
                                                            <td class="text-align-right"> <?php echo $pendfin->getNumeroDcto() ?> </td>
                                                            <td> <?php echo date("d/m/Y", $pendfin->getDataVcto()->getTimesTamp()); ?> </td>
                                                            <td> <?php echo $pendfin->getParcela() ?> </td>
                                                            <td class="text-align-right"> <?php echo formatFloat($pendfin->getValor()) ?> </td>
                                                            <td class="text-align-center">
                                                                <a href="<?php echo $pendFinBlt->getPdf() ?>"
                                                                   class="btn btn-primary fa fa-file-pdf-o"> Gerar Boleto PDF</a>
                                                                <!--                                                                <a href="--><?php //echo $pendFinBlt->getUrl() ?><!--"-->
                                                                <!--                                                                   class="btn btn-primary fa fa-print"> Imprimir</a>-->
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                        </tbody>

                                    </table>
                                    <br><br><br>

                                    <div
                                            class="jarviswidget jarviswidget-color-darken" id="wid-id-0"
                                            data-widget-editbutton="false"
                                            data-widget-deletebutton="false">
                                        <header>
                                            <a onclick="printfatura()"
                                               class="btn btn-primary fa fa-print margin-left-10 align-text-center">Imprimir Fatura</a>
                                            <span class="widget-icon"> <i class="fa fa-print"></i> </span>
                                            <h2>Impressão da Fatura</h2>
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
                                                           style="undefined;table-layout: fixed; width: 923px; padding: 5px">
                                                        <colgroup>
                                                            <col style="width: 462px">
                                                            <col style="width: 461px">
                                                        </colgroup>

                                                        <tr>
                                                            <th class="tg-7ru9" colspan="2"><span
                                                                        style="font-weight:bold">FATURA DE PRESTAÇÃO DE SERVIÇOS / OPERAÇÃO MERCANTIL</span>
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
                                                                Nº <?php echo $fatura_transacao; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-s764">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <?php
                                                                echo "Cidade: " . $fatura_municipio . " - " . $fatura_municipio_uf;
                                                                ?>
                                                            </td>
                                                            <td class="tg-4uwb">&nbsp;&nbsp;&nbsp;&nbsp; Data de Emissão: <?php echo $fatura_datamvto; ?></td>
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
                                                            <td class="tg-i7pz"> Tomador do Serviço</td>
                                                            <td class="tg-i7pz"> Cobrança Para</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-6jgx"> <?php echo $fatura_clie_nome; ?></td>
                                                            <td class="tg-6jgx"> <?php echo $fatura_clie_nome; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-6jgx"> <?php echo $fatura_clie_cnpjcpf; ?></td>
                                                            <td class="tg-6jgx"> <?php echo $fatura_clie_cnpjcpf; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-6jgx"> <?php echo $fatura_clie_endereco; ?></td>
                                                            <td class="tg-6jgx"> <?php echo $fatura_clie_endereco; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-6jgx"> <?php echo $fatura_clie_fone; ?></td>
                                                            <td class="tg-6jgx"> <?php echo $fatura_clie_fone; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-6jgx"> <?php echo $fatura_clie_email; ?></td>
                                                            <td class="tg-6jgx"> <?php echo $fatura_clie_email; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-xuqs">&nbsp;&nbsp;&nbsp;Descrição</td>
                                                            <td class="tg-6nhr">Valor&nbsp;&nbsp;&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-kftd"><?php echo $fatura_descricao == '' ? 'Serviço - ' : $fatura_descricao ?></td>
                                                            <td class="tg-my2k"><?php echo formatFloat($fatura_valorTotal); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <?php if ($fatura_numerodcto != "") {
                                                                echo '<td style="font-size: 12px;" class="tg-0lax">Documentos Associados: ' . $fatura_numerodcto . '</td>';
                                                            } else {
                                                                echo '<td class="tg-0lax"></td>';
                                                            } ?>
                                                            <td class="tg-lqy6"></td>
                                                        </tr>
                                                        <?php
                                                        for ($i = 0; $i < 8; $i++) {
                                                            echo '<tr> <td class="tg-kftd"></td><td class="tg-my2k"></td></tr>';
                                                            echo '<tr> <td class="tg-0lax"></td><td class="tg-lqy6"></td></tr>';
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td class="tg-7qzr">Total:</td>
                                                            <td class="tg-7qzr"><?php echo formatFloat($fatura_valorTotal); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="tg-ynn5"><span style="font-weight:bold">De Acordo em      &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp/&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp/&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                                                            </td>
                                                            <td class="tg-0g60">Condições de Pagamento</td>
                                                        </tr>

                                                        <?php
                                                        $count = 0;
                                                        foreach ($listPendFin as $pendfin) {
                                                            echo '<tr>';
                                                            if ($count == 0) {
                                                                echo '<td style=" margin: 3px; tex-space:1px; text-align: center;" rowspan="' . $fatura_totalparcelas . '" >_______________________________________________________ <br><br>' . $fatura_clie_nome . '</td >';
                                                            }
                                                            echo '<td class="tg-0qe0"> ' .
                                                                $pendfin->getParcela() . "/" . $fatura_totalparcelas .
                                                                ' - ' . '  R$ ' . formatFloat($pendfin->getValor()) .
                                                                ' - ' . date("d/m/Y", $pendfin->getDataVcto()->getTimesTamp()) .
                                                                '</td></tr>';
                                                            $count += 1;
                                                        }
                                                        ?>

                                                        <!--                                                        <tr>-->
                                                        <!--                                                            <td class="tg-6qw1">-->
                                                        <!--                                                                -->
                                                        <!--                                                            </td>-->
                                                        <!--                                                            <td class="tg-0qe0">3-6 R$ 553,12 10/03/2019</td>-->
                                                        <!--                                                        </tr>-->
                                                        <!--                                                        <tr>-->
                                                        <!--                                                            <td class="tg-6qw1">--><?php //echo $fatura_clie_nome; ?>
                                                        <!--                                                            </td>-->
                                                        <!--                                                            <td class="tg-0qe0">4-6 R$ 553,12 10/04/2019</td>-->
                                                        <!--                                                        </tr>-->

                                                        <tr>
                                                            <td class="tg-13ft" colspan="2"><span
                                                                        style="font-weight:bold">www.GerBoletos.com.br</span>
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