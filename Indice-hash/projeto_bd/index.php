<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto de Banco de Dados</title>
    <style>
        body
        {
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
            background-image: radial-gradient(circle at 0% 0%, #dc54c9 0, #cc4dcd 16.67%, #b947d1 33.33%, #a342d4 50%, #893fd7 66.67%, #693edb 83.33%, #393fde 100%);
            padding: 10px 10px 10px 10px;
            width: 400px;
            height: 400px;
            display: table;
            border-radius: 20px;
        }
        .campo{
            color: white;
            font-size: 22px;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
        button{
            background-color: #008CBA;
            border-radius: 10px;
            border-color: whitesmoke;
            color: white;
            padding: 12px 28px;
            text-align: center;
            text-decoration: none;
            float: left;
            font-size: 16px;
            font-weight: bold;
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
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }
        input{
            border-radius:4px;
            -moz-border-radius:4px;
            -webkit-border-radius:4px;
            box-shadow: 1px 1px 2px #333333;
            -moz-box-shadow: 1px 1px 2px #333333;
            -webkit-box-shadow: 1px 1px 2px #333333;
            background: white;
            border:1px solid white;
            width:150px;
            text-align: center;
            font-size: 28px;
            font-family: Arial, sans-serif;
        }
    

    </style>

</head>
<body>
        <div class="cabecalho">
            <h1>Aplicação do projeto de Banco de Dados</h1>
        </div>

        <div class="content">
            <form action="main.php" method="post" enctype="multipart/form-data">
                <div class="campo">
                    <label>Informe o tamanho da página</label> <br><br>
                </div>
                <div class="campo">
                    <input type="number" name="tamanhoPagina" required="Preencha este campo!"><br><br>  
                </div>
                <div class="campo">
                    <label>Informe o tamanho dos buckets</label> <br><br>
                </div>
                <div class="campo">
                    <input type="number" name="tamanhoBucket" required="Preencha este campo!"><br><br>  
                </div>
                <div class="campo">
                    <label>Informe a chave de busca</label> <br><br>
                </div>
                <div class="campo">
                    <input type="text" name="key" required="Preencha este campo!"><br><br>  
                </div>                    
                <div class="btn">
                    <button type="submit">Enviar</button>
                </div>
            </form>
        </div>
</body>
</html>