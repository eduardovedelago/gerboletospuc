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
$page_title = "Configuração Geral";
$classPHPNameController = 'form-confger';
$wEntityName = "models\ConfGer";
/* -----------------------------------------------------------
 *  ####[alteracao]  ./Variaveis Globais Formulário
 * -----------------------------------------------------------*/


/* -----------------------------------------------------------
 *  ####[alteracao]  Variáveis de Acesso Usuário
 * -----------------------------------------------------------*/
//Variável do Formuário
$_acessoForm = 900;

//Variaveis de CRUD
$_acessoIncluir = 901;
$_acessoAlterar = 902;
$_acessoExcluir = 903;

//Variáveis de Acesso as Opções
$_acessoCopy = 900;
$_acessoPDF = 900;
$_acessoExcel = 900;
$_acessoPrinter = 900;
/* -----------------------------------------------------------
 *  ####                  ./Validação Acesso Usuário
 * -----------------------------------------------------------*/


/* -----------------------------------------------------------
 *  ####[alteracao]  Listas de Dados dos Edits - ItemsEdits
 * -----------------------------------------------------------*/

$listComportamentos = null;
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
$page_nav["configuracao"]["active"] = true;
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
    $breadcrumbs["configuracao"] = "";
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
                    Configuração /
                    <span>
						Geral
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

<!--                        <header>-->
<!--                            <span class="widget-icon"> <i class="fa fa-table"></i> </span>-->
<!--                            <!--/* ------------------------------------------------------------->
<!--                            <!--* ####[alteracao] Texto de Cabeçalho do Grid-->
<!--                            <!--* -----------------------------------------------------------*/-->
<!--                            <h2> Listagem de Portadores </h2>-->
<!---->
<!--                        </header>-->

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
                                <form onpageshow="form_execute_Load_ConfGer()" name="form-cadastro" class="smart-form" id="form_cadastro" method="post">
                                    <!--/* -----------------------------------------------------------
                                           * #### Estes Inputs São de Controle e Estão hidden Alterar Somente Caso
                                           Necessário
                                           * -----------------------------------------------------------*/-->
                                    <!-- hidden parameters -->
                                    <input id="action-form-cadastro" name="action" type="hidden" value="insert">
                                    <input id="codigo-form-cadastro" name="conta" type="hidden" value="">
                                    <!-- ./hidden parameters -->

                                    <fieldset>
                                        <section>
                                            <label class="label">Texto Boleto</label>
                                            <label class="textarea">
                                                <textarea id="ed_textoboleto" name="ed_textoboleto" maxlength="350" rows="5" class="custom-scroll" ></textarea>
                                            </label>
                                            <label class="label text-align-right right-txt txt-color-red">Tags permitidas no Texto do Boleto:</label>
                                            <label class="label text-align-right right-txt txt-color-redLight">#NumParcelas; #Parcela; #NumeroDcto; #DataLcto; #DataMvto;  #DataVcto;  #Empresa.Nome;  #Empresa.CNPJ</label>
                                        </section>

                                    </fieldset>
                                <div class="modal-footer">
                                    <button type="submit"
                                            id="btnSave"
                                            class="btn-form-modal btn btn-primary"><i
                                                class="fa fa-check"></i> Salvar
                                    </button>
                                    <button id="btnCancelarConfGer" type="button" class="btn-form-modal btn btn-default"
                                            ><i class="fa fa-close"></i> Cancelar
                                    </button>

                                </div>
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

            <!-- end row -->

        </section>
        <!-- end widget grid -->
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
    <script src="<?php echo ASSETS_URL; ?>/js/forms/form-confger.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/jquery-modais/jquery.loadingModal.js"></script>
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
