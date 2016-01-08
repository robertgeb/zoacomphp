<?php

  ini_set('display_errors', 'On');
  error_reporting(E_ALL);
  /*
        URL
  */
  $site = "politica.estadao.com.br";

  function clean($var) {

  	$var = strtolower($var);

    $map = array(
      'á' => 'a',
      'à' => 'a',
      'ã' => 'a',
      'â' => 'a',
      'é' => 'e',
      'ê' => 'e',
      'í' => 'i',
      'ó' => 'o',
      'ô' => 'o',
      'õ' => 'o',
      'ú' => 'u',
      'ü' => 'u',
      'ç' => 'c',
      'Á' => 'A',
      'À' => 'A',
      'Ã' => 'A',
      'Â' => 'A',
      'É' => 'E',
      'Ê' => 'E',
      'Í' => 'I',
      'Ó' => 'O',
      'Ô' => 'O',
      'Õ' => 'O',
      'Ú' => 'U',
      'Ü' => 'U',
      'Ç' => 'C'
  );

    $string = strtr($var, $map); // corrompe os caracteres acentuados
    $string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.
    $string = preg_replace('/[^A-Za-z0-9\_]/', '', $string); // Removes special chars.

    return preg_replace('/_+/', '_', $string);
  }

  function lerFrase($texto)
  {
    //Soma a cada verbo encontrado
    $soma = 0;

    $classe = "";

    $htmlDicio = new DOMDocument();

    //Array com resultado
    $resultado = array(
      'palavras' => 0,
      'verbos' => array(),
      'substantivos' => array(),
      'nome' => array(),
      'preposicao' => array(),
      'outros' => array(),
      'falhas' => array()
    );

    //Limpa o texto de caracteres especiais e acentuacoes
    $texto = clean($texto);

    //Separa a palavra
    $palavra = strtok($texto, "_");
    $done = (false===$palavra);
    while(!$done && $palavra != "" && $palavra != " " && $palavra != "-"){
      $soma++;
      $resultado['palavras'] = $soma;
      $ch = curl_init();
      $timeout = 5;
      curl_setopt($ch, CURLOPT_URL, "http://www.dicio.com.br/$palavra/");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
      $data = curl_exec($ch);
      curl_close($ch);
      // $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));
      // $data = @file_get_contents("http://dicio.com.br/$palavra", false, $context);
      if ($data !== false) {
        // return $resultado;
        @$htmlDicio->loadHTML($data);
        // usleep(250);
        $significado = $htmlDicio->getElementById('significado');
        if ($significado) {
          $significado = $significado->nodeValue;
          $classe = substr($significado,0,1);
        }

        if ($classe == "v")
        {
          $resultado['verbos'][] = $palavra;
        }else if($classe == "s")
        {
          $resultado['substantivos'][] = $palavra;
        }else if($classe == "p")
        {
          $resultado['preposicao'][] = $palavra;
        }
        else {
          $resultado['outros'][] = $palavra;
          $resultado['falhas'][] = $palavra;
        }
      }else {
        // echo "Falha";
        // exit();
        // return $resultado;
        $resultado['falhas'][] = $palavra;
      }
      // break;
      $palavra = strtok("_");
    }
    return $resultado;
  }

  //Classe para tratar DOM
  $html = new DOMDocument();
  if(@!$html->loadHTMLFile("http://".$site)){
    echo "Falha";
    exit();
  }
  $xpath = new DOMXPath($html);
  $element = $xpath->query("//a[@href]/h2[@class='titulo']");
  //Captura cada link
  $links = array();
  $output = "<ol>";
  foreach ($element as $key => $value) {
    $conteudo = $value->nodeValue;
    // $link = $value->previousSibling->nodeAttribute('href');
    $verbos = 0;
    if (str_word_count($conteudo)>2) {
      $result = lerFrase($conteudo);
      $output .= "<li>"
        .$conteudo
        ."<br><small>$link</small>"
        ."<br>Palavras: ".$result['palavras']
        ."<h4><br>Verbos: ".implode(",", $result['verbos'])
        ."<br>Substativos: ".implode(",", $result['substantivos'])
        ."<br>Preposições: "
        .implode(",", $result['preposicao'])
        ."<br>Palavras não reconhecidas: "
        .implode(",", $result['falhas'])
        ."</h4></li>";
        if ($key == 4) {
          # code...
          break;
        }
      // $links[] = array(
      //   'url' => $link,
      //   'text' => $conteudo
      // );
    }
  }

  $output .= "</ul>";
  // $output = print_r($links);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>robo</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <h1>
          <?php
            echo $site;
           ?>
        </h1>
        <hr>
        <h3>
          <?php
            echo $output;
           ?>
        </h3>
      </div>
    </div>
  </body>
</html>
