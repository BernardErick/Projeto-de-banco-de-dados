<?php
class Tupla {  //objeto tupla, contém uma chave e um valor
    public $key; public $value;
    public function __construct($key) {$this->key = $key; $this->value = $key;}
    public function getKey(){return $this->key;}     //retorna a chave
    public function getValue(){return $this->value;} //retorna o valor
}
class Table {  //objeto table, responsavel por acumular objetos tupla
    public $tuplas = array(); //estrutura de dados interna
    public function insert($value) { array_push($this->tuplas,$value); }//insere o valor na tabela de forma indexada
    public function show(){
        echo "
        <style>
            #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            }
            #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
            }
            #customers tr{background-color: #f2f2f2;}
            #customers tr:hover {background-color: #ddd;}
            #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color:green;
            color: white;
            }
        </style>";
        echo "<table id='customers'>";
        for($i = 0; $i< count($this->tuplas);$i++){
            echo <<<END
                <tr>
                    <th>Índice</th>
                    <th>Chave</th>
                    <th>Valor</th>
                </tr>
                <tr>
                    <td><b>{$i}</b></td>
                    <td><b>{$this->tuplas[$i]->key}</b></td>
                    <td><b>{$this->tuplas[$i]->value}</b></td>
                </tr>
            END;
        }
        echo "</table>";
        //var_dump($this->tuplas);
    }
}
class Page{
    public $pages = array();
    public $numPages = 0;public $pageIndex = 0;public $lenPage;public $len = 0;
    public function __construct($lenPage) {$this->lenPage = $lenPage;}
    public function insert($valor) {
        if($this->pageIndex < $this->lenPage){  //verifica se naquela página, ainda tem espaço pra por
            $this->pages[$this->numPages][$this->pageIndex] = $valor; //caso tiver, adicione 'naquela' pagina e 'naquel'e indice o valor
            $this->pageIndex++; //depois pule para o proximo indice da pagina
            if($this->pageIndex >= $this->lenPage){ //verifica se o atual indice da pagina passou do limite
                $this->numPages++; //caso tiver, avance para a proxima pagina
                $this->pageIndex = 0;//caso tiver, retorne para o indice 0 
            }
            $this->len++; //valor adicionado e contado
        }
    }
    public function show(){
        echo "
        <style>
            #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            }
            #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
            }
            #customers tr{background-color: #f2f2f2;}
            #customers tr:hover {background-color: #ddd;}
            #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color:green;
            color: white;
            }
        </style>";
        echo <<<END
            <table id="customers">
            <tr>
                <th>Páginas</th>
                <th>Tuplas</th>
            </tr>
        END;
        foreach($this->pages as $indice => $this->numPages){

            if(isset($indice)){
                echo <<<END
                    <tr>
                        <td><b>$indice</b></td>
                END;
                echo "<td>";
                foreach($this->pages[$indice] as $index){
                    echo <<<END
                        <b>Chave:</b> {$index->key} || <b>Valor:</b> {$index->value}<br>
                    END;
                }
                echo "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
    }
    public function getNumberOfPages(){return $this->numPages;}
    public function findkey($key,$page){
        if($page == -1){
            echo "<h2>Chave não existe.😜</h2>";
        } else {
                foreach($this->pages[$page] as $page ){
                    if($page->key == $key){
                            return $page; 
                    }
                }
            }
        return null;
    }
}
class Bucket{
    public $bucket = array();public $NB; public $FR;public $bk_size = 0;
    public function __construct($NB,$FR){$this->FR = $FR;$this->NB = $NB;} 
    public function insert($value,$index,$pageindex){
        if(!isset($this->bucket[$index]))
            $this->bucket[$index] = new BucketFragment($this->FR);
        $this->bucket[$index]->insert($value,$pageindex);
    }
    public function show(){
        foreach($this->bucket as $bk){
            $bk->show();
            echo "<br>";
        }
    }
    public function findkey($key,$hashkey){
        $page = $this->bucket[$hashkey]->findkey($key);
        return $page;
    }
}
class BucketFragment{ //vai ter um por posição no bucket / estrutura de dados que faz a mecanica com o FR
    public $bucketFragment = array();public $FR; public $idx = 0;public $idx2 = 0;
    public $collisions = 0;public $overflow = false;
    public function __construct($FR){$this->FR = $FR;} 
    public function insert($key,$pageindex){
        $obj = new stdClass();
        $obj->key = $key; $obj->pageindex = $pageindex; //criando um objeto predefinido para guardar chave e posicao

        if($this->idx2 == $this->FR){
            $this->idx2 = 0;$this->idx++;$this->overflow = true;
        }
        if($this->overflow === true)
            $this->collisions++;
        $this->bucketFragment[$this->idx][$this->idx2] = $obj;$this->idx2++; 
    }
    public function show(){
        //var_dump($this->bucketFragment);
        echo "
        <style>
            #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            }
            #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
            }
            #customers tr:hover {background-color: #ddd;}
            #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #1355FA;
            color: white;
            }
        </style>";
        echo "<table id='customers'>";
        echo "<tr><th>BucketFragment</th></tr>";
        echo "<tr><th>Overflows: {$this->getOverflows()} || Colisões: {$this->getCollisions()}</th></tr>";
        for($i = 0; $i< count($this->bucketFragment);$i++){      
            for($j = 0; $j < count($this->bucketFragment[$i]);$j++){
                if($i >= 1){ //overflow pra cima
                    echo <<<END
                    <tr style='background-color: #B31200'>
                        <td><b>{$this->bucketFragment[$i][$j]->key} || página {$this->bucketFragment[$i][$j]->pageindex}</b></td>
                    </tr>
                    END;                
                }
                else{
                    echo <<<END
                        <tr style ='background-color: #68B009'>
                            <td><b>{$this->bucketFragment[$i][$j]->key} || página {$this->bucketFragment[$i][$j]->pageindex}</b></td>
                        </tr>
                    END;
                }  

            }
        }
        echo "</table>";

    }
    public function getOverflows(){return $this->idx;} //retorna overflows
    public function getCollisions(){return $this->collisions;} //retorna colisoes
    public function findkey($key){
        for($i = 0; $i < count($this->bucketFragment);$i++){
            for($j = 0;$j < count($this->bucketFragment[$i]);$j++){
                if($key == trim($this->bucketFragment[$i][$j]->key)){
                    return $this->bucketFragment[$i][$j]->pageindex;
                }
            }
        }
        return -1;
    }
}
//implementação da hash code
function hashCode ($str,$NB){ 
    $hash = 0;
    $length = strlen($str);
    for($i = 0; $i < $length; $i++) {
        $hash = (31 * $hash + ord($str[$i])) % $NB;
    }
    return $hash;
}
function query($bucket,$page,$NB,$key){
    $hashkey = hashCode($key,$NB); //passando a hash na chave de busca
    $pos_pagina = $bucket->findkey($key,$hashkey); //encontrando a posicao na pagina dessa chave com hash
    $tupla = $page->findkey($key,$pos_pagina); //procurando a tupla na pagina
    if(isset($tupla)){
        echo "
        <style>
            #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            }
            #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
            }
            #customers tr{background-color: #f2f2f2;}
            #customers tr:hover {background-color: #ddd;}
            #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            color: white;
            background-color:green; 
            }
        </style>";
        echo <<<END
            <table id="customers">
                <tr>
                    <th>Chave procurada</th>
                    <th>Valor encontrado</th>
                </tr>
                <tr>
                    <td><b>$tupla->key</b></td>
                    <td><b>$tupla->value</b></td>
                </tr>
            </table>
        END;
    }
    
}
