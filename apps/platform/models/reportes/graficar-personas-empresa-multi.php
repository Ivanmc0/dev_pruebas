<?php require_once ('../../appInit.php');

    $estructure = [];
    if (isset($_POST["conditions"]) && $_POST["conditions"] != "") {
        $a = explode(',', $_POST["conditions"]);
        foreach ($a as $key => $value) {
            $b = explode(':', $value);
            $estructure[$b[0]] = $b[1];
        }
    }



    $complement     = "";
    $complement2    = "";
    $segmentos      = 0;

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
    $complement     = "";
    $complement2    = "";
    $thisEvaluacion = $_TUCOACH->get_data("grw_tuc_p2b_estudios", " AND id = ".$_POST["id"]." AND eliminado = 0 ORDER BY id DESC ", 0);
    $segtos         = $_TUCOACH->reorder_array($_TUCOACH->get_data("grw_tuc_segmentaciones_opciones", " AND eliminado = 0 ORDER BY id DESC ", 1), "id");
    $sgts           = $_TUCOACH->reorder_array($_TUCOACH->get_data("grw_tuc_segmentaciones", " AND eliminado = 0 ORDER BY id DESC ", 1), "id");

    // echo '<pre>';
    // print_r($segtos);
    // echo '</pre>';

    if($thisEvaluacion){

        $testG = $_TUCOACH->get_data("grw_tuc_paquetests", " AND id = ".$thisEvaluacion["id_grupotests"]." AND  eliminado = 0 ORDER BY id DESC ", 0);


        if($_POST["cond2"] == ""){

            $ross[0] = $_TUCOACH->get_dataO( $complement.$cond." AND EMP.id = {$thisEvaluacion["id_empresa"]} AND ASIG.id_evaluacion = {$thisEvaluacion["id"]} ORDER BY CAT.id DESC ", $complement2.$cond2." AND EMP.id = {$thisEvaluacion["id_empresa"]} AND ASIG.id_evaluacion = {$thisEvaluacion["id"]} ");
            $params[0] = "Todos los Evaluadores";

        }else{
            $params = [];
            foreach (unserialize($_POST["cond2"]) as $key => $segs) {
                $params[$key] = "Resultado ".($key+1)."";
                foreach ($segs as $key2 => $opcion) {
                    $params[$key] .= " | ".($sgts[$segtos[$opcion]["id_segmento"]]["nombre"]).": ".($segtos[$opcion]["nombre"]);
                    if($key2 == 0) $complement2 = "";
                    if($complement2 != "") $complement2 .= " || ";
                    $complement2 .= " OPT.id = ".$opcion. " ";
                }
                $complement2 = ' AND ('.$complement2.')';
                $ross[] = $_TUCOACH->get_dataO( $complement.$cond." AND EMP.id = {$thisEvaluacion["id_empresa"]} AND ASIG.id_evaluacion = {$thisEvaluacion["id"]} ORDER BY CAT.id DESC ", $complement2." AND EMP.id = {$thisEvaluacion["id_empresa"]} AND ASIG.id_evaluacion = {$thisEvaluacion["id"]} ");
            }

        }

        if(!isset($estructure["categoria"])|| $estructure["categoria"] == ""){

            $myData[0]["labels"][] = ($testG["nombre"]);
            $myData[0]["graph"] = 'bar';
            $myData[0]["title"] = "Evaluación general";

            foreach($ross AS $key => $ros){

                $myData[0]["datasety"][$key]["label"] = $params[$key];
                $myData[0]["datasety"][$key]["data"][] = round($ros[0]["calculos"][1]["promedio"],2);

            }

        } else if(isset($estructure["categoria"]) && $estructure["categoria"] == 0){

            $myData[0]["graph"] = 'line';
            $myData[0]["title"] = "".($testG["nombre"]);
            foreach($ross AS $key => $ros){
                foreach($ros[1] AS $key2 => $categoria){
                    if($categoria){
                        if($key == 0) $myData[0]["labels"][] = ($categoria["nombre"]);
                        $myData[0]["datasety"][$key]["label"] = $params[$key];
                        $myData[0]["datasety"][$key]["data"][] = round($categoria["calculos"][1]["promedio"],2);
                    }
                }
            }

        }else if(isset($estructure["competencia"]) && $estructure["competencia"] == 0){

            $myData[0]["graph"] = 'line';
            foreach($ross AS $key => $ros){
                foreach($ros[1] AS $key2 => $categoria){
                    $myData[0]["title"] = "Categoría | ".($categoria["nombre"]);
                    if($categoria){
                        foreach($categoria["competencias"] AS $competencia){
                            if($key == 0) $myData[0]["labels"][] = ($competencia["nombre"]);
                            $myData[0]["datasety"][$key]["label"] = $params[$key];
                            $myData[0]["datasety"][$key]["data"][] = round($competencia["calculos"][1]["promedio"],2);
                        }
                    }
                }
            }

        }else if(isset($estructure["comportamiento"]) && $estructure["comportamiento"] == 0){

            $myData[0]["graph"] = 'line';
            foreach($ross AS $key => $ros){
                foreach($ros[1] AS $key2 => $categoria){
                    foreach($categoria["competencias"] AS $competencia){
                        $myData[0]["title"] = "Competencia | ".($competencia["nombre"]);
                        foreach($competencia["comportamientos"] AS $comportamiento){
                            if($key == 0) $myData[0]["labels"][] = ($comportamiento["nombre"]);
                            $myData[0]["datasety"][$key]["label"] = $params[$key];
                            $myData[0]["datasety"][$key]["data"][] = round($comportamiento["calculos"][1]["promedio"],2);
                        }
                    }

                }
            }
        }else if(isset($estructure["comportamiento"]) && $estructure["comportamiento"] != 0){

            $myData[0]["graph"] = 'bar';
            foreach($ross AS $key => $ros){
                foreach($ros[1] AS $key2 => $categoria){
                    foreach($categoria["competencias"] AS $competencia){
                        $myData[0]["title"] = "Competencia | ".($competencia["nombre"]);
                        foreach($competencia["comportamientos"] AS $comportamiento){
                            if($key == 0) $myData[0]["labels"][] = ($comportamiento["nombre"]);
                            $myData[0]["datasety"][$key]["label"] = $params[$key];
                            $myData[0]["datasety"][$key]["data"][] = round($comportamiento["calculos"][1]["promedio"],2);
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
					<div class="p50 p0_oS rr5" style="border-radius:0; height:auto;">
						<div class="taC tU color333 ff0 t20 mb20">'.$graph["title"].'</div>
						<div class="chart-container p30 p0_oS mb50" style="position: relative; height:400px; width:100%">
							<canvas id="graphion-'.$key.'"></canvas>
						</div>
                        <div id="graphion-'.$key.'-info" class="taC t12 colorfff">
                            <a id="graphion-'.$key.'-info-data" class="btn btn-primary btn-sm colorfff" title="Mostrar datos" onclick="Graphion.openTable(\'graphion-'.$key.'-info-table\')">
                                Mostrar datos &nbsp; <i class="fa fa-eye t10"></i>
                            </a>
                            <a id="graphion-'.$key.'-info-graph" download="ImagenGrafica.jpg" href="" class="btn btn-primary btn-sm" title="Descargar Gráfico">
                                Descargar gráfico &nbsp; <i class="fa fa-download t10"></i>
                            </a>

                            <div id="graphion-'.$key.'-info-table" class="pAA30 dN table-responsive">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                            ';
                            foreach ($graph["labels"] as $a1 => $value) {
                                if($a1 == 0) echo '<th scope="col"></th>';
                                echo '<th scope="col">'.$value.'</th>';
                            }
                            echo '
                                </tr>
                              </thead>
                              <tbody>
                            ';
                            foreach ($graph["datasety"] as $a1 => $value) {
                                echo '<tr>';
                                echo '<td scope="col">'.$value["label"].'</td>';
                                foreach ($value["data"] as $a1 => $value2) {
                                    echo '<td scope="col">'.$value2.'</td>';
                                }
                                echo '</tr>';
                            }
                            echo '
                              </tbody>
                            </table>
                            </div>

                        </div>
					</div>


					<script>
						// bar, line, radar
						// Graphion.ggg("graphion-'.$key.'", '.json_encode($graph).', "#333");
						Graphion.ggg("graphion-'.$key.'", '.json_encode($graph).', "#ffffff", true);
					</script>
				';
			}
		}

    }

?>