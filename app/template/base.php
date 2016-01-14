<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Jim</title>
        <!-- <link href="public/css/bootstrap.min.css" rel="stylesheet"> -->
        <style>
            <?php echo file_get_contents(ROOT . DS . "public" . DS . "css" . DS . "bootstrap.min.css"); ?>
        </style>
        <!-- <link href="public/css/style.css" rel="stylesheet"> -->
        <style>
            <?php echo file_get_contents(ROOT . DS . "public" . DS . "css" . DS . "style.css"); ?>
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <!-- Titulo  -->

                <h1> <?php echo $title; ?> </h1>

                <!-- Conteudo -->

                <p>
                    <?php echo $content ?>
                </p>
            </div>
        </div>
        <!-- <script src="public/js/jquery.min.js"></script> -->
        <script type="text/javascript">
            <?php echo file_get_contents(ROOT . DS . "public" . DS . "js" . DS . "jquery.min.js") ?>
        </script>
        <!-- <script src="public/js/bootstrap.min.js"></script> -->
        <script type="text/javascript">
            <?php echo file_get_contents(ROOT . DS . "public" . DS . "js" . DS . "bootstrap.min.js") ?>
        </script>
        <!-- <script src="public/js/script.js"></script> -->
        <script type="text/javascript">
            <?php echo file_get_contents(ROOT . DS . "public" . DS . "js" . DS . "script.js") ?>
        </script>
    </body>
</html>
