<?php
include('../config.php');
$templatePath = dirname(__FILE__);
$uploadPath = $templatePath . "/uploads/";
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <script src="<?php echo $root; ?>js/plugins/jquery-compassionuk.min.js"></script>
    <!-- CONTENT JS-->
    <script src="https://cdn.tiny.cloud/1/9a7n5irddkx00ptgu1yamssye7myj0thcw21aaqt5805qwua/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="<?php echo $root; ?>js/plugins/compassionuk.jquery.validate.min.js"></script>
</head>

<body>
    <form method="POST" id="stepSix" enctype="multipart/form-data">
        <div class="form-group">
            <label for="executive_text" class="col-md-3 col-sm-3 col-xs-6 control-label">Text</label>
            <div class="col-md-6 col-sm-3 col-xs-6 ">
                <textarea type="text" class="form-control executive_text" id="executive_text" name="executive_text"
                    rows="9"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="executive_text_2" class="col-md-3 col-sm-3 col-xs-6 control-label">Text</label>
            <div class="col-md-6 col-sm-3 col-xs-6 ">
                <textarea type="text" class="form-control executive_text" id="executive_text_2" name="executive_text_2"
                    rows="9"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="executive_text_2" class="col-md-3 col-sm-3 col-xs-6 control-label">Text</label>
            <div class="col-md-6 col-sm-3 col-xs-6 ">
                <textarea type="text" class="form-control executive_text" id="executive_text_2" name="executive_text_2"
                    rows="9"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="executive_text_2" class="col-md-3 col-sm-3 col-xs-6 control-label">Text</label>
            <div class="col-md-6 col-sm-3 col-xs-6 ">
                <textarea type="text" class="form-control executive_text" id="executive_text_2" name="executive_text_2"
                    rows="9"></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary stepSixBtn">Next&nbsp;</button>
    </form>
    <script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
    var root = location.protocol + '//' + location.host + "/";
    $(document).ready(function() {
        var formSix = "#stepSix";
        var stepSixBtn = $(formSix).find(".stepSixBtn");
        var objectivesIconFiles = $(".executive_text");

        $(formSix).validate({
            rules: {
                "objectivesText[]": {
                    required: true
                },
            },
            submitHandler: function(form) {
                if ($(formSix).valid()) {
                    tinyMCE.triggerSave();
                    var formData = new FormData();
                    var objectivesDetails = [];
                    formData.append('step', 'stepSix');

                    if (objectivesIconFiles.length > 0) {
                        objectivesIconFiles.each(function() {
                            var objectivesText = $(this).val();
                            objectivesDetails.push({
                                objectivesText: objectivesText
                            });
                            formData.append('objectivesText[]', objectivesText);
                        });
                    }
                    console.log(objectivesDetails)
                    formData.append('ObjectivesDetails', JSON.stringify(objectivesDetails));

                    $.ajax({
                        url: root + "/_ajax/intervention_report/__intervention_form.php",
                        type: "POST",
                        data: formData,
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response) {
                            // Handle success response
                        }
                    });
                }
            }
        });
    });
    </script>
</body>

</html>