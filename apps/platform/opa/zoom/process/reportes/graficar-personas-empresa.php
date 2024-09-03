<?php require_once ('../../../appInit.php');

    $estructure = [];
    if (isset($_POST["conditions"]) && $_POST["conditions"] != "") {
        $a = explode(',', $_POST["conditions"]);
        foreach ($a as $key => $value) {
            $b = explode(':', $value);
            $estructure[$b[0]] = $b[1];
        }
    }


    $complement = "";
    $complement2 = "";

    if(isset($estructure["categoria"]) && $estructure["categoria"] != 0 && $estructure["categoria"] != ""){
        $complement .= " AND CAT.id = ".$estructure["categoria"]. " ";
    }

    if(isset($estructure["competencia"]) && $estructure["competencia"] != 0){
        $complement .= " AND COMPE.id = ".$estructure["competencia"]. " ";
    }

    if(isset($estructure["comportamiento"]) && $estructure["comportamiento"] != 0){
        $complement .= " AND COM.id = ".$estructure["comportamiento"]. " ";
    }


    $cond           = isset($_POST["cond"]) && $_POST["cond"] != "" ? $_POST["cond"] : "";
    $cond2          = isset($_POST["cond2"]) && $_POST["cond2"] != "" ? $_POST["cond2"] : "";
    $duo            = isset($_POST["duo"]) && $_POST["duo"] ? 1 : 0;
    $test["eq"]     = 20;
    $thisEvaluacion = $_TUCOACH->get_data("grw_tuc_p2b_estudios", " AND id = ".$_POST["id"]." AND eliminado = 0 ORDER BY id DESC ", 0);

    if($thisEvaluacion){

        $testG = $_TUCOACH->get_data("grw_tuc_paquetests", " AND id = ".$thisEvaluacion["id_grupotests"]." AND  eliminado = 0 ORDER BY id DESC ", 0);

        $ross = $_TUCOACH->get_data( $complement.$cond." AND EMP.id = {$thisEvaluacion["id_empresa"]} AND ASIG.id_evaluacion = {$thisEvaluacion["id"]} ORDER BY CAT.id DESC ", $complement2.$cond2." AND EMP.id = {$thisEvaluacion["id_empresa"]} AND ASIG.id_evaluacion = {$thisEvaluacion["id"]} ");

        if(!isset($estructure["categoria"])|| $estructure["categoria"] == ""){

            $myData[0]["graph"] = 'bar';
            $myData[0]["title"] = "Evaluación General";
            $myData[0]["labels"][] = ($testG["nombre"]);
            $myData[0]["datasety"][1]["label"] = 'Área';
            $myData[0]["datasety"][1]["data"][] = round($ross[0]["calculos"][1]["promedio"],2);
            if($duo) $myData[0]["datasety"][2]["label"] = 'Empresa';
            if($duo) $myData[0]["datasety"][2]["data"][] = round($ross[0]["calculos"][2]["promedio"],2);

        } else if(isset($estructure["categoria"]) && $estructure["categoria"] == 0){


            $myData[0]["graph"] = 'bar';
            $myData[0]["title0"] = "Gráfica del Test";
            $myData[0]["title"] = ($testG["nombre"]);
            foreach($ross[1] AS $categoria){
                if($categoria){
                    $myData[0]["labels"][] = ($categoria["nombre"]);
                    $myData[0]["datasety"][1]["label"] = 'Área';
                    $myData[0]["datasety"][1]["data"][] = round($categoria["calculos"][1]["promedio"],2);
                    if($duo) $myData[0]["datasety"][2]["label"] = 'Empresa';
                    if($duo) $myData[0]["datasety"][2]["data"][] = round($categoria["calculos"][2]["promedio"],2);
                }
            }

        }else if(isset($estructure["competencia"]) && $estructure["competencia"] == 0){

            $myData[0]["graph"] = 'bar';
            foreach($ross[1] AS $categoria){
                $myData[0]["title0"] = "Gráfica de la Categoría";
                $myData[0]["title"] = ($categoria["nombre"]);
                if($categoria){
                    ($categoria["nombre"]);
                    round($categoria["calculos"][1]["promedio"],2);
                    round($categoria["calculos"][2]["promedio"],2);
                    foreach($categoria["competencias"] AS $competencia){
                        $myData[0]["labels"][] = ($competencia["nombre"]);
                        $myData[0]["datasety"][1]["label"] = 'Área';
                        $myData[0]["datasety"][1]["data"][] = round($competencia["calculos"][1]["promedio"],2);
                        if($duo) $myData[0]["datasety"][2]["label"] = 'Empresa';
                        if($duo) $myData[0]["datasety"][2]["data"][] = round($competencia["calculos"][2]["promedio"],2);
                    }
                }
            }

        }else if(isset($estructure["comportamiento"]) && $estructure["comportamiento"] == 0){

            $myData[0]["graph"] = 'bar';
            foreach($ross[1] AS $categoria){
                if($categoria){
                    foreach($categoria["competencias"] AS $competencia){
                        $myData[0]["title0"] = "Gráfica de la Competencia";
                        $myData[0]["title"] = ($competencia["nombre"]);
                        foreach($competencia["comportamientos"] AS $comportamiento){
                            $myData[0]["labels"][] = ($comportamiento["nombre"]);
                            $myData[0]["datasety"][1]["label"] = 'Área';
                            $myData[0]["datasety"][1]["data"][] = round($comportamiento["calculos"][1]["promedio"],2);
                            if($duo) $myData[0]["datasety"][2]["label"] = 'Empresa';
                            if($duo) $myData[0]["datasety"][2]["data"][] = round($comportamiento["calculos"][2]["promedio"],2);
                        }
                    }
                }
            }

        }


        // echo '<pre>';
        // print_r($myData);
        // echo '</pre>';


        if ($myData) {
			foreach ($myData as $key => $graph) {
				echo'
					<div class="p50 bfff rr5" style="border-radius:0; height:100%;">
                    <div class="taC color666 ff0 t14 mb5">'.$graph["title0"].'</div>
                    <div class="taC tU color000 ff0 t20 mb20">'.$graph["title"].'</div>
                    <div class="chart-container p30" style="position: relative; height:calc(100% - 50px); width:100%">
							<canvas id="graphion-'.$key.'"></canvas>
						</div>
					</div>

					<script>
						// bar, line, radar
						Graphion.ggg("graphion-'.$key.'", '.json_encode($graph).');
					</script>
				';
			}
		}

    }

?>