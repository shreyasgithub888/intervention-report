<?php ob_start(); ?>
<?php
include('../config.php');
$sql = "SELECT * FROM `country_list` ORDER BY `country_list`.`country_name` ASC";
$results = mysqli_query($acc_conn, $sql);
if (mysqli_num_rows($results) > 0) {
    $wordsArray = array();
    while ($row = mysqli_fetch_array($results)) {
        $wordsArray[$row['country_code']] = $row['country_name'];
    }
    $countryarr = $wordsArray;
}
?>

<html>

<head>
    <title>Interventions Reports</title>
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
    <!-- <script src="<?php echo $root; ?>js/bootstrap.min.js"></script>-->
    <script src="<?php echo $root; ?>js/plugins/compassionuk.jquery.validate.min.js"></script>
    <script src="<?php echo $root; ?>sweetalert-master/dist/sweetalert.min.js"></script>
    <script src="<?php echo $root; ?>js/plugins/swal-forms.js"></script>

    <!-- CONTENT JS-->
    <script type="text/javascript" src="<?php echo $root; ?>assets-minified/js-core.js"></script>
    <script src="<?php echo $root; ?>js/content/config.js"></script>
    <script src="<?php echo $root; ?>js/content/intervention_report/__dashboard.js?_<?= rand(); ?>"></script>
    <script src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo $root; ?>assets-minified/all-demo.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $root; ?>css/Dashboard.css">
    <style>
    .search {
        background-color: #5bccf6;
        color: #fff;
        border-top: 10px solid #5bccf6;
        border-bottom: 10px solid #5bccf6;
        padding: 30px 0 40px 0;
    }

    .container {
        width: auto !important;
    }

    .form-horizontal {
        margin-left: 0px !important;
    }

    .sweet-alert h2 {
        text-align: center;
        /*added by shreyas */
    }



    .sa-custom {
        width: 60px !important;
        height: 60px !important;
        border-radius: 10px !important;
        margin-left: auto !important;
        position: relative !important;
        /*added by shreyas */
        margin: 0px auto !important;
        /*added by shreyas */
    }

    .table-striped>tbody>tr:nth-of-type(odd) {
        background-color: initial;
    }

    .icon-check:before {
        padding: 4px;
        background: #8eca3f !important;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
    }

    .icon-remove:before {
        padding: 4px;
        background: #fa7753 !important;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
    }

    .icon-unlock-alt:before {
        padding: 4px;
        background: #3ca1ff !important;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
    }

    .icon-pencil:before {
        padding: 4px;
        background: #3ca1ff !important;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
    }

    .glyph-icon:before {
        width: 25px;
    }

    .table>tbody>tr>td {
        padding-bottom: 6px !important;
        border-bottom: 1px solid #ddd !important;
        color: #333;
    }

    .sweet-alert h2 {
        line-height: 0px;
        /*added by shreyas */
    }

    .sweet-alert p {
        color: #797979;
        font-size: 16px;
        text-align: center;
        font-weight: 300;
        position: relative;
        text-align: center;
        /*added by shreyas */
        float: none;
        margin: 0;
        padding: 0;
        line-height: normal;
    }

    .sa-button-container {
        text-align: center;
    }

    .sweet-alert button {
        background-color: #8CD4F5;
        color: white;
        border: none;
        box-shadow: none;
        font-size: 17px;
        font-weight: 500;
        -webkit-border-radius: 4px;
        border-radius: 5px;
        padding: 10px 32px;
        margin: 0px 0px 0 0px;
        /*added by shreyas */
        cursor: pointer;
    }

    .sa-custom {
        width: 60px !important;
        height: 60px !important;
        border-radius: 10px !important;
    }

    .table-striped>tbody>tr:nth-of-type(odd) {
        background-color: initial;
    }


    .swal-form {
        height: 200px;
    }

    .sweet-alert {
        display: flex;
        flex-direction: column;
    }

    .sweet-alert {
        margin-top: -220px !important;
    }


    .swal-form .patch-swal-styles-for-inputs {
        float: left;
        margin: 0 0 !important;
    }

    .swal-form label {
        float: left;
        padding: 0 10px;
    }
    button.publish {
        padding: 4px;
        background: #808080 !important;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
        border: 0;
    }
    button.publish:before {
        display: none;
    }
    button.draft {
        padding: 4px;
        background: #8eca3f !important;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
        border: 0;
    }
    button.draft:before {
        display: none;
    }
    </style>
</head>

<body style="background-color:white !important;">

    <!-- <div id="loading"><img src="<?php echo $root; ?>assets/images/spinner/loader-dark.gif" alt="Loading..."></div> -->
    <div id="sb-site">
        <div id="page-wrapper">
            <?php
            require_once($doc_root . '/includes/header.php');
            require_once($doc_root . '/includes/left-menu.html');
            ?>
            <div class="divider"></div>
        </div>
    </div>

    <!-- dashboard -->
    <div id="page-content-wrapper" class="rm-transition">
        <div id="page-content">
            <div class="page-box">
                <h3 class="page-title"> Intervention Report </h3>
                <div id="wrapper">
                    <div id="content">
                        <?php
                        $record_id = $_GET['id'];
                        $sql = "SELECT * FROM `ir_intervention_report` WHERE `ir_id` = $record_id";
                        $result = mysqli_query($ir_conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            // var_dump("row ", $row);
                            $report_stage = $row["report_stage"];
                            $post_title = $row["post_title"];
                            $image1_url = $row["image1_url"];
                        }

                        ?>
                        <div class="container-fluid search">
                            <form role="form" id="searchForm">
                                <div class="form-group col-md-2">
                                    <label for="source code">Stage</label>
                                    <input type="text" class="form-control" id="stage" name="stage">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="country">Country</label>
                                    <select name="country_type" class="form-control" id="country_type">
                                        <?php
                                        foreach ($countryarr as $x => $x_value) {
                                            if ($row["country_id"] === $x_value) {
                                                echo '<option value="' . $x . '" selected="selected">' . $x_value . '</option>';
                                            } else {
                                                echo '<option value="' . $x . '">' . $x_value . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="category">Category</label>
                                    <select name="category_type" class="form-control" id="category_type">
                                        <option value="">Select a Category</option>
                                        <option value="Child Survival"
                                            <?php echo isset($row["category"]) && $row["category"] === "Child Survival" ? "selected" : ""; ?>>
                                            Child Survival</option>
                                        <option value="Water"
                                            <?php echo isset($row["category"]) && $row["category"] === "Water" ? "selected" : ""; ?>>
                                            Water</option>
                                        <option value="Health"
                                            <?php echo isset($row["category"]) && $row["category"] === "Health" ? "selected" : ""; ?>>
                                            Health</option>
                                        <option value="Stability"
                                            <?php echo isset($row["category"]) && $row["category"] === "Stability" ? "selected" : ""; ?>>
                                            Stability</option>
                                        <option value="Education"
                                            <?php echo isset($row["category"]) && $row["category"] === "Education" ? "selected" : ""; ?>>
                                            Education</option>
                                        <option value="Child Protection"
                                            <?php echo isset($row["category"]) && $row["category"] === "Child Protection" ? "selected" : ""; ?>>
                                            Child Protection</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" id="status">
                                        <option value="">Select a Status</option>
                                        <option value="Draft"
                                            <?php echo isset($row["Status"]) && $row["Status"] === "Draft" ? "selected" : ""; ?>>
                                            Draft</option>
                                        <option value="publish"
                                            <?php echo isset($row["Status"]) && $row["Status"] === "publish" ? "selected" : ""; ?>>
                                            Publish</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <button type="submit" name="search" id="search" class="btn btn-primary"
                                        style="margin-top: 24px;">SEARCH&nbsp;<img src="../images/search-icon.png"
                                            style=" height:20px;width:20px;"></img> </button>
                                    <button type="button" name="clear" id="clear" class="btn btn-primary"
                                        onclick="this.form.reset();"
                                        style="margin-top: 24px; padding:0 20px;margin: 24px 5px 0 5px;">CLEAR</button>
                                </div>
                            </form>
                        </div>

                        <div class="container" id="no-data" style="margin-top: 100px;">
                            <h2 id="stats" style="text-align: center;">NO RECORDS TO DISPLAY</h2>
                        </div>
                        <div class="col-12 pull-right py-5" style="display: flex;padding: 10px;">
                            <div class="col-md-9" style="float: right;">
                                <a href="<?php echo $root; ?>intervention_report/forms.php" name="audit-log"
                                    id="audit-log" style="font-size: 15px;" class="btn btn-primary">Add New</a>
                            </div>
                        </div>
                        <div class="space_div" style="margin:z 0 0 20px 0; "></div>
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"
                            id="dynamic-table-example-1" style="width: 100%;margin-left: 0px;">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Stage</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Country</th>
                                    <th class="text-center">Category </th>
                                    <th class="text-center">Status </th>
                                    <th class="text-center">Date Created</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <?php include('../footer.php'); ?>
    <script type="text/javascript" src="<?php echo $root; ?>assets-minified/.js"></script>
    <!--[if !(IE 8)]><!-->
    <script type="text/javascript" src="<?php echo $root; ?>assets-minified/widgets/skycons/skycons.js"></script>
    <script type="text/javascript" src="<?php echo $root; ?>assets-minified/widgets/charts/piegage/piegage.js">
    </script>
    <script type="text/javascript" src="<?php echo $root; ?>assets-minified/widgets/charts/piegage/piegage-demo.js">
    </script>
    <script type="text/javascript" src="<?php echo $root; ?>assets-minified/widgets/charts/sparklines/sparklines.js">
    </script>
    <script type="text/javascript"
        src="<?php echo $root; ?>assets-minified/widgets/charts/sparklines/sparklines-demo.js"></script>
    <!--[endif]-->
    <!--[if lt IE 9]>
    <script src="<?php echo $root; ?>assets-minified/js-core/html5shiv.js"></script>
    <![endif]-->

</body>

</html>
<?php
ob_end_flush();
?>