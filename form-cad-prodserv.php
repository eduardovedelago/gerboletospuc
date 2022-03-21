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
$page_title = "Produtos e Serviços";
$classPHPNameController = 'form-cad-prodserv';
$wEntityName = "models\ProdServ";
/* -----------------------------------------------------------
 *  ####[alteracao]  ./Variaveis Globais Formulário
 * -----------------------------------------------------------*/


/* -----------------------------------------------------------
 *  ####[alteracao]  Variáveis de Acesso Usuário
 * -----------------------------------------------------------*/
//Variável do Formuário
$_acessoForm = \Ctrl\AccessUserCtrl::$Acess_Cadastro_ProdServ;

//Variaveis de CRUD
$_acessoIncluir = \Ctrl\AccessUserCtrl::$Acess_Cadastro_ProdServ_Incluir;
$_acessoAlterar = \Ctrl\AccessUserCtrl::$Acess_Cadastro_ProdServ_Alterar;
$_acessoExcluir = \Ctrl\AccessUserCtrl::$Acess_Cadastro_ProdServ_Excluir;

//Variáveis de Acesso as Opções
$_acessoCopy = \Ctrl\AccessUserCtrl::$Acess_Cadastro_ProdServ_Opcoes;
$_acessoPDF = \Ctrl\AccessUserCtrl::$Acess_Cadastro_ProdServ_Opcoes;
$_acessoExcel = \Ctrl\AccessUserCtrl::$Acess_Cadastro_ProdServ_Opcoes;
$_acessoPrinter = \Ctrl\AccessUserCtrl::$Acess_Cadastro_ProdServ_Opcoes;
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
$page_nav["cadastros"]["sub"]["cadastro_prodserv"]["active"] = true;
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
$breadcrumbs["Cadastros"] = "";
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
                    Cadastros /
                    <span>
                        Produtos e Serviços
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
                            <h2> Listagem de Produtos e Serviços </h2>

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
                                        <th class="hasinput" style="width:6%">
                                            <input type="text" class="form-control" placeholder="Filtrar Código"/>
                                        </th>

                                        <th class="hasinput" style="width:25%">
                                            <input type="text" class="form-control"
                                                   placeholder="Filtrar Descricao"/>
                                        </th>

                                        <th class="hasinput" style="width:4%">
                                            <input type="text" class="form-control" placeholder="Filtrar Valor"/>
                                        </th>

                                        <!--/* ------------------------------------------------------------->
                                        <!--* #### Filtros da Coluna Opções está Hidden-->
                                        <!--* -----------------------------------------------------------*/-->
                                        <th class="hasinput" style="width:15%">
                                            <input type="hidden" class="form-control" placeholder=""/>
                                        </th>
                                    </tr>
                                    <tr>
                                        <!--/* -----------------------------------------------------------
                                        * ####[alteracao] Colunas do Grid
                                        * -----------------------------------------------------------*/-->
                                        <th>Código</th>
                                        <th data-class="expand">Descrição</th>
                                        <th class="text-align-right" data-hide="phone">Valor</th>
                                        <th>Opções</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                    try {
                                        $entRep = $entityManager->getRepository($wEntityName);
                                        $listDadosResult = $entRep->findAll();
                                        if ($listDadosResult != null) {
                                            foreach ($listDadosResult as $dadosObj) {
                                                ?>
                                                <tr>
                                                    <!--/* -----------------------------------------------------------
                                                    * ####[alteracao] Preenchimento dos Conteúdo do Grid
                                                    * -----------------------------------------------------------*/-->
                                                    <td> <?php echo $dadosObj->getCodigo() ?> </td>
                                                    <td> <?php echo $dadosObj->getDescricao() ?> </td>
                                                    <td class="text-align-right"> <?php echo formatFloat( $dadosObj->getValor() ) ?> </td>
                                                    <!--/* -----------------------------------------------------------
                                                    * ####[alteracao] Botões de Cada Linha (Cuidar a Variável
                                                    * "_acesso..."), Altera Somente se Necessário
                                                    * botões delete e edit manter o NAME pois está linkado com o
                                                    * Java Script
                                                    * -----------------------------------------------------------*/-->
                                                    <td>
                                                        <?php
                                                        echo \app\Html::loadButtonTagA($_acessoExcluir, "btnDelete", null, $dadosObj->getCodigo(), "Executa exclusão do registro selecionado", "glyphicon glyphicon-trash", null);
                                                        echo \app\Html::loadButtonTagA($_acessoAlterar, "btnEdit", null, $dadosObj->getCodigo(), "Executa a edição do registro selecionado", "fa fa-edit", null);
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
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
                                                <!--/* -----------------------------------------------------------
                                                * ####[alteracao] Preenchimento dos dados de Cadastro
                                                * O JavaScript que Preenche essas informações Precisa do Padrão
                                                * id="ed_....." ou seja o ID deve sempre começar com "ed_" seguido
                                                * do nome do campo na classe "model"
                                                * -----------------------------------------------------------*/-->
                                                <section>
                                                    <?php echo \app\Html::createEdit('edDescricao', 'ed_descricao', 'Descrição', 'text', 'fa-file-text-o', 'Informe a Descrição do Produto'); ?>
                                                </section>

                                                <section>
                                                    <label class="input" name="lbl_ed_valor">
                                                        <i class="icon-append fa fa-dollar"></i>
                                                        <input class="align-right-txt"
                                                               id="ed_valor" name="edValor"
                                                               type="text" maxlength="15"
                                                               pattern="(\d{3})([\.])(\d{2}"/>
                                                    </label>
                                                </section>
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


<?php

//Botão Incluir Está Dentro do JSTableTools - Include Button , Incluir"
//Caso Necessário Alteração Copiar o Código do JSTableTools para este Ponto...
include("./src/app/JSTableTools.php")

?>


    <script type="text/javascript">

        function formatReal(int) {
            var tmp = int + '';
            tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
            if (tmp.length > 6)
                tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

            return tmp;
        }

        (function ($, undefined) {

            "use strict";

            $(function () {
                var $edvalor = $("#ed_valor");

                $edvalor.on("keypress", function (ev) {
                        if (ev.keyCode < 48 || ev.keyCode > 57) {
                            ev.preventDefault();
                            return;
                        }
                    }
                );

                $edvalor.on("keyup", function (event) {
                    var selection = window.getSelection().toString();
                    if (selection !== '') {
                        return;
                    }
                    if ($.inArray(event.keyCode, [38, 40, 37, 39]) !== -1) {
                        return;
                    }
                    var $this = $(this);
                    var input = $this.val();
                    input = input.replace(',', '');
                    input = input.replace('.', '');
                    input = formatReal(input);
                    //input = input ? parseInt(input, 10) : 0;
                    $this.val(function () {
                        return input;// === 0) ? "0,00" : input.toLocaleString("pt-BR");
                    });
                });

            });
        })(jQuery);

        /* -----------------------------------------------------------
        *  Seta as Variáveis Globais que são utilizadas no js "forms.functions.js"
        * -----------------------------------------------------------*/
        function loadVarsGlobaisFormulario(classCtrl) {
            wClassCtrl = classCtrl;
            wUrlCtrl = "../../controller/" + wClassCtrl + "-ctrl.php";
        }

        loadVarsGlobaisFormulario(<?php echo '"' . $classPHPNameController . '"' ?>);

        <?php
        if ($_GET['startIncluir'] == "true") {
            echo "showFormInsertModal();";
        }
        ?>
    </script>


<?php
//include footer
include("inc/google-analytics.php");
?>