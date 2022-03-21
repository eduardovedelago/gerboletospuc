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
$page_title = "Clientes";
$classPHPNameController = 'form-cad-cliente';
$wEntityName = "models\Cliente";
/* -----------------------------------------------------------
 *  ####[alteracao]  ./Variaveis Globais Formulário
 * -----------------------------------------------------------*/


/* -----------------------------------------------------------
 *  ####[alteracao]  Variáveis de Acesso Usuário
 * -----------------------------------------------------------*/
//Variável do Formuário
$_acessoForm = \Ctrl\AccessUserCtrl::$Acess_Cadastro_Clientes;

//Variaveis de CRUD
$_acessoIncluir = \Ctrl\AccessUserCtrl::$Acess_Cadastro_Clientes_Incluir;
$_acessoAlterar = \Ctrl\AccessUserCtrl::$Acess_Cadastro_Clientes_Alterar;
$_acessoExcluir = \Ctrl\AccessUserCtrl::$Acess_Cadastro_Clientes_Excluir;

//Variáveis de Acesso as Opções
$_acessoCopy = \Ctrl\AccessUserCtrl::$Acess_Cadastro_Clientes_Opcoes;
$_acessoPDF = \Ctrl\AccessUserCtrl::$Acess_Cadastro_Clientes_Opcoes;
$_acessoExcel = \Ctrl\AccessUserCtrl::$Acess_Cadastro_Clientes_Opcoes;
$_acessoPrinter = \Ctrl\AccessUserCtrl::$Acess_Cadastro_Clientes_Opcoes;
//Cadastro de Usuário Logado
$usuario = \Ctrl\UserCtrl::getObjetoUsuario_Login();
/* -----------------------------------------------------------
 *  ####                  ./Validação Acesso Usuário
 * -----------------------------------------------------------*/


/* -----------------------------------------------------------
 *  ####[alteracao]  Listas de Dados dos Edits - ItemsEdits
 * -----------------------------------------------------------*/

$repMunicipios = $entityManager->getRepository("models\Municipio");
$repMunicipios = $repMunicipios->findAll();
$resultMunic = [];
if ($repMunicipios != null) {
    foreach ($repMunicipios as $dadosObj) {
        $resultMunic[] = [$dadosObj->getCodigo(), $dadosObj->getNome()];
    }
}

$resultSituacao = [];
$resultSituacao[] = ["L", "Liberado"];
$resultSituacao[] = ["I", "Inativo"];
$resultSituacao[] = ["B", "Bloqueado"];


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
$page_nav["cadastros"]["sub"]["cadastro_clientes"]["active"] = true;
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
						Clientes
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
                            <h2> Listagem de Clientes </h2>

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
                                <table id="datatable_cadastro" class="table table-striped table-bordered table-hover"
                                       width="100%">

                                    <thead>
                                    <tr>
                                        <!--/* ------------------------------------------------------------->
                                        <!--* ####[alteracao] Filtros das Colunas do Grid ()-->
                                        <!--* -----------------------------------------------------------*/-->
                                        <th class="hasinput" style="width:5%">
                                            <input type="text" class="form-control" placeholder="Filtrar Código"/>
                                        </th>

                                        <th class="hasinput" style="width:20%">
                                            <input type="text" class="form-control" placeholder="Filtrar Nome"/>
                                        </th>

                                        <th class="hasinput" style="width:4%">
                                            <input type="text" class="form-control" placeholder="Filtrar Tipo"/>
                                        </th>

                                        <th class="hasinput" style="width:12%">
                                            <input type="text" class="form-control" placeholder="Filtrar CNPJ/CPF"/>
                                        </th>

                                        <th class="hasinput" style="width:20%">
                                            <input type="text" class="form-control" placeholder="Filtrar E-Mail"/>
                                        </th>

                                        <th class="hasinput" style="width:13%">
                                            <input type="text" class="form-control" placeholder="Filtrar Celular"/>
                                        </th>

                                        <th class="hasinput" style="width:10%">
                                            <input type="text" class="form-control" placeholder="Filtrar Situação"/>
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
                                        <th data-class="expand">Nome</th>
                                        <th data-hide="phone">Tipo</th>
                                        <th data-class="expand">CNPJ/CPF</th>
                                        <th data-class="expand">E-Mail</th>
                                        <th data-class="expand">Celular</th>
                                        <th data-class="expand">Situacao</th>
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
                                        if ($empr_codigo>0) {
                                            $entRep = $entityManager->getRepository($wEntityName);
                                            $listDadosResult = $entRep->findAll();
                                            if ($listDadosResult != null) {
                                                foreach ($listDadosResult as $dadosObj) {
                                                    if ($usuario->isAdministrador() || $usuario->getEmpresa()==$dadosObj->getEmprCodigo()) {
                                                        ?>
                                                        <tr>
                                                            <!--/* -----------------------------------------------------------
                                                            * ####[alteracao] Preenchimento dos Conteúdo do Grid
                                                            * -----------------------------------------------------------*/-->
                                                            <td> <?php echo $dadosObj->getCodigo() ?> </td>
                                                            <td> <?php echo $dadosObj->getNome() ?> </td>
                                                            <td> <?php echo $dadosObj->getTipo() ?> </td>
                                                            <td> <?php echo $dadosObj->getCnpjCpf() ?> </td>
                                                            <td> <?php echo $dadosObj->getEmail() ?> </td>
                                                            <td> <?php echo $dadosObj->getCelular() ?> </td>
                                                            <td> <?php
                                                                $situacao = $dadosObj->getSituacao();
                                                                if ($situacao != null && $situacao != "") {
                                                                    if ($situacao == "L") {
                                                                        echo '<span class="label label-success"> Liberado</span>';
                                                                    }
                                                                    if ($situacao == "I") {
                                                                        echo '<span class="label label-warning"> Inativo</span>';
                                                                    }
                                                                    if ($situacao == "B") {
                                                                        echo '<span class="label label-danger"> Bloqueado</span>';
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
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

                                        <form name="form-cadastro" class="smart-form" id="form_cadastro" method="post">

                                            <!--/* -----------------------------------------------------------
                                            * #### Estes Inputs São de Controle e Estão hidden Alterar Somente Caso
                                            Necessário
                                            * -----------------------------------------------------------*/-->
                                            <!-- hidden parameters -->
                                            <input id="action-form-cadastro" name="action" type="hidden" value="insert">
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

                                                    <div class="row">
                                                        <div class="col col-2">
                                                            <label class="label">Pessoa: </label>
                                                        </div>
                                                        <div class="col col-4">
                                                            <!--                                                            <label class="radio">-->
                                                            <input type="radio" name="edTipo" id="ed_tipo" value="F">
                                                            <label for="ed_tipo">Física</label>
                                                            <!--                                                                <i></i>Física-->
                                                            <!--                                                            </label>-->
                                                        </div>
                                                        <div class="col col-4">
                                                            <!--                                                            <label class="radio">-->
                                                            <!--                                                                <input type="radio" name="edTipo" id="ed_tipo2"-->
                                                            <!--                                                                       data-value="J"  value="J">-->
                                                            <!--                                                                <i></i>Jurídica</label>-->
                                                            <input type="radio" name="edTipo" id="ed_tipo" value="J">
                                                            <label for="ed_tipo">Jurídica</label>
                                                        </div>
                                                    </div>
                                                </section>

                                                <div class="row">
                                                    <section class="col col-6">
                                                        <?php echo \app\Html::createEdit('edNome', 'ed_nome', null, '*text', 'fa fa-user', 'Nome', true, "", "prepend"); ?>
                                                    </section>
                                                    <section class="col col-6">
                                                        <?php echo \app\Html::createEdit('edRazaoSocial', 'ed_razaoSocial', null, '*text', 'fa fa-user', 'Razão Social', false, "", "prepend"); ?>
                                                    </section>
                                                </div>

                                                <div class="row">
                                                    <section class="col col-6">
                                                        <?php echo \app\Html::createEdit('edCnpjCpf', 'ed_cnpjCpf', null, '*text', 'fa fa-file-text', 'CNPJ/CPF', true, "", "prepend"); ?>
                                                    </section>
                                                    <section class="col col-6">
                                                        <?php echo \app\Html::createEdit('edRgIe', 'ed_rgIe', null, 'text', 'fa fa-file-text-o', 'RG/IE', true, "", "prepend"); ?>
                                                    </section>
                                                </div>

                                                <section>
                                                    <?php echo \app\Html::createEdit('edEmail', 'ed_email', null, '*email', 'fa fa-envelope-o', 'E-Mail', true, "", "prepend"); ?>
                                                </section>

                                                <section>
                                                    <?php echo \app\Html::createEditSelectSimple('edSituacao', 'ed_situacao', "", $resultSituacao, false); ?>
                                                </section>

                                                <div class="row">
                                                    <section class="col col-6">
                                                        <?php echo \app\Html::createEdit('edFone', 'ed_fone', null, 'tel', 'fa fa-phone', 'Fone', true, "(99) 9999-9999?9", "prepend"); ?>
                                                    </section>
                                                    <section class="col col-6">
                                                        <?php echo \app\Html::createEdit('edCelular', 'ed_celular', null, '*tel', 'fa fa-phone', 'Celular', true, "(99) 9999-9999?9", "prepend"); ?>
                                                    </section>
                                                </div>

                                            </fieldset>

                                            <fieldset>
                                                <div class="row">
                                                    <section class="col col-4">
                                                        <label class="input"> <i
                                                                    class="icon-prepend fa fa-envelope-square"></i>
                                                            <input type="text" name="edCEP" id="ed_cep"
                                                                   placeholder="CEP" data-mask="99.999-999" required>
                                                        </label>
                                                    </section>

                                                    <section class="col col-4">
                                                        <?php echo \app\Html::createEdit('edEnderecoNumero', 'ed_enderecoNumero', null, '*text', 'fa fa-home', 'Número', true, "", "prepend"); ?>
                                                    </section>

                                                    <section class="col col-4">
                                                        <?php echo \app\Html::createEdit('edEnderecoBairro', 'ed_enderecoBairro', null, '*text', '', 'Bairro'); ?>
                                                    </section>
                                                </div>
                                                <section>
                                                    <?php echo \app\Html::createEditSelectSimple('edMunicipio', 'ed_muni_Codigo', "", $resultMunic, false); ?>
                                                </section>

                                                <section>
                                                    <?php echo \app\Html::createEdit('edEndereco', 'ed_endereco', null, '*text', 'fa-map-marker', 'Endereço', true, "", "prepend"); ?>
                                                </section>

                                                <section>
                                                    <?php echo \app\Html::createEdit('edEnderecoComplemento', 'ed_enderecoComplemento', null, 'text', 'fa-code-fork', 'Complemento', true, "", "prepend"); ?>
                                                </section>
                                            </fieldset>

                                            <fieldset>
                                                <section>
                                                    <label class="textarea">
                                                        <textarea rows="3" name="edObservacao" id="ed_observacao"
                                                                  placeholder="Observações"></textarea>
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