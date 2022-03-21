<?php
//Inicialização da Página
require_once("inc/init.php");
require_once("inc/config.ui.php");
//Validação da Sessão
require_once("sessionIsAuthenticated.php");
//Conexão com a Base de Dados:
include_once('database.php');

include_once("src/models/PendFin.php");
include_once("controller/CalcAntecipacaoCtrl.php");

/* -----------------------------------------------------------
 *  ####[alteracao]  Variaveis Globais Formulário
 * ----------------------------------------------------------- */
$page_title = "Antecipação de Movimentos";
$classPHPNameController = 'form-lcto-antecip-analise-det';
$wEntityName = "models\PendFin";

$transacao = null;
if (isset($_POST['transacao'])) {
    $transacao = $_POST['transacao'];
}

if ($transacao == null) {
    header('Location: form-lcto-antecip-analise.php');
    exit;
}

$dtMvto = null;
if (isset($_POST['dtmvto'])) {
    $dtMvto = date_create_from_format('Y-m-d', $_POST['dtmvto']);
}
if ($dtMvto == null) {
    $dtMvto = new DateTime('now');
}

/* -----------------------------------------------------------
 *  ####[alteracao]  ./Variaveis Globais Formulário
 * -----------------------------------------------------------*/


/* -----------------------------------------------------------
 *  ####[alteracao]  Variáveis de Acesso Usuário
 * -----------------------------------------------------------*/
//Variável do Formuário
$_acessoForm = \Ctrl\AccessUserCtrl::$Acess_Lctos_Antecip;
$usuario = \Ctrl\UserCtrl::getObjetoUsuario_Login();

$_acessoCopy = 0;
$_acessoPDF = 0;
$_acessoExcel = 0;
$_acessoPrinter = 0;

/* -----------------------------------------------------------
 *  ####                  ./Validação Acesso Usuário
 * -----------------------------------------------------------*/


/* -----------------------------------------------------------
 *  ####[alteracao]  Listas de Dados dos Edits - ItemsEdits
 * -----------------------------------------------------------*/


/* -----------------------------------------------------------
 *  ####[alteracao]   ./Listas de Dados dos Edits - END
 * -----------------------------------------------------------*/


/* -----------------------------------------------------------
 *  ####  Função que Valida se o Usuário tem Acesso ao Formulário e Instalação
 * -----------------------------------------------------------*/

use ctrl\UserCtrl;

UserCtrl::validateAcessAuthorizedForm($_acessoForm);


/* -----------------------------------------------------------
 *  ####  CSS e Cabeçalho
 * -----------------------------------------------------------*/
$page_css[] = "your_style.css";
$page_css[] = "jquery.loadingModal.css";
$page_css[] = "jquery.loadingModal.min.css";
include("inc/header.php");

/* -----------------------------------------------------------
 *  ####[alteracao]  Informação de Navegação
 * -----------------------------------------------------------*/
$page_nav["financeiro"]["sub"]["lctos_pendfin_antecip_analise"]["active"] = true;
include("inc/nav.php");
?>
    <!-- ==========================CONTENT STARTS HERE ========================== -->
    <!-- MAIN PANEL -->
    <div id="main" role="main">

        <?php
        /* -----------------------------------------------------------
         *  ####[alteracao]  Informação de Navegação, "BreadCrumbs"
         *                      deve ser alterada para quem é o Pai do
         *                      formulário
         * -----------------------------------------------------------*/
        $breadcrumbs["Antecipação"] = "";
        include("inc/ribbon.php");
        ?>

        <!-- MAIN CONTENT -->
        <div id="content">

            <form id="form-lcto-analise-antecip" name="form-lcto-analise-antecip">

                <input id="transacao" name="transacao" type="hidden" value="<?php echo $transacao ?>">
                <input id="operacoes" name="operacoes" type="hidden" value="">
                <input id="numOcorrencias" name="numOcorrencias" type="hidden" value="">
                <input id="numAprovados" name="numAprovados" type="hidden" value="">
                <input id="numRejeitados" name="numRejeitados" type="hidden" value="">
                <input id="valorRepasse" name="valorRepasse" type="hidden" value="">
                <input id="valorMvto" name="valorMvto" type="hidden" value="">

                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <h1 class="page-title txt-color-blueDark">
                            <i class="fa fa-dollar fa-fw "></i>
                            <!--/* ------------------------------------------------------------->
                            <!--* ####[alteracao] Texto de Cabeçalho do Formuário-->
                            <!--* -----------------------------------------------------------*/-->
                            Movimento /
                            <span>
                        Antecipação - Análise Detalhe
					</span>
                        </h1>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <div class="form-group has-success text-align-center margin-top-10">
                            <label class="col-md-2 col-sm-2 col-lg-2 control-label margin-top-5 margin-right-5">Repasse:</label>
                            <div class="col-md-2 col-sm-2 col-lg-2">
                                <div class="input-group">
                                    <input class="form-control" name="dataMvto" id="dataMvto" type="date" value="<?php echo $dtMvto->format('Y-m-d') ?>"/>
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <div class="input-group-btn">
                                        <button id="btnReloadForm" class="btn btn-success" type="button" data-dtmvto="<?php echo $dtMvto->format('Y-m-d') ?>" data-transacao="<?php echo $transacao ?>">
                                            Carregar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- widget grid -->
                <section id="widget-grid" class="">

                    <!-- row -->
                    <div class="row">

                        <!-- NEW WIDGET START -->
                        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1"
                                 data-widget-editbutton="false">

                                <header>
                                    <span class="widget-icon"> <i class="fa fa-dollar"></i> </span>
                                    <!--/* ------------------------------------------------------------->
                                    <!--* ####[alteracao] Texto de Cabeçalho do Grid-->
                                    <!--* -----------------------------------------------------------*/-->
                                    <h2> Detalhe do Movimento</h2>
                                </header>

                                <!-- widget div-->
                                <div>
                                    <div id="div_avisos">

                                    </div>

                                    <!-- widget edit box -->
                                    <div class="jarviswidget-editbox">
                                        <!-- This area used as dropdown edit box -->

                                    </div>
                                    <!-- end widget edit box -->

                                    <!-- widget content -->
                                    <div class="widget-body no-padding">
                                        <table id="datatable_cadastro"
                                               class="table table-striped table-bordered table-hover"
                                               width="100%">

                                            <thead>
                                            <tr>
                                                <!--/* ------------------------------------------------------------->
                                                <!--* ####[alteracao] Filtros das Colunas do Grid ()-->
                                                <!--* -----------------------------------------------------------*/-->
                                                <th class="hasinput" style="width:80px">
                                                    <input type="text" class="form-control" placeholder="Aprovação"/>
                                                </th>
                                                <th class="hasinput" style="width:150px">
                                                    <input type="text" class="form-control" placeholder="Cliente"/>
                                                </th>
                                                <th class="hasinput" style="width:70px">
                                                    <input type="text" class="form-control" placeholder="Vcto"/>
                                                </th>
                                                <th class="hasinput" style="width:150px">
                                                    <input type="text" class="form-control" placeholder="Descrição"/>
                                                </th>
                                                <th class="hasinput" style="width:25px">
                                                    <input type="text" class="form-control" placeholder="Parcela"/>
                                                </th>
                                                <th class="hasinput" style="width:50px">
                                                    <input type="text" class="form-control" placeholder="Valor"/>
                                                </th>
                                                <th class="hasinput" style="width:70px">
                                                    <input type="text" class="form-control" placeholder="N. Dcto"/>
                                                </th>
                                                <!--/* ------------------------------------------------------------->
                                                <!--* #### Filtros da Coluna Opções está Hidden-->
                                                <!--* -----------------------------------------------------------*/-->
                                                <th class="hasinput" style="width:120px">
                                                    <input type="hidden" class="form-control" placeholder=""/>
                                                </th>
                                            </tr>
                                            <tr>
                                                <!--/* -----------------------------------------------------------
                                                * ####[alteracao] Colunas do Grid
                                                * -----------------------------------------------------------*/-->
                                                <th data-class="expand">Aprovação</th>
                                                <th data-class="expand">Cliente</th>
                                                <th data-class="expand">Vencimento</th>
                                                <th data-class="expand">Descrição</th>
                                                <th class="text-align-right" data-class="phone">Parcela</th>
                                                <th class="text-align-right" data-class="expand">Valor</th>
                                                <th class="text-align-right" data-class="phone">N. Dcto</th>
                                                <th>Anexos</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php
                                            try {
                                                $empr_codigo = 0;
                                                if ($usuario != null && $usuario->getEmpresa() > 0) {
                                                    $empr_codigo = $usuario->getEmpresa();
                                                }
                                                if ($empr_codigo > 0) {
                                                    $qb = $entityManager->createQueryBuilder();
                                                    if ($qb != null) {
                                                        $qb->select('p.transacao', 'p.operacao', 'p.codEntidade', 'p.status', 'p.dataVcto', 'p.parcela', 'p.valor', 'p.numeroDcto', 'p.observacao',
                                                            'e.codigo as empr_codigo', 'e.nome', 'e.fatorCompra', 'e.percAdValoren', 'e.percIOF', 'e.percIOFDiario', 'e.taxaboleto', 'e.fatorCompra',
                                                            'a.codigo'
                                                        );
                                                        $qb->from('models\pendfin', 'p');
                                                        $qb->innerJoin('models\MovAntecipacao', 'a', 'WITH', 'a.transacao = p.transacaoAntecipacao');
                                                        $qb->innerJoin('models\Cliente', 'c', 'WITH', 'c.codigo = p.codEntidade');
                                                        $qb->innerJoin('models\Empresa', 'e', 'WITH', 'e.codigo = p.empr_Codigo');
                                                        $qb->where('p.status = :status')->setParameter('status', "P");
                                                        $qb->andWhere('p.statusAntecipacao = :statusAntecipacao')->setParameter('statusAntecipacao', "P");
                                                        $qb->andWhere('a.status = :statusMA')->setParameter('statusMA', "N");
                                                        $qb->andWhere('a.transacao = :transacao')->setParameter("transacao", $transacao);
                                                        $qb->orderBy('p.dataVcto');
                                                        $dadosResult = $qb->getQuery()->getResult();
                                                        foreach ($dadosResult as $dadosObj) {
                                                            ?>
                                                            <tr>
                                                                <!--/* -----------------------------------------------------------
                                                                * ####[alteracao] Preenchimento dos Conteúdo do Grid
                                                                * -----------------------------------------------------------*/-->
                                                                <?php
                                                                $existFiles = false;
                                                                $uploaddir = './uploads/' . $dadosObj['transacao'];
                                                                if (file_exists($uploaddir)) {
                                                                    $files = scandir($uploaddir);
                                                                    $existFiles = sizeof($files) > 0;
                                                                }
                                                                ?>
                                                                <td>
                                                                    <label class="checkbox">
                                                                        <?php
                                                                        $valorPrev = 0;
                                                                        $dtvcto = $dadosObj['dataVcto'];
                                                                        $percAdValore = $dadosObj['percAdValoren'];
                                                                        $percIOF = $dadosObj['percIOF'];
                                                                        $percIOFDiario = $dadosObj['percIOFDiario'];
                                                                        $taxaBoleto = $dadosObj['taxaboleto'];
                                                                        $fatorCompra = $dadosObj['fatorCompra'];
                                                                        $calc = new CalcAntecipacaoCtrl();
                                                                        $dadosCalc = $calc->executeCalculo($dadosObj['valor'], $dtvcto, $dtMvto, $fatorCompra, $percAdValore, $percIOF, $percIOFDiario, $taxaBoleto);
                                                                        ?>
                                                                        <button id="btnStatusOP_<?php echo $dadosObj['operacao'] ?>"
                                                                                type="button"
                                                                                class="btn btn-info dropdown-toggle"
                                                                                data-toggle="dropdown"
                                                                                data-id="<?php echo $dadosObj['codigo'] ?>"
                                                                                data-bruto="<?php echo $dadosObj['valor'] ?>"
                                                                                data-liquido="<?php echo $dadosCalc['liquido'] ?>"
                                                                                data-custo="<?php echo $dadosCalc['custo_total'] ?>"
                                                                                tabindex="-1">
                                                                            <span id="spanStatusOp_<?php echo $dadosObj['operacao'] ?>"
                                                                                  data-value="<?php echo $dadosObj['operacao'] ?>"> Pendente </span>
                                                                            <span class="caret"></span>
                                                                        </button>
                                                                        <input id="inputStatusOP_<?php echo $dadosObj['operacao'] ?>" name="inputStatusOP_<?php echo $dadosObj['operacao'] ?>"
                                                                               type="hidden" value="9">
                                                                        <ul name="ulStatusOP_<?php echo $dadosObj['operacao'] ?>" id="ulStatusOp" class="dropdown-menu pull-right" role="menu"
                                                                            data-value="<?php echo $dadosObj['operacao'] ?>">
                                                                            <li value="1" data-value="<?php echo $dadosObj['operacao'] ?>"><a href="javascript:void(0);">Aprovar</a></li>
                                                                            <li value="2" data-value="<?php echo $dadosObj['operacao'] ?>"><a href="javascript:void(0);">Rejeitar</a></li>
                                                                            <li value="9" data-value="<?php echo $dadosObj['operacao'] ?>" class="divider"></li>
                                                                            <li value="9" data-value="<?php echo $dadosObj['operacao'] ?>"><a href="javascript:void(0);">Cancelar</a></li>
                                                                        </ul>
                                                                    </label>
                                                                </td>
                                                                <td> <?php echo $dadosObj['nome'] ?> </td>
                                                                <td> <?php echo $dadosObj['dataVcto']->format('d/m/Y') ?> </td>
                                                                <td> <?php echo $dadosObj['observacao'] ?> </td>
                                                                <td class="text-align-right"> <?php echo $dadosObj['parcela'] ?> </td>
                                                                <td class="text-align-right"> <?php echo formatFloat($dadosObj['valor']) ?> </td>
                                                                <td class="text-align-right"> <?php echo $dadosObj['numeroDcto'] ?> </td>
                                                                <!--/* -----------------------------------------------------------
                                                                * ####[alteracao] Botões de Cada Linha (Cuidar a Variável
                                                                * "_acesso..."), Altera Somente se Necessário
                                                                * botões delete e edit manter o NAME pois está linkado com o
                                                                * Java Script
                                                                * -----------------------------------------------------------*/-->
                                                                <td>
                                                                    <?php
                                                                    if ($existFiles) {
                                                                        echo '<div style="height: 35px;" class="btn-group dropup">
                                                                    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                                         <span class="fa fa-download"></span>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-right">';
                                                                        if (assert($files)) {
                                                                            foreach ($files as $file) {
                                                                                if ($file != '.' && $file != '..') {
                                                                                    echo '<li> <a href="download.php?transacao=' . $dadosObj['transacao'] . '&file=' . $file . '">' . $file . '</a> </li> <li class="divider"></li>';
                                                                                }
                                                                            }
                                                                        }
                                                                        echo '</ul>
                                                                </div>';
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                }
                                            } catch (Exception $exception) {
                                                echo '<div class="alert alert-danger no-margin fade in">' .
                                                    '<button class="close" data-dismiss="alert">×</button>' .
                                                    '<i class="fa-fw fa fa-exclamation-circle"></i>' .
                                                    'Falha ao Carregar dados: ' . $page_title . '<br>' . $exception->getMessage() .
                                                    '</div>';
                                            }
                                            ?>
                                            </tbody>

                                        </table>

                                    </div>

                                </div>
                                <!-- end widget div -->

                            </div>
                            <!-- end widget -->

                        </article>
                        <!-- WIDGET END -->

                    </div>

                </section>
                <!-- end widget grid -->

                <!-- end row -->
                <div id="footer-antecip-totais"
                     style="color: #333; background: #4c4f53;  border: 1px solid #C2C2C2; z-index: 901;  margin: 3px; margin-top: 0px; margin-bottom: 0px; padding: 6px 6px 0; position: fixed; height: 50px; bottom: 60px; width: 90%;">
                    <div class="col-xs-8 col-sm-8">
                        <div class="row">
                            <div class="col-xs-2 col-sm-2">
                                <span class="txt-color-blueLight">N. Aprovadas</span>
                            </div>
                            <div class="col-xs-2 col-sm-2">
                                <span class="txt-color-blueLight">Valor Bruto</span>
                            </div>
                            <div class="col-xs-2 col-sm-2">
                                <span class="txt-color-blueLight">Valor Desc</span>
                            </div>
                            <div class="col-xs-2 col-sm-2">
                                <span class="txt-color-blueLight">Valor Repasse</span>
                            </div>
                            <div class="col-xs-2 col-sm-2">
                                <span class="txt-color-orange">N. Rejeitados</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2 col-sm-2">
                                <span id="spnCountAprovadas" class="txt-color-white">000</span>
                            </div>
                            <div class="col-xs-2 col-sm-2">
                                <span id="spnValorBruto" class="txt-color-white">R$ 0,00</span>
                            </div>
                            <div class="col-xs-2 col-sm-2">
                                <span id="spnValorDesc" class="txt-color-white">R$ 0,00</span>
                            </div>
                            <div class="col-xs-2 col-sm-2">
                                <span id="spnValorLiquido" class="txt-color-white">R$ 0,00</span>
                            </div>
                            <div class="col-xs-2 col-sm-2">
                                <span id="spnCountRejeitadas" class="txt-color-white">000</span>
                            </div>
                        </div>
                    </div><!--                                onclick="form_func_execute_ShowModal('#modalCadastro');"-->
                    <div id="divBtnSubmit" class="col-xs-1 col-sm-1" hidden>
                        <button type="button"
                                id="btnSubmit"
                                class="btn btn-success">
                            <i class="fa fa-magnet"> </i> Confirmar
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>


    <!--END MAIN PANEL-->
    <!-- ==========================CONTENT ENDS HERE ========================== -->

    <!--PAGE FOOTER-->
<?php // incluir dados de rodapé da Página
include("inc/footer.php");
?>
    <!-- END PAGE FOOTER -->

<?php //include required scripts
include("inc/scripts.php");
?>
    <!--/* -----------------------------------------------------------
    * #### Script Geral
    * -----------------------------------------------------------*/-->
    <!-- Funções do Formulário de Cadastro -->
    <!--    <script src="--><?php //echo ASSETS_URL; ?><!--/js/forms.functions.js"></script>-->
    <!-- ./Funções do Formulário de Cadastro -->

    <!--/* -----------------------------------------------------------
    * #### Script do Formulário
    * -----------------------------------------------------------*/-->
    <!-- JS FORM -->
<?php
if (file_exists("js/forms/" . $classPHPNameController . '.js')) {
    $fileJsFormulario = ASSETS_URL . '/js/forms/' . $classPHPNameController . '.js';
    echo '<script src="' . $fileJsFormulario . '"></script>';
}
?>
    <!-- ./JS FORM -->

    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/jquery-modais/jquery.loadingModal.js"></script>

    <script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.colVis.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.tableTools.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>


    <script type="text/javascript">

        $(document).ready(function () {

            var responsiveHelper_datatable_cadastro = undefined;

            var breakpointDefinition = {
                tablet: 1024,
                phone: 480
            };

            /* TABLETOOLS */
            var tabelaCadastro = $('#datatable_cadastro').DataTable({

                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>TC>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-5 col-xs-12 hidden-xs'i><'col-xs-6 col-sm-2'l><'col-xs-12 col-sm-5'p>>",
                "autoWidth": true,
                "bProcessing": true,
                "oTableTools":
                    {
                        "aButtons":
                            [
                                <?php
                                $strBtnIncluirAjax = null;
                                $strBtnOpcoes = \app\Html::loadButtonsOpcoesAjaxPlugin(true, true, true, true);
                                $resultBtns = "";
                                if ($strBtnIncluirAjax != null && $strBtnIncluirAjax != "") {
                                    $resultBtns = $resultBtns . $strBtnIncluirAjax;
                                }
                                if ($strBtnOpcoes != null && $strBtnOpcoes != "") {
                                    if ($resultBtns != "") {
                                        $resultBtns = $resultBtns . ' , ';
                                    }
                                    $resultBtns = $resultBtns . $strBtnOpcoes;
                                }
                                echo $resultBtns;
                                ?>
                            ]
                        ,
                        "sSwfPath":
                            "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
                    }
                ,
                "preDrawCallback":

                    function () {
                        if (!responsiveHelper_datatable_cadastro) {
                            responsiveHelper_datatable_cadastro = new ResponsiveDatatablesHelper($('#datatable_cadastro'), breakpointDefinition);
                        }
                    }
                ,
                "rowCallback":

                    function (nRow) {
                        responsiveHelper_datatable_cadastro.createExpandIcon(nRow);
                    }

                ,
                "drawCallback":

                    function (oSettings) {
                        responsiveHelper_datatable_cadastro.respond();
                    }
            });

            // Apply the filter
            $("#datatable_cadastro thead th input[type=text]").on('keyup change', function () {

                tabelaCadastro
                    .column($(this).parent().index() + ':visible')
                    .search(this.value)
                    .draw();

            });
            /* END COLUMN FILTER */

            //Correção CSS Stilo dos botoes do Grid - Cuidado ao Modificar ordem faz diferença
            $(".DTTT_container").removeClass().addClass("btn-group pull-right");

            $("#ToolTables_datatable_cadastro_0").removeClass().addClass("DTTT_button_collection btn btn-primary btn-sm dropdown-toggle pull-right btn-margim ");//DTTT_button
            $("#ToolTables_datatable_cadastro_0").removeClass().addClass("DTTT_button_collection btn btn-primary btn-sm dropdown-toggle pull-right btn-margim");//DTTT_button
            $("#ToolTables_datatable_cadastro_0").append('<span class="caret"></span>');
            $('.ColVis_Button').removeClass().addClass("ColVis_MasterButton btn btn-primary btn-sm dropdown-toggle pull-left btn-margim");
            $('.ColVis_MasterButton').append('<span class="caret"></span>');
            /* END TABLETOOLS */

        });


        /* -----------------------------------------------------------
        *  Seta as Variáveis Globais que são utilizadas no js "forms.functions.js"
        * -----------------------------------------------------------*/
        function loadVarsGlobaisFormulario(classCtrl) {
            wClassCtrl = classCtrl;
            wUrlCtrl = "../../controller/" + wClassCtrl + "-ctrl.php";
        }

        loadVarsGlobaisFormulario(<?php echo '"' . $classPHPNameController . '"' ?>);

    </script>


<?php
//include footer
include("inc/google-analytics.php");
?>