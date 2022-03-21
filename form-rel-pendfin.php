<?php
//Inicialização da Página
require_once("inc/init.php");
require_once("inc/config.ui.php");
//Validação da Sessão
require_once("sessionIsAuthenticated.php");
//Conexão com a Base de Dados:
include_once 'database.php';

include_once("src/models/PendFin.php");

use models\PendFin;
use models\Cliente;

/* -----------------------------------------------------------
 *  ####[alteracao]  Variaveis Globais Formulário
 * ----------------------------------------------------------- */
$page_title = "Movimento Financeiro";
$classPHPNameController = 'form-rel-pendfin';
$wEntityName = "models\PendFin";
/* -----------------------------------------------------------
 *  ####[alteracao]  ./Variaveis Globais Formulário
 * -----------------------------------------------------------*/


/* -----------------------------------------------------------
 *  ####[alteracao]  Variáveis de Acesso Usuário
 * -----------------------------------------------------------*/
//Variável do Formuário
$_acessoForm = \Ctrl\AccessUserCtrl::$Acess_Rel_PendFin;
$usuario = \Ctrl\UserCtrl::getObjetoUsuario_Login();

$_acessoCopy = 0;
$_acessoPDF = 0;
$_acessoExcel = 0;
$_acessoPrinter = 0;

$wFiltro_Tipo = isset($_GET['radio-grp-tipo']) ? $_GET['radio-grp-tipo'] : null;
$wFiltro_Status = isset($_GET['radio-grp-status']) ? $_GET['radio-grp-status'] : null;
$wFiltro_DtMvtoI = isset($_GET['ed_datamvto_i']) ? $_GET['ed_datamvto_i'] : null;
$wFiltro_DtMvtoF = isset($_GET['ed_datamvto_f']) ? $_GET['ed_datamvto_f'] : null;
$wFiltro_DtVctoI = isset($_GET['ed_datavcto_i']) ? $_GET['ed_datavcto_i'] : null;
$wFiltro_DtVctoF = isset($_GET['ed_datavcto_f']) ? $_GET['ed_datavcto_f'] : null;
$wFiltro_DtBaixaI = isset($_GET['ed_databx_i']) ? $_GET['ed_databx_i'] : null;
$wFiltro_DtBaixaF = isset($_GET['ed_databx_f']) ? $_GET['ed_databx_f'] : null;

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
include("inc/header.php");

/* -----------------------------------------------------------
 *  ####[alteracao]  Informação de Navegação
 * -----------------------------------------------------------*/
$page_nav["relatorios"]["sub"]["rel_pendfin"]["active"] = true;
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
$breadcrumbs["Relatórios"] = "";
include("inc/ribbon.php");
?>

    <!-- MAIN CONTENT -->
    <div id="content">

        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark">
                    <i class="fa fa-table fa-fw "></i>
                    <!--/* ------------------------------------------------------------->
                    <!--* ####[alteracao] Texto de Cabeçalho do Formuário-->
                    <!--* -----------------------------------------------------------*/-->
                    Movimento /
                    <span>
                        Financeiro /
					</span>
                </h1>
            </div>
            <!--            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">-->

            <!--            </div>-->
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
                            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                            <!--/* ------------------------------------------------------------->
                            <!--* ####[alteracao] Texto de Cabeçalho do Grid-->
                            <!--* -----------------------------------------------------------*/-->
                            <h2> Listagem do Movimento</h2>

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
                                        <th class="hasinput" style="width:40px">
                                            <input type="text" class="form-control" placeholder="Operação"/>
                                        </th>
                                        <?php
                                        if ($usuario->isAdministrador()) {
                                            echo '<th class="hasinput" style="width:190px">' .
                                                '<input type="text" class="form-control" placeholder="Empresa"/>' .
                                                '</th>';
                                        }
                                        ?>
                                        <th class="hasinput" style="width:190px">
                                            <input type="text" class="form-control" placeholder="Cliente"/>
                                        </th>
                                        <th class="hasinput" style="width:80px">
                                            <input type="date" class="form-control" placeholder="Lcto"/>
                                        </th>
                                        <th class="hasinput" style="width:80px">
                                            <input type="date" class="form-control" placeholder="Vcto"/>
                                        </th>
                                        <th class="hasinput" style="width:80px">
                                            <input type="text" class="form-control" placeholder="Status"/>
                                        </th>
                                        <th class="hasinput" style="width:40px">
                                            <input type="text" class="form-control" placeholder="Parcela"/>
                                        </th>
                                        <th class="hasinput" style="width:40px">
                                            <input type="text" class="form-control" placeholder="Valor"/>
                                        </th>
                                        <th class="hasinput" style="width:90px">
                                            <input type="text" class="form-control" placeholder="N. Dcto"/>
                                        </th>
                                        <!--/* ------------------------------------------------------------->
                                        <!--* #### Filtros da Coluna Opções está Hidden-->
                                        <!--* -----------------------------------------------------------*/-->
                                        <th class="hasinput" style="width:90px">
                                            <input type="hidden" class="form-control" placeholder=""/>
                                        </th>
                                    </tr>
                                    <tr>
                                        <!--/* -----------------------------------------------------------
                                        * ####[alteracao] Colunas do Grid
                                        * -----------------------------------------------------------*/-->
                                        <th data-hide="phone">Operação</th>
                                        <?php
                                        if ($usuario->isAdministrador()) {
                                            echo '<th data-class="expand">Empresa</th>';
                                        }
                                        ?>
                                        <th data-class="expand">Cliente</th>
                                        <th data-class="expand">Lançamento</th>
                                        <th data-class="expand">Vencimento</th>
                                        <th data-class="expand">Status</th>
                                        <th class="text-align-right" data-class="phone">Parcela</th>
                                        <th class="text-align-right" data-class="expand">Valor</th>
                                        <th class="text-align-right" data-class="phone">N. Dcto</th>
                                        <th>Opções</th>
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
                                                if ($usuario->isAdministrador()) {
                                                    $qb->select('p.transacao ,p.operacao', 'p.codEntidade', 'p.status', 'p.dataLcto', 'p.dataVcto', 'p.parcela', 'p.valor', 'p.numeroDcto', 'p.email',
                                                        'c.codigo', 'c.nome','e.nome as nomeEmpresa','p.cobranca', 'p.baixaManual')
                                                        ->from('models\PendFin', 'p')
                                                        ->innerJoin('models\Cliente', 'c', 'WITH', 'c.codigo = p.codEntidade')
                                                        ->innerJoin('models\Empresa', 'e', 'WITH', 'p.empr_Codigo = e.codigo');
                                                } else {
                                                    $qb->select('p.transacao ,p.operacao', 'p.codEntidade', 'p.status', 'p.dataLcto', 'p.dataVcto', 'p.parcela', 'p.valor', 'p.numeroDcto', 'p.email', 'c.codigo', 'c.nome','p.cobranca')
                                                        ->from('models\PendFin', 'p')
                                                        ->where('p.empr_Codigo = :empresa')
                                                        ->innerJoin('models\Cliente', 'c', 'WITH', 'c.codigo = p.codEntidade')
                                                        ->setParameter('empresa', $empr_codigo);
                                                }
                                                if ($wFiltro_Tipo != null && $wFiltro_Tipo != "") {
                                                    $qb->andWhere('p.tipo = :tipo')
                                                        ->setParameter('tipo', $wFiltro_Tipo);
                                                }
                                                if ($wFiltro_Status != null && $wFiltro_Status != "" && $wFiltro_Status != "T") {
                                                    $qb->andWhere('p.status = :status')
                                                        ->setParameter('status', $wFiltro_Status);
                                                }
                                                if ($wFiltro_DtMvtoI != null && $wFiltro_DtMvtoI != "") {
                                                    $qb->andWhere('p.dataMvto >= :dtmvtoi')
                                                        ->setParameter('dtmvtoi', new DateTime($wFiltro_DtMvtoI), \Doctrine\DBAL\Types\Type::DATE);
                                                }
                                                if ($wFiltro_DtMvtoF != null && $wFiltro_DtMvtoF != "") {
                                                    $qb->andWhere('p.dataMvto <= :dtmvtof')
                                                        ->setParameter('dtmvtof', new DateTime($wFiltro_DtMvtoF), \Doctrine\DBAL\Types\Type::DATE);
                                                }
                                                if ($wFiltro_DtVctoI != null && $wFiltro_DtVctoI != "") {
                                                    $qb->andWhere('p.dataVcto >= :dtvctoi')
                                                        ->setParameter('dtvctoi', new DateTime($wFiltro_DtVctoI), \Doctrine\DBAL\Types\Type::DATE);
                                                }
                                                if ($wFiltro_DtVctoF != null && $wFiltro_DtVctoF != "") {
                                                    $qb->andWhere('p.dataVcto <= :dtvctof')
                                                        ->setParameter('dtvctof', new DateTime($wFiltro_DtVctoF), \Doctrine\DBAL\Types\Type::DATE);
                                                }
                                                if ($wFiltro_DtBaixaI != null && $wFiltro_DtBaixaI != "") {
                                                    $qb->andWhere('p.dataBaixa >= :dtbxi')
                                                        ->setParameter('dtbxi', new DateTime($wFiltro_DtBaixaI), \Doctrine\DBAL\Types\Type::DATE);
                                                }
                                                if ($wFiltro_DtBaixaF != null && $wFiltro_DtBaixaF != "") {
                                                    $qb->andWhere('p.dataBaixa <= :dtbxf')
                                                        ->setParameter('dtbxf', new DateTime($wFiltro_DtBaixaF), \Doctrine\DBAL\Types\Type::DATE);
                                                }
                                                $dadosResult = $qb->getQuery()->getResult();
                                                foreach ($dadosResult as $dadosObj) {
                                                    ?>
                                                    <tr>
                                                        <!--/* -----------------------------------------------------------
                                                        * ####[alteracao] Preenchimento dos Conteúdo do Grid
                                                        * -----------------------------------------------------------*/-->
                                                        <td> <?php echo $dadosObj['operacao'] ?> </td>
                                                        <?php
                                                        if ($usuario->isAdministrador()) {
                                                            echo '<td>' . $dadosObj['nomeEmpresa'] . '</td>';
                                                        }
                                                        ?>
                                                        <td> <?php echo $dadosObj['nome'] ?> </td>
                                                        <td> <?php echo $dadosObj['dataLcto']->format('d/m/Y') ?> </td>
                                                        <td> <?php echo $dadosObj['dataVcto']->format('d/m/Y') ?> </td>
                                                        <td>
                                                            <?php
                                                            if ($dadosObj['status'] == "P") {
                                                                if ($dadosObj['cobranca'] == "S") {
                                                                    echo '<span class="label label-default bg-color-magenta"> Cobrança </span>';
                                                                } else if ($dadosObj['dataVcto'] < new DateTime('now')){
                                                                    echo '<span class="label label-warning"> Atrasado </span>';
                                                                } else {
                                                                    echo '<span class="label label-danger"> Pendente</span>';
                                                                }
                                                            } else if ($dadosObj['status'] == "B") {
                                                                if (($dadosObj['baixaManual']!="") && ($dadosObj['baixaManual']!="N")) {
                                                                    //$tiposDeBaixa[] = ["S", " Baixa Normal"];
                                                                    //$tiposDeBaixa[] = ["R", " Recompra"];
                                                                    //$tiposDeBaixa[] = ["E", " Renegociada"];
                                                                    if ($dadosObj['baixaManual']=="R") {
                                                                        echo '<span class="label label-default bg-color-laranja-fabio"> Recomprada</span>';
                                                                    } else if ($dadosObj['baixaManual']=="E") {
                                                                        echo '<span class="label label-default bg-color-pinkDark"> Renegociada</span>';
                                                                    } else {
                                                                        echo '<span class="label label-success"> Baixada (Manual) '.$dadosObj["baixaManual"].' </span>';
                                                                    }
                                                                } else {
                                                                    echo '<span class="label label-success"> Baixada</span>';
                                                                }
                                                            } else if ($dadosObj['status'] == "C") {
                                                                echo '<span class="label label-default bg-color-grayDark"> Cancelada</span>';
                                                            }
                                                            ?>
                                                        </td>
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
                                                            <a href="/form-print-pendfin.php?transacao=<?php echo $dadosObj['transacao'] ?>"
                                                               class="btn btn-primary fa fa-print"> Imprimir</a>
                                                            <?php
                                                            $uploaddir = './uploads/' . $dadosObj['transacao'];
                                                            if (file_exists($uploaddir)) {
                                                                echo '<div class="btn-group dropup">
                                                                    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                                         <span class="fa fa-download"></span>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-right">';
                                                                $files = scandir($uploaddir);
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
                            <!-- end widget content -->
                        </div>
                        <!-- end widget div -->

                    </div>
                    <!-- end widget -->

                </article>
                <!-- WIDGET END -->

            </div>

            <!-- end row -->

            <!-- end row -->

        </section>
        <!-- end widget grid -->


        <!-- Modal -->
        <div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <h3 class="modal-title" id="myModalLabel"><?php echo $page_title ?></h3>
                    </div>
                    <div class="modal-body custom-scroll terms-body">

                        <div id="left">
                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3"
                                 data-widget-colorbutton="false" data-widget-editbutton="false"
                                 data-widget-custombutton="false">
                                <header>
                                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                    <h2>Dados do Cadastro</h2>
                                </header>

                                <!-- widget div-->
                                <div>

                                    <!-- widget edit box -->
                                    <div class="jarviswidget-editbox">
                                        <!-- This area used as dropdown edit box -->
                                    </div>
                                    <!-- end widget edit box -->

                                    <!-- widget content -->
                                    <div class="widget-body no-padding">

                                        <form name="form-cadastro" class="smart-form" id="form_cadastro"
                                              method="post">

                                            <!--/* -----------------------------------------------------------
                                            * #### Estes Inputs São de Controle e Estão hidden Alterar Somente Caso
                                            Necessário
                                            * -----------------------------------------------------------*/-->
                                            <!-- hidden parameters -->
                                            <input id="action-form-cadastro" name="action" type="hidden"
                                                   value="insert">
                                            <input id="codigo-form-cadastro" name="codigo" type="hidden" value="">
                                            <!-- ./hidden parameters -->

                                            <header>
                                                <!--                                                    Tooltips (with icon)-->
                                            </header>
                                            <fieldset>
                                            </fieldset>

                                            <div class="modal-footer">
                                                <button type="submit"
                                                        id="btnSave"
                                                        class="btn-form-modal btn btn-primary"><i
                                                            class="fa fa-check"></i> Salvar
                                                </button>
                                                <button type="button" class="btn-form-modal btn btn-default"
                                                        data-dismiss="modal"><i class="fa fa-close"></i> Cancelar
                                                </button>

                                            </div>
                                        </form>

                                    </div>
                                    <!--end widget content-->

                                </div>
                                <!--end widget div-->

                            </div>
                            <!--end widget div-->

                        </div>
                        <!--end left div-->
                    </div><!-- /.modal - content-->
                </div><!-- /.modal - dialog-->
            </div><!-- /.modal-->
        </div>
        <!--END MAIN CONTENT-->
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
    <script src="<?php echo ASSETS_URL; ?>/js/forms.functions.js"></script>
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