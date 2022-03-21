<?php //initilize the page
require_once("inc/init.php");
require_once("inc/config.ui.php");

include_once 'database.php';

use models\Especies;


$page_title = "Cadastro de Espécies";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["cadastros"]["sub"]["cadatro_especies"]["active"] = true;
include("inc/nav.php");
?>
    <!-- ==========================CONTENT STARTS HERE ========================== -->
    <!-- MAIN PANEL -->
    <div id="main" role="main">

        <?php
        //configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
        //$breadcrumbs["New Crumb"] => "http://url.com"
        $breadcrumbs["Tables"] = "";
        include("inc/ribbon.php");
        ?>

        <!-- MAIN CONTENT -->
        <div id="content">

            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                    <h1 class="page-title txt-color-blueDark">
                        <i class="fa fa-table fa-fw "></i>
                        Cadastros
                        <span>>
						Espécies
					</span>
                    </h1>
                </div>
                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
                    <ul id="sparks" class="">
                        <li class="sparks-info">
                            <h5> My Income <span class="txt-color-blue">$47,171</span></h5>
                            <div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
                                1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
                            </div>
                        </li>
                        <li class="sparks-info">
                            <h5> Site Traffic <span class="txt-color-purple"><i class="fa fa-arrow-circle-up"
                                                                                data-rel="bootstrap-tooltip"
                                                                                title="Increased"></i>&nbsp;45%</span>
                            </h5>
                            <div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm">
                                110,150,300,130,400,240,220,310,220,300, 270, 210
                            </div>
                        </li>
                        <li class="sparks-info">
                            <h5> Site Orders <span class="txt-color-greenDark"><i class="fa fa-shopping-cart"></i>&nbsp;2447</span>
                            </h5>
                            <div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm">
                                110,150,300,130,400,240,220,310,220,300, 270, 210
                            </div>
                        </li>
                    </ul>
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
                                <h2> Listagem de Espécies </h2>

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
                                    <table id="datatable_teste"
                                           class="table table-striped table-bordered table-hover" width="100%">

                                        <thead>

                                        <tr>
                                            <th class="hasinput" style="width:17%">
                                                <input type="text" class="form-control" placeholder="Filtrar Código"/>
                                            </th>

                                            <th class="hasinput" style="width:17%">
                                                <input type="text" class="form-control" placeholder="Filtrar Descricao"/>
                                            </th>

                                            <!--                                            Opções-->
                                            <th>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Código</th>
                                            <th data-class="expand">Descrição</th>
                                            <th>Opções</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        <?php
                                        try {
                                            $classPHPName = 'form-cad-especies';
                                            $entRep = $entityManager->getRepository("models\Especies");
                                            $listUsuarios = $entRep->findAll();
                                            foreach ($listUsuarios as $especies) {
                                                echo "<tr>";
                                                echo "<td>" . $especies->getCodigo() . "</td>";
                                                echo "<td>" . $especies->getDescricao() . "</td>";
                                                echo "<td>" .
                                                    "<a href=\"javascript:void(0);\" class=\"btn btn-xs btn-default pull-left\" data-action=\"msgConfirmar\" data-msgConfirmar-msg=\"Confirma Exclusão?\" ><i class=\"glyphicon glyphicon-trash\"></i></a> " .
                                                    "<a href=\"javascript:void(0);\" class=\"btn btn-xs btn-default pull-left\"><i class=\"glyphicon glyphicon-adjust\"></i></a> " .
                                                    '<a href="\form-cad-especies.php" class="btn btn-default btn-xs" data-action="msgConfirmar" data-msgConfirmar-msg="Confirma Exclusão?" data-onclick="crud_DeleteExecute(' . $especies->getCodigo() .
                                                    trim(',\'') . $classPHPName .
                                                    '\')" class="btn btn-xs btn-default pull-center"><i class="glyphicon glyphicon-trash"></i></a> ' .
//                                                    '<a href="login.html" class="btn btn-default btn-xs" data-action="userLogout" data-logout-msg="Your message here..."> action </a>'.
                                                    "</td>";
                                                echo "</tr>";
                                            }
                                        } catch (Exception $exception) {
                                            echo "<div class=\"alert alert-danger no-margin fade in\">" .
                                                "<button class=\"close\" data-dismiss=\"alert\">×</button>" .
                                                "<i class=\"fa-fw fa fa-exclamation-circle\"></i>" .
                                                "Falha ao Carregar dados: " .
                                                $page_title .
                                                "<br>" .
                                                $exception->getMessage() .
                                                "</div>";
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


        </div>
        <!-- END MAIN CONTENT -->

    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Terms & Conditions</h4>
                </div>
                <div class="modal-body custom-scroll terms-body">

                    <div id="left">



                        <h1>SMARTADMIN TERMS & CONDITIONS TEMPLATE</h1>



                        <h2>Cadastro de Usuários</h2>

                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
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
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Smart Tooltips (left) </h2>

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

                                    <form class="smart-form">
                                        <header>
                                            Tooltips (with icon)
                                        </header>

                                        <fieldset>
                                            <section>
                                                <label class="label">Text input with top-right tooltip</label>
                                                <label class="input"> <i class="icon-append fa fa-question-circle"></i>
                                                    <input type="text" placeholder="Focus to view the tooltip">
                                                    <b class="tooltip tooltip-top-right">
                                                        <i class="fa fa-warning txt-color-teal"></i>
                                                        Some helpful information</b>
                                                </label>
                                            </section>

                                            <section>
                                                <label class="label">Text input with bottom-right tooltip</label>
                                                <label class="input"> <i class="icon-append fa fa-question-circle"></i>
                                                    <input type="text" placeholder="Focus to view the tooltip">
                                                    <b class="tooltip tooltip-bottom-right">
                                                        <i class="fa fa-warning txt-color-teal"></i>
                                                        Some helpful information</b>
                                                </label>
                                            </section>

                                            <section>
                                                <label class="label">Text input with right tooltip</label>
                                                <label class="input"> <i class="icon-append fa fa-question-circle"></i>
                                                    <input type="text" placeholder="Focus to view the tooltip">
                                                    <b class="tooltip tooltip-right">
                                                        <i class="fa fa-warning txt-color-teal"></i>
                                                        Some helpful information</b>
                                                </label>
                                            </section>

                                        </fieldset>

                                        <fieldset>
                                            <section>
                                                <label class="label">Textarea with top-right tooltip</label>
                                                <label class="textarea"> <i class="icon-append fa fa-question-circle"></i>
                                                    <textarea rows="3" placeholder="Focus to view the tooltip"></textarea>
                                                    <b class="tooltip tooltip-top-right">
                                                        <i class="fa fa-warning txt-color-teal"></i>
                                                        Some helpful information </b>
                                                </label>
                                            </section>

                                            <section>
                                                <label class="label">Textarea with bottom-right tooltip</label>
                                                <label class="textarea"> <i class="icon-append fa fa-question-circle"></i>
                                                    <textarea rows="3" placeholder="Focus to view the tooltip"></textarea>
                                                    <b class="tooltip tooltip-bottom-right"><i class="fa fa-warning txt-color-teal"></i> Some helpful information</b>
                                                </label>
                                            </section>

                                            <section>
                                                <label class="label">Textarea with right tooltip</label>
                                                <label class="textarea"> <i class="icon-append fa fa-question-circle"></i>
                                                    <textarea rows="3" placeholder="Focus to view the tooltip"></textarea>
                                                    <b class="tooltip tooltip-right"><i class="fa fa-warning txt-color-teal"></i> Some helpful information</b>
                                                </label>
                                            </section>

                                        </fieldset>

                                    </form>

                                </div>
                                <!-- end widget content -->

                            </div>
                            <!-- end widget div -->

                        </div>
                        <!-- end widget -->


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-primary" id="i-agree">
                        <i class="fa fa-check"></i> I Agree
                    </button>

                    <button type="button" class="btn btn-danger pull-left" id="print">
                        <i class="fa fa-print"></i> Print
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

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

    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.colVis.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.tableTools.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

    <script type="text/javascript">


        // DO NOT REMOVE : GLOBAL FUNCTIONS!

        $(document).ready(function () {

            /* // DOM Position key index //

            l - Length changing (dropdown)
            f - Filtering input (search)
            t - The Table! (datatable)
            i - Information (records)
            p - Pagination (paging)
            r - pRocessing
            < and > - div elements
            <"#id" and > - div with an id
            <"class" and > - div with a class
            <"#id.class" and > - div with an id and class

            Also see: http://legacy.datatables.net/usage/features
            */

            /* BASIC ;*/
            var responsiveHelper_dt_basic = undefined;
            var responsiveHelper_datatable_fixed_column = undefined;
            var responsiveHelper_datatable_col_reorder = undefined;
            var responsiveHelper_datatable_tabletools = undefined;
            var responsiveHelper_datatable_teste = undefined;

            var breakpointDefinition = {
                tablet: 1024,
                phone: 480
            };

            $('#dt_basic').dataTable({
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-12 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth": true,
                "preDrawCallback": function () {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_dt_basic) {
                        responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
                    }
                },
                "rowCallback": function (nRow) {
                    responsiveHelper_dt_basic.createExpandIcon(nRow);
                },
                "drawCallback": function (oSettings) {
                    responsiveHelper_dt_basic.respond();
                }
            });



            /* TABLETOOLS */
            $('#datatable_tabletools').dataTable({

                // Tabletools options:
                //   https://datatables.net/extensions/tabletools/button_options
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
                "oTableTools":
                    {
                        "aButtons":
                            [
//
//                                    "copy",
//                                    "csv",
//                                    "xls",
                            {
                                "sExtends": "pdf",
                                "sTitle": "SmartAdmin_PDF",
                                "sText": '<i class="fa fa-files-o"></i>',
                                "sPdfMessage": "SmartAdmin PDF Export",
                                "sPdfSize": "letter"
                            }
                            //},
//                                    {
//                                        "sExtends": "print",
//                                        "sMessage": "Generated by SmartAdmin <i>(press Esc to close)</i>"
//                                    },
                        ]
                        ,
                        "sSwfPath":
                            "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
                    }
                ,
                "autoWidth":
                    true,
                "preDrawCallback":

                    function () {
                        // Initialize the responsive datatables helper once.
                        if (!responsiveHelper_datatable_tabletools) {
                            responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#datatable_tabletools'), breakpointDefinition);
                        }
                    }

                ,
                "rowCallback":

                    function (nRow) {
                        responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
                    }

                ,
                "drawCallback":

                    function (oSettings) {
                        responsiveHelper_datatable_tabletools.respond();
                    }
            });

            /* END TABLETOOLS */


            /* TABLETOOLS */
            $('#datatable_teste').dataTable({

                // Tabletools options:
                //   https://datatables.net/extensions/tabletools/button_options
                "bJQueryUI": true,
                "bProcessing": true,
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'TC>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
                "oTableTools":
                    {
                        "aButtons":
                            [
                                {
                                    "sExtends": "ajax",
                                    "sButtonText": "Incluir Novo",
                                    "sAjaxUrl": "",
                                    "fnClick": function (nButton, oConfig) {
                                        $("#myModal").modal('toggle');
                                    },
                                    "fnAjaxComplete": function (XMLHttpRequest, textStatus) {
                                        //$("#dl_frame").attr('src', 'downloadFile.php?file=' + XMLHttpRequest.exportFile);
                                    }
                                },
                                {

                                    "sExtends": "collection",
                                    "sButtonText": "Opções",
                                    "aButtons": [
                                        {
                                            "sExtends": "pdf",
                                            "sTitle": "DevSoft",
                                            "sButtonClass": "btn btn-primary pull-left",
                                            "sButtonText": "  Gerar PDF  ",
                                            "sPdfMessage": "SmartAdmin PDF Export",
                                            "sPdfSize": "letter"
                                        },
                                        {
                                            "sExtends": "copy",
                                            "sTitle": "SmartAdmin",
                                            "sButtonClass": "btn btn-primary pull-left",
                                            "sButtonText": "  Copiar (Ctrl+C)  ",
                                            "fnComplete": function (a, b, c, d) {
                                                var e = d.split("\n").length;
                                                b.bHeader && e--, null !== this.s.dt.nTFoot && b.bFooter && e--;
                                                var f = 1 == e ? "" : "s";
                                                this.fnInfo("<h6>Dados Copiados com Sucesso</h6><p>Copiado " + e + " registro" + f + " Para sua Área de Transferencia</p>", 1500);
                                            }
                                        },
                                        {
                                            "sExtends": "csv",
                                            "sTitle": "SmartAdmin_PDF",
                                            "sButtonClass": "btn btn-primary pull-left",
                                            "sButtonText": "Gerar Excell",
                                            "sPdfMessage": "SmartAdmin PDF Export",
                                            "sPdfSize": "letter"
                                        },
                                        {
                                            "sExtends": "xls",
                                            "sTitle": "SmartAdmin_PDF",
                                            "sButtonClass": "btn btn-primary pull-left",
                                            "sButtonText": "Gerar Excell (xls)",
                                            "sPdfMessage": "SmartAdmin PDF Export",
                                            "sPdfSize": "letter"
                                        },
                                        {
                                            "sExtends": "print",
                                            "sInfo": "<h6>Visualizar Impressão</h6><p>Utilize o Browser para efetuar a impressão dos dados. Precione ESC para Retornar</p>",
                                            "sMessage": "SmartAdmin",
                                            "sButtonClass": "btn btn-primary pull-left",
                                            "sButtonText": "Imprimir"
                                        }
                                    ]
                                }
                            ]
                        ,
                        "sSwfPath":
                            "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
                    }
                ,
                "autoWidth":
                    true,
                "preDrawCallback":

                    function () {
                        // Initialize the responsive datatables helper once.
                        if (!responsiveHelper_datatable_teste) {
                            responsiveHelper_datatable_teste = new ResponsiveDatatablesHelper($('#datatable_teste'), breakpointDefinition);
                        }
                    }

                ,
                "rowCallback":

                    function (nRow) {
                        responsiveHelper_datatable_teste.createExpandIcon(nRow);
                    }

                ,
                "drawCallback":

                    function (oSettings) {
                        responsiveHelper_datatable_teste.respond();
                    }
            });

            //Correção CSS Stilo dos botoes do Grid - Cuidado ao Modificar ordem faz diferença
            $(".DTTT_container").removeClass().addClass("btn-group pull-right");
            $("#ToolTables_datatable_teste_0").removeClass().addClass("DTTT_button_collection btn btn-primary btn-sm dropdown-toggle pull-right btn-margim  fa-plus");//DTTT_button
            $("#ToolTables_datatable_teste_1").removeClass().addClass("DTTT_button_collection btn btn-primary btn-sm dropdown-toggle pull-right btn-margim");//DTTT_button
            $("#ToolTables_datatable_teste_1").append('<span class="caret"></span>');
            $('.ColVis_Button').removeClass().addClass("ColVis_MasterButton btn btn-primary btn-sm dropdown-toggle pull-left btn-margim");
            $('.ColVis_MasterButton').append('<span class="caret"></span>');
            /* END TABLETOOLS */

        })

    </script>

<?php
//include footer
include("inc/google-analytics.php");
?>