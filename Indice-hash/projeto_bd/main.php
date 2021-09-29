<?php
ini_set('memory_limit', '400M');
require_once("provider.php");
//primeiras variaveis
$tamanho_pagina = $_POST['tamanhoPagina']; //passado no index.php
$chave = $_POST['key']; //passado no index.php
$FR = $_POST['tamanhoBucket']; //passado no index.php
$NR = count(file("dados.txt")); //tamanho dos buckets
$NB = ceil($NR / $FR); //tamanho dos buckets
//criando tabela e paginas
$table = new Table(); //criando tabela
$page = new Page($tamanho_pagina); //criando a pagina
$bucket = new Bucket($NB,$FR); //criando o bucket
//abrindo o arquivo local
$arq_local = "dados.txt";
$arq_local_aberto = fopen($arq_local,"r");
$linha = fgets($arq_local_aberto);
//manipulações iniciais
$i = 0;
while($linha){
    $key = trim($linha); //limpando o dado recebido
    $tupla = new Tupla($key); //criando uma tupla
    $table->insert($tupla); //adicionando a tupla na tabela
    $page->insert($tupla); //adicionando a tupla na pagina
    //echo "inserindo no bucket a chave " .$key ." com a hash ".hashCode($key,$NB)." e sua pagina é ".floor($i/$tamanho_pagina)."<br>";
    $bucket->insert($key, hashCode($key,$NB),floor($i/$tamanho_pagina));//inserindo a chave da tupla e a posicao sua posicao na pagina dentro do bucket
    $i++; 
    $linha = fgets($arq_local_aberto);
}

//visualização dos dados
//$table->show();
//$page->show();
//$bucket->show();
//$tuplaprocurada = query($bucket,$page,$NB,$chave);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu principal</title>
    <style>
        body{
            background-image: radial-gradient(circle at 0% 0%, #9056d9 0, #734cd6 25%, #4d42d4 50%, #003ad2 75%, #0035cf 100%);
        }
        .cabecalho{
            display: flex;
            justify-content: center;
            font-family: Arial, sans-serif;
        }
        .content{
            display: flex;
            justify-content: center;
        }
        form{
            background-image: linear-gradient(135deg, #66c1ff 0, #0c7bed 50%, #003b84 100%);
            padding: 10px 10px 10px 10px;
            width: 400px;
            height: 400px;
            display: block;
            border-radius: 20px;
        }
        .campo{
            color: white;
            font-size: 22px;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        button{
            background-color: #008CBA;
            border-radius: 10px;
            color: white;
            padding: 12px 28px;
            text-align: center;
            text-decoration: none;
            float: left;
            font-size: 12px;
            transition-duration: 0.4s;
            cursor:pointer;
        }
        button:hover {
            background-color: #4CAF50; /* Green */
            color: white;
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
        }
        .btn{
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }
        h1{
            color: white;
        }
        input[type=text]{
            border-radius:4px;
            -moz-border-radius:4px;
            -webkit-border-radius:4px;
            box-shadow: 1px 1px 2px #333333;
            -moz-box-shadow: 1px 1px 2px #333333;
            -webkit-box-shadow: 1px 1px 2px #333333;
            background: white;
            border:1px solid white;
            width:250px;
            text-align: center;
            font-size: 28px;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
</body>
</html>