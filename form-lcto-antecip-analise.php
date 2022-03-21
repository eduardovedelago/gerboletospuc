<?php
//Inicialização da Página
require_once("inc/init.php");
require_once("inc/config.ui.php");
//Validação da Sessão
require_once("sessionIsAuthenticated.php");
//Conexão com a Base de Dados:
include_once 'database.php';

include_once("src/models/PendFin.php");
include_once("controller/CalcAntecipacaoCtrl.php");

/* -----------------------------------------------------------
 *  ####[alteracao]  Variaveis Globais Formulário
 * ----------------------------------------------------------- */
$page_title = "Análise Antecipação de Movimentos";
$classPHPNameController = 'form-lcto-antecip-analise';
$wEntityName = "models\PendFin";
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
$page_css[] = "upload.css";
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
$breadcrumbs["Antecipacao"] = "";
include("inc/ribbon.php");
?>

    <!-- MAIN CONTENT -->
    <div id="content">

        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-5">
                <h1 class="page-title txt-color-blueDark">
                    <i class="fa fa-dollar fa-fw "></i>
                    <!--/* ------------------------------------------------------------->
                    <!--* ####[alteracao] Texto de Cabeçalho do Formuário-->
                    <!--* -----------------------------------------------------------*/-->
                    Movimento /
                    <span>
                        Financeiro / Análise de Antecipação
					</span>
                </h1>
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
                                        <th class="hasinput" style="width:50px">
                                            <input type="hidden" class="form-control" placeholder="Análise"/>
                                        </th>
                                        <th class="hasinput" style="width:200px">
                                            <input type="text" class="form-control" placeholder="Empresa"/>
                                        </th>
                                        <th class="hasinput" style="width:70px">
                                            <input type="date" class="form-control" placeholder="Lcto"/>
                                        </th>
                                        <th class="hasinput" style="width:50px">
                                            <input type="number" class="form-control" placeholder="Valor"/>
                                        </th>
                                        <th class="hasinput" style="width:50px">
                                            <input type="number" class="form-control" placeholder="Prev"/>
                                        </th>
                                        <th class="hasinput" style="width:50px">
                                            <input type="number" class="form-control" placeholder="Num. Pend."/>
                                        </th>
                                    </tr>
                                    <tr>
                                        <!--/* -----------------------------------------------------------
                                        * ####[alteracao] Colunas do Grid
                                        * -----------------------------------------------------------*/-->
                                        <th data-class="expand">Análise</th>
                                        <th data-class="expand">Cliente</th>
                                        <th data-class="expand">Lançamento</th>
                                        <th class="text-align-right" data-class="expand">Valor</th>
                                        <th class="text-align-right" data-class="expand">Prev.</th>
                                        <th class="text-align-right" data-class="expand">Num. Pend.</th>
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
                                            //$qb = getCreateQueryBuilderLogged($entityManager)->createQueryBuilder();
                                            if ($qb != null) {
                                                $qb->select('a.transacao', 'a.valor', 'a.valorprev', 'a.dataLcto',
                                                    'e.codigo', 'e.nome',
                                                    'e.fatorCompra', 'e.percAdValoren', 'e.percIOF', 'e.percIOFDiario', 'e.taxaboleto', 'e.fatorCompra',
                                                    'count(a.transacao) as countPF'
                                                );
                                                $qb->from('models\MovAntecipacao', 'a');
                                                $qb->innerJoin('models\PendFin', 'p', 'WITH', 'a.transacao = p.transacaoAntecipacao');
                                                $qb->innerJoin('models\Cliente', 'c', 'WITH', 'c.codigo = p.codEntidade');
                                                $qb->innerJoin('models\Empresa', 'e', 'WITH', 'e.codigo = p.empr_Codigo');
                                                $qb->groupBy('a.transacao', 'a.valor', 'a.valorprev', 'a.dataLcto');
                                                $qb->addGroupBy('e.codigo', 'e.nome');
                                                $qb->addGroupBy('e.fatorCompra', 'e.percAdValoren', 'e.percIOF', 'e.percIOFDiario', 'e.taxaboleto', 'e.fatorCompra');
                                                $qb->where('a.status = :status')->setParameter('status', "N");
                                                $qb->andWhere('p.statusAntecipacao = :statusAntecipacao')->setParameter('statusAntecipacao', "P");
                                                $qb->andWhere('p.status = :statusp')->setParameter('statusp', "P");

                                                $qb->orderBy('a.dataLcto', 'desc');
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
                                                            <button id="btnAnalisar"
                                                                    class="analisar btn btn-primary fa fa-tag"
                                                                    data-transacao="<?php echo $dadosObj['transacao'] ?>">
                                                                Analisar
                                                            </button>

                                                        </td>
                                                        <td> <?php echo $dadosObj['nome'] ?> </td>
                                                        <td> <?php echo $dadosObj['dataLcto']->format('d/m/Y') ?> </td>
                                                        <td class="text-align-right"> <?php echo formatFloat($dadosObj['valor']) ?> </td>
                                                        <td class="text-align-right"> <?php echo formatFloat($dadosObj['valorprev']) ?> </td>
                                                        <td class="text-align-right"> <?php echo $dadosObj['countPF'] ?> </td>
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
                                    <span class="widget-icon"> <i class="fa fa-dollar"></i> </span>
                                    <h2>Confirmação</h2>
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

                                        <form name="form-antecipacao" class="smart-form" id="form-antecipacao"
                                              method="post">

                                            <!--/* -----------------------------------------------------------
                                            * #### Estes Inputs São de Controle e Estão hidden Alterar Somente Caso
                                            Necessário
                                            * -----------------------------------------------------------*/-->
                                            <!-- hidden parameters -->
                                            <input id="action-form-cadastro" name="action" type="hidden" value="insert">
                                            <input id="codigo-form-cadastro" name="codigo" type="hidden" value="">
                                            <input id="operacoes-form-cadastro" name="operacoes_antecipar" type="hidden"
                                                   value="">
                                            <!-- ./hidden parameters -->

                                            <header>
                                                <!--                                                    Tooltips (with icon)-->
                                            </header>
                                            <fieldset>
                                                <section class="padding-10">
                                                    <div class="row padding-10 label-primary txt-color-white">
                                                        Confirma a solicitação das antecipação das Movimentos?
                                                    </div>
                                                </section>
                                            </fieldset>

                                            <div style=" text-align: center;  color: #333; background: #3276b1; height: 50px; bottom: 50px; display: block; margin: 10px;">
                                                <div style="margin-left: 25px" class="col-xs-8 col-sm-8">
                                                    <div class="row">
                                                        <div class="col-xs-3 col-sm-3  margin-left-10">
                                                            <span class="txt-color-white">Valor Bruto</span>
                                                        </div>
                                                        <div class="col-xs-4 col-sm-3  margin-left-10">
                                                            <span class="txt-color-white">Valor Previsto</span>
                                                        </div>
                                                        <div class="col-xs-4 col-sm-3  margin-left-10">
                                                            <span class="txt-color-white">Data Prevista</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-3 col-sm-3 margin-left-10">
                                                            <input type="text" id="edValorBruto" name="edValorBruto"
                                                                   value="0.00"/>
                                                        </div>
                                                        <div class="col-xs-4 col-sm-3 margin-left-10">
                                                            <input type="text" id="edValorPrev" name="edValorPrev"
                                                                   value="0.00"/>
                                                        </div>
                                                        <div class="col-xs-4 col-sm-3 margin-left-10">
                                                            <input id="edDataPrev" name="edDataPrev"
                                                                   value="00/00/0000"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit"
                                                        id="btnSave"
                                                        class="btn-form-modal btn btn-success"><i
                                                            class="fa fa-check"></i> Confirmar
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

        <div class="modal fade" id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <h3 class="modal-title" id="myModalLabel"><?php echo $page_title ?></h3>
                    </div>
                    <div class="upload center-block">
                        <div class="upload-files" id="upload-files">
                            <header>
                                <p>
                                    <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                    <span class="up">up</span>
                                    <span class="load">load</span>
                                </p>
                            </header>
                            <div class="body" id="drop">
                                <i class="fa fa-file-text-o pointer-none" aria-hidden="true"></i>
                                <p class="pointer-none"><b>Arraste e Solte</b> os arquivos aqui <br/> ou <a href=""
                                                                                                            id="triggerFile">Click
                                        Aqui</a>
                                    para selecionar os arquivos</p>
                                <input id="edFileAntecip" type="file" multiple="multiple"/>
                                <input id="transcaoUpload" name="transcaoUpload" type="hidden"/>
                            </div>
                            <footer id="footerUpload">
                                <div class="divider">
                                    <span><AR>Arquivos</AR></span>
                                </div>
                                <div class="list-files">
                                    <!--   template   -->
                                </div>
                                <button class="importar">Concluir</button>
                            </footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- end row -->
    <div id="footer-antecip-totais"
         style="color: #333; background: #4c4f53;  border: 1px solid #C2C2C2; z-index: 901;  margin: 5px; margin-bottom: 0px; padding: 6px 6px 0; position: fixed; height: 50px; bottom: 50px; width: 100%;"
         hidden>
        <div class="col-xs-8 col-sm-8">
            <div class="row">
                <div class="col-xs-4 col-sm-3">
                    <span class="txt-color-orange">Num. Antecipações</span>
                </div>
                <div class="col-xs-3 col-sm-3">
                    <span class="txt-color-orange">Valor Bruto</span>
                </div>
                <div class="col-xs-4 col-sm-3">
                    <span class="txt-color-orange">Valor Previsto</span>
                </div>
                <div class="col-xs-4 col-sm-3">
                    <span class="txt-color-orange">Data Prevista</span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-sm-3">
                    <span id="spnCountAntecipar" class="txt-color-white">000</span>
                </div>
                <div class="col-xs-3 col-sm-3">
                    <span id="spnValorBruto" class="txt-color-white">R$ 0,00</span>
                </div>
                <div class="col-xs-4 col-sm-3">
                    <span id="spnValorPrevisto" class="txt-color-white">R$ 0,00</span>
                </div>
                <div class="col-xs-4 col-sm-3">
                    <span id="spnDataPrev" class="txt-color-white">00/00/0000</span>
                </div>
            </div>
        </div>
        <div class="col-xs-2 col-sm-1">
            <button type="button"
                    id="btnSave"
                    onclick="form_func_execute_ShowModal('#modalCadastro');"
                    class="btn btn-success">
                <i class="fa fa-dollar"></i> Solicitar
            </button>
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