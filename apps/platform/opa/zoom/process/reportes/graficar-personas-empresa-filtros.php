<?php require_once ('../../../appInit.php');

    $complement     = "";
    $complement2    = [];
    $estructure     = "";

    if($_POST["id_categoria"] == ""){

    }else if($_POST["id_categoria"] == 0){
        $estructure = "categoria:0";
    }else if($_POST["id_categoria"] > 0){
        $complement .= " AND CAT.id = ".$_POST["id_categoria"]. " ";
        $estructure = "categoria:".$_POST["id_categoria"].",competencia:0";
    }

    if($_POST["id_competencia"] != 0){
        $complement .= " AND COMPE.id = ".$_POST["id_competencia"]. " ";
        $estructure = "categoria:".$_POST["id_categoria"].",competencia:".$_POST["id_competencia"].",comportamiento:0";
    }

    if($_POST["id_comportamiento"] != 0){
        $complement .= " AND COM.id = ".$_POST["id_comportamiento"]. " ";
        $estructure = "categoria:".$_POST["id_categoria"].",competencia:".$_POST["id_competencia"].",comportamiento:".$_POST["id_comportamiento"];
    }


    if(isset($_POST["segmentos"])){
        foreach ($_POST["segmentos"] as $key => $linea) {
            foreach ($linea as $key2 => $opcion) {
                if($opcion != 0) $complement2[$key][$key2] = intval($opcion);
            }
        }
        empty($complement2);
        if((empty($complement2))){
            $complement2 = "";
        }else{
            $complement2 = serialize($complement2);
        }
    }

    // if($complement2 != "") $complement2 .= " || ";
    // $complement2 .= " OPT.id = ".$_POST["segmento1"]. " ";

    // $complement2 = ' AND ('.$complement2.')';



    // echo '<pre class="taL color333">';
    // echo serialize($complement2);
    // echo '</pre>';

    echo '
        <div id="rsp_modalGraph" class=""></div>
        <script>Zoom.modalGraph("graficar-personas-empresa-multi", "'.$_POST["id"].'", "'.$complement.'", "'.$complement2.'", '.$_POST["duo"].', "'.$estructure.'");</script>
    ';

?>