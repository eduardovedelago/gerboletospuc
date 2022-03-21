<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 06/09/17
 * Time: 23:39
 */

namespace app;


class Html
{


    public static function loadButtonTagA($acesso, $name, $id, $data, $msgSpanInfo, $icon, $css, $customProperties = "")
    {
        if (Html::validateAcesso($acesso)) {
            $strName = $name != null ? ' name="' . $name . '" ' : " ";
            $strID = $id != null ? ' id="' . $id . '" ' : " ";
            $strData = $data != null ? ' data="' . $data . '" ' : " ";
            $strCSS = $css != null ? ' class="' . $css . '" ' : ' class="btn btn-xs btn-default margin-right-5 pull-right" ';
            $strIcon = $icon != null ? ' <i class="' . $icon . '"></i> ' : " ";
            $strSpanInfo = null;
            if ($msgSpanInfo != null) {
                $strSpanInfo = '<span rel="tooltip"' .
                    'data-original-title="<i class=\'text-info fa fa-info-circle\'></i> Info: ' . $msgSpanInfo . '"' .
                    'data-html="true">' .
                    $strIcon .
                    '</span>';
            }
            $result = '<a ' . $strName . $strData . $strID . $strCSS . $customProperties . ' >';
            if ($strSpanInfo != null) {
                $result = $result . $strSpanInfo;
            } else {
                $result = $result . $strIcon;
            }
            $result = $result . '</a>';
            return $result;
        } else {
            return "";
        }
    }

    public static function loadMenu($acesso, $keyMenu, $title, $icon, $url)
    {

    }

    public static function loadButtonAjaxPlugin($acesso, $title, $ajaxURL, $functionJS, $fnAjaxComplete)
    {
        if (Html::validateAcesso($acesso)) {
            $ajaxURL = $ajaxURL == null ? '""' : $ajaxURL;
            $fnAjaxComplete = $fnAjaxComplete == null ? ' ' : $fnAjaxComplete;
            $result = '{' .
                '       "sExtends": "ajax",' .
                '       "sButtonText": "' . $title . '",' .
                '       "sAjaxUrl": ' . $ajaxURL . ',' .
                '       "fnClick": function (nButton, oConfig) {' .
                '          ' . $functionJS . ';' .
                '        },' .
                '       "fnAjaxComplete": function (XMLHttpRequest, textStatus) {' .
                '           ' . $fnAjaxComplete .
                '        }' .
                '      }';
            return $result;
        } else {
            return "";
        }
    }

    public static function loadButtonsOpcoesAjaxPlugin($acessoPDF, $acessoCopy, $acessoExcell, $acessoImpressao)
    {
        $result = "";
        if ($acessoPDF != null || $acessoCopy != null || $acessoExcell != null || $acessoImpressao != null) {
            $begin = '{
                        "sExtends": "collection",
                        "sButtonText": "Opções",
                        "aButtons": [';
            if (Html::validateAcesso($acessoPDF)) {
                $button = '{
                                "sExtends": "pdf",
                                "sTitle": "DevSoft",
                                "sButtonClass": "btn btn-primary pull-left",
                                "sButtonText": "  Gerar PDF  ",
                                "sPdfMessage": "SmartAdmin PDF Export",
                                "sPdfSize": "letter"
                            }';
                $result = $result . "\n\r" . ($result == "" ? $button : ',' . $button);
            }
            if (Html::validateAcesso($acessoCopy)) {
                $button = '{
                                "sExtends": "copy",
                                "sTitle": "SmartAdmin",
                                "sButtonClass": "btn btn-primary pull-left",
                                "sButtonText": "  Copiar Dados",
                                "fnComplete": function (a, b, c, d) {
                                      var e = d.split("\n").length;
                                      b.bHeader && e--, null !== this.s.dt.nTFoot && b.bFooter && e--;
                                      var f = 1 == e ? "" : "s";
                                      this.fnInfo("<h6>Dados Copiados com Sucesso</h6><p>Copiado " + e + " registro" + f + " Para sua Área de Transferencia</p>", 1500);
                                }
                            }';
                $result = $result . "\n\r" . ($result == "" ? $button : ',' . $button);
            }
            if (Html::validateAcesso($acessoExcell)) {
                $button = '{
                                "sExtends": "xls",
                                "sTitle": "SmartAdmin_PDF",
                                "sButtonClass": "btn btn-primary pull-left",
                                "sButtonText": "Gerar Excell (xls)",                           
                                "sPdfSize": "letter"
                            }';
                $result = $result . "\n\r" . ($result == "" ? $button : ',' . $button);
            }
            if (Html::validateAcesso($acessoImpressao)) {
                $button = '{
                                "sExtends": "print",
                                "sInfo": "<h6>Visualizar Impressão</h6><p>Utilize o Browser para efetuar a impressão dos dados. Precione ESC para Retornar</p>",
                                "sMessage": "SmartAdmin",
                                "sButtonClass": "btn btn-primary pull-left",
                                "sButtonText": "Imprimir"
                            }';
                $result = $result . "\n\r" . ($result == "" ? $button : ',' . $button);
            }
            $end = ']
                 }';
        }
        if ($result != "") {
            return $begin . $result . $end;
        } else {
            return "";
        }
    }

    public static function createEditSelectSimple($nameEdit, $idEdit, $label, $listItens, $addIdText = true, $firstOption = null)
    {
        $result = "";
        if ($label != null) {
            $result =  $result .' <label class="label" > ' . $label . '</label > ';
        }
        $result = $result .'<label class="select" >';
        $result = $result .'<select class="chosen" id="' . $idEdit . '" name="' . $nameEdit .'">' ;
        if ($firstOption!=null) {
            $result = $result . '<option value=""> ' . $firstOption . ' </option>';
        }
        foreach ($listItens as $option) {
            if ($addIdText){
            $result = $result .'<option value="'.$option[0].'"> '. $option[0].' - '.$option[1].' </option>';
            } else {
                $result = $result .'<option value="'.$option[0].'"> '.$option[1].' </option>';
            }
        }
        $result = $result . '</select>';
        $result = $result . ' <i></i > </label>';
        return $result;
    }

    public static function createEditSelect($nameEdit, $idEdit, $label, $type, $icon, $placeholder, $addKeyInText, $values, $disableEditIfNullValues = true)
    {
        if ($values != null && sizeof($values) > 0) {
            $class_DL = 'dlSelectClass_' . $nameEdit;
            $id_A = 'aSelect' . $nameEdit;
            $id_UL = 'uSelect' . $nameEdit;
            $id_btn = 'bSelect' . $nameEdit;

            $result = '
            <dl class="' . $class_DL . '">
                <dt>
                    <a id="' . $id_A . '" href="#">';
            $result = $result . self::createEdit($nameEdit, $idEdit, $label, $type, $icon, $placeholder);
            $result = $result .
                '   </a>
                </dt>

                <dd>
                    <div class="mutliSelect">
                        <ul class="conteudoMultiSelect"
                            id="' . $id_UL . '">';
            foreach ($values as $value) {
                $result = $result .
                    '<li >
                    <input type = "checkbox" data = "' . $value[0] . '" /> ';
                if ($addKeyInText) {
                    $result = $result . $value[0] . ' - ' . $value[1];
                } else {
                    $result = $result . $value[1];
                }
                $result = $result .
                    '</li >';
            }
            $result = $result .
                '               <li>
                                <button id="' . $id_btn . '" type="button" class="btn btn-primary btn-success pull-right">
                                    <i class="fa fa-check"></i> Confirmar
                                </button>
                            </li>
                        </ul>
                    </div>
                </dd>
            </dl>
        ';
            $result = $result .
                '
            <script>
                $("#' . $id_A . '").on(\'click\', function () {
                    $("#' . $id_UL . '").slideToggle(\'fast\');
                    setaCheckedListByData(\'' . $idEdit . '\', \'' . $id_UL . '\');                    
                });
            
                $("#' . $id_btn . '").on(\'click\', function () {
                    closeListSelects(\'' . $id_UL . '\');
                    setaDadosSelectedsToEdit(\'' . $idEdit . '\', \'' . $id_UL . '\');
                });
            
                $(document).bind(\'click\', function (e) {
                    var $clicked = $(e.target);
                    if (!$clicked.parents().hasClass("' . $class_DL . '")) {
                        closeListSelects(\'' . $id_UL . '\');                        
                    }
                });
            
                $(\'.' . $class_DL . ' input[type="checkbox"]\').on(\'click\', function () {
                    setaDadosSelectedsToEdit(\'' . $idEdit . '\', \'' . $id_UL . '\');
                });
                
                function setaDadosSelectedsToEdit(editID, ulSelectID) {
                    var dadosEd = "";
                    var check = $(\'#\' + ulSelectID).find(\'input[type="checkbox"]:checked\');
                    if (check.length > 0) {
                        check.each(function () {
                            if (dadosEd != "") {
                                dadosEd = dadosEd + \';\';
                            }
                            dadosEd = dadosEd + $(this).attr(\'data\');
                        });
                    } else {
                        dadosEd = check.attr(\'data\')
                    }
            
                    $(\'#\' + editID).val(dadosEd);
                }
            
                function closeListSelects(ulSelectID){
                    $(\'#\'+ulSelectID).hide();
                }
                
                function setaCheckedListByData(editID, ulSelectID) {
                    var check = $(\'#\' + ulSelectID).find(\'input[type="checkbox"]:checked\');
                    var dadosEd = $(\'#\' + editID).val();
                    if (check.length <= 0) {
                        check = $(\'#\' + ulSelectID).find(\'input[type="checkbox"]\');
                        if (check.length > 0) {
                            check.each(function () {
                                var data = $(this).attr(\'data\');
                                if ((dadosEd + \';\').indexOf((data + \';\')) >= 0) {
                                    $(this).prop("checked", true);
                                }
                            });
                        }
                    }
                }
            </script>
            
            ';
        } else {
            if ($disableEditIfNullValues) {
                $result = self::createEdit($nameEdit, $idEdit, $label, $type, $icon, $placeholder, false);
            } else {
                $result = self::createEdit($nameEdit, $idEdit, $label, $type, $icon, $placeholder, true);
            }
        }
        return $result;
    }

    public static function createEdit($nameEdit, $idEdit, $label, $type, $icon, $placeholder, $enabledEdit = true, $maskEdit = "", $iconAppend_Prepend= "append")
    {
        $required = '';
        if ($type!=null && strpos($type,'*') !== false){
            $type = str_replace('*','',$type);
            $required = ' required ';
        }

        $dadosMaskEdit = '';
        if ($maskEdit!=""){
            $dadosMaskEdit = ' data-mask="'.$maskEdit.'" data-mask-placeholder= "_"';
        }
        $result = '';
        if ($label != null){
            $result = $result . '  <label class="label">' . $label . '</label>';
        }
        $result = $result . '                            
                <label class="input" name="lbl_'.$nameEdit.'">
                    <i class="icon-'.$iconAppend_Prepend.' fa ' . $icon . '"></i>
                    <input id="' . $idEdit . '" name="' . $nameEdit . '" type="' . $type . '" placeholder="' . $placeholder . '"' . ($enabledEdit == false ? 'disabled' : '') . $dadosMaskEdit.$required.'>                     
                </label>';
        return $result;
    }

    public static function validateAcesso($codigoAcesso)
    {
        if (\ctrl\UserCtrl::validateAcessAuthorizedByPos($codigoAcesso)) {
            return true;
        } else {
            return false;
        }
    }

}