<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Acesso Negado";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
//$page_nav["misc"]["sub"]["err_404"]["active"] = true;
include("inc/nav.php");

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php
    //configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
    //$breadcrumbs["New Crumb"] => "http://url.com"
    //$breadcrumbs["Misc"] = "";
    include("inc/ribbon.php");
    ?>

    <!-- MAIN CONTENT -->
    <div id="content">

        <!-- row -->
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center error-box">
                            <h2 class="error-text-3 bounceInDown animated"><i
                                        class="fa fa-fw fa-warning fa-lg text-warning"></i> Acesso Negado <span
                                        class="particle particle--c"></span><span
                                        class="particle particle--a"></span><span class="particle particle--b"></span>
                            </h2>
                            <br><br><br><br>
                            <h1 class="font-xl"><strong>Acesso <u>Não</u> Autorizado a página solicitada</strong></h1>
                            <h1 class="font-xl"><strong>Verifique com o Administrador do Sistema</strong></h1>
                            <br/>
                            <p class="lead">

                            </p>
                            <p class="font-md">

                                <b>Voce está sendo redirecionado para HOME, em <span id="countdown">5</span>
                                    segundos</b><a href="index.php"> Link Redirect</a>
                                <script>


                                    var seconds = 5; // seconds for HTML
                                    var foo; // variable for clearInterval() function

                                    function redirect() {
                                        document.location = 'index.php';
                                    }

                                    function updateSecs() {
                                        document.getElementById("countdown").innerHTML = seconds;
                                        seconds--;
                                        if (seconds == -1) {
                                            clearInterval(foo);
                                            redirect();
                                        }
                                    }

                                    function countdownTimer() {
                                        foo = setInterval(function () {
                                            updateSecs()
                                        }, 1000);
                                    }

                                    countdownTimer();
                                </script>
                            </p>
                            <br>
                            <!--                            <div class="error-search well well-lg padding-10">-->
                            <!--                                <div class="input-group">-->
                            <!--                                    <input class="form-control input-lg" type="text" placeholder="let's try this again"-->
                            <!--                                           id="search-error">-->
                            <!--                                    <span class="input-group-addon"><i class="fa fa-fw fa-lg fa-search"></i></span>-->
                            <!--                                </div>-->
                            <!--                            </div>-->

                        </div>

                    </div>

                </div>

            </div>

            <!-- end row -->

        </div>

    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE FOOTER -->
<?php
// include page footer
include("inc/footer.php");
?>
<!-- END PAGE FOOTER -->

<?php
//include required scripts
include("inc/scripts.php");
?>

<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->

<script>

    $(document).ready(function () {
        // PAGE RELATED SCRIPTS
    })

</script>

<?php
//include footer
include("inc/google-analytics.php");
?>
