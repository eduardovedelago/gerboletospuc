<?php
//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
//require_once("inc/config.ui.php");


/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Login";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
$no_main_header = true;
$page_html_prop = array("id" => "extr-page", "class" => "animated fadeInDown");
$page_body_prop = array();
include("inc/header.php");

?>
    <!-- ==========================CONTENT STARTS HERE ========================== -->
    <!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
    <header id="header">
        <!--<span id="logo"></span>-->

        <div id="logo-group">
            <span id="logo"> <img src="<?php echo ASSETS_URL; ?>/img/logo.png" alt="SmartAdmin"> </span>

            <!-- END AJAX-DROPDOWN -->
        </div>

        	<!-- <span id="extr-page-header-space"> <span class="hidden-mobile hiddex-xs"></span>Não é Cadastrado ?  <a href=" -->
        <!-- <?php echo APP_URL; ?>/register.php" class="btn btn-danger">Entre em contato</a> </span> -->

    </header>

    <div id="main" role="main" style="margin-top: 70px;">

        <!-- MAIN CONTENT -->
        <div id="content" class="container">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
                    <h1 class="txt-color-red login-header-big">GerBoletos</h1>
                    <div class="hero">

                        <div class="pull-left login-desc-box-l">
                            <h4 class="paragraph-header">Sistema para Emissão de Boletos<br> <br> Para Acessar o Sistema Efetue o Login.</h4>
                            <div class="login-app-icons">
                                <!--							<a href="javascript:void(0);" class="btn btn-danger btn-sm">Frontend Template</a>-->
                                <!--							<a href="javascript:void(0);" class="btn btn-danger btn-sm">Find out more</a>-->
                            </div>
                        </div>

                        <img src="<?php echo ASSETS_URL; ?>/img/demo/iphoneview.png" class="pull-right display-image"
                             alt="" style="width:210px">

                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <h5 class="about-heading"></h5>
                            <p>
                                <!--							Aqui Pode Ser Colocado Texto -->
                            </p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <h5 class="about-heading"></h5>
                            <p>
                                <!--							Aqui Pode Ser Colocado Texto -->
                            </p>
                        </div>
                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                    <div class="well no-padding">
                        <?php
                        $email = $_COOKIE['_email'];
                        $nome =  $_COOKIE['_name'];
//                        if ($email != null) {
/*                            echo '<form name="form-login" id="form-login" class="lockscreen animated flipInY" action="<?php echo APP_URL; ?>/index.php">*/
//                            <div class="logo">
/*                                <h1 class="semi-bold"><img src="<?php echo ASSETS_URL; ?>/img/logo-o.png" alt=""/>*/
//                                    SmartAdmin</h1>
//                            </div>
//                            <div>
//                                <img src="/img/avatars/sunny-big.png" alt="" width="120"
//                                     height="120"/>
//                                <div>
//                                    <h1><i class="fa fa-user fa-3x text-muted air air-top-right hidden-mobile"></i>John
//                                        Doe
//                                        <small><i class="fa fa-lock text-muted"></i> &nbsp;Locked</small>
//                                    </h1>
//                                    <p class="text-muted">
//                                        <a href="mailto:simmons@smartadmin">'.$email.'</a>
//                                    </p>
//
//                                    <div class="input-group">
//                                        <input class="form-control" type="password" placeholder="Password">
//                                        <div class="input-group-btn">
//                                            <button class="btn btn-primary" type="submit">
//                                                <i class="fa fa-key"></i>
//                                            </button>
//                                        </div>
//                                    </div>
//                                    <p class="no-margin margin-top-5">
//                                        Logged as someone else? <a href="/login.php"> Click
//                                            here</a>
//                                    </p>
//                                </div>
//
//                            </div>
//                            <p class="font-xs margin-top-5">
//                                Copyright SmartAdmin 2014-2020.
//
//                            </p>
//                        </form>';
//                        } else {
                            echo '<form name="form-login" id="form-login" class="smart-form client-form">
                            <header>
                            Login
                            </header>

                            <fieldset>

                                <input id="action-form-cadastro" name="action" type="hidden" value="executeLogin">

                                <section>
                                    <label class="label">CPF</label>
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="cpf" data-mask="999.999.999-99" data-mask-placeholder= "_">
                                        <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i>
                            Informe o seu CPF</b></label>
                                </section>

                                <section>
                                    <label class="label">Senha</label>
                                    <label class="input"> <i class="icon-append fa fa-lock"></i>
                                        <input type="password" name="password">
                                        <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i>
                            Informe Sua Senha</b> </label>
                                    <div class="note">
                                        <a href="<?php echo APP_URL; ?>/forgotpassword.php">Esqueceu a Senha?</a>
                                    </div>
                                </section>

                                <section>
                                    <label class="checkbox">
                                        <input type="checkbox" name="remember" checked="S">
                                        <i></i>Lembrar-me</label>
                                </section>
                            </fieldset>
                            <footer>                                                                
                                <button id="btnLogin" type="submit" class="btn btn-primary">
                            Login
                                </button>                                                                
                            </footer>
                        </form>';
                        //}
                        ?>

                    </div>
                    <!--				<h5 class="text-center"> - Or sign in using -</h5>-->
                    <!--													-->
                    <!--								<ul class="list-inline text-center">-->
                    <!--									<li>-->
                    <!--										<a href="javascript:void(0);" class="btn btn-primary btn-circle"><i class="fa fa-facebook"></i></a>-->
                    <!--									</li>-->
                    <!--									<li>-->
                    <!--										<a href="javascript:void(0);" class="btn btn-info btn-circle"><i class="fa fa-twitter"></i></a>-->
                    <!--									</li>-->
                    <!--									<li>-->
                    <!--										<a href="javascript:void(0);" class="btn btn-warning btn-circle"><i class="fa fa-linkedin"></i></a>-->
                    <!--									</li>-->
                    <!--								</ul>-->
                    <!--				-->
                </div>
            </div>
        </div>
    </div>


    <!-- END MAIN PANEL -->
    <!-- ==========================CONTENT ENDS HERE ========================== -->

<?php
//include required scripts
include("inc/scripts.php");
?>

    <!-- Funções do Formulário de Cadastro -->
    <script src="<?php echo ASSETS_URL; ?>/js/forms/login.js"></script>

    <!-- ./Funções do Formulário de Cadastro -->


    <script type="text/javascript">
        runAllForms();

        $(function () {

        });
    </script>

<?php
//include footer
include("inc/google-analytics.php");
?>