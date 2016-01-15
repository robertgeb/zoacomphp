<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Jim</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
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
        <div id="sidebar">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="http://localhost/~robert/robo/">
                        Robot Jim
                    </a>
                </li>
                <li>
                    <a href="http://localhost/~robert/robo/">
                        Home
                    </a>
                    <a href="noticias" class="dropdown">
                        <a aria-expanded="false" class="dropdown-toggle" data-toggle="dropdown" href="#">
                          Notícias <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                          <li><a href="http://localhost/~robert/robo/noticias/ultimas">Ultimas</a></li>
                          <li><a href="http://localhost/~robert/robo/noticias/sincronizar">Sincronizar</a></li>
                        </ul>
                    </a>
                </li>
            </ul>
        </div>
        <div id="content" style="display: none;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">

                        <!-- Titulo  -->

                        <?php echo $output['title']; ?>

                        <!-- Conteudo -->

                        <?php echo $output['content']; ?>
                    </div>
                </div>
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
