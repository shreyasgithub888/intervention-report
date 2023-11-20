<?php ob_start( ); ?>
<?php include ('../config.php'); ?>
<?php //include('../db.php'); ?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- js from compassion-->
    <link rel="stylesheet" href="<?php echo $root;?>css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $root;?>sweetalert-master/dist/sweetalert.css">
    <link rel="stylesheet" href="<?php echo $root;?>css/swal-forms.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $root;?>css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $root;?>assets-minified/icons/spinnericon/spinnericon.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
    <!-- PLUGINS JS-->
    <script src="<?php echo $root;?>js/plugins/jquery-compassionuk.min.js"></script>
    <script src="<?php echo $root;?>js/plugins/papaparse.min.js"></script>
    <script src="<?php echo $root;?>js/plugins/compassion.moment.min.js"></script>
    <script src="<?php echo $root;?>js/bootstrap.min.js"></script>
    <script src="<?php echo $root;?>sweetalert-master/dist/sweetalert.min.js"></script>
    <script src="<?php echo $root;?>js/plugins/swal-forms.js"></script>
    <!-- CONTENT JS-->
    <script type="text/javascript" src="<?php echo $root;?>assets-minified/js-core.js"></script>
    <script src="<?php echo $root;?>js/content/config.js"></script>
    <script src="<?php echo $root;?>js/plugins/compassionuk.jquery.validate.min.js"></script>
    <script src="<?php echo $root;?>js/content/intervention_report/__intervention_form.js"></script>
    <script src="<?php echo $root;?>js/content/intervention_report/__intervention_form2.js"></script>
    <script src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $root;?>assets-minified/all-demo.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $root;?>css/">
    <script type="text/javascript">
    </script>
    <style>
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

    .btn-ico {
        height: 20px;
        width: 20px;
    }

    input.error,select.error {
        border: 2px solid red;
    }
    label.error{
        color:red;
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

    form:not(:first-of-type) {
        display: none;
    }
    </style>
</head>

<body style="background-color:white !important;">
    <div id="loading"><img src="<?php echo $root;?>assets/images/spinner/loader-dark.gif" alt="Loading..."></div>
    <div id="sb-site">
        <div id="page-wrapper" style="padding-top:unset;">
            <?php
                   require_once($doc_root.'/includes/header.php');
                   require_once($doc_root.'/includes/left-menu.html');
                ?>
            <div class="divider"></div>
        </div>
    </div>
    <div id="page-content-wrapper" class="rm-transition">
        <div id="page-content">
            <div class="page-box">
                <h3 class="page-title">
                    UPDATE INTERVENTION REPORT
                </h3>
                <div id="wrapper">
                    <div id="content">
                        <div class="row">
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                            <div class="col-md-10 col-sm-10 col-xs-12 hed">
                                <div class="row">
                                    <div class="col-md-1 col-sm-2 col-xs-2"></div>
                                    <div class="col-md-9 col-sm-2 col-xs-2" id="interventioForm"
                                        style="padding-top:15px;">
                                       
									   <form method="POST" action="" class="form-horizontal" name="stepOne" id="stepOne" data-form-id="1">
									   <?php
                  $sql1 = "SELECT * FROM ir_intervention_report WHERE post_title LIKE '%".$ir_id."%'";  
                  $result1 = $ir_conn->query($sql1);	
                  if($result1->num_rows > 0) {
                  	$row1 = $result1->fetch_assoc();
                  }   
               ?>
    <h3 class="page-title text-white text-center">
        INTERVENTION REPORT
    </h3>
    <div class="form-group">
        <label for="report_stage" class="col-md-4 col-sm-3 col-xs-6 control-label">Report stage </label>
        <div class="col-md-6 col-sm-3 col-xs-6">
            <input type="radio" name="report_stage" class="report_stage" value="Proposal">
            <label class="control-label">Proposal</label>

            <input type="radio" name="report_stage" class="report_stage" value="Update">
            <label class="control-label">Update</label>

            <input type="radio" name="report_stage" class="report_stage" value="Thank you">
            <label class="control-label">Thank you</label>
        </div>
    </div>
    <div class="form-group">
        <label for="post_title" class="col-md-4 col-sm-3 col-xs-6 control-label">Post Title</label>
        <div class="col-md-6 col-sm-3 col-xs-6 ">
            <input type="text" class="form-control" id="post_title" name="post_title" value="<?php echo $row1['post_title']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="country_type" class="col-md-4 col-sm-3 col-xs-6 control-label">Country</label>
        <div class="col-md-6 col-sm-3 col-xs-6 ">
            <select name="country_type" class="form-control" id="country_type">
                <option value="" selected>Select a type</option>
                <option value="India">India</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="America">America</option>
                <option value="London">London</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="intervation_type" class="col-md-4 col-sm-3 col-xs-6 control-label">Intervation</label>
        <div class="col-md-6 col-sm-3 col-xs-6 ">
            <select name="intervation_type" class="form-control" id="intervation_type">
                <option value="" selected>Select a type</option>
                <option value="intervation1">intervation1</option>
                <option value="intervation2">intervation2</option>
                <option value="intervation3">intervation3</option>
                <option value="intervation4">intervation4</option>
            </select>
        </div>
    </div>
	<div class="form-group">
        <label for="category_type" class="col-md-4 col-sm-3 col-xs-6 control-label">Category</label>
        <div class="col-md-6 col-sm-3 col-xs-6 ">
            <select name="category_type" class="form-control" id="category_type">
                <option value="" selected>Select a category</option>
                <option value="Child_Survival">Child Survival</option>
                <option value="Water">Water</option>
                <option value="intervation3">Health</option>
                <option value="Health">Stability</option>
                <option value="intervation4">Education</option>
                <option value="Child_Protection">Child Protection</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="image_file" class="col-md-4 col-sm-3 col-xs-6 control-label">Image</label>
        <div class="col-md-6 col-sm-3 col-xs-6 ">
            <input type="file" class="form-control" id="image_file" name="image_file" value="">
        </div>
    </div>
    <div class="error-text" style=""></div>
    <div class="success-text" style=""></div>
    <center><button type="submit" class="stepOneF btn btn-primary">Submit</button></center>
</form>
                                        
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
    <script type="text/javascript" src="<?php echo $root;?>assets-minified/all-demo.js"></script>
    <script type="text/javascript" src="<?php echo $root;?>assets-minified/widgets/skycons/skycons.js"></script>
    <script type="text/javascript" src="<?php echo $root;?>assets-minified/widgets/charts/piegage/piegage.js">
    </script>
    <script type="text/javascript" src="<?php echo $root;?>assets-minified/widgets/charts/piegage/piegage-demo.js">
    </script>
    <script type="text/javascript" src="<?php echo $root;?>assets-minified/widgets/charts/sparklines/sparklines.js">
    </script>
    <script type="text/javascript"
        src="<?php echo $root;?>assets-minified/widgets/charts/sparklines/sparklines-demo.js"></script>

</body>

</html>
<?php
ob_end_flush( );
?>