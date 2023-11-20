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
    <script src="<?php echo $root; ?>js/content/intervention_report/__dashboard-v2.js?_<?= rand(); ?>"></script>
    <script src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo $root; ?>assets-minified/all-demo.css">

    <link rel="stylesheet" type="text/css" href="<?php echo $root; ?>css/content/intervention-dashboard.css" />




</head>

<body style="background-color:white !important;">

    <div id="sb-site">
        <div id="page-wrapper" style="padding-top:unset;">
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
                                <div class="form-group col-md-2 hide">
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
                                <div class="form-group col-md-2 hide">
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
                                <a href="<?php echo $root; ?>intervention_report/add_forms.php" name="audit-log"
                                    id="audit-log" style="font-size: 15px;" class="btn btn-primary">Add New</a>
                            </div>
                        </div>
                        <div class="space_div" style="margin:z 0 0 20px 0; "></div>
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"
                            id="dynamic-table-example-1" style="width: 100%;margin-left: 0px;">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Country</th>
                                    <th class="text-center">Category </th>
                                    <th class="text-center">Proposal Published Date</th>
                                    <th class="text-center">Update Published Date</th>
                                    <th class="text-center">Thank you Published Date</th>
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