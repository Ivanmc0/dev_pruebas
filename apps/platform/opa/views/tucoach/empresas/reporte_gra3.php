<?php $allion_json      = json_encode($allion); ?>
<?php $segmentions_json = json_encode($segmentions); ?>
<input id="allion_json" type="hidden" value='<?php echo  $allion_json; ?>'>
<input id="segmentions_json" type="hidden" value='<?php echo  $segmentions_json; ?>'>

<?php

    if(count($allion) > 0){
        foreach($allion AS $test){
            if($test && is_array($test)){
                echo '<div class="card">';
                echo '<div class="tab bfff p2040 bBS1 primary rr10 t30"><div class="tabIn tB tU">';
                echo "Test | ".($test["nombre"]);
                echo '</div>';
                echo '<div class="tabIn w100x taR t24 primary"><div class="wh80 rr50 taC bg-amber bg-darken-2 colorfff" style="padding-top:20px;"><div class="tB">'.round($test["promedio_categoria"],2).'</div><hr style="margin:3px 0;"><div class="t14 ff1">'.round(($test["eq"]*$test["promedio_categoria"]),1).'%'.'</div></div></div>';
                echo '<div class="tabIn w100x taR t24 primary"><div class="wh80 rr50 taC bg-cyan bg-darken-1 colorfff" style="padding-top:20px;"><div class="tB">'.round($test["promedio_categoria2"],2).'</div><hr style="margin:3px 0;"><div class="t14 ff1">'.round(($test["eq"]*$test["promedio_categoria2"]),1).'%'.'</div></div></div>';
                echo '</div>';
                echo '<div class="p20">';

                foreach($test["categorias"] AS $categoria){
                    if(isset($categoria["nombre"])){
                        if($categoria){
                            echo '<div class="tab bg-primary p2040 colorfff t24"><div class="tabIn">';
                            echo ($categoria["nombre"]);
                            echo '</div>';
                            echo '<div class="tabIn w80x taR t18 primary"><div class="wh60 rr50 taC bg-amber bg-darken-2 colorfff" style="padding-top:13px;"><div class="tB">'.round($categoria["promedio_valor"],2).'</div><hr style="margin:3px 0;"><div class="t10 ff1">'.round(($test["eq"]*$categoria["promedio_valor"]),1).'%'.'</div></div></div>';
                            echo '<div class="tabIn w80x taR t18 primary"><div class="wh60 rr50 taC bg-cyan bg-darken-1 colorfff" style="padding-top:13px;"><div class="tB">'.round($categoria["promedio2_valor"],2).'</div><hr style="margin:3px 0;"><div class="t10 ff1">'.round(($test["eq"]*$categoria["promedio2_valor"]),1).'%'.'</div></div></div>';
                            echo '</div>';
                            echo '<div class="p10 bg-primary bg-accent-1 mb30">';

                            foreach($categoria["competencias"] AS $competencia){
                                if(isset($competencia["nombre"])){
                                    echo '<div class="tab bccc p1530 primary t18"><div class="tabIn">';
                                    echo ($competencia["nombre"]);
                                    echo '</div>';
                                    echo '<div class="tabIn w80x taR t18 primary"><div class="wh60 rr50 taC bg-amber bg-darken-2 colorfff" style="padding-top:13px;"><div class="tB">'.round($competencia["promedio"],2).'</div><hr style="margin:3px 0;"><div class="t10 ff1">'.round(($test["eq"]*$competencia["promedio"]),1).'%'.'</div></div></div>';
                                    echo '<div class="tabIn w80x taR t18 primary"><div class="wh60 rr50 taC bg-cyan bg-darken-1 colorfff" style="padding-top:13px;"><div class="tB">'.round($competencia["promedio2"],2).'</div><hr style="margin:3px 0;"><div class="t10 ff1">'.round(($test["eq"]*$competencia["promedio2"]),1).'%'.'</div></div></div>';
                                    echo '</div>';
                                    echo '<div class="bGray bS1 mb10">';

                                    foreach($competencia["comportamientos"] AS $comportamiento){
                                        if(isset($comportamiento["nombre"])){
                                            echo '<div class="tab p2030 t16" style="border-top:1px solid #ccc;"><div class="tabIn">';
                                            echo ($comportamiento["nombre"]);

                                            echo '<hr>';

                                            foreach ($comportamiento["seg_opciones"] as $key => $w_parametro){
                                                echo '<div class="bS1 p510 mb5">'.utf8_decode($w_parametro["conteo"]).' - '.utf8_decode($w_parametro["nombre"]);
                                                // echo '<pre>'.print_r($w_parametro).'</pre>';
                                                echo '<div class="fR t12 bg-cyan bg-darken-1 colorfff p510">'.round($w_parametro["promedio2"],2).'</div>';
                                                echo '<div class="fR t12 bg-amber bg-darken-2 colorfff p510">'.round($w_parametro["promedio"],2).'</div>';
                                                echo '</div>';
                                            }


                                            echo '</div>';
                                            echo '<div class="tabIn w80x taR t18 primary"><div class="wh60 rr50 taC bg-amber bg-darken-2 colorfff" style="padding-top:13px;"><div class="tB">'.round($comportamiento["g_soluciones"]["promedio"],2).'</div><hr style="margin:3px 0;"><div class="t10 ff1">'.round(($test["eq"]*$comportamiento["g_soluciones"]["promedio"]),2).'%'.'</div></div></div>';
                                            echo '<div class="tabIn w80x taR t18 primary"><div class="wh60 rr50 taC bg-cyan bg-darken-1 colorfff" style="padding-top:13px;"><div class="tB">'.round($comportamiento["g_soluciones"]["promedio2"],2).'</div><hr style="margin:3px 0;"><div class="t10 ff1">'.round(($test["eq"]*$comportamiento["g_soluciones"]["promedio2"]),2).'%'.'</div></div></div>';
                                            echo '<div class="tabIn w50x taR primary"><button onclick="Zoom.preload_Graph('.$comportamiento["id"].',\''.$comportamiento["nombre"].'\')" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalGraph"><i class="la la-bar-chart"></i></button></div>';
                                            echo '</div>';
                                        }
                                    }
                                    echo '</div>';
                                }
                            }
                            echo '</div>';
                        }
                    }
                }
                echo '</div>';
                echo '</div>';
            }
        }
    } else echo "No se encontraron datos";

    //Zoom.crearGraph('.$comportamiento["id"].',\''.$comportamiento["nombre"].'\')
//echo '<div class="tabIn w50x taR primary"><button onclick="Zoom.crearGraph('.$comportamiento["id"].',\''.$comportamiento["nombre"].'\')" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalGraph"><i class="la la-bar-chart"></i></button></div>';


?>

<!-- <pre><?php print_r($allion); ?></pre> -->




<div class="modal fade" id="modalGraph" tabindex="-1" role="dialog" aria-labelledby="modalGraphLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content beee">

        <div id="chartContainer" style="height:600px; width:100%;"></div>

    </div>
  </div>
</div>



<script src="../resources/plugins/canvasjs.min.js"></script>