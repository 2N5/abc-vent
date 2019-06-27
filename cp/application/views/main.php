<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $this->meta_title; ?> Certificate</title>
        <!-- Bootstrap -->
        <link href="/cp/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- styles -->
        <link href="/cp/assets/css/styles.css" rel="stylesheet">

        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

        <link href="/cp/assets/vendors/form-helpers/css/bootstrap-formhelpers.min.css" rel="stylesheet">
        <link href="/cp/assets/vendors/select/bootstrap-select.min.css" rel="stylesheet">
        <link href="/cp/assets/vendors/tags/css/bootstrap-tags.css" rel="stylesheet">

        <link href="/cp/assets/css/forms.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="//cdn.ckeditor.com/4.5.7/full/ckeditor.js"></script> 



    </head>
    <body>
        <?php include dirname(__FILE__) . '/layouts/' . $this->layout . '.php'; ?>

        <script src="/cp/assets/bootstrap/js/bootstrap.min.js"></script>
        
        <script src="/cp/assets/vendors/form-helpers/js/bootstrap-formhelpers.min.js"></script>
        <script src="/cp/assets/vendors/select/bootstrap-select.min.js"></script>
        <script src="/cp/assets/vendors/tags/js/bootstrap-tags.min.js"></script>
        <script src="/cp/assets/vendors/mask/jquery.maskedinput.min.js"></script>
        <script src="/cp/assets/vendors/moment/moment.min.js"></script>
        <script src="/cp/assets/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>

        <!-- bootstrap-datetimepicker -->
        <link href="/cp/assets/vendors/bootstrap-datetimepicker/datetimepicker.css" rel="stylesheet">
        <script src="/cp/assets/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script> 


        <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
        <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

        <script src="/cp/assets/js/custom.js"></script>
        <script src="/cp/assets/js/forms.js"></script>        
        <script src="/cp/assets/js/functions.js"></script>
        <script src="/cp/assets/js/main.js"></script>

        <script>
            CKEDITOR.replace('editor');
            CKEDITOR.replace('editor1');
        </script>
        
        <script>
//        $('input, textarea, select').addClass('form-control').wrap("<div class='form-group'></div>");
        $('input, textarea, select').addClass('form-control');
        $('[type="submit"], [type="button"]').removeClass('form-control').addClass('btn btn-success');
        </script>
    </body>
</html>
