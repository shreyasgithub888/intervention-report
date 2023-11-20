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
$fetchQuery = "SELECT * FROM `ir_intervention_report` WHERE `ir_id` = $record_id";
$result = mysqli_query($ir_conn, $fetchQuery);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $report_stage = $row["report_stage"];
    $post_title = $row["post_title"];
    $ir_url = $row["ir_url"];
}
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="<?php echo $root; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $root; ?>sweetalert-master/dist/sweetalert.css">
    <link rel="stylesheet" href="<?php echo $root; ?>css/swal-forms.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $root; ?>css/content/single_report_form.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $root; ?>assets-minified/all-demo.css">

    <!-- JavaScript Libraries -->
    <script src="<?php echo $root; ?>js/plugins/jquery-compassionuk.min.js"></script>
    <script src="<?php echo $root; ?>js/plugins/papaparse.min.js"></script>
    <script src="<?php echo $root; ?>js/plugins/compassion.moment.min.js"></script>
    <script src="<?php echo $root; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo $root; ?>sweetalert-master/dist/sweetalert.min.js"></script>
    <script src="<?php echo $root; ?>js/plugins/swal-forms.js"></script>
    <script src="<?php echo $root; ?>assets-minified/js-core.js"></script>
    <script src="<?php echo $root; ?>js/plugins/compassionuk.jquery.validate.min.js"></script>
    <script src="<?php echo $root; ?>js/content/config.js"></script>
    <script src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo $root; ?>js/content/intervention_report/__single_report_form.js?_<?= rand(); ?>"></script>

</head>


<body style="background-color:white !important;">
    <input type="hidden" id="existing_ir_id" name="existing_ir_id" value="<?php echo $record_id; ?>" />
    <!-- <div id="loading"><img src="<?php echo $root; ?>assets/images/spinner/loader-dark.gif" alt="Loading..."></div> -->
    <div id="sb-site">
        <div id="page-wrapper" style="padding-top:unset;">
            <?php
            require_once($doc_root . '/includes/header.php');
            require_once($doc_root . '/includes/left-menu.html');
            ?>
            <div class="divider"></div>
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
                                    <div class="col-md-9 col-sm-2 col-xs-2" id="interventioForm"
                                        style="padding-top:15px;">
                                        <form method="POST" action="" class="form-horizontal" name="stepOne"
                                            id="stepOne" data-form-id="1" enctype="multipart/form-data">
                                            <h3 class="page-title text-white text-center">
                                                INTERVENTION REPORT
                                            </h3>
                                            <input type="hidden" id="existing_ir_id" name="existing_ir_id"
                                                value="<?php echo $record_id ?>" />
                                            <input type="hidden" class="report_stage" id="report_stage"
                                                name="report_stage" value="Proposal" />
                                            <div class="form-group">
                                                <label for="post_title"
                                                    class="col-md-3 col-sm-3 col-xs-6 control-label">Post Title</label>
                                                <div class="col-md-6 col-sm-3 col-xs-6 ">
                                                    <input type="text" class="form-control" id="post_title"
                                                        name="post_title" value="<?php echo $post_title ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="ir_url"
                                                    class="col-md-3 col-sm-3 col-xs-6 control-label">URL:</label>
                                                <div class="col-md-6 col-sm-3 col-xs-6 ">
                                                    <input type="text" class="form-control" id="ir_url" name="ir_url"
                                                        value="<?php echo $ir_url ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="country_type"
                                                    class="col-md-3 col-sm-3 col-xs-6 control-label">Country</label>
                                                <div class="col-md-6 col-sm-3 col-xs-6 ">
                                                    <select name="country_type" class="form-control" id="country_type">
                                                        <?php
                                                        foreach ($countryarr as $x => $x_value) {
                                                            if ($row["country_id"] == $x) {
                                                                echo '<option value="' . $x . '" selected="selected">' . $x_value . '</option>';
                                                            } else {
                                                                echo '<option value="' . $x . '">' . $x_value . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="category_type"
                                                    class="col-md-3 col-sm-3 col-xs-6 control-label">Intervention</label>
                                                <div class="col-md-6 col-sm-3 col-xs-6 ">
                                                    <select name="category_type" class="form-control"
                                                        id="category_type">
                                                        <option value=""
                                                            <?php echo !isset($row["category"]) ? "selected" : ""; ?>>
                                                            Select a category</option>
                                                        <option value="Child Survival"
                                                            <?php echo isset($row["category"]) && $row["category"] === "Child Survival" ? "selected" : ""; ?>>
                                                            Child Survival</option>
                                                        <option value="Water"
                                                            <?php echo isset($row["category"]) && $row["category"] === "Water" ? "selected" : ""; ?>>
                                                            Water
                                                        </option>
                                                        <option value="Health"
                                                            <?php echo isset($row["category"]) && $row["category"] === "Health" ? "selected" : ""; ?>>
                                                            Health
                                                        </option>
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
                                            </div>
                                            <div class="error-text" style="    margin: 25px 270px;"></div>
                                            <div class="success-text"></div>
                                            <center style="padding-bottom:15px;">
                                                <a href="<?php echo $root?>intervention_report/dashboard.php"
                                                    type="button" class="btn btn-primary"><span class="icon"><img
                                                            class="btn-icon"
                                                            src="<?php echo $root?>images/arrow-right.png"
                                                            style="transform: rotate(180deg);"></span>&nbsp;Back</a>
                                                <button type="submit" class="stepOneF btn btn-primary">Submit&nbsp;
                                                    <span class="icon">
                                                        <img class="btn-icon"
                                                            src="<?php echo $root?>images/arrow-right.png">
                                                    </span>
                                            </center>
                                        </form>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="container hide" id="no-data" style="margin-top: 100px;">
                            <h2 id="stats" style="text-align: center;">NO RECORDS TO DISPLAY</h2>
                        </div>
                        <div class="space_div" style="margin:0 0 60px 0; "></div>
                        <?php if (!empty($record_id)) { ?>

                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"
                            id="dynamic-table-example-1" style="width: 100%;margin-left: 0px;">
                            <thead>
                                <tr>
                                    <th class="text-center">Stage</th>
                                    <th class="text-center">Status </th>
                                    <th class="text-center">Published Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                        </table>
                        <?php } ?>
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

    <script>
    function createSlug(text) {
        const removeSpecialCharsRegex = /[^\w\s-]/g;
        const replaceMultipleSpacesRegex = /\s+/g;
        const leadingTrailingHyphensRegex = /^-+|-+$/g;
        const slug = text
            .toLowerCase()
            .replace(removeSpecialCharsRegex, '')
            .replace(replaceMultipleSpacesRegex, '-')
            .replace(leadingTrailingHyphensRegex, '');
        return slug;
    }
    $(document).ready(function() {

        const postTitleInput = document.getElementById("post_title");
        const ir_urlInput = document.getElementById("ir_url");
        if (postTitleInput) {
            postTitleInput.addEventListener("change", function() {
                const title = postTitleInput.value;
                const slug = createSlug(title);
                ir_urlInput.value = slug;
            });
        }

        $('#post_title').on('keyup', function() {
            const postTitle = $(this).val();
            const submitButton = $('.stepOneF');
            const errorDiv = $(".error-text");

            submitButton.attr('disabled', false);
            errorDiv.html("");

            $.ajax({
                url: root + "/_ajax/intervention_report/__single_report_details.php",
                type: 'POST',
                data: {
                    post_title: postTitle,
                    check: 1
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response.status)
                    if (response.status === 'matched') {
                        submitButton.attr('disabled', true);
                        errorDiv.html(
                            "<span style='border: 2px solid red; padding: 1rem; color: red; font-weight: bold; display: initial; text-align: center;'>Post title already exists</span>"
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });


        var formOne = "#stepOne";
        var form_btn = $(formOne).find(".stepOneF");
        var success_text = $(formOne).find('.success-text');
        var error_text = $(formOne).find('.error-text');
        $(formOne).validate({
            rules: {
                post_title: "required",
                report_stage: "required",
                country_type: "required",
                category_type: "required",
                ir_url: "required"
            },
            submitHandler: function(form) {
                form_btn.attr("disabled", true);
                form_btn.html('<img src="' + root + 'images/blue-load.gif"/>');
                var formData = new FormData();
                formData.append('step', 'stepOne');
                formData.append('post_title', $(form).find("#post_title").val());
                formData.append('ir_url', $(form).find("#ir_url").val());
                formData.append('report_stage', $(form).find("input[name='report_stage']").val());
                formData.append('country', $(form).find("#country_type").val());
                formData.append('category_type', $(form).find("#category_type").val());
                $.ajax({
                    url: root + "/_ajax/intervention_report/__intervention_form.php",
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    cache: true,
                    processData: false,
                    success: function(response) {
                        error_text.html("");
                        if (response.status == 1) {
                            success_text.html(
                                '<p style="color: green;font-weight: 600;text-align: center;">Thank you for your request.</p>'
                            );
                            form.reset(); // Reset the form values
                            window.location.href = "dashboard.php";
                        } else if (response.status == 0) {
                            success_text.html(
                                '<p style="color: red;font-weight: 600;text-align: center;">' +
                                response.status_text + '</p>');
                        }
                        form_btn.html(
                            'Submit <span class="icon"><img class="btn-icon" src="' +
                            root + 'images/arrow-right.png"></span>').attr(
                            "disabled", false);
                    }
                });
            }
        });

    });
    </script>
</body>

</html>
<?php
ob_end_flush();
?>