<?php
//Inicialização da Página
require_once("inc/init.php");
require_once("inc/config.ui.php");
//Validação da Sessão
require_once("sessionIsAuthenticated.php");
//Conexão com a Base de Dados:
include_once 'database.php';

/* -----------------------------------------------------------
 *  ####[alteracao]  Variaveis Globais Formulário
 * ----------------------------------------------------------- */
$page_title = "Baixa de Movimento";
$classPHPNameController = 'form-proc-baixar-blt';
$wEntityName = "models\PendFin";
/* -----------------------------------------------------------
 *  ####[alteracao]  ./Variaveis Globais Formulário
 * -----------------------------------------------------------
 */


/* -----------------------------------------------------------
 *  ####[alteracao]  Variáveis de Acesso Usuário
 * -----------------------------------------------------------*/
//Variável do Formuário
$_acessoForm = \Ctrl\AccessUserCtrl::$Acess_Proc_BaixarBlt;

//Variaveis de CRUD
$_acessoIncluir = \Ctrl\AccessUserCtrl::$Acess_Proc_BaixarBlt;
$_acessoAlterar = \Ctrl\AccessUserCtrl::$Acess_Proc_BaixarBlt;
$_acessoExcluir = \Ctrl\AccessUserCtrl::$Acess_Proc_BaixarBlt;

//Variáveis de Acesso as Opções
$_acessoCopy = \Ctrl\AccessUserCtrl::$Acess_Proc_BaixarBlt;
$_acessoPDF = \Ctrl\AccessUserCtrl::$Acess_Proc_BaixarBlt;
$_acessoExcel = \Ctrl\AccessUserCtrl::$Acess_Proc_BaixarBlt;
$_acessoPrinter = \Ctrl\AccessUserCtrl::$Acess_Proc_BaixarBlt;
/* -----------------------------------------------------------
 *  ####                  ./Validação Acesso Usuário
 * -----------------------------------------------------------*/


/* -----------------------------------------------------------
 *  ####[alteracao]  Listas de Dados dos Edits - ItemsEdits
 * -----------------------------------------------------------*/

$tiposDeBaixa = [];
$tiposDeBaixa[] = ["S", " Baixa Normal"];
$tiposDeBaixa[] = ["R", " Recompra"];
$tiposDeBaixa[] = ["E", " Renegociada"];

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
$page_nav["procedimentos"]["sub"]["proc_baixar_blt"]["active"] = true;
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
$breadcrumbs["Procedimentos"] = "";
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
                    Baixar /
                    <span>
						Mvtos Financeiros
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
                            <h2> Dados do Movimento </h2>

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
                            <div class="text-center widget-body padding-10">

                                <form name="form-cadastro" class="smart-form" id="form_cadastro" method="post">

                                    <!--/* -----------------------------------------------------------
                                    * #### Estes Inputs São de Controle e Estão hidden Alterar Somente Caso
                                    Necessário
                                    * -----------------------------------------------------------*/-->
                                    <!-- hidden parameters -->
                                    <input id="action-form" name="action" type="hidden" value="cancel-blt">
                                    <!-- ./hidden parameters -->

                                    <header>
                                        <!--Tooltips (with icon)-->
                                    </header>


                                    <fieldset>
                                        <div class="row">
                                            <label class="label label-default padding-5">Número da Operação</label>
                                        </div>

                                        <div class="row">
                                            <section class="col col-9">
                                                <label class="input" name="lbl_edOperacao">
                                                    <i class="icon-append fa fa-file-text-o">
                                                    </i>
                                                    <input id="ed_operacao" name="edOperacao" type="number" placeholder="Informe o Número da operação" required>
                                                </label>
                                            </section>
                                            <section class="col col-2 align-right-txt txt-align-center-ho">
                                                <button style="width: 150px;" id="btnValidaOpCanc" type="button" class="btn btn-success btn-labeled text-center ">
                                                    <span class="btn-label">
                                                        <i class="fa fa-check"></i>
                                                    </span> Visualizar Op.
                                                </button>
                                            </section>
                                        </div>

                                        <div id="section_operacao_2" hidden>
                                            <div>
                                                <br>
                                                <row class="row">
                                                    <span class="widget-icon col-sm-2"> <i class="fa fa-user"></i> </span>
                                                    <label style="font-weight: bold" class="col-sm-2 text-left">Cliente: </label>
                                                    <label id="ed_clie_nome" class="col-sm-5 text-left"> </label>
                                                </row>
                                                <row class="row">
                                                    <span class="widget-icon col-sm-2"> <i class="fa fa-envelope"></i> </span>
                                                    <label style="font-weight: bold" class="col-sm-2 text-left">E-Mail Cliente: </label>
                                                    <label id="ed_clie_email" class="col-sm-5 text-left"> </label>
                                                </row>
                                                <row class="row">
                                                    <span class="widget-icon col-sm-2"> <i class="fa fa-money"></i> </span>
                                                    <label style="font-weight: bold" class="col-sm-2 text-left">Valor: </label>
                                                    <label id="ed_pfin_valor" class="col-sm-5 text-left"> </label>
                                                </row>
                                                <row class="row">
                                                    <span class="widget-icon col-sm-2"> <i class="fa fa-play"></i> </span>
                                                    <label style="font-weight: bold" class="col-sm-2 text-left">Número de Parcelas: </label>
                                                    <label id="ed_pfin_parcela" class="col-sm-5 text-left"> </label>
                                                </row>
                                                <row class="row">
                                                    <span class="widget-icon col-sm-2"> <i class="fa fa-calendar"></i> </span>
                                                    <label style="font-weight: bold" class="col-sm-2 text-left">Data de Vcto: </label>
                                                    <label id="ed_pfin_datavcto" class="col-sm-5 text-left"> </label>
                                                </row>
                                                <row class="row">
                                                    <span class="widget-icon col-sm-2"> <i class="fa fa-calendar"></i> </span>
                                                    <label style="font-weight: bold" class="col-sm-2 text-left">Data de Mvto: </label>
                                                    <label id="ed_pfin_datamvto" class="col-sm-5 text-left"> </label>
                                                </row>
                                                <row class="row">
                                                    <span class="widget-icon col-sm-2"> <i class="fa fa-file-text"></i> </span>
                                                    <label style="font-weight: bold" class="col-sm-2 text-left">Num. Dcto.: </label>
                                                    <label id="ed_pfin_numerodcto" class="col-sm-5 text-left"> </label>
                                                </row>
                                                <row class="row">
                                                    <span class="widget-icon col-sm-2"> <i class="fa fa-file-text"></i> </span>
                                                    <label style="font-weight: bold" class="col-sm-2 text-left">Desc/Obs.: </label>
                                                    <label id="ed_pfin_observacao" class="col-sm-5 text-left"> </label>
                                                </row>
                                                <row class="row">
                                                    <span class="widget-icon col-sm-2"> <i class="fa fa-file-text"></i> </span>
                                                    <label style="font-weight: bold" class="col-sm-2 text-left">Invoice ID: </label>
                                                    <label id="ed_pblt_invoiceid" class="col-sm-5 text-left"> </label>
                                                </row>
                                                <br>
                                            </div>
                                            <div class="row">
                                                <label class="label label-default padding-5">Reinforme a Operação</label>
                                            </div>
                                            <div class="row">
                                                <section class="col col-9" disabled="true">
                                                    <label class="input" name="lbl_edOperacao2">
                                                        <i class="icon-append fa fa-file-text-o"></i>
                                                        <input id="ed_operacao2" name="edOperacao2" type="number" placeholder="Informe o número da operação Novamente" maxlength="10" required>
                                                    </label>
                                                </section>
                                            </div>

                                            <div class="row">
                                                <label class="label label-default padding-5">Tipo da Baixa</label>
                                            </div>
                                            <div class="row">
                                                <section class="col col-9">
                                                    <?php echo \app\Html::createEditSelectSimple('ed_BaixaManual', 'ed_BaixaManual', "", $tiposDeBaixa,false); ?>
                                                </section>
                                            </div>

                                            <div class="row">
                                                <label class="label label-default padding-5">Motivo da Baixa</label>
                                            </div>
                                            <div class="row">
                                                <section class="col col-9" disabled="true">
                                                    <label class="input" name="lbl_edOperacao2">
                                                        <i class="icon-append fa fa-file-text-o"></i>
                                                        <input id="ed_motivobx" name="ed_motivobx" type="text" placeholder="Informe o Motivo da Baixa" maxlength="100" required>
                                                    </label>
                                                </section>
                                                <section class="col col-2 align-right-txt txt-align-center-ho">
                                                    <button style="width: 150px;" id="btnExecuteBaixa" type="button" class="btn btn-warning btn-labeled text-center ">
                                                        <span class="btn-label"> <i class="fa fa-trash"></i>
                                                        </span> Baixar Op.
                                                    </button>
                                                </section>
                                            </div>

                                        </div>
                                    </fieldset>
                                </form>
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

        </section>
        <!-- end widget grid -->

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
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/jquery-modais/jquery.loadingModal.js"></script>


<?php

//Botão Incluir Está Dentro do JSTableTools - Include Button , Incluir"
//Caso Necessário Alteração Copiar o Código do JSTableTools para este Ponto...
include("./src/app/JSTableTools.php")

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

<?php
//include footer
include("inc/google-analytics.php");
?>