<?php ob_start(); ?>
<?php
include('../config.php');
$templatePath = dirname(__FILE__);
$uploadPath = $templatePath . "/uploads/";

$sql = "SELECT * FROM `country_list` ORDER BY `country_list`.`country_name` ASC";
$results = mysqli_query($acc_conn, $sql);
if (mysqli_num_rows($results) > 0) {
    $wordsArray = array();
    while ($row = mysqli_fetch_array($results)) {
        $wordsArray[$row['country_code']] = $row['country_name'];
    }
    $countryarr = $wordsArray;
}
$record_id = $_GET['id'];
$report_stage = $_GET['stage'];
// var_dump($report_stage);die;
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- js from compassion-->
    <link rel="stylesheet" href="<?php echo $root; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $root; ?>sweetalert-master/dist/sweetalert.css">
    <link rel="stylesheet" href="<?php echo $root; ?>css/swal-forms.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $root; ?>css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $root; ?>assets-minified/icons/spinnericon/spinnericon.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
    <!-- PLUGINS JS-->

    <script src="<?php echo $root; ?>js/plugins/jquery-compassionuk.min.js"></script>
    <script src="<?php echo $root; ?>js/plugins/papaparse.min.js"></script>
    <script src="<?php echo $root; ?>js/plugins/compassion.moment.min.js"></script>
    <script src="<?php echo $root; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo $root; ?>sweetalert-master/dist/sweetalert.min.js"></script>
    <script src="<?php echo $root; ?>js/plugins/swal-forms.js"></script>
    <!-- CONTENT JS-->
    <!-- <script src="<?php echo $root; ?>js/plugins/tinymce.min.js" referrerpolicy="origin"></script> -->
    <script src="https://cdn.tiny.cloud/1/9a7n5irddkx00ptgu1yamssye7myj0thcw21aaqt5805qwua/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script type="text/javascript" src="<?php echo $root; ?>assets-minified/js-core.js"></script>
    <script src="<?php echo $root; ?>js/content/config.js"></script>
    <script src="<?php echo $root; ?>js/plugins/compassionuk.jquery.validate.min.js"></script>
    <script src="<?php echo $root; ?>js/content/intervention_report/__intervention_form.js?_<?= rand(); ?>"></script>
    <script src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $root; ?>assets-minified/all-demo.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $root; ?>css/">
    <script type="text/javascript">
    </script>
    <style>
    /* .tox.tox-silver-sink.tox-tinymce-aux {
        display: none;
    } */

    .tox.tox-tinymce {
        display: flex !important;
    }

    .icon-spin {
        border: none !important;
        margin-top: -4px !important;
        color: white !important;
    }

    .demo-icon {
        font-size: 22px;
        line-height: 40px;
        float: left;
        width: 40px;
        height: 40px;
        margin: 10px;
        text-align: center;
        color: #999;
        border-radius: 3px;
    }

    .text-white {
        color: white !important;
    }

    .hed {
        background-color: #65a6ff;
        border-radius: 12px;
    }

    .control-label {
        color: white;
    }

    .bootstrap-timepicker-widget table td input,
    .chosen-container-multi,
    .chosen-container-single .chosen-search input,
    .dataTables_length select,
    .form-control,
    .input,
    .ui-toolbar input,
    .ui-toolbar select,
    div.dataTables_filter input {
        padding: 1px 5px !important;
    }

    .b-bg {
        background-color: #0F569A;
        color: white;
        border-color: -1px solid transparent !important;
        height: 30px;
    }

    .btn-icon {
        height: 15px;
        width: 15px;
        margin-bottom: 3px;
    }

    input.error,
    select.error {
        border: 2px solid red;
    }

    label.error {
        color: red;
    }

    select::-ms-expand {
        display: none;
    }

    .post-wrapper {
        position: relative;
        width: 100%;
    }

    .post-input {
        float: left;
        box-sizing: border-box;
        /*padding-right: 80px;*/
        width: 85%;
    }

    .post-button {
        position: absolute;
        top: 0;
        right: 0;
        font-weight: bold;
        width: 45px;
    }

    th {
        text-align: -webkit-center;
    }

    .col-md-3.col-sm-3.col-xs-6 {
        margin-bottom: 5px;
    }

    [class^='icon-spin-']:before,
    [class*=' icon-spin-']:before {
        font-family: 'spinnericon' !important;
    }

    .icon-spin {
        border: none !important;
        margin-top: 5px !important;
        color: white !important;
        line-height: 20px !important;
        width: 20px !important;
        height: 20px !important;
    }

    .rowsappended {
        cursor: pointer;
    }

    form {
        display: none;
    }

    .sweet-alert h2 {
        text-align: center;
    }

    button.close {
        padding: 0;
        cursor: pointer;
        border: 0;
        background-color: white;
        position: absolute;
        top: 0;
        z-index: 9999;
        right: 0;
        margin: 10px;
        border-radius: 50%;
        opacity: unset !important;
        font-size: 18px;
        width: 25px;
        height: 25px;
        line-height: unset !important;
    }

    #show_img {
        object-fit: contain;
    }

    #loading {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        background-color: rgba(0, 0, 0, 0.2);
    }

    #loading img {
        display: block;
    }
    </style>
</head>

<body style="background-color:white !important;">
    <div id="loading"><img src="<?php echo $root; ?>assets/images/spinner/loader-dark.gif" alt="Loading..."></div>
    <div id="sb-site">
        <div id="page-wrapper" style="padding-top:unset;">
            <?php
            require_once($doc_root . '/includes/header.php');
            require_once($doc_root . '/includes/left-menu.html');
            ?>
            <div class="divider"></div>
        </div>
    </div>
    <div class="modal" id="imageModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <button type="button" class="close" data-dismiss="imageModal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <div class="modal-content" style="border: 0;overflow:hidden">
                <img src="" width="600" id="show_img" height="500">
            </div>
        </div>
    </div>
    <div id="page-content-wrapper" class="rm-transition">
        <div id="page-content">
            <div class="page-box">
                <h3 class="page-title">
                    INTERVENTION REPORT
                </h3>
                <div id="wrapper">
                    <div id="content">
                        <div class="row">
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                            <div class="col-md-10 col-sm-10 col-xs-12 hed">
                                <div class="row">
                                    <div class="col-md-1 col-sm-2 col-xs-2"></div>
                                    <input type="hidden" id="existing_ir_id" name="existing_ir_id"
                                        value="<?php echo $record_id; ?>" />
                                    <input type="hidden" class="report_stage" id="report_stage" name="report_stage"
                                        value="<?php echo $report_stage ?>" />
                                    <div class="col-md-9 col-sm-2 col-xs-2" id="interventioForm"
                                        style="padding-top:15px;">
                                        <!--form 1 start-->
                                        <?php // require_once("./widgets/form-step-1.php") 
                                        ?>
                                        <!--form 1 end-->
                                        <!--form 1.3 start-->
                                        <?php require_once("./widgets/form-step-1.3.php") ?>
                                        <!--form 1.3 end-->
                                        <!--form 1.4 start-->
                                        <?php require_once("./widgets/form-step-1.4.php") ?>
                                        <!--form 1.4 end-->
                                        <!--form 1.5 start-->
                                        <?php require_once("./widgets/form-step-1.5.php") ?>
                                        <!--form 1.5 end-->
                                        <!--form 1.5 start-->
                                        <?php require_once("./widgets/form-step-1.5.php") ?>
                                        <!--form 1.5 end-->
                                        <!--form 2 start-->
                                        <?php require_once("./widgets/form-step-2.php") ?>
                                        <!--form 2 end-->
                                        <!--form 3 start-->
                                        <?php require_once("./widgets/form-step-3.php") ?>
                                        <!--form 3 end-->
                                        <!--form 4 start-->
                                        <?php require_once("./widgets/form-step-4.php") ?>
                                        <!--form 4 end-->
                                        <!--form 5 start-->
                                        <?php require_once("./widgets/form-step-5.php") ?>
                                        <!--form 5 end-->
                                        <!--form 6 start-->
                                        <?php require_once("./widgets/form-step-6.php") ?>
                                        <!--form 6 end-->
                                        <!--form 7 start-->
                                        <?php require_once("./widgets/form-step-7.php") ?>
                                        <!--form 7 end-->
                                        <!--form 8 start-->
                                        <?php require_once("./widgets/form-step-8.php") ?>
                                        <!--form 8 end-->
                                        <!--form 9 start-->
                                        <?php require_once("./widgets/form-step-9.php") ?>
                                        <!--form 9 end-->
                                        <!--form 10 start-->
                                        <?php require_once("./widgets/form-step-10.php") ?>
                                        <!--form 10 end-->
                                        <!--form 11 start-->
                                        <?php require_once("./widgets/form-step-11.php") ?>
                                        <!--form 11 end-->
                                        <!--form 12 start-->
                                        <?php require_once("./widgets/form-step-12.php") ?>
                                        <!--form 12 end-->
                                        <!--form 13 start-->
                                        <?php require_once("./widgets/form-step-13.php") ?>
                                        <!--form 13 end-->
                                        <!--form 14 start-->
                                        <?php require_once("./widgets/form-step-14.php") ?>
                                        <!--form 14 end-->
                                        <!--form 14.5 start-->
                                        <?php require_once("./widgets/form-step-14.5.php") ?>
                                        <!--form 14.5 end-->
                                        <!--form 15 start-->
                                        <?php require_once("./widgets/form-step-15.php") ?>
                                        <!--form 15 end-->
                                        <!--form 16 start-->
                                        <?php require_once("./widgets/form-step-16.php") ?>
                                        <!--form 16 end-->
                                        <!--form 16.5 start-->
                                        <?php require_once("./widgets/form-step-16.5.php") ?>
                                        <!--form 16.5 end-->
                                        <!--form 17 start-->
                                        <?php require_once("./widgets/form-step-17.php") ?>
                                        <!--form 17 end-->
                                        <!--form 17.5 start-->
                                        <?php require_once("./widgets/form-step-17.5.php") ?>
                                        <!--form 17.5 end-->
                                        <!--form 18 start-->
                                        <?php require_once("./widgets/form-step-18.php") ?>
                                        <!--form 18 end-->
                                        <!--form 18.5 start-->
                                        <?php require_once("./widgets/form-step-18.5.php") ?>
                                        <!--form 18.5 end-->
                                        <!--form 19 start-->
                                        <?php require_once("./widgets/form-step-19.php") ?>
                                        <!--form 19 end-->
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('../footer.php'); ?>
    <script type="text/javascript" src="<?php echo $root; ?>assets-minified/all-demo.js"></script>
    <script type="text/javascript" src="<?php echo $root; ?>assets-minified/widgets/skycons/skycons.js"></script>
    <script type="text/javascript" src="<?php echo $root; ?>assets-minified/widgets/charts/piegage/piegage.js">
    </script>
    <script type="text/javascript" src="<?php echo $root; ?>assets-minified/widgets/charts/piegage/piegage-demo.js">
    </script>
    <script type="text/javascript" src="<?php echo $root; ?>assets-minified/widgets/charts/sparklines/sparklines.js">
    </script>
    <script type="text/javascript"
        src="<?php echo $root; ?>assets-minified/widgets/charts/sparklines/sparklines-demo.js"></script>

</body>

</html>
<?php
ob_end_flush();
?>