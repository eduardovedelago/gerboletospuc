<?php

//initilize the page
require_once("inc/init.php");

require_once("inc/config.ui.php");

require_once("sessionIsAuthenticated.php");

//Obrigatório colocar em todos formulário que irão utilizar (inc/nav.php ou inc/header.php)
include_once("./controller/UserCtrl.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Home";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";

include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
//$page_nav["dashboard"]["sub"]["analytics"]["active"] = true;
$page_nav["dashboard"]["active"] = true;
include("inc/nav.php");

//Executa Carga Empresa

?>
    <!-- ==========================CONTENT STARTS HERE ========================== -->
    <!-- MAIN PANEL -->
    <div id="main" role="main">
        <?php
        //configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
        //$breadcrumbs["New Crumb"] => "http://url.com"
        include("inc/ribbon.php");
        ?>

        <!-- MAIN CONTENT -->
        <div id="content">

            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                    <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Home
                    </h1>
                </div>
                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
                    <ul id="sparks" class="">

                    </ul>
                </div>
            </div>

            <?php

            if ($_GET['error']!=null &&  $_GET['error']!=""){
                echo ' <div class="alert alert-danger fade in">
						<button class="close" data-dismiss="alert">
							×
						</button>
						<i class="fa-fw fa fa-times"></i>
						<strong>Erro: </strong>';
                echo $_GET['error'];
                echo '</div>';
            }

            ?>

            <?php

            if ($_GET['info']!=null &&  $_GET['info']!=""){
                echo ' <div class="alert alert-success fade in">
						<button class="close" data-dismiss="alert">
							×
						</button>
						<i class="fa-fw fa fa-check"></i>
						<strong>Info: </strong>';
                echo $_GET['info'];
                echo '</div>';
            }

            ?>
            <!-- widget grid -->
            <section id="widget-grid" class="">

                <!-- row -->
                <div class="row">
                    <article class="col-sm-12">
                        <!-- new widget -->
                        <div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false"
                             data-widget-editbutton="false" data-widget-fullscreenbutton="false"
                             data-widget-colorbutton="false" data-widget-deletebutton="false">
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
                                <span class="widget-icon"> <i
                                            class="glyphicon glyphicon-home txt-color-darken"></i> </span>
                                <h2> Acesso Rápido </h2>

                                <ul class="nav nav-tabs pull-right in" id="myTab">
                                    <!--                                    <li class="active">-->
                                    <!--                                        <a data-toggle="tab" href="#s1"><i class="fa fa-clock-o"></i> <span-->
                                    <!--                                                    class="hidden-mobile hidden-tablet">Geral</span></a>-->
                                    <!--                                    </li>-->

                                    <!--                                    <li>-->
                                    <!--                                        <a data-toggle="tab" href="#s2"><i class="fa fa-calendar"></i> <span-->
                                    <!--                                                    class="hidden-mobile hidden-tablet">Agenda</span></a>-->
                                    <!--                                    </li>-->

                                    <!--                                    <li>-->
                                    <!--                                        <a data-toggle="tab" href="#s3"><i class="fa fa-dollar"></i> <span-->
                                    <!--                                                    class="hidden-mobile hidden-tablet">Revenue</span></a>-->
                                    <!--                                    </li>-->
                                </ul>

                            </header>

                            <!-- widget div-->
                            <div class="no-padding">
                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">

                                </div>
                                <!-- end widget edit box -->

                                <div class="widget-body">
                                    <!-- content -->
                                    <div id="myTabContent" class="tab-content backgroundHome">
                                        <div class="tab-pane fade active in padding-10 no-padding-bottom" id="s1">
                                            <div class="row">
                                                <div id="graficos">
                                                    <!-- <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 padding-3">
                                                        <div class="x_panel_unidade" style="border-color: #b1b2b5">
                                                            <div class="x_title_unidade">
                                                                <strong><a>Clientes</a></strong>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="x_content_unidade">
                                                                <img src="./img/person_icon.png" class="center-block"
                                                                     height="120px" width="120px">
                                                                <a class="btn btn-success center-block margin-top-10"
                                                                   href="<?php echo APP_URL . '/form-cad-cliente.php' ?> ">Abrir</a>
                                                            </div>
                                                        </div>
                                                    </div> -->
<!--                                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 padding-3">-->
<!--                                                        <div class="x_panel_unidade" style="border-color: #b1b2b5">-->
<!--                                                            <div class="x_title_unidade">-->
<!--                                                                <strong><a>Produtos e Serviços</a></strong>-->
<!--                                                                <div class="clearfix"></div>-->
<!--                                                            </div>-->
<!--                                                            <div class="x_content_unidade">-->
<!--                                                                <img src="./img/prodserv.png" class="center-block"-->
<!--                                                                     height="120px" width="120px">-->
<!--                                                                <a class="btn btn-success center-block margin-top-10"-->
<!--                                                                   href="--><?php //echo APP_URL . '/form-cad-prodserv.php' ?><!-- ">Abrir</a>-->
<!--                                                            </div>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
                                                    <!-- <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 padding-3">
                                                        <div class="x_panel_unidade" style="border-color: #b1b2b5">
                                                            <div class="x_title_unidade">
                                                                <strong><a>Antecipação</a></strong>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="x_content_unidade">

                                                                <img src="./img/dolar_icon.png" class="center-block"
                                                                     height="120px" width="120px">

                                                                <a class="btn btn-success center-block margin-top-10"
                                                                   href="javascript:void(0);">Solicitar</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 padding-3">
                                                        <div class="x_panel_unidade" style="border-color: #b1b2b5">
                                                            <div class="x_title_unidade"><strong><a>Mvto. Financeiro</a></strong>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="x_content_unidade">

                                                                <img src="./img/saco_icon.png" class="center-block"
                                                                     height="120px" width="120px">

                                                                <a name="btnExecuteLcto" id="btnExecuteLcto"
                                                                   class="btn btn-success center-block margin-top-10"
                                                                   href="javascript:void(0);">Incluir Movimento</a>
                                                            </div>
                                                        </div>
                                                    </div> -->
<!--                                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 padding-3">-->
<!--                                                        <div class="x_panel_unidade" style="border-color: #b1b2b5">-->
<!--                                                            <div class="x_title_unidade"><strong><a>Atualizar Boleto</a></strong>-->
<!--                                                                <div class="clearfix"></div>-->
<!--                                                            </div>-->
<!--                                                            <div class="x_content_unidade">-->
<!---->
<!--                                                                <img src="./img/edit_icon.png" class="center-block"-->
<!--                                                                     height="120px" width="120px">-->
<!---->
<!--                                                                <a class="btn btn-success center-block margin-top-10"-->
<!--                                                                   href="javascript:void(0);">Alterar</a>-->
<!--                                                            </div>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
                                                    <!-- <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 padding-3">
                                                        <div class="x_panel_unidade" style="border-color: #b1b2b5">
                                                            <div class="x_title_unidade"><strong><a>Relatório do Mvto</a></strong>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="x_content_unidade">

                                                                <img src="./img/icon-report.png" class="center-block"
                                                                     height="120px" width="120px">

                                                                <a name="btnExecuteRelBlt" id="btnExecuteRelBlt"
                                                                   class="btn btn-success center-block margin-top-10"
                                                                   href="javascript:void(0);">Abrir</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 padding-3">
                                                        <div class="x_panel_unidade" style="border-color: #b1b2b5">
                                                            <div class="x_title_unidade"><strong><a>Taxas</a></strong>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="x_content_unidade">

                                                                <img src="./img/taxa_icon.png" class="center-block"
                                                                     height="120px" width="120px">

                                                                <a name="btnVisParamEmpr" id="btnVisParamEmpr"
                                                                   class="btn btn-success center-block margin-top-10"
                                                                   href="javascript:void(0);">Visualizar</a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 padding-3">
                                                        <div class="x_panel_unidade" style="border-color: #b1b2b5">
                                                            <div class="x_title_unidade"><strong><a>Cancelar Boleto</a></strong>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="x_content_unidade">
                                                                <img src="./img/cancel_icon.png" class="center-block"
                                                                     height="120px" width="120px">
                                                                
                                                                <a class="btn btn-danger center-block margin-top-10"
                                                                   href="<?php echo APP_URL . '/form-proc-cancel-blt.php' ?> ">Abrir</a>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- end content -->
                                </div>

                            </div>
                            <!-- end widget div -->
                        </div>
                        <!-- end widget -->

                    </article>

                    <div class="modal fade" id="modalExecuteLcto" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content backgroundHome">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        &times;
                                    </button>
                                    <h3 class="modal-title txt-color-white">
                                        Mvto. Financeiro</h3>
                                </div>
                                <div class="tab-pane fade active in padding-10 no-padding-bottom" id="s1">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-3">
                                            <div class="x_panel_unidade" style="border-color: #b1b2b5">
                                                <div class="x_title_unidade">
                                                    <a href="<?php echo APP_URL . '/form-lcto-pendfin.php?tpLcto=1' ?>">Incluir
                                                        Boletos</a>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content_unidade">
                                                    <div class="col-xs-5">
                                                        <img src="./img/barras_icon.png" class="center-block"
                                                             height="80px" width="80px">
                                                    </div>
                                                    <div class="col-xs-5 margin-top-5-perc">
                                                        <a class="btn btn-primary center-block"
                                                           href="<?php echo APP_URL . '/form-lcto-pendfin.php?tpLcto=1' ?>">Incluir</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-3">
                                            <div class="x_panel_unidade" style="border-color: #b1b2b5">
                                                <div class="x_title_unidade">
                                                    <a>Incluir Cheques</a>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content_unidade">
                                                    <div class="col-xs-5">
                                                        <img src="./img/cheque_icon.png" class="center-block"
                                                             height="80px" width="80px">
                                                    </div>
                                                    <div class="col-xs-5 margin-top-5-perc">

                                                        <a class="btn btn-primary center-block"
                                                           href="<?php echo APP_URL . '/form-lcto-pendfin.php?tpLcto=2' ?> ">Incluir</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-3">
                                            <div class="x_panel_unidade" style="border-color: #b1b2b5">
                                                <div class="x_title_unidade">
                                                    <a>Incluir Duplicata</a>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content_unidade">
                                                    <div class="col-xs-5">
                                                        <img src="./img/duplicata_icon.png" class="center-block"
                                                             height="80px" width="80px">
                                                    </div>
                                                    <div class="col-xs-5 margin-top-5-perc">

                                                        <a class="btn btn-primary center-block"
                                                           href="<?php echo APP_URL . '/form-lcto-pendfin.php?tpLcto=3' ?> ">Incluir</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.modal - content-->
                        </div><!-- /.modal - dialog-->
                    </div><!-- /.modal-->


                    <!-- Modal Taxas-->
                    <div class="modal fade" id="modalParametroEmpr" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel"
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
                                                <h2>Parametros da Empresa</h2>
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

                                                    <form name="form-config" class="smart-form" id="form-config"
                                                          method="post">

                                                        <header>
                                                                <?php
                                                                if ($empresa != null) {
                                                                    echo $empresa->getNome() . " - " . $empresa->getCnpj();
                                                                }
                                                                ?>
                                                        </header>
                                                        <fieldset>
                                                            <div class="tree smart-form">
                                                                <section>
                                                                    <span id="sCartGarantida" class="widget-icon"> <i
                                                                                class="fa fa-check"></i> </span> <label>
                                                                        Carteira Garantida </label>
                                                                    <label class="pull-right col-sm-2">
                                                                        <?php
                                                                        if ($empresa != null && $empresa->getCarteiragarantida() != null && $empresa->getCarteiragarantida() == "S") {
                                                                            echo "Sim";
                                                                        } else {
                                                                            echo "Não";
                                                                        }
                                                                        ?>
                                                                    </label>
                                                                </section>
                                                                <section>
                                                                    <span id="sCartGarantida" class="widget-icon"> <i
                                                                                class="fa fa-check"></i> </span> <label>
                                                                        Taxa Boleto </label>
                                                                    <label class="pull-right col-sm-2"> <?php if ($empresa != null) echo formatFloat($empresa->getTaxaboleto()) ?> </label>
                                                                </section>
                                                                <section>
                                                                    <span id="sCartGarantida" class="widget-icon"> <i
                                                                                class="fa fa-check"></i> </span> <label>
                                                                        Taxa Cheque - </label>
                                                                    <label class="pull-right col-sm-2"> <?php if ($empresa != null) echo formatFloat($empresa->getTaxacheque()) ?> </label>
                                                                </section>
                                                                <section>
                                                                    <span class="widget-icon"> <i
                                                                                class="fa fa-check"></i> </span> <label>
                                                                        Juros Boleto - </label>
                                                                    <label class="pull-right col-sm-2"> <?php if ($empresa != null) echo formatFloat($empresa->getJurosboleto()) ?> </label>
                                                                </section>
                                                                <section>
                                                                    <span class="widget-icon"> <i
                                                                                class="fa fa-check"></i> </span> <label>
                                                                        Multa Boleto - </label>
                                                                    <label class="pull-right col-sm-2"> <?php if ($empresa != null) echo formatFloat($empresa->getMultaboleto()) ?> </label>
                                                                </section>
                                                                <section>
                                                                    <span class="widget-icon"> <i
                                                                                class="fa fa-check"></i> </span> <label>
                                                                        Mora Boleto - </label>
                                                                    <label class="pull-right col-sm-2"> <?php if ($empresa != null) echo formatFloat($empresa->getMoraboleto()) ?> </label>
                                                                </section>
                                                                <!--                                                                --><?php
                                                                //                                                                try {
                                                                //                                                                    //echo loadTreeViewHtml();
                                                                //                                                                    //$acessUserCtrl = new Ctrl\AccessUserCtrl();
                                                                //                                                                    // echo $acessUserCtrl->loadTreeViewHtml();
                                                                //                                                                } catch (Exception $exception) {
                                                                //                                                                    echo '<div class="alert alert-danger no-margin fade in">' .
                                                                //                                                                        '<button class="close" data-dismiss="alert">×</button>' .
                                                                //                                                                        '<i class="fa-fw fa fa-exclamation-circle"></i>' .
                                                                //                                                                        'Falha ao Carregar dados da configuração da Empresa : ' . $page_title . '<br>' . $exception->getMessage() .
                                                                //                                                                        '</div>';
                                                                //                                                                }
                                                                //                                                                ?>
                                                            </div>

                                                        </fieldset>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn-form-modal btn btn-default"
                                                                    data-dismiss="modal"><i class="fa fa-close"></i> OK
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
                    <!--END MAIN CONTENT-->
                </div>

                <!-- end row -->

                <!-- row -->

                <!-- end row -->

            </section>
            <!-- end widget grid -->

        </div>
        <!-- END MAIN CONTENT -->

    </div>
    <!-- END MAIN PANEL -->

    <!-- ==========================CONTENT ENDS HERE ========================== -->

    <!-- PAGE FOOTER -->
<?php
include("inc/footer.php");
?>
    <!-- END PAGE FOOTER -->

<?php
//include required scripts
include("inc/scripts.php");
?>

    <!-- PAGE RELATED PLUGIN(S)
    <script src="..."></script>-->
    <!-- Flot Chart Plugin: Flot Engine, Flot Resizer, Flot Tooltip -->
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.cust.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.resize.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.time.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.tooltip.min.js"></script>

    <!-- Vector Maps Plugin: Vectormap engine, Vectormap language -->
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/vectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- Full Calendar -->
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/moment/moment.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/fullcalendar/jquery.fullcalendar.min.js"></script>

    <script src="<?php echo ASSETS_URL; ?>/js/forms.functions.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/forms/index.js"></script>
    <script>
        $(document).ready(function () {

            /*
             * PAGE RELATED SCRIPTS
             */

            $(".js-status-update a").click(function () {
                var selText = $(this).text();
                var $this = $(this);
                $this.parents('.btn-group').find('.dropdown-toggle').html(selText + ' <span class="caret"></span>');
                $this.parents('.dropdown-menu').find('li').removeClass('active');
                $this.parent().addClass('active');
            });

            /*
            * TODO: add a way to add more todo's to list
            */

            // initialize sortable
            $(function () {
                $("#sortable1, #sortable2").sortable({
                    handle: '.handle',
                    connectWith: ".todo",
                    update: countTasks
                }).disableSelection();
            });

            // check and uncheck
            $('.todo .checkbox > input[type="checkbox"]').click(function () {
                var $this = $(this).parent().parent().parent();

                if ($(this).prop('checked')) {
                    $this.addClass("complete");

                    // remove this if you want to undo a check list once checked
                    //$(this).attr("disabled", true);
                    $(this).parent().hide();

                    // once clicked - add class, copy to memory then remove and add to sortable3
                    $this.slideUp(500, function () {
                        $this.clone().prependTo("#sortable3").effect("highlight", {}, 800);
                        $this.remove();
                        countTasks();
                    });
                } else {
                    // insert undo code here...
                }

            })

            // count tasks
            function countTasks() {

                $('.todo-group-title').each(function () {
                    var $this = $(this);
                    $this.find(".num-of-tasks").text($this.next().find("li").size());
                });

            }

            /*
            * RUN PAGE GRAPHS
            */

            /* TAB 1: UPDATING CHART */
            // For the demo we use generated data, but normally it would be coming from the server

            var data = [], totalPoints = 200, $UpdatingChartColors = $("#updating-chart").css('color');

            function getRandomData() {
                if (data.length > 0)
                    data = data.slice(1);

                // do a random walk
                while (data.length < totalPoints) {
                    var prev = data.length > 0 ? data[data.length - 1] : 50;
                    var y = prev + Math.random() * 10 - 5;
                    if (y < 0)
                        y = 0;
                    if (y > 100)
                        y = 100;
                    data.push(y);
                }

                // zip the generated y values with the x values
                var res = [];
                for (var i = 0; i < data.length; ++i)
                    res.push([i, data[i]])
                return res;
            }

            // setup control widget
            var updateInterval = 1500;
            $("#updating-chart").val(updateInterval).change(function () {

                var v = $(this).val();
                if (v && !isNaN(+v)) {
                    updateInterval = +v;
                    $(this).val("" + updateInterval);
                }

            });

            // setup plot
            var options = {
                yaxis: {
                    min: 0,
                    max: 100
                },
                xaxis: {
                    min: 0,
                    max: 100
                },
                colors: [$UpdatingChartColors],
                series: {
                    lines: {
                        lineWidth: 1,
                        fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 0.4
                            }, {
                                opacity: 0
                            }]
                        },
                        steps: false

                    }
                }
            };

            var plot = $.plot($("#updating-chart"), [getRandomData()], options);

            /* live switch */
            $('input[type="checkbox"]#start_interval').click(function () {
                if ($(this).prop('checked')) {
                    $on = true;
                    updateInterval = 1500;
                    update();
                } else {
                    clearInterval(updateInterval);
                    $on = false;
                }
            });

            function update() {
                if ($on == true) {
                    plot.setData([getRandomData()]);
                    plot.draw();
                    setTimeout(update, updateInterval);

                } else {
                    clearInterval(updateInterval)
                }

            }

            var $on = false;

            /*end updating chart*/

            /* TAB 2: Social Network  */

            $(function () {
                // jQuery Flot Chart
                var twitter = [[1, 27], [2, 34], [3, 51], [4, 48], [5, 55], [6, 65], [7, 61], [8, 70], [9, 65], [10, 75], [11, 57], [12, 59], [13, 62]],
                    facebook = [[1, 25], [2, 31], [3, 45], [4, 37], [5, 38], [6, 40], [7, 47], [8, 55], [9, 43], [10, 50], [11, 47], [12, 39], [13, 47]],
                    data = [{
                        label: "Twitter",
                        data: twitter,
                        lines: {
                            show: true,
                            lineWidth: 1,
                            fill: true,
                            fillColor: {
                                colors: [{
                                    opacity: 0.1
                                }, {
                                    opacity: 0.13
                                }]
                            }
                        },
                        points: {
                            show: true
                        }
                    }, {
                        label: "Facebook",
                        data: facebook,
                        lines: {
                            show: true,
                            lineWidth: 1,
                            fill: true,
                            fillColor: {
                                colors: [{
                                    opacity: 0.1
                                }, {
                                    opacity: 0.13
                                }]
                            }
                        },
                        points: {
                            show: true
                        }
                    }];

                var options = {
                    grid: {
                        hoverable: true
                    },
                    colors: ["#568A89", "#3276B1"],
                    tooltip: true,
                    tooltipOpts: {
                        //content : "Value <b>$x</b> Value <span>$y</span>",
                        defaultTheme: false
                    },
                    xaxis: {
                        ticks: [[1, "JAN"], [2, "FEB"], [3, "MAR"], [4, "APR"], [5, "MAY"], [6, "JUN"], [7, "JUL"], [8, "AUG"], [9, "SEP"], [10, "OCT"], [11, "NOV"], [12, "DEC"], [13, "JAN+1"]]
                    },
                    yaxes: {}
                };

                var plot3 = $.plot($("#statsChart"), data, options);
            });

            // END TAB 2

            // TAB THREE GRAPH //
            /* TAB 3: Revenew  */

            $(function () {

                var trgt = [[1354586000000, 153], [1364587000000, 658], [1374588000000, 198], [1384589000000, 663], [1394590000000, 801], [1404591000000, 1080], [1414592000000, 353], [1424593000000, 749], [1434594000000, 523], [1444595000000, 258], [1454596000000, 688], [1464597000000, 364]],
                    prft = [[1354586000000, 53], [1364587000000, 65], [1374588000000, 98], [1384589000000, 83], [1394590000000, 980], [1404591000000, 808], [1414592000000, 720], [1424593000000, 674], [1434594000000, 23], [1444595000000, 79], [1454596000000, 88], [1464597000000, 36]],
                    sgnups = [[1354586000000, 647], [1364587000000, 435], [1374588000000, 784], [1384589000000, 346], [1394590000000, 487], [1404591000000, 463], [1414592000000, 479], [1424593000000, 236], [1434594000000, 843], [1444595000000, 657], [1454596000000, 241], [1464597000000, 341]],
                    toggles = $("#rev-toggles"), target = $("#flotcontainer");

                var data = [{
                    label: "Target Profit",
                    data: trgt,
                    bars: {
                        show: true,
                        align: "center",
                        barWidth: 30 * 30 * 60 * 1000 * 80
                    }
                }, {
                    label: "Actual Profit",
                    data: prft,
                    color: '#3276B1',
                    lines: {
                        show: true,
                        lineWidth: 3
                    },
                    points: {
                        show: true
                    }
                }, {
                    label: "Actual Signups",
                    data: sgnups,
                    color: '#71843F',
                    lines: {
                        show: true,
                        lineWidth: 1
                    },
                    points: {
                        show: true
                    }
                }]

                var options = {
                    grid: {
                        hoverable: true
                    },
                    tooltip: true,
                    tooltipOpts: {
                        //content: '%x - %y',
                        //dateFormat: '%b %y',
                        defaultTheme: false
                    },
                    xaxis: {
                        mode: "time"
                    },
                    yaxes: {
                        tickFormatter: function (val, axis) {
                            return "$" + val;
                        },
                        max: 1200
                    }

                };

                plot2 = null;

                function plotNow() {
                    var d = [];
                    toggles.find(':checkbox').each(function () {
                        if ($(this).is(':checked')) {
                            d.push(data[$(this).attr("name").substr(4, 1)]);
                        }
                    });
                    if (d.length > 0) {
                        if (plot2) {
                            plot2.setData(d);
                            plot2.draw();
                        } else {
                            plot2 = $.plot(target, d, options);
                        }
                    }

                };

                toggles.find(':checkbox').on('change', function () {
                    plotNow();
                });
                plotNow()

            });

            /*
             * VECTOR MAP
             */

            data_array = {
                "US": 4977,
                "AU": 4873,
                "IN": 3671,
                "BR": 2476,
                "TR": 1476,
                "CN": 146,
                "CA": 134,
                "BD": 100
            };

            $('#vector-map').vectorMap({
                map: 'world_mill_en',
                backgroundColor: '#fff',
                regionStyle: {
                    initial: {
                        fill: '#c4c4c4'
                    },
                    hover: {
                        "fill-opacity": 1
                    }
                },
                series: {
                    regions: [{
                        values: data_array,
                        scale: ['#85a8b6', '#4d7686'],
                        normalizeFunction: 'polynomial'
                    }]
                },
                onRegionLabelShow: function (e, el, code) {
                    if (typeof data_array[code] == 'undefined') {
                        e.preventDefault();
                    } else {
                        var countrylbl = data_array[code];
                        el.html(el.html() + ': ' + countrylbl + ' visits');
                    }
                }
            });

            /*
             * FULL CALENDAR JS
             */

            if ($("#calendar").length) {
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();

                var calendar = $('#calendar').fullCalendar({

                    editable: true,
                    draggable: true,
                    selectable: false,
                    selectHelper: true,
                    unselectAuto: false,
                    disableResizing: false,
                    height: "auto",

                    header: {
                        left: 'title', //,today
                        center: 'prev, next, today',
                        right: 'month, agendaWeek, agenDay' //month, agendaDay,
                    },

                    select: function (start, end, allDay) {
                        var title = prompt('Event Title:');
                        if (title) {
                            calendar.fullCalendar('renderEvent', {
                                    title: title,
                                    start: start,
                                    end: end,
                                    allDay: allDay
                                }, true // make the event "stick"
                            );
                        }
                        calendar.fullCalendar('unselect');
                    },

                    events: [{
                        title: 'All Day Event',
                        start: new Date(y, m, 1),
                        description: 'long description',
                        className: ["event", "bg-color-greenLight"],
                        icon: 'fa-check'
                    }, {
                        title: 'Long Event',
                        start: new Date(y, m, d - 5),
                        end: new Date(y, m, d - 2),
                        className: ["event", "bg-color-red"],
                        icon: 'fa-lock'
                    }, {
                        id: 999,
                        title: 'Repeating Event',
                        start: new Date(y, m, d - 3, 16, 0),
                        allDay: false,
                        className: ["event", "bg-color-blue"],
                        icon: 'fa-clock-o'
                    }, {
                        id: 999,
                        title: 'Repeating Event',
                        start: new Date(y, m, d + 4, 16, 0),
                        allDay: false,
                        className: ["event", "bg-color-blue"],
                        icon: 'fa-clock-o'
                    }, {
                        title: 'Meeting',
                        start: new Date(y, m, d, 10, 30),
                        allDay: false,
                        className: ["event", "bg-color-darken"]
                    }, {
                        title: 'Lunch',
                        start: new Date(y, m, d, 12, 0),
                        end: new Date(y, m, d, 14, 0),
                        allDay: false,
                        className: ["event", "bg-color-darken"]
                    }, {
                        title: 'Birthday Party',
                        start: new Date(y, m, d + 1, 19, 0),
                        end: new Date(y, m, d + 1, 22, 30),
                        allDay: false,
                        className: ["event", "bg-color-darken"]
                    }, {
                        title: 'Smartadmin Open Day',
                        start: new Date(y, m, 28),
                        end: new Date(y, m, 29),
                        className: ["event", "bg-color-darken"]
                    }],


                    eventRender: function (event, element, icon) {
                        if (!event.description == "") {
                            element.find('.fc-title').append("<br/><span class='ultra-light'>" + event.description + "</span>");
                        }
                        if (!event.icon == "") {
                            element.find('.fc-title').append("<i class='air air-top-right fa " + event.icon + " '></i>");
                        }
                    }
                });

            }
            ;

            /* hide default buttons */
            $('.fc-toolbar .fc-right, .fc-toolbar .fc-center').hide();

            // calendar prev
            $('#calendar-buttons #btn-prev').click(function () {
                $('.fc-prev-button').click();
                return false;
            });

            // calendar next
            $('#calendar-buttons #btn-next').click(function () {
                $('.fc-next-button').click();
                return false;
            });

            // calendar today
            $('#calendar-buttons #btn-today').click(function () {
                $('.fc-button-today').click();
                return false;
            });

            // calendar month
            $('#mt').click(function () {
                $('#calendar').fullCalendar('changeView', 'month');
            });

            // calendar agenda week
            $('#ag').click(function () {
                $('#calendar').fullCalendar('changeView', 'agendaWeek');
            });

            // calendar agenda day
            $('#td').click(function () {
                $('#calendar').fullCalendar('changeView', 'agendaDay');
            });

            /*
             * CHAT
             */

            $.filter_input = $('#filter-chat-list');
            $.chat_users_container = $('#chat-container > .chat-list-body')
            $.chat_users = $('#chat-users')
            $.chat_list_btn = $('#chat-container > .chat-list-open-close');
            $.chat_body = $('#chat-body');

            /*
            * LIST FILTER (CHAT)
            */

            // custom css expression for a case-insensitive contains()
            jQuery.expr[':'].Contains = function (a, i, m) {
                return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
            };

            function listFilter(list) {// header is any element, list is an unordered list
                // create and add the filter form to the header

                $.filter_input.change(function () {
                    var filter = $(this).val();
                    if (filter) {
                        // this finds all links in a list that contain the input,
                        // and hide the ones not containing the input while showing the ones that do
                        $.chat_users.find("a:not(:Contains(" + filter + "))").parent().slideUp();
                        $.chat_users.find("a:Contains(" + filter + ")").parent().slideDown();
                    } else {
                        $.chat_users.find("li").slideDown();
                    }
                    return false;
                }).keyup(function () {
                    // fire the above change event after every letter
                    $(this).change();

                });

            }

            // on dom ready
            listFilter($.chat_users);

            // open chat list
            $.chat_list_btn.click(function () {
                $(this).parent('#chat-container').toggleClass('open');
            })

            $.chat_body.animate({
                scrollTop: $.chat_body[0].scrollHeight
            }, 500);

        });

    </script>

<?php
//include footer
include("inc/google-analytics.php");
?>