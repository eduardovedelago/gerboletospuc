<?php

//CONFIGURATION for SmartAdmin UI

//ribbon breadcrumbs config
//array("Display Name" => "URL");
$breadcrumbs = array(
    "Home" => APP_URL
);


// #####################################################
// ####[alteracao] - Criar Variáveis que controlão
//                   os acessos de Usuários
//                   e Usalas nos Menus
// #####################################################
include_once("controller/UserCtrl.php");
$_userAcess_Cadastro = \ctrl\UserCtrl::validateAcessAuthorizedByPos(\ctrl\AccessUserCtrl::$Acess_Cadastro);
$_userAcess_Cadastro_Grupos = \ctrl\UserCtrl::validateAcessAuthorizedByPos(\ctrl\AccessUserCtrl::$Acess_Cadastro_Grupos);
$_userAcess_Cadastro_Municipios = \ctrl\UserCtrl::validateAcessAuthorizedByPos(\ctrl\AccessUserCtrl::$Acess_Cadastro_Municipios);
$_userAcess_Cadastro_Empresas = \ctrl\UserCtrl::validateAcessAuthorizedByPos(\ctrl\AccessUserCtrl::$Acess_Cadastro_Empresas);
$_userAcess_Cadastro_Usuarios = \ctrl\UserCtrl::validateAcessAuthorizedByPos(\ctrl\AccessUserCtrl::$Acess_Cadastro_Usuarios);
$_userAcess_Cadastro_Clientes = \ctrl\UserCtrl::validateAcessAuthorizedByPos(\ctrl\AccessUserCtrl::$Acess_Cadastro_Clientes);
$_userAcess_Cadastro_ProdServ = \ctrl\UserCtrl::validateAcessAuthorizedByPos(\ctrl\AccessUserCtrl::$Acess_Cadastro_ProdServ);

$_userAcess_Lctos = \ctrl\UserCtrl::validateAcessAuthorizedByPos(\ctrl\AccessUserCtrl::$Acess_Lctos);
$_userAcess_Lctos_Blt = \ctrl\UserCtrl::validateAcessAuthorizedByPos(\ctrl\AccessUserCtrl::$Acess_Lctos_Blt);
$_userAcess_Lctos_Cheq = \ctrl\UserCtrl::validateAcessAuthorizedByPos(\ctrl\AccessUserCtrl::$Acess_Lctos_Cheq);
$_userAcess_Lctos_Dupl = \ctrl\UserCtrl::validateAcessAuthorizedByPos(\ctrl\AccessUserCtrl::$Acess_Lctos_Dupl);
$_userAcess_Lctos_Fat = \ctrl\UserCtrl::validateAcessAuthorizedByPos(\ctrl\AccessUserCtrl::$Acess_Lctos_Fat);
$_userAcess_Lctos_Antecip = \ctrl\UserCtrl::validateAcessAuthorizedByPos(\ctrl\AccessUserCtrl::$Acess_Lctos_Antecip);

$_userAcess_Rel_PendFin = \ctrl\UserCtrl::validateAcessAuthorizedByPos(\ctrl\AccessUserCtrl::$Acess_Rel_PendFin);
$_userAcess_Rel_IuguLogs = \ctrl\UserCtrl::validateAcessAuthorizedByPos(\ctrl\AccessUserCtrl::$Acess_Rel_IuguLogs);

$_userAcess_Cadastro_Financeiro = \ctrl\UserCtrl::validateAcessAuthorizedByPos(200);
$_userAcess_Cadastro_Financeiro_Fpgto = \ctrl\UserCtrl::validateAcessAuthorizedByPos(210);
$_userAcess_Cadastro_Financeiro_Lpgto = \ctrl\UserCtrl::validateAcessAuthorizedByPos(220);
$_userAcess_Cadastro_Financeiro_Portador = \ctrl\UserCtrl::validateAcessAuthorizedByPos(230);
$_userAcess_Cadastro_Contabilidade = \ctrl\UserCtrl::validateAcessAuthorizedByPos(400);
$_userAcess_Cadastro_Contabilidade_PlanoGer = \ctrl\UserCtrl::validateAcessAuthorizedByPos(410);
$_userAcess_Cadastro_Contabilidade_PlanoCon = \ctrl\UserCtrl::validateAcessAuthorizedByPos(420);

$_userAcess_IntegracaoBancaria = \ctrl\UserCtrl::validateAcessAuthorizedByPos(\ctrl\AccessUserCtrl::$Acess_IntegracaoBancaria);
$_userAcess_IntegracaoBancaria_SIC = \ctrl\UserCtrl::validateAcessAuthorizedByPos(\ctrl\AccessUserCtrl::$Acess_IntegracaoBancaria);

$_userAcess_Proc = \ctrl\UserCtrl::validateAcessAuthorizedByPos(\ctrl\AccessUserCtrl::$Acess_Proc);
$_userAcess_Proc_CancelBlt = \ctrl\UserCtrl::validateAcessAuthorizedByPos(\ctrl\AccessUserCtrl::$Acess_Proc_CancelBlt);
$_userAcess_Proc_BaixarBlt = \ctrl\UserCtrl::validateAcessAuthorizedByPos(\ctrl\AccessUserCtrl::$Acess_Proc_BaixarBlt);

$_userAcess_ConfGer = \ctrl\UserCtrl::validateAcessAuthorizedByPos(\ctrl\AccessUserCtrl::$Acess_ConfGer);

$page_nav = array(

    // #####################################################
    // ####[alteracao]    -    Inicio Menus do Sistema
    // #####################################################

    "dashboard" => array(
        "title" => "Home",
        "icon" => "fa-home",
        "url" => APP_URL
//        "sub" => array(
//            "analytics" => array(
//                "title" => "Dashboard",
//                "icon" => "fa-dashboard",
//                "url" => APP_URL
//            )
//        )
    ),
    "cadastros" => array(
        "title" => "Cadastros",
        "icon" => "fa-list-alt",
        'active' => false,
        'userAcess' => $_userAcess_Cadastro,
        "sub" => array(
            "cadastro_grupos" => array(
                'title' => 'Grupos',
                'icon' => ' fa-group',
                'active' => false,
                'userAcess' => $_userAcess_Cadastro_Grupos,
                "url" => APP_URL . "/form-cad-grupos.php"
            ),
            "cadastro_usuarios" => array(
                'title' => 'Usuários',
                'icon' => 'fa-user',
                'active' => false,
                'userAcess' => $_userAcess_Cadastro_Usuarios,
                "url" => APP_URL . "/form-cad-usuarios.php"
            ),
            "cadastro_municipios" => array(
                'title' => 'Municípios',
                'icon' => 'fa-building',
                'active' => false,
                'userAcess' => $_userAcess_Cadastro_Municipios,
                "url" => APP_URL . "/form-cad-municipios.php"
            ),
            "cadastro_empresas" => array(
                'title' => 'Empresas',
                'icon' => 'fa-building',
                'active' => false,
                'userAcess' => $_userAcess_Cadastro_Empresas,
                "url" => APP_URL . "/form-cad-empresas.php"
            ),
            "cadastro_clientes" => array(
                'title' => 'Clientes',
                'icon' => 'fa-child',
                'active' => false,
                'userAcess' => $_userAcess_Cadastro_Clientes,
                "url" => APP_URL . "/form-cad-cliente.php"
            ),
            "cadastro_prodserv" => array(
                'title' => 'Produtos/Serv',
                'icon' => 'fa-stack-overflow',
                'active' => false,
                'userAcess' => $_userAcess_Cadastro_ProdServ,
                "url" => APP_URL . "/form-cad-prodserv.php"
            ),
            "financeiro" => array(
                'title' => 'Financeiro',
                'icon' => 'fa-money',
                'active' => false,
                'userAcess' => $_userAcess_Cadastro_Financeiro,
                "sub" => array(
                    "cadastro_fpgto" => array(
                        'title' => 'Formas de Pagamento',
                        'icon' => 'fa-credit-card',
                        'active' => false,
                        'userAcess' => $_userAcess_Cadastro_Financeiro_Fpgto,
                        "url" => APP_URL . "/form-cad-fpgto.php"
                    ),
                    "cadastro_lpgto" => array(
                        'title' => 'Locais de Pagamento',
                        'icon' => 'fa-bank',
                        'active' => false,
                        'userAcess' => $_userAcess_Cadastro_Financeiro_Lpgto,
                        "url" => APP_URL . "/form-cad-lpgto.php"
                    ),
                    "cadastro_portador" => array(
                        'title' => 'Portadores',
                        'icon' => 'fa-user',
                        'active' => false,
                        'userAcess' => $_userAcess_Cadastro_Financeiro_Portador,
                        "url" => APP_URL . "/form-cad-portador.php"
                    )
                )
            ),
            "contabilidade" => array(
                'title' => 'Contabilidade',
                'icon' => 'fa-money',
                'active' => false,
                'userAcess' => $_userAcess_Cadastro_Contabilidade,
                "sub" => array(
                    "cadastro_planoger" => array(
                        'title' => 'Plano Gerencial',
                        'icon' => 'fa-credit-card',
                        'active' => false,
                        'userAcess' => $_userAcess_Cadastro_Contabilidade_PlanoGer,
                        "url" => APP_URL . "/form-cad-planoger.php"
                    ),
                    "cadastro_planocon" => array(
                        'title' => 'Plano Contábil',
                        'icon' => 'fa-credit-card',
                        'active' => false,
                        'userAcess' => $_userAcess_Cadastro_Contabilidade_PlanoCon,
                        "url" => APP_URL . "/form-cad-planocon.php"
                    )
                )
            )
        )
    ),
    "financeiro" => array(
        "title" => "Mvto. Financeiro",
        "icon" => "fa-fire",
        'userAcess' => $_userAcess_Lctos,
        "sub" => array(
            "lctos_pendfin_bl" => array(
                'title' => 'Incluir Boleto',
                'icon' => 'fa-money',
                'active' => false,
                'userAcess' => $_userAcess_Lctos_Blt,
                "url" => APP_URL . "/form-lcto-pendfin.php?tpLcto=1"
            ),
            "lctos_pendfin_ch" => array(
                'title' => 'Incluir Cheque',
                'icon' => 'fa-money',
                'active' => false,
                'userAcess' => $_userAcess_Lctos_Cheq,
                "url" => APP_URL . "/form-lcto-pendfin.php?tpLcto=2"
            ),
            "lctos_pendfin_du" => array(
                'title' => 'Incluir Duplicata',
                'icon' => 'fa-money',
                'active' => false,
                'userAcess' => $_userAcess_Lctos_Dupl,
                "url" => APP_URL . "/form-lcto-pendfin.php?tpLcto=3"
            ),
            "lctos_pendfin_fa" => array(
                'title' => 'Incluir Fatura',
                'icon' => 'fa-money',
                'active' => false,
                'userAcess' => $_userAcess_Lctos_Fat,
                "url" => APP_URL . "/form-lcto-pendfin-fatura.php"
            ),                        
        )
    ),
    "relatorios" => array(
        "title" => "Relatórios",
        "icon" => "fa-list",
        'active' => false,
        'userAcess' => $_userAcess_Rel_PendFin,
        "sub" => array(
            "rel_pendfin" => array(
                'title' => 'Financeiro',
                'icon' => ' fa-dollar',
                'active' => false,
                'userAcess' => $_userAcess_Rel_PendFin,
                "completTagA" => 'name="menu_rel_fin" id="menu_rel_fin" data-toggle="modal"',
                "url" => "#modalRelPendFin"
            )            
        )
    ),
    "intbco" => array(
        "title" => "Integração Bancária",
        "icon" => "fa-bank",
        'active' => false,
        'userAcess' => $_userAcess_IntegracaoBancaria,
        "sub" => array(
            "intbco_sicredi" => array(
                'title' => 'Sicredi',
                'icon' => ' fa-file-text-o',
                'active' => false,
                'userAcess' => $_userAcess_IntegracaoBancaria_SIC,
                "url" => APP_URL . "/controller/exp-intbco-sicredi-ctrl.php"
            )
        )
    ),
    "procedimentos" => array(
        'title' => 'Procedimentos',
        'icon' => 'fa-cogs',
        'active' => false,
        'userAcess' => $_userAcess_Proc,
        "sub" => array(
            "proc_canc_blt" => array(
                'title' => 'Cancelar Boleto',
                'icon' => 'fa-recycle',
                'active' => false,
                'userAcess' => $_userAcess_Proc_CancelBlt,
                "url" => APP_URL . "/form-proc-cancel-blt.php"
            ),
            
        )
    ),
    "configuracao" => array(
        "title" => "Configuração",
        "icon" => "fa-sliders",
        'active' => false,
        'userAcess' => $_userAcess_ConfGer,
        "url" => APP_URL . "/form-confger.php"
    ),
    // #####################################################
    // ####[./]    -    Termino Menus do Sistema - END
    // #####################################################


//    "smartui" => array(
//        "title" => "Smart UI",
//        "icon" => "fa-code",
//        "sub" => array(
//            "general" => array(
//                'title' => 'General Elements',
//                'icon' => 'fa-folder-open',
//                'sub' => array(
//                    'alert' => array(
//                        'title' => 'Alerts',
//                        'url' => APP_URL . "/smartui-alert.php"
//                    ),
//                    'progress' => array(
//                        'title' => 'Progress',
//                        'url' => APP_URL . '/smartui-progress.php'
//                    )
//                )
//            ),
//            "carousel" => array(
//                "title" => "Carousel",
//                "url" => APP_URL . '/smartui-carousel.php'
//            ),
//            "tab" => array(
//                "title" => "Tab",
//                "url" => APP_URL . '/smartui-tab.php'
//            ),
//            "accordion" => array(
//                "title" => "Accordion",
//                "url" => APP_URL . '/smartui-accordion.php'
//            ),
//            "widget" => array(
//                'title' => "Widget",
//                'url' => APP_URL . "/smartui-widget.php"
//            ),
//            "datatable" => array(
//                "title" => "DataTable",
//                "url" => APP_URL . "/smartui-datatable.php"
//            ),
//            "button" => array(
//                "title" => "Button",
//                "url" => APP_URL . "/smartui-button.php"
//            ),
//            'smartform' => array(
//                'title' => 'Smart Form',
//                'url' => APP_URL . '/smartui-form.php'
//            )
//        )
//    ),
//    "smartint" => array(
//        "title" => "SmartAdmin Intel",
//        "icon" => "fa-cube txt-color-blue",
//        "sub" => array(
//            "layouts" => array(
//                "title" => "App Layouts",
//                "icon" => "fa-gear",
//                "url" => APP_URL . "/layouts.php"
//            ),
//            "applayout" => array(
//                "title" => "App Settings",
//                "icon" => "fa-cube",
//                "url" => APP_URL . "/applayout.php"
//            )
//        )
//    ),
//    "outlook" => array(
//        "title" => "Outlook",
//        "icon" => "fa-inbox",
//        "label_htm" => '<span class="badge pull-right inbox-badge margin-right-13">14</span>'
//    ),
//    "graphs" => array(
//        "title" => "Graphs",
//        "icon" => "fa-bar-chart-o",
//        "sub" => array(
//            "flot" => array(
//                "title" => "Flot Chart",
//                "url" => APP_URL . "/flot.php"
//            ),
//            "morris" => array(
//                "title" => "Morris Charts",
//                "url" => APP_URL . "/morris.php"
//            ),
//            "sparklines" => array(
//                "title" => "Sparklines",
//                "url" => APP_URL . "/sparkline-charts.php"
//            ),
//            "easypie" => array(
//                "title" => "EasyPieCharts",
//                "url" => APP_URL . "/easypie-charts.php"
//            ),
//            "dygraphs" => array(
//                "title" => "Dygraphs",
//                "url" => APP_URL . "/dygraphs.php",
//            ),
//            "chartjs" => array(
//                "title" => "Chart.js",
//                "url" => APP_URL . "/chartjs.php"
//            ),
//            "highchart" => array(
//                "title" => "HighchartTable",
//                "url" => APP_URL . "/hchartable.php",
//                "label_htm" => ' <span class="badge pull-right inbox-badge bg-color-yellow">new</span>'
//            )
//        )
//    ),
//    "tables" => array(
//        "title" => "Tables",
//        "icon" => "fa-table",
//        "sub" => array(
//            "normal" => array(
//                "title" => "Normal Tables",
//                "url" => APP_URL . "/table.php"
//            ),
//            "data" => array(
//                "title" => "Data Tables",
//                "url" => APP_URL . "/datatables.php",
//                "label_htm" => ' <span class="badge inbox-badge bg-color-greenLight">responsive</span>'
//            ),
//            "jqgrid" => array(
//                "title" => "Jquery Grid",
//                "url" => APP_URL . "/jqgrid.php"
//            )
//        )
//    ),
//    "forms" => array(
//        "title" => "Forms",
//        "icon" => "fa-pencil-square-o",
//        "sub" => array(
//            "smart_elements" => array(
//                "title" => "Smart Form Elements",
//                "url" => APP_URL . "/form-elements.php"
//            ),
//            "smart_layout" => array(
//                "title" => "Smart Form Layouts",
//                "url" => APP_URL . "/form-templates.php"
//            ),
//            "smart_validation" => array(
//                "title" => "Smart Form Validation",
//                "url" => APP_URL . "/validation.php"
//            ),
//            "bootstrap_forms" => array(
//                "title" => "Bootstrap Form Elements",
//                "url" => APP_URL . "/bootstrap-forms.php"
//            ),
//            "form_plugins" => array(
//                "title" => "Form Plugins",
//                "url" => APP_URL . "/plugins.php"
//            ),
//            "wizards" => array(
//                "title" => "Wizards",
//                "url" => APP_URL . "/wizard.php"
//            ),
//            "bootstrap_editors" => array(
//                "title" => "Bootstrap Editors",
//                "url" => APP_URL . "/other-editors.php"
//            ),
//            "dropzone" => array(
//                "title" => "Dropzone",
//                "url" => APP_URL . "/dropzone.php"
//            ),
//            "imagecrop" => array(
//                "title" => "Image Cropping",
//                "url" => APP_URL . "/image-editor.php"
//            ),
//            "ck_editor" => array(
//                "title" => "CK Editor",
//                "url" => APP_URL . "/ckeditor.php"
//            )
//        )
//    ),
//    "ui_elements" => array(
//        "title" => "UI Elements",
//        "icon" => "fa-desktop",
//        "sub" => array(
//            "general" => array(
//                "title" => "General Elements",
//                "url" => APP_URL . "/general-elements.php"
//            ),
//            "buttons" => array(
//                "title" => "Buttons",
//                "url" => APP_URL . "/buttons.php"
//            ),
//            "icons" => array(
//                "title" => "Icons",
//                "sub" => array(
//                    "fa" => array(
//                        "title" => "Font Awesome",
//                        "icon" => "fa-plane",
//                        "url" => APP_URL . "/fa.php"
//                    ),
//                    "glyph" => array(
//                        "title" => "Glyph Icons",
//                        "icon" => "fa-plane",
//                        "url" => APP_URL . "/glyph.php"
//                    ),
//                    "flags" => array(
//                        "title" => "Flags",
//                        "icon" => "fa-flag",
//                        "url" => APP_URL . "/flags.php"
//                    )
//                )
//            ),
//            "grid" => array(
//                "title" => "Grid",
//                "url" => APP_URL . "/grid.php"
//            ),
//            "tree_view" => array(
//                "title" => "Tree View",
//                "url" => APP_URL . "/treeview.php"
//            ),
//            "nestable_lists" => array(
//                "title" => "Nestable Lists",
//                "url" => APP_URL . "/nestable-list.php"
//            ),
//            "jquery_ui" => array(
//                "title" => "jQuery UI",
//                "url" => APP_URL . "/jqui.php"
//            ),
//            "typo" => array(
//                "title" => "Typography",
//                "url" => APP_URL . "/typography.php"
//            ),
//            "nav6" => array(
//                "title" => "Six Level Menu",
//                "sub" => array(
//                    "second_lvl" => array(
//                        "title" => "Item #2",
//                        "icon" => "fa-folder-open",
//                        "sub" => array(
//                            "third_lvl" => array(
//                                "title" => "Sub #2.1",
//                                "icon" => "fa-folder-open",
//                                "sub" => array(
//                                    "file" => array(
//                                        "title" => "Item #2.1.1",
//                                        "icon" => "fa-file-text"
//                                    ),
//                                    "fourth_lvl" => array(
//                                        "title" => "Expand",
//                                        "icon" => "fa-plus",
//                                        "sub" => array(
//                                            "file" => array(
//                                                "title" => "File",
//                                                "icon" => "fa-file-text"
//                                            ),
//                                            "fifth_lvl" => array(
//                                                "title" => "Delete",
//                                                "icon" => "fa-trash-o"
//                                            )
//                                        )
//                                    )
//                                )
//                            )
//                        )
//                    ),
//                    "folder" => array(
//                        "title" => "Item #3",
//                        "icon" => "fa-folder-open",
//                        "sub" => array(
//                            "third_lvl" => array(
//                                "title" => "Sub #3.1",
//                                "icon" => "fa-folder-open",
//                                "sub" => array(
//                                    "file1" => array(
//                                        "title" => "File",
//                                        "icon" => "fa-file-text"
//                                    ),
//                                    "file2" => array(
//                                        "title" => "File",
//                                        "icon" => "fa-file-text"
//                                    )
//                                )
//                            )
//                        )
//                    ),
//                    "disabled" => array(
//                        "title" => "Item #4 (disabled)",
//                        "class" => "inactive",
//                        "icon" => "fa-folder-open"
//                    )
//                )
//            ),
//        )
//    ),
//    "widgets" => array(
//        "title" => "Widgets",
//        "url" => APP_URL . "/widgets.php",
//        "icon" => "fa-list-alt"
//    ),
//    "cool" => array(
//        "title" => "Cool Features!",
//        "icon" => "fa-cloud",
//        "icon_badge" => "3",
//        "sub" => array(
//            "cal" => array(
//                "title" => "Calendar",
//                "url" => APP_URL . "/calendar.php",
//                "icon" => "fa-calendar"
//            ),
//            "gmap_skins" => array(
//                "title" => "GMap Skins",
//                "url" => APP_URL . "/gmap-xml.php",
//                "icon" => "fa-map-marker",
//                "label_htm" => '<span class="badge bg-color-greenLight pull-right inbox-badge">9</span>'
//            )
//        )
//
//    ),
//    "views" => array(
//        "title" => "App Views",
//        "icon" => "fa-puzzle-piece",
//        "sub" => array(
//            "projects" => array(
//                "title" => "Projects",
//                "icon" => "fa fa-file-text-o",
//                "url" => APP_URL . "/projects.php"
//            ),
//            "blog" => array(
//                "title" => "Blog",
//                "icon" => "fa fa-paragraph",
//                "url" => APP_URL . "/blog.php"
//            ),
//            "gallery" => array(
//                "title" => "Gallery",
//                "icon" => "fa fa-picture-o",
//                "url" => APP_URL . "/gallery.php"
//            ),
//            "forum" => array(
//                "title" => "Forum Layout",
//                "icon" => "fa fa-comments",
//                "sub" => array(
//                    "general" => array(
//                        "title" => "General View",
//                        "url" => APP_URL . "/forum.php"
//                    ),
//                    "topic" => array(
//                        "title" => "Topic View",
//                        "url" => APP_URL . "/forum-topic.php"
//                    ),
//                    "post" => array(
//                        "title" => "Post View",
//                        "url" => APP_URL . "/forum-post.php"
//                    ),
//                )
//            ),
//            "profile" => array(
//                "title" => "Profile",
//                "icon" => "fa fa-group",
//                "url" => APP_URL . "/profile.php"
//            ),
//            "timeline" => array(
//                "title" => "Timeline",
//                "icon" => "fa fa-clock-o",
//                "url" => APP_URL . "/timeline.php"
//            ),
//            "search" => array(
//                "title" => "Search Page",
//                "icon" => "fa fa-search",
//                "url" => APP_URL . "/search.php"
//            ),
//        )
//    ),
//    "ecommerce" => array(
//        "title" => "E-Commerce",
//        "icon" => "fa-shopping-cart",
//        "sub" => array(
//            "orders" => array(
//                "title" => "Orders",
//                "url" => APP_URL . "/orders.php"
//            ),
//            "prod-view" => array(
//                "title" => "Products View",
//                "url" => APP_URL . "/products-view.php"
//            ),
//            "prod-detail" => array(
//                "title" => "Products Detail",
//                "url" => APP_URL . "/products-detail.php"
//            )
//        )
//    ),
//    "misc" => array(
//        "title" => "Miscellaneous",
//        "icon" => "fa-windows",
//        "sub" => array(
//            "pricing_tables" => array(
//                "title" => "Pricing Tables",
//                "url" => APP_URL . "/pricing-table.php"
//            ),
//            "invoice" => array(
//                "title" => "Invoice",
//                "url" => APP_URL . "/invoice.php"
//            ),
//            "login" => array(
//                "title" => "Login",
//                "url" => APP_URL . "/login.php"
//            ),
//            "register" => array(
//                "title" => "Register",
//                "url" => APP_URL . "/register.php"
//            ),
//            "forgot" => array(
//                "title" => "Forgot Password",
//                "url" => APP_URL . "/forgotpassword.php"
//            ),
//            "lock" => array(
//                "title" => "Locked Screen",
//                "url" => APP_URL . "/lock.php"
//            ),
//            "err_404" => array(
//                "title" => "Error 404",
//                "url" => APP_URL . "/error404.php"
//            ),
//            "err_500" => array(
//                "title" => "Error 500",
//                "url" => APP_URL . "/error500.php"
//            ),
//            "blank" => array(
//                "title" => "Blank Page",
//                "url" => APP_URL . "/blank_.php"
//            )
//        )
//    ),
//    "smartchat" => array(
//        "title" => "Smart Chat API <sup>beta</sup>",
//        "icon" => "fa fa-lg fa-fw fa-comment-o",
//        "icon_badge" => array(
//            'content' => '!',
//            'class' => 'bg-color-pink flash animated'
//        ),
//        "li_class" => array("chat-users", "top-menu-invisible"),
//        "sub" => '
//			<div class="display-users">
//				<input class="form-control chat-user-filter" placeholder="Filter" type="text">
//
//			  	<a href="#" class="usr"
//				  	data-chat-id="cha1"
//				  	data-chat-fname="Sadi"
//				  	data-chat-lname="Orlaf"
//				  	data-chat-status="busy"
//				  	data-chat-alertmsg="Sadi Orlaf is in a meeting. Please do not disturb!"
//				  	data-chat-alertshow="true"
//				  	data-rel="popover-hover"
//				  	data-placement="right"
//				  	data-html="true"
//				  	data-content="
//						<div class=\'usr-card\'>
//							<img src=\'img/avatars/5.png\' alt=\'Sadi Orlaf\'>
//							<div class=\'usr-card-content\'>
//								<h3>Sadi Orlaf</h3>
//								<p>Marketing Executive</p>
//							</div>
//						</div>
//					">
//				  	<i></i>Sadi Orlaf
//			  	</a>
//
//				<a href="#" class="usr"
//				  	data-chat-id="cha2"
//				  	data-chat-fname="Jessica"
//				  	data-chat-lname="Dolof"
//				  	data-chat-status="online"
//				  	data-chat-alertmsg=""
//				  	data-chat-alertshow="false"
//				  	data-rel="popover-hover"
//				  	data-placement="right"
//				  	data-html="true"
//				  	data-content="
//						<div class=\'usr-card\'>
//							<img src=\'img/avatars/1.png\' alt=\'Jessica Dolof\'>
//							<div class=\'usr-card-content\'>
//								<h3>Jessica Dolof</h3>
//								<p>Sales Administrator</p>
//							</div>
//						</div>
//					">
//				  	<i></i>Jessica Dolof
//				</a>
//
//				<a href="#" class="usr"
//				  	data-chat-id="cha3"
//				  	data-chat-fname="Zekarburg"
//				  	data-chat-lname="Almandalie"
//				  	data-chat-status="online"
//				  	data-rel="popover-hover"
//				  	data-placement="right"
//				  	data-html="true"
//				  	data-content="
//						<div class=\'usr-card\'>
//							<img src=\'img/avatars/3.png\' alt=\'Zekarburg Almandalie\'>
//							<div class=\'usr-card-content\'>
//								<h3>Zekarburg Almandalie</h3>
//								<p>Sales Admin</p>
//							</div>
//						</div>
//					">
//				  	<i></i>Zekarburg Almandalie
//				</a>
//
//				<a href="#" class="usr"
//				  	data-chat-id="cha4"
//				  	data-chat-fname="Barley"
//				  	data-chat-lname="Krazurkth"
//				  	data-chat-status="away"
//				  	data-rel="popover-hover"
//				  	data-placement="right"
//				  	data-html="true"
//				  	data-content="
//						<div class=\'usr-card\'>
//							<img src=\'img/avatars/4.png\' alt=\'Barley Krazurkth\'>
//							<div class=\'usr-card-content\'>
//								<h3>Barley Krazurkth</h3>
//								<p>Sales Director</p>
//							</div>
//						</div>
//					">
//				  	<i></i>Barley Krazurkth
//				</a>
//
//				<a href="#" class="usr offline"
//				  	data-chat-id="cha5"
//				  	data-chat-fname="Farhana"
//				  	data-chat-lname="Amrin"
//				  	data-chat-status="incognito"
//				  	data-rel="popover-hover"
//				  	data-placement="right"
//				  	data-html="true"
//				  	data-content="
//						<div class=\'usr-card\'>
//							<img src=\'img/avatars/female.png\' alt=\'Farhana Amrin\'>
//							<div class=\'usr-card-content\'>
//								<h3>Farhana Amrin</h3>
//								<p>Support Admin <small><i class=\'fa fa-music\'></i> Playing Beethoven Classics</small></p>
//							</div>
//						</div>
//					">
//				  	<i></i>Farhana Amrin (offline)
//				</a>
//
//				<a href="#" class="usr offline"
//					data-chat-id="cha6"
//				  	data-chat-fname="Lezley"
//				  	data-chat-lname="Jacob"
//				  	data-chat-status="incognito"
//				  	data-rel="popover-hover"
//				  	data-placement="right"
//				  	data-html="true"
//				  	data-content="
//						<div class=\'usr-card\'>
//							<img src=\'img/avatars/male.png\' alt=\'Lezley Jacob\'>
//							<div class=\'usr-card-content\'>
//								<h3>Lezley Jacob</h3>
//								<p>Sales Director</p>
//							</div>
//						</div>
//					">
//				  	<i></i>Lezley Jacob (offline)
//				</a>
//
//				<a href="ajax/chat.php" class="btn btn-xs btn-default btn-block sa-chat-learnmore-btn">About the API</a>
//			</div>'
//    )
);

//configuration variables
$page_title = "";
$page_css = array();
$no_main_header = false; //set true for lock.php and login.php
$page_body_prop = array(); //optional properties for <body>
$page_html_prop = array(); //optional properties for <html>
?>