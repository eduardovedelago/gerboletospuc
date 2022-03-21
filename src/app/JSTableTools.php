<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 13/09/17
 * Time: 11:40
 */

?>
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
                            $strBtnIncluirAjax = \app\Html::loadButtonAjaxPlugin($_acessoIncluir, "", null, "showFormInsertModal()", null);//Title Add Junto Com CSS
                            $strBtnOpcoes = \app\Html::loadButtonsOpcoesAjaxPlugin($_acessoCopy, $_acessoPDF, $_acessoExcel, $_acessoPrinter);
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
        $("#ToolTables_datatable_cadastro_0").append('<span class="fa fa-plus"></span> <span>Incluir Novo</span>');
        $("#ToolTables_datatable_cadastro_0").removeClass().addClass("DTTT_button_collection btn btn-primary btn-sm dropdown-toggle pull-right btn-margim ");//DTTT_button
        $("#ToolTables_datatable_cadastro_1").removeClass().addClass("DTTT_button_collection btn btn-primary btn-sm dropdown-toggle pull-right btn-margim");//DTTT_button
        $("#ToolTables_datatable_cadastro_1").append('<span class="caret"></span>');
        $('.ColVis_Button').removeClass().addClass("ColVis_MasterButton btn btn-primary btn-sm dropdown-toggle pull-left btn-margim");
        $('.ColVis_MasterButton').append('<span class="caret"></span>');
        /* END TABLETOOLS */

    });

    function showFormInsertModal() {
        $('#form_cadastro')[0].reset();
        $("#action-form-cadastro").val("insert");
        $("#codigo-form-cadastro").val("0");
        form_func_execute_ShowModal("#modalCadastro");
    }

</script>