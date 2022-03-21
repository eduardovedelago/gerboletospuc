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
$page_title = "Cadastro de Usuários";
$classPHPNameController = 'form-cad-usuarios';
$wEntityName = "models\Usuarios";


/* -----------------------------------------------------------
 *  ####[alteracao]  Variáveis de Acesso Usuário
 * -----------------------------------------------------------*/
$_acessoForm = \Ctrl\AccessUserCtrl::$Acess_Cadastro_Usuarios;

$_acessoIncluir = \Ctrl\AccessUserCtrl::$Acess_Cadastro_Usuarios_Incluir;
$_acessoAlterar = \Ctrl\AccessUserCtrl::$Acess_Cadastro_Usuarios_Alterar;
$_acessoExcluir = \Ctrl\AccessUserCtrl::$Acess_Cadastro_Usuarios_Excluir;
$_acessoAlterarAcessos = \Ctrl\AccessUserCtrl::$Acess_Cadastro_Usuarios_Acessos;
$_acessoAlterarPw = \Ctrl\AccessUserCtrl::$Acess_Cadastro_Usuarios_AlterarSenha;
$_acessoEliminarPw = \Ctrl\AccessUserCtrl::$Acess_Cadastro_Usuarios_EliminarSenha;
$_acessoAtivarUsu = \Ctrl\AccessUserCtrl::$Acess_Cadastro_Usuarios_AtivarUsuario;

$_acessoCopy = \Ctrl\AccessUserCtrl::$Acess_Cadastro_Usuarios_Opcoes;
$_acessoPDF = \Ctrl\AccessUserCtrl::$Acess_Cadastro_Usuarios_Opcoes;
$_acessoExcel = \Ctrl\AccessUserCtrl::$Acess_Cadastro_Usuarios_Opcoes;
$_acessoPrinter = \Ctrl\AccessUserCtrl::$Acess_Cadastro_Usuarios_Opcoes;
/* -----------------------------------------------------------
 *  ####                  ./Validação Acesso Usuário
 * -----------------------------------------------------------*/


/* -----------------------------------------------------------
 *  ####[alteracao]  Listas de Dados dos Edits - ItemsEdits
 * -----------------------------------------------------------*/
$entGrupo = $entityManager->getRepository("models\Grupos");
$listEntGrupo = $entGrupo->findAll();
$grupos = [];
if ($listEntGrupo != null) {
    foreach ($listEntGrupo as $grupo) {
        $grupos[] = [$grupo->getCodigo(), $grupo->getNome()];
    }
}

$entEmpresas = $entityManager->getRepository("models\Empresa");
$listEntEmpr = $entEmpresas->findAll();
$empresas = [];
if ($listEntEmpr != null) {
    foreach ($listEntEmpr as $empr) {
        $empresas[] = [$empr->getCodigo(), $empr->getNome()];
    }
}

/* -----------------------------------------------------------
 *  ####[alteracao]   ./Listas de Dados dos Edits - END
 * -----------------------------------------------------------*/


/* -----------------------------------------------------------
 *  ####  Função que Valida se o Usuário tem Acesso ao Formulário e Instalação
 * -----------------------------------------------------------*/
use ctrl\UserCtrl;
UserCtrl::validateAcessAuthorizedForm($_acessoForm);
/* -----------------------------------------------------------
 *  ####                  ./Validação Acesso Usuário
 * -----------------------------------------------------------*/


/* -----------------------------------------------------------
 *  ####  CSS e Cabeçalho
 * -----------------------------------------------------------*/
$page_css[] = "your_style.css";
include("inc/header.php");

/* -----------------------------------------------------------
 *  ####[alteracao]  Informação de Navegação
 * -----------------------------------------------------------*/
$page_nav["cadastros"]["sub"]["cadastro_usuarios"]["active"] = true;
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
                    Cadastros /
                    <span>
						Usuários
					</span>
                </h1>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
<!--                <ul id="sparks" class="">-->
<!--                    <li class="sparks-info">-->
<!--                        <h5> My Income <span class="txt-color-blue">$47,171</span></h5>-->
<!--                        <div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">-->
<!--                            1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li class="sparks-info">-->
<!--                        <h5> Site Traffic <span class="txt-color-purple"><i class="fa fa-arrow-circle-up"-->
<!--                                                                            data-rel="bootstrap-tooltip"-->
<!--                                                                            title="Increased"></i>&nbsp;45%</span>-->
<!--                        </h5>-->
<!--                        <div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm">-->
<!--                            110,150,300,130,400,240,220,310,220,300, 270, 210-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li class="sparks-info">-->
<!--                        <h5> Site Orders <span class="txt-color-greenDark"><i class="fa fa-shopping-cart"></i>&nbsp;2447</span>-->
<!--                        </h5>-->
<!--                        <div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm">-->
<!--                            110,150,300,130,400,240,220,310,220,300, 270, 210-->
<!--                        </div>-->
<!--                    </li>-->
<!--                </ul>-->
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
                        <!-- widget options:
                        usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                        data-widget-colorbutton="false"
                        data-widget-editbutton="false"
                        data-widget-togglebutton="false"
                        data-widget-deletebutton="false"
                        data-widget-fullscreenbutton="false"
                        data-widget-custombutton="false"
                        data-widget-collapsed="true"
                        data-widget-sortable="false"

                        -->
                        <header>
                            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                            <h2> Listagem de Usuários </h2>

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
                                        <th class="hasinput" style="width:7%">
                                            <input type="text" class="form-control" placeholder="Filtrar Código"/>
                                        </th>

                                        <th class="hasinput" style="width:20%">
                                            <input type="text" class="form-control" placeholder="Filtrar Nome"/>
                                        </th>

                                        <th class="hasinput" style="width:20%">
                                            <input type="text" class="form-control" placeholder="Filtrar E-Mail"/>
                                        </th>

                                        <th class="hasinput" style="width:12%">
                                            <input type="text" class="form-control" placeholder="Filtrar CPF"/>
                                        </th>

                                        <th class="hasinput" style="width:8%">
                                            <input type="text" class="form-control" placeholder="Filtrar Ativo"/>
                                        </th>                                        

                                        <th class="hasinput" style="width:20%">
                                            <input type="hidden" class="form-control" placeholder=""/>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Código</th>
                                        <th data-class="expand">Nome</th>
                                        <th data-hide="phone">E-mail</th>
                                        <th data-hide="expand">CPF</th>
                                        <th data-hide="phone">Ativo</th>                                        
                                        <th>Opções</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    <?php
                                    try {
                                        $entRep = $entityManager->getRepository($wEntityName);
                                        $listDadosResult = $entRep->findAll();
                                        if ($listDadosResult != null) {
                                            foreach ($listDadosResult as $usuario) {
                                                ?>
                                                <tr>
                                                    <td> <?php echo $usuario->getCodigo() ?> </td>
                                                    <td>  <?php echo $usuario->getNome() ?> </td>
                                                    <td> <?php echo $usuario->getEmail() ?> </td>
                                                    <td> <?php echo $usuario->getCpf() ?> </td>
                                                    <td>
                                                        <span class="<?php if ($usuario->getAtivo()=="S"){echo "label label-success"; } else { echo "label label-danger";} ?> " name="grdCellAtivo_<?php echo $usuario->getCodigo() ?>"> <?php echo $usuario->getAtivo() ?></span>
                                                        <?php
                                                        echo \app\Html::loadButtonTagA($_acessoAtivarUsu, "btnEditAtivo", null, $usuario->getCodigo(), "Executa a edição do Status do Usuário (Ativo/Inátivo)", "fa fa-check-square-o", null);
                                                        ?>
                                                    </td>                                                    
                                                    <td>
                                                        <?php
                                                        echo \app\Html::loadButtonTagA($_acessoExcluir, "btnDelete", null, $usuario->getCodigo(), "Executa exclusão do registro selecionado", "glyphicon glyphicon-trash", null);
                                                        echo \app\Html::loadButtonTagA($_acessoAlterar, "btnEdit", null, $usuario->getCodigo(), "Executa a edição do registro selecionado", "fa fa-edit", null);
                                                        echo \app\Html::loadButtonTagA($_acessoAlterarAcessos, "btnEditAcessos", null, $usuario->getCodigo(), "Executa a edição dos Acessos do Usuário", "fa fa-sliders", null, ' acessos="' . $usuario->getAcessos() . '" ');
                                                        echo \app\Html::loadButtonTagA($_acessoAlterarPw, "btnEditPassword", null, $usuario->getCodigo(), "Executa a edição da Senha do Usuário", "fa fa-key", null);
                                                        echo \app\Html::loadButtonTagA($_acessoEliminarPw, "btnEliminarPw", null, $usuario->getCodigo(), "Eliminar Senha do Usuário", "fa fa-eraser", null);
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

                                        <form name="form-cadastro" class="smart-form" id="form_cadastro" method="post">

                                            <!-- hidden parameters -->
                                            <input id="action-form-cadastro" name="action" type="hidden" value="insert">
                                            <input id="codigo-form-cadastro" name="codigo" type="hidden" value="">
                                            <!-- ./hidden parameters -->

                                            <header>
                                                <!--                                                    Tooltips (with icon)-->
                                            </header>
                                            <fieldset>
                                                <section>
                                                    <label class="label">Nome</label>
                                                    <label class="input">
                                                        <i class="icon-append fa fa-user"></i>
                                                        <input id="ed_nome" name="edNome" type="text"
                                                               placeholder="Informe o Nome do Usuário">
                                                    </label>
                                                </section>

                                                <section>
                                                    <label class="label">E-Mail</label>
                                                    <label class="input">
                                                        <i class="icon-append fa fa-envelope-o"></i>
                                                        <input id="ed_email" name="edEmail" type="mail"
                                                               placeholder="Informe o E-Mail do Usuário">
                                                    </label>
                                                </section>
                                                <section>
                                                    <?php echo \app\Html::createEdit('edCpf', 'ed_cpf', 'CPF', 'text', 'fa-file-text-o', 'Informe o CPF do Usuário',true,'999.999.999-99'); ?>
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
                                    <!-- end widget content -->

                                </div>
                                <!-- end widget div -->

                            </div>
                            <!-- end widget div -->

                        </div>
                        <!-- end left div -->
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

        </div>
        <!-- END MAIN CONTENT -->


        <!-- Modal -->
        <div class="modal fade" id="modalAcessos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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

                        <div id="center">
                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3"
                                 data-widget-colorbutton="false" data-widget-editbutton="false"
                                 data-widget-custombutton="false">

                                <header>
                                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                    <h2>Acessos do Usuário</h2>
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

                                        <form name="form-acessos" class="smart-form" id="form-acessos" method="post">

                                            <header>
                                                <!--                                                    Tooltips (with icon)-->
                                            </header>
                                            <fieldset>
                                                <div class="tree smart-form">
                                                    <?php

                                                    $WResultTreeView = "";


                                                    function loadTreeViewHtml()
                                                    {
                                                        $listAcessos = new Ctrl\AccessUserCtrl();//$this->getListAcessos();
                                                        $listAcessos = $listAcessos->getListAcessos();
                                                        $position = 0;
                                                        $nivelAtual = 1;
                                                        $GLOBALS["WResultTreeView"] = $GLOBALS["WResultTreeView"] . '<ul class="treeview">' . "\n\r";
                                                        while ($position + 1 < sizeof($listAcessos)) {
                                                            $posRet = addNivelTreeViewHtml($nivelAtual, $position, $listAcessos);
                                                            $position = $posRet;
                                                        }
                                                        return $GLOBALS["WResultTreeView"];
                                                    }


                                                    function addItemAcessoTreeView(\models\AccessUsers $acess)
                                                    {
                                                        $item = '<li>' . "\n\r";
                                                        $item .= '<input type = "checkbox" name="treeAcessos" id = "' . $acess->getPosicao() . '">' . "\n\r";
                                                        $item .= '<label for = "' . $acess->getCodigo() . '" class = "custom-unchecked">' . $acess->getDescricao() . '</label>' . "\n\r";
                                                        return $item;
                                                    }

                                                    function addNivelTreeViewHtml($nivelAtual, $position, $listAcessos)
                                                    {
                                                        $strAddItem = addItemAcessoTreeView($listAcessos[$position]);
                                                        $GLOBALS["WResultTreeView"] = $GLOBALS["WResultTreeView"] . $strAddItem;
                                                        $GLOBALS["WResultTreeView"] = $GLOBALS["WResultTreeView"] . '<ul>' . "\n\r";
                                                        $position++;
                                                        while ($position < sizeof($listAcessos) && $listAcessos[$position]->getNivel() >= $nivelAtual) {
                                                            $nivelAtual = $listAcessos[$position]->getNivel();
                                                            if ($position + 1 < sizeof($listAcessos) && ($listAcessos[$position + 1]->getNivel() > $nivelAtual)) {
                                                                $posRet = addNivelTreeViewHtml($nivelAtual, $position, $listAcessos);
                                                                $position = $posRet;
                                                            } else {
                                                                $GLOBALS["WResultTreeView"] = $GLOBALS["WResultTreeView"] . addItemAcessoTreeView($listAcessos[$position]) . "\n\r";
                                                                $position++;
                                                            }
                                                            $GLOBALS["WResultTreeView"] = $GLOBALS["WResultTreeView"] . "</li> \n\r";
                                                        }
                                                        $GLOBALS["WResultTreeView"] = $GLOBALS["WResultTreeView"] . "</ul> \n\r";
                                                        return $position;
                                                    }

                                                    try {
                                                        echo loadTreeViewHtml();
                                                        //$acessUserCtrl = new Ctrl\AccessUserCtrl();
                                                        // echo $acessUserCtrl->loadTreeViewHtml();
                                                    } catch (Exception $exception) {
                                                        echo '<div class="alert alert-danger no-margin fade in">' .
                                                            '<button class="close" data-dismiss="alert">×</button>' .
                                                            '<i class="fa-fw fa fa-exclamation-circle"></i>' .
                                                            'Falha ao Carregar dados dos Acessos de Usuário : ' . $page_title . '<br>' . $exception->getMessage() .
                                                            '</div>';
                                                    }
                                                    ?>
                                                </div>

                                            </fieldset>

                                            <div class="modal-footer">
                                                <button type="button"
                                                        id="btnSaveAcessos"
                                                        class="btn-form-modal btn btn-primary"><i
                                                            class="fa fa-check"></i> Salvar
                                                </button>
                                                <button type="button" class="btn-form-modal btn btn-default"
                                                        data-dismiss="modal"><i class="fa fa-close"></i> Cancelar
                                                </button>

                                            </div>
                                        </form>

                                    </div>
                                    <!-- end widget content -->

                                </div>
                                <!-- end widget div -->

                            </div>
                            <!-- end widget div -->

                        </div>
                        <!-- end left div -->
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

        </div>
        <!-- END MAIN CONTENT -->


        <!-- Modal -->
        <div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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

                        <div id="center">
                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3"
                                 data-widget-colorbutton="false" data-widget-editbutton="false"
                                 data-widget-custombutton="false">

                                <header>
                                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                    <h2>Cadastrar Senha do Usuário:</h2>
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

                                        <form name="form-acessos" class="smart-form" id="form-acessos" method="post">

                                            <header>
                                                <!--                                                    Tooltips (with icon)-->
                                            </header>
                                            <fieldset>
                                                <section>
                                                    <label class="label">Senha</label>
                                                    <label class="input">
                                                        <i class="icon-append fa fa-envelope-o"></i>
                                                        <input id="ed_password1" name="edPassword1" type="password"
                                                               placeholder="Informe a Senha">
                                                    </label>
                                                    <label class="label">Redigite</label>
                                                    <label class="input">
                                                        <i class="icon-append fa fa-envelope-o"></i>
                                                        <input id="ed_password2" name="edPassword2" type="password"
                                                               placeholder="Redigite a Senha">
                                                    </label>
                                                </section>
                                            </fieldset>

                                            <div class="modal-footer">
                                                <button type="button"
                                                        id="btnSavePassword"
                                                        class="btn-form-modal btn btn-primary"><i
                                                            class="fa fa-check"></i> Salvar
                                                </button>
                                                <button type="button" class="btn-form-modal btn btn-default"
                                                        data-dismiss="modal"><i class="fa fa-close"></i> Cancelar
                                                </button>

                                            </div>
                                        </form>

                                    </div>
                                    <!-- end widget content -->

                                </div>
                                <!-- end widget div -->

                            </div>
                            <!-- end widget div -->

                        </div>
                        <!-- end left div -->
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

        </div>
        <!-- END MAIN CONTENT -->
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