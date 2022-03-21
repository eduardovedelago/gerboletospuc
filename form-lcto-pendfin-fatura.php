<?php //initilize the page
require_once("inc/init.php");
require_once("inc/config.ui.php");

require_once("sessionIsAuthenticated.php");

//include_once("/controller/AccessUserCtrl.php");
include_once 'database.php';

$page_title = "Inclusão Mvto. Financeiro";
$page_title_sub = "";
$classPHPNameController = 'form-lcto-pendfin';
$wEntityName = "models\PendFin";


/* -----------------------------------------------------------
 *  ####                  Load tipo do Lançamento
 * -----------------------------------------------------------*/
try {
    if (sizeof($_GET) > 0) $wTipoLcto = $_GET['tpLcto'];//1 - Boleto, 2 - Cheque, 3 - Duplicata
    if (($wTipoLcto == null || $wTipoLcto == "") && (sizeof($_POST) > 0)) $wTipoLcto = $_POST['tpLcto'];
    if ($wTipoLcto == null || $wTipoLcto == "") {
        $wTipoLcto = 4;
    }
} catch (Exception $exception) {
    $wTipoLcto = 4;
}

if ($wTipoLcto == 4) {
    $page_title_sub = "Inclusão de Faturas";
} else if ($wTipoLcto == 3) {
    $page_title_sub = "Inclusão de Duplicata";
} else if ($wTipoLcto == 2) {
    $page_title_sub = "Inclusão de Cheques";
} else {
    $page_title_sub = "Inclusão de Boletos";
}

/* -----------------------------------------------------------
 *  ####                  Validação Acesso Grupos
 * -----------------------------------------------------------*/
//include "./controller/UserCtrl.php";

$_acessoForm = \Ctrl\AccessUserCtrl::$Acess_Lctos_PendFin_Faturas;

use ctrl\UserCtrl;

UserCtrl::validateAcessAuthorizedForm($_acessoForm);
$usuario = \Ctrl\UserCtrl::getObjetoUsuario_Login();
if ($usuario == null){
    header("location: access-denied-install.php");
    die;
}
/* -----------------------------------------------------------
 *  ####                  ./Validação Acesso Grupo
 * -----------------------------------------------------------*/


$page_css[] = "your_style.css";
include("inc/header.php");

if ($wTipoLcto == 4) {
    $page_nav["financeiro"]["sub"]["lctos_pendfin_fa"]["active"] = true;
} else if ($wTipoLcto == 3) {
    $page_nav["financeiro"]["sub"]["lctos_pendfin_du"]["active"] = true;
} else if ($wTipoLcto == 2) {
    $page_nav["financeiro"]["sub"]["lctos_pendfin_ch"]["active"] = true;
} else {
    $page_nav["financeiro"]["sub"]["lctos_pendfin_bl"]["active"] = true;
}
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
                    Financeiro / <span>Inclusão de Movimentos  / <?php echo $page_title_sub ?>
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
                            <span class="widget-icon"> <i class="fa fa-check"></i> </span>
                            <?php echo "<h2>" . $page_title_sub . "</h2>" ?>
                        </header>

                        <!-- widget div-->
                        <div>

                            <!-- widget edit box -->
                            <div class="jarviswidget-editbox">
                                <!-- This area used as dropdown edit box -->

                            </div>
                            <!-- end widget edit box -->

                            <!-- widget content -->
                            <div class="widget-body">

                                <div class="row">
                                    <form id="wizard-1" novalidate="novalidate">
                                        <input id="action-form-cadastro" name="action" type="hidden" value="insert">
                                        <input id="tipoLcto" name="tipoLcto" type="hidden"
                                               value="<?php echo $wTipoLcto ?>">

                                        <div id="bootstrap-wizard-1" class="col-sm-12">
                                            <div class="form-bootstrapWizard">
                                                <ul class="bootstrapWizard form-wizard">
                                                    <li class="active" data-target="#step1">
                                                        <a href="#tab1" data-toggle="tab"> <span
                                                                    class="step">1</span>
                                                            <span class="title">Cliente</span> </a>
                                                    </li>
                                                    <li data-target="#step2">
                                                        <a href="#tab2" data-toggle="tab"> <span
                                                                    class="step">2</span>
                                                            <span class="title">Dados do Mvto.</span> </a>
                                                    </li>
                                                    <li data-target="#step3">
                                                        <a href="#tab3" data-toggle="tab"> <span
                                                                    class="step">3</span>
                                                            <span class="title">Parcelas</span> </a>
                                                    </li>
                                                    <li data-target="#step4">
                                                        <a href="#tab4" data-toggle="tab"> <span
                                                                    class="step">4</span>
                                                            <span class="title">Complemento</span> </a>
                                                    </li>
                                                    <li data-target="#step5">
                                                        <a href="#tab5" data-toggle="tab"> <span
                                                                    class="step">5</span>
                                                            <span class="title">Resumo</span> </a>
                                                    </li>
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab1">
                                                    <br>
                                                    <h3><strong>Etapa 1 </strong> - Entidade</h3>

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <div id="divSelectCliente" class="flex">
                                                                    <span class="dadosmvto"><i
                                                                                class="fa fa-flag fa-lg fa-fw"></i></span>
                                                                    <select class="form-control selectpicker input-lg col-md-1"
                                                                            id="ed_clie_codigo" name="edCliente"
                                                                            placeholder="Click para selecionar o Cliente"
                                                                            data-live-search="true"
                                                                            style="input-lg">
                                                                        <option value="" disabled selected> Click
                                                                            para
                                                                            selecionar o Cliente
                                                                        </option>
                                                                        <?php
                                                                        $entRep = $entityManager->getRepository("models\Cliente");
                                                                        $listDadosResult = $entRep->findAll();
                                                                        if ($listDadosResult != null) {
                                                                            foreach ($listDadosResult as $dadosObj) {
                                                                                    echo '<option value="' . $dadosObj->getCodigo() . '"> ' . ucwords($dadosObj->getNome()) . ' - ' . $dadosObj->getCnpjcpf() . ' </option>';
                                                                            }
                                                                        } ?>
                                                                    </select>

                                                                    <button class="btnIncluirPF btn-form-modal btn btn-default btn-primary"
                                                                            type="button" method="post"
                                                                            id="btnNewClient"
                                                                            onclick="window.location.href='form-cad-cliente.php?startIncluir=true'"
                                                                            value="Incluir" title="Incluir"><i
                                                                                class="fa fa-plus"></i> Incluir Cliente
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row" disabled="true">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <div class="flex">
                                                                     <span class="dadosmvto"><i
                                                                                 class="fa fa-male fa-lg fa-fw"></i> </span>
                                                                    <input class="inputsPF" title="Nome:"
                                                                           placeholder=" Nome:"
                                                                           type="text"
                                                                           disabled
                                                                           name="ed_clie_nome" id="ed_clie_nome">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <div class="flex">
                                                                    <span class="dadosmvto"><i
                                                                                class="fa fa-group fa-lg fa-fw"></i></span>
                                                                    <input class="inputsPF" type="text"
                                                                           title=" Razão Social:"
                                                                           placeholder="Razão Social:"
                                                                           disabled
                                                                           name="ed_clie_razaosocial"
                                                                           id="ed_clie_razaosocial">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row" disabled="true">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <div class="flex">
                                                                    <span class="dadosmvto"><i
                                                                                class="fa fa-qrcode fa-lg fa-fw"></i></span>
                                                                    <input class="inputsPF"
                                                                           placeholder=" CNPJ / CPF" type="text"
                                                                           disabled
                                                                           name="ed_clie_cnpjcpf"
                                                                           id="ed_clie_cnpjcpf">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <div class="flex">
                                                                     <span class="dadosmvto"><i
                                                                                 class="fa fa-envelope fa-lg fa-fw"></i></span>
                                                                    <input class="inputsPF"
                                                                           placeholder=" E-Mail" type="text"
                                                                           name="ed_clie_email" id="ed_clie_email">

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab2">
                                                    <br>
                                                    <h3><strong>Etapa 2</strong> - Dados do Movimento</h3>


                                                    <div class="row">
                                                        <div class="col-sm-7">
                                                            <div class="form-group">
                                                                <label class="labelsPF"
                                                                       for="ed_pfin_valor">Produtos / Serviços</label>
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-barcode"></span>
                                                                    <select class="selectpicker col-sm-12 col-md-12"
                                                                            id="ed_prod_codigo" name="ed_prod_codigo"
                                                                            placeholder="Click para selecionar o Produto / Serviço"
                                                                            data-live-search="true"
                                                                            style="input-lg">
                                                                        <option value="" disabled selected> Click
                                                                            para
                                                                            selecionar o Produto / Serviço
                                                                        </option>
                                                                        <?php
                                                                        $entRep = $entityManager->getRepository("models\ProdServ");
                                                                        $listDadosResult = $entRep->findAll();
                                                                        if ($listDadosResult != null) {
                                                                            foreach ($listDadosResult as $dadosObj) {
                                                                                echo '<option value="' . $dadosObj->getCodigo() . '"> ' . ucwords($dadosObj->getDescricao()) . ' </option>';
                                                                            }
                                                                        } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label class="labelsPF" for="amount">Qtd</label>
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-level-up"></span>
                                                                    <input class="inputsPF align-right-txt padding-7"
                                                                           id="ed_pfin_parcela" name="ed_pfin_parcela"
                                                                           min="1" max="99" type="number"
                                                                           required="true"
                                                                           maxlength="2" value="1"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label class="labelsPF" for="amount">Valor Total</label>
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-money"></span>
                                                                    <input class="inputsPF align-right-txt padding-7"
                                                                           id="ed_pfin_parcela" name="ed_pfin_parcela"
                                                                           required="false"
                                                                           maxlength="2" value="1"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-7">
                                                            <div class="form-group">
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-barcode"></span>
                                                                    <select class="selectpicker col-sm-12 col-md-12"
                                                                            id="ed_prod_codigo" name="ed_prod_codigo"
                                                                            placeholder="Click para selecionar o Produto / Serviço"
                                                                            data-live-search="true"
                                                                            style="input-lg">
                                                                        <option value="" disabled selected> Click
                                                                            para
                                                                            selecionar o Produto / Serviço
                                                                        </option>
                                                                        <?php
                                                                        $entRep = $entityManager->getRepository("models\ProdServ");
                                                                        $listDadosResult = $entRep->findAll();
                                                                        if ($listDadosResult != null) {
                                                                            foreach ($listDadosResult as $dadosObj) {
                                                                                echo '<option value="' . $dadosObj->getCodigo() . '"> ' . ucwords($dadosObj->getDescricao()) . ' </option>';
                                                                            }
                                                                        } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-level-up"></span>
                                                                    <input class="inputsPF align-right-txt padding-7"
                                                                           id="ed_pfin_parcela" name="ed_pfin_parcela"
                                                                           min="1" max="99" type="number"
                                                                           required="true"
                                                                           maxlength="2" value="1"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-money"></span>
                                                                    <input class="inputsPF align-right-txt padding-7"
                                                                           id="ed_pfin_parcela" name="ed_pfin_parcela"
                                                                           required="false"
                                                                           maxlength="2" value="1"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-7">
                                                            <div class="form-group">
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-barcode"></span>
                                                                    <select class="selectpicker col-sm-12 col-md-12"
                                                                            id="ed_prod_codigo" name="ed_prod_codigo"
                                                                            placeholder="Click para selecionar o Produto / Serviço"
                                                                            data-live-search="true"
                                                                            style="input-lg">
                                                                        <option value="" disabled selected> Click
                                                                            para
                                                                            selecionar o Produto / Serviço
                                                                        </option>
                                                                        <?php
                                                                        $entRep = $entityManager->getRepository("models\ProdServ");
                                                                        $listDadosResult = $entRep->findAll();
                                                                        if ($listDadosResult != null) {
                                                                            foreach ($listDadosResult as $dadosObj) {
                                                                                echo '<option value="' . $dadosObj->getCodigo() . '"> ' . ucwords($dadosObj->getDescricao()) . ' </option>';
                                                                            }
                                                                        } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-level-up"></span>
                                                                    <input class="inputsPF align-right-txt padding-7"
                                                                           id="ed_pfin_parcela" name="ed_pfin_parcela"
                                                                           min="1" max="99" type="number"
                                                                           required="true"
                                                                           maxlength="2" value="1"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-money"></span>
                                                                    <input class="inputsPF align-right-txt padding-7"
                                                                           id="ed_pfin_parcela" name="ed_pfin_parcela"
                                                                           required="false"
                                                                           maxlength="2" value="1"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-7">
                                                            <div class="form-group">
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-barcode"></span>
                                                                    <select class="selectpicker col-sm-12 col-md-12"
                                                                            id="ed_prod_codigo" name="ed_prod_codigo"
                                                                            placeholder="Click para selecionar o Produto / Serviço"
                                                                            data-live-search="true"
                                                                            style="input-lg">
                                                                        <option value="" disabled selected> Click
                                                                            para
                                                                            selecionar o Produto / Serviço
                                                                        </option>
                                                                        <?php
                                                                        $entRep = $entityManager->getRepository("models\ProdServ");
                                                                        $listDadosResult = $entRep->findAll();
                                                                        if ($listDadosResult != null) {
                                                                            foreach ($listDadosResult as $dadosObj) {
                                                                                echo '<option value="' . $dadosObj->getCodigo() . '"> ' . ucwords($dadosObj->getDescricao()) . ' </option>';
                                                                            }
                                                                        } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-level-up"></span>
                                                                    <input class="inputsPF align-right-txt padding-7"
                                                                           id="ed_pfin_parcela" name="ed_pfin_parcela"
                                                                           min="1" max="99" type="number"
                                                                           required="true"
                                                                           maxlength="2" value="1"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-money"></span>
                                                                    <input class="inputsPF align-right-txt padding-7"
                                                                           id="ed_pfin_parcela" name="ed_pfin_parcela"
                                                                           required="false"
                                                                           maxlength="2" value="1"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">


                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="labelsPF" for="ed_pfin_datamvto">Dt.
                                                                    Mvto</label>
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-calendar"></span>
                                                                    <input class="inputsPF"
                                                                           id="ed_pfin_datamvto" name="ed_pfin_datamvto"
                                                                           type="date"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="labelsPF" for="ed_pfin_datavcto">Dt.
                                                                    Vcto</label>
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-calendar"></span>
                                                                    <input class="inputsPF"
                                                                           id="ed_pfin_datavcto" name="ed_pfin_datavcto"
                                                                           type="date"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="labelsPF"
                                                                       for="ed_pfin_valor">Valor</label>
                                                                <div class="flex">
                                                                    <span class="dadosmvto">R$</span>
                                                                    <input class="padding-7 align-right-txt inputsPF"
                                                                           id="ed_pfin_valor" name="ed_pfin_valor"
                                                                           type="text" maxlength="15"
                                                                           pattern="(\d{3})([\.])(\d{2}" readonly/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="labelsPF" for="amount">Observações</label>
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-file-text"></span>
                                                                    <input class="inputsPF"
                                                                           class="col-sm-12" id="ed_pfin_observacao"
                                                                           name="ed_pfin_observacao" type="text"
                                                                           required="false"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab3">

                                                    <br>
                                                    <h3><strong>Etapa 3</strong> - Parcelas</h3>
                                                    <div class="row formParcelas">
                                                        <fieldset>
                                                            <section>
                                                                <div class="row">
                                                                    <div class="col-sm-2">
                                                                        <div class="form-group">
                                                                            <label class="labelsPF">Parcela</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label class="labelsPF">Valor</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label class="labelsPF">Vencimento</label>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div id="div_parcelas" name="div_parcelas"
                                                                     class="form-group">

                                                                </div>
                                                            </section>
                                                        </fieldset>
                                                        <fieldset>
                                                            <section>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label class="labelsPF">Valor Total</label>
                                                                            <div class="flex">
                                                                                <span class="dadosmvto">R$</span>
                                                                                <input class="padding-7 align-right-txt  inputsPF"
                                                                                       placeholder="0,00"
                                                                                       id="ed_parc_valortotal"
                                                                                       name="ed_parc_valortotal"
                                                                                       type="text" disabled/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label class="labelsPF">Valor
                                                                                Informado</label>
                                                                            <div class="flex">
                                                                                <span class="dadosmvto">R$</span>
                                                                                <input class="padding-7 align-right-txt inputsPF"
                                                                                       placeholder="0,00"
                                                                                       id="ed_parc_valorinfo"
                                                                                       name="ed_parc_valorinfo"
                                                                                       type="text" disabled/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label class="labelsPF">Diferença</label>
                                                                            <div class="flex">
                                                                                <span class="dadosmvto">R$</span>
                                                                                <input class="padding-7 align-right-txt inputsPF"
                                                                                       placeholder="0,00"
                                                                                       id="ed_parc_diferenca"
                                                                                       name="ed_parc_diferenca"
                                                                                       validaParcelasValor
                                                                                       type="text"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab4">
                                                    <br>
                                                    <h3><strong>Etapa 4</strong> - Complemento</h3>

                                                    <div class="row smart-form">
                                                        <section class="col-sm-8">
                                                            <div class="form-group">
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-envelope"></span>
                                                                    <label class="marginCheckToggle labelsPF toggle">
                                                                        <label class="labelsPF">Enviar Boleto por
                                                                            E-mail</label>
                                                                        <input class="inputsPF"
                                                                               type="checkbox" name="checkbox-toggle"
                                                                               checked="checked">
                                                                        <i data-swchon-text="Sim"
                                                                           data-swchoff-text="Não"></i>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab5">
                                                    <br>
                                                    <h3><strong>Etapa 5</strong> - Resumo do Movimento</h3>
                                                    <row class="row">
                                                        <span class="widget-icon col-sm-1"> <i class="fa fa-user"></i> </span>
                                                        <label style="font-weight: bold"
                                                               class="col-sm-2">Cliente: </label>
                                                        <label data-value="ed_clie_nome" class="col-sm-2"> </label>
                                                    </row>
                                                    <row class="row">
                                                        <span class="widget-icon col-sm-1"> <i
                                                                    class="fa fa-envelope"></i> </span>
                                                        <label style="font-weight: bold" class="col-sm-2">E-Mail
                                                            Cliente: </label>
                                                        <label data-value="ed_clie_email" class="col-sm-2"> </label>
                                                    </row>
                                                    <row class="row">
                                                        <span class="widget-icon col-sm-1"> <i class="fa fa-money"></i> </span>
                                                        <label style="font-weight: bold"
                                                               class="col-sm-2">Valor: </label>
                                                        <label data-value="ed_pfin_valor" class="col-sm-2"> </label>
                                                    </row>
                                                    <row class="row">
                                                        <span class="widget-icon col-sm-1"> <i
                                                                    class="fa fa-calendar"></i> </span>
                                                        <label style="font-weight: bold" class="col-sm-2">Data de
                                                            Movimento: </label>
                                                        <label data-value="ed_pfin_datamvto" class="col-sm-2"> </label>
                                                        <span class="widget-icon col-sm-1"> <i
                                                                    class="fa fa-calendar"></i> </span>
                                                        <label style="font-weight: bold" class="col-sm-2">Data de
                                                            Vencimento: </label>
                                                        <label data-value="ed_pfin_datavcto" class="col-sm-2"> </label>
                                                    </row>
                                                    <row class="row">
                                                        <span class="widget-icon col-sm-1"> <i class="fa fa-play"></i> </span>
                                                        <label style="font-weight: bold" class="col-sm-2">Número de
                                                            Parcelas: </label>
                                                        <label data-value="ed_pfin_parcela" class="col-sm-2"> </label>
                                                    </row>
                                                    <row id="resParcelas" class="row" style="display: none">
                                                        //code-fork
                                                    </row>
                                                    <row class="row">
                                                        <span class="widget-icon col-sm-1"> <i
                                                                    class="fa fa-file-text"></i> </span>
                                                        <label style="font-weight: bold" class="col-sm-2">Número do
                                                            Documento: </label>
                                                        <label data-value="ed_pfin_numerodcto"
                                                               class="col-sm-2"> </label>
                                                    </row>
                                                    <row class="row">
                                                        <span class="widget-icon col-sm-1"> <i
                                                                    class="fa fa-file-text"></i> </span>
                                                        <label style="font-weight: bold" class="col-sm-2">Descrição /
                                                            Observação: </label>
                                                        <label data-value="ed_pfin_observacao"
                                                               class="col-sm-6"> </label>
                                                    </row>
                                                    <row class="row" <?php if ($wTipoLcto == 2 || $wTipoLcto == 3) echo 'style="display: none"' ?> >
                                                        <span class="widget-icon col-sm-1"> <i
                                                                    class="fa fa-file-text"></i> </span>
                                                        <label style="font-weight: bold" class="col-sm-2">Instrução
                                                            Boleto: </label>
                                                        <label data-value="ed_instrucao" class="col-sm-6"> </label>
                                                    </row>
                                                    <row class="row" <?php if ($wTipoLcto == 1 || $wTipoLcto == 3) echo 'style="display: none"' ?> >
                                                        <span class="widget-icon col-sm-1"> <i
                                                                    class="fa fa-file-text-o"></i> </span>
                                                        <label style="font-weight: bold"
                                                               class="col-sm-2">Banco: </label>
                                                        <label data-value="ed_bancocheque" class="col-sm-1"> </label>
                                                        <span class="widget-icon col-sm-1"> <i
                                                                    class="fa fa-file-text-o"></i> </span>
                                                        <label style="font-weight: bold"
                                                               class="col-sm-1">Agencia: </label>
                                                        <label data-value="ed_agenciacheque" class="col-sm-2"> </label>
                                                        <span class="widget-icon col-sm-1"> <i
                                                                    class="fa fa-file-text-o"></i> </span>
                                                        <label data-value="ed_contacheque"
                                                               class="pull-right col-sm-2"></label>
                                                        <label style="font-weight: bold" class="col-sm-2">Conta
                                                            Corrente: </label>
                                                    </row>
                                                    <row class="row" <?php if ($wTipoLcto == 1 || $wTipoLcto == 3) echo 'style="display: none"' ?> >
                                                        <span class="widget-icon col-sm-1"> <i
                                                                    class="fa fa-file-text-o"></i> </span>
                                                        <label style="font-weight: bold"
                                                               class="col-sm-1">Nominal: </label>
                                                        <label data-value="ed_nominalcheque" class="col-sm-2"> </label>
                                                    </row>
                                                    <br>
                                                </div>

                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <ul class="pager wizard no-margin">
                                                                <li class="previous first disabled">
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-lg btn-default">
                                                                        Reiniciar </a>
                                                                </li>
                                                                <li class="previous disabled">
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-lg btn-default"> Retornar </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div>
                                                            <ul class="pager wizard no-margin">
                                                                <li class="next">
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-lg txt-color-darken">
                                                                        Prosseguir </a>
                                                                </li>
                                                                <li class="finish">
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-lg txt-color-darken">Finalizar </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

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


    <script>

        function getMoney(str) {
            return parseInt(str.replace(/[\D]+/g, ''));
        }

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
                var $form = $("#wizard-1");
                var $edvalor = $form.find("#ed_pfin_valor");

                $form.find('#ed_pfin_parcela').on("keyup", function (ev) {

                    var i = parseInt($(this).val());
                    if (i > 99 || i == 0) {
                        $(this).val('1');
                        ev.preventDefault();
                        return;
                    }

                });

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