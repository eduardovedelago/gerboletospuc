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
$wTipoLcto = 1;
$page_title_sub = "Inclusão de Boletos";

/* -----------------------------------------------------------
 *  ####                  Validação Acesso Grupos
 * -----------------------------------------------------------*/
//include "./controller/UserCtrl.php";

$_acessoForm = \Ctrl\AccessUserCtrl::$Acess_Lctos;

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
$page_css[] = "inputfile.css";
$page_css[] = "jquery.loadingModal.css";
$page_css[] = "jquery.loadingModal.min.css";

include("inc/header.php");

$page_nav["financeiro"]["sub"]["lctos_pendfin_bl"]["active"] = true;

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
                    Financeiro / <span>Inclusão de Movimentos  / Boletos
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
                                    <form class="nsubmit steps-container" id="wizard-1" novalidate="novalidate"
                                          enctype="multipart/form-data">
                                        <input id="action-form-cadastro" name="action" type="hidden" value="insert">
                                        <input id="tipoLcto" name="tipoLcto" type="hidden" value="1"><!--Boleto-->

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
                                                    <!-- <li data-target="#step4">
                                                        <a href="#tab4" data-toggle="tab"> <span
                                                                    class="step">4</span>
                                                            <span class="title">Antecipação</span> </a>
                                                    </li> -->
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
                                                                                if (($usuario->isAdministrador()) || ($usuario->getEmpresa()==$dadosObj->getEmprCodigo())) {
                                                                                    echo '<option value="' . $dadosObj->getCodigo() . '"> ' . ucwords($dadosObj->getNome()) . ' - ' . $dadosObj->getCnpjcpf() . ' </option>';
                                                                                }
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
                                                        <div id="div_clie_razaosocial" class="col-sm-6">
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

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="labelsPF"
                                                                       for="ed_pfin_valor">Valor Total</label>
                                                                <div class="flex">
                                                                    <span class="dadosmvto">R$</span>
                                                                    <input class="padding-7 align-right-txt inputsPF"
                                                                           id="ed_pfin_valor" name="ed_pfin_valor"
                                                                           autocomplete="off"
                                                                           type="text" maxlength="15"
                                                                           pattern="(\d{3})([\.])(\d{2}"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2" <?php if ($wTipoLcto <> 1) echo 'style="display: none"' ?>>
                                                            <div class="form-group">
                                                                <label class="labelsPF" for="amount">Parcelas</label>
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-play"></span>
                                                                    <input class="inputsPF"
                                                                           id="ed_pfin_parcela" name="ed_pfin_parcela"
                                                                           min="1" max="99" type="number"
                                                                           required="true"
                                                                           maxlength="2" value="1"/>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label class="labelsPF" for="ed_pfin_datamvto">Dt.
                                                                    Mvto</label>
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-calendar"></span>
                                                                    <input class="inputsPF"
                                                                           id="ed_pfin_datamvto" name="ed_pfin_datamvto"
                                                                           readonly
                                                                           type="date"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label class="labelsPF" for="ed_pfin_datavcto">Dt.
                                                                    Vcto</label>
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-calendar"></span>
                                                                    <input class="inputsPF"
                                                                           id="ed_pfin_datavcto" name="ed_pfin_datavcto"
                                                                           max="2021-12-31"
                                                                           type="date"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label class="labelsPF">Número(s) de Dcto(s)</label>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label class="labelsPF" for="amount"></label>
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-file-text"></span>
                                                                    <input class="inputsPF"
                                                                           id="ed_pfin_numerodcto1"
                                                                           name="ed_pfin_numerodcto1"
                                                                           autocomplete="off"
                                                                           type="text"/>
                                                                </div>
                                                            </div>
                                                        </div>                                                      
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="labelsPF" for="amount">Descricao dos Servicos</label>
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-file-text"></span>
                                                                    <input class="inputsPF align-left-txt"
                                                                           class="col-sm-12" id="ed_pfin_observacao"
                                                                           name="ed_pfin_observacao" type="text"
                                                                           placeholder="Descricao dos servicos ou produtos - fatura"
                                                                           autocomplete="off"
                                                                           required
                                                                    />
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
                                                                                <input class="padding-7 align-right-txt inputsPF"
                                                                                       placeholder="0,00"
                                                                                       id="ed_parc_valortotal"
                                                                                       name="ed_parc_valortotal"
                                                                                       type="text" disabled/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label class="labelsPF">Valor Total Parcelas</label>
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
                                                                                       type="text" readonly/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <!-- <div class="tab-pane" id="tab4">
                                                    <br>
                                                    <h3><strong>Etapa 4</strong> - Antecipação</h3>

                                                    <div class="row smart-form">
                                                        <section class="col-sm-9">
                                                            <div class="form-group">
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-money"></span>
                                                                    <label class="marginCheckToggle labelsPF toggle">
                                                                        <label class="labelsPF"><h3>Deseja Antecipar o
                                                                                Recebimento Deste(s) Boleto(s)</h3>
                                                                        </label>
                                                                        <div class="onoffswitch">
                                                                            <input type="checkbox"
                                                                                   name="pfin_statusantecipacao"
                                                                                   class="onoffswitch-checkbox"
                                                                                   id="pfin_statusantecipacao">
                                                                            <label class="onoffswitch-label"
                                                                                   for="pfin_statusantecipacao">
                                                                                <span class="onoffswitch-inner"
                                                                                      value="S"></span>
                                                                                <span class="onoffswitch-switch"
                                                                                      value="N"></span>
                                                                            </label>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>


                                                    <div id="fsSelectFiles" style="display: none"
                                                         class="row smart-form">
                                                        <section class="col-sm-12">
                                                            <div class="form-group">
                                                                <div class="flex">
                                                                    <span class="dadosmvto fa fa-upload"></span>
                                                                    <label class="margin-top-15 labelsPF">Anexar Documento
                                                                    </label>
                                                                    <div >

                                                                        <div class="content">
                                                                            <div class="box">
                                                                                <input type="file" name="file-2[]" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} Arquivos Selecionados" multiple="">
                                                                                <label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>Selecione os Arquivos</span></label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="filesName margin-top-15 label label-primary padding-5 text-center" style="display: none"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>

                                                    </div>

                                                </div> -->
                                                <div class="tab-pane" id="tab5">
                                                    <br>
                                                    <h3><strong>Etapa 5</strong> - Dados de Resumo do Lançamento</h3>
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
                                                        <label data-value="ed_pfin_numerodcto1"
                                                               class="col-sm-1"> </label>                                                        
                                                    </row>
                                                    <row class="row">
                                                        <span class="widget-icon col-sm-1"> <i
                                                                    class="fa fa-file-text"></i> </span>
                                                        <label style="font-weight: bold" class="col-sm-2">Descrição /
                                                            Observação: </label>
                                                        <label data-value="ed_pfin_observacao"
                                                               class="col-sm-6"> </label>
                                                    </row>
                                                    <br>
                                                </div>

                                                <div class="form-actions ">
                                                    <div class="row padding-5">
                                                        <div class="col-sm-4">
                                                            <ul class="pager wizard no-margin">
                                                                <li class="previous first disabled">
                                                                    <button type="button"
                                                                            class="btn btn-labeled btn-primary"><span
                                                                                class="btn-label"><i
                                                                                    class="glyphicon glyphicon glyphicon-refresh"></i></span>Reiniciar
                                                                    </button>
                                                                </li>
                                                                <li class="previous disabled">
                                                                    <button type="button"
                                                                            class="btn btn-labeled btn-warning"><span
                                                                                class="btn-label"><i
                                                                                    class="glyphicon glyphicon-chevron-left"></i></span>Retornar
                                                                    </button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div>
                                                            <ul class="pager wizard no-margin align-right-txt">
                                                                <li id="liSubmitFormNext" class="next">
                                                                    <button type="button"
                                                                            class="btn btn-labeled btn-success"><span
                                                                                class="btn-label"><i
                                                                                    class="glyphicon glyphicon-chevron-right"></i></span>Prosseguir
                                                                    </button>
                                                                </li>
                                                                <li id="liSubmitFormFinalizar" style="display: none">
                                                                    <button type="submit"
                                                                            class="btn btn-labeled btn-success"><span
                                                                                class="btn-label"><i
                                                                                    class="glyphicon glyphicon-ok"></i></span>Finalizar
                                                                    </button>
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
    <!--    <script src="--><?php //echo ASSETS_URL; ?><!--/js/forms.functions.js"></script>-->
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