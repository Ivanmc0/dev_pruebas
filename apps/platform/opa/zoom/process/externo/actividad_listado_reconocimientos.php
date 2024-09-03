<?php require_once('../../../appInit.php');



if($interactividad = $_ZOOM->get_data('grw_lel_dinamicas', ' AND id = ' . $_POST["enc"] . ' AND inactivo = 0 AND eliminado = 0', 0)){


    if($reconocimientos = $_ZOOM->get_data('grw_sol_act_reconocimientos', ' AND id_trabajador = ' . $_POST['t'] . ' AND id_dinamica = ' . $interactividad['id'] . ' AND inactivo = 0 AND eliminado = 0', 1)) {
        foreach ($reconocimientos as $key => $pre) {
            $trabajador = $_ZOOM->get_data("zoom_users", ' AND id = ' . $pre['id_reconocido'] . ' AND inactivo = 0 AND eliminado = 0', 0);
            $reco = $_ZOOM->get_data('grw_reconocimientos', ' AND id = ' . $pre['id_reconocimiento'] . ' AND inactivo = 0 AND eliminado = 0', 0);
            echo '

                <div class="tab mb10">
                    <div class="tabIn p10 w100x bS1 bCeee rr5 taC t30 bfff colorVerde">
                        
<div class="posR" style="z-index:2;">
    <div class="mAUTO b333 posR" style="width:70px; height:70px; clip-path: polygon(100% 0, 100% 75%, 50% 100%, 0 75%, 0 0);">
        <div class="mAUTO posR" style="top:5px; left:0px; width:60px; height:60px; clip-path: polygon(100% 0, 100% 75%, 50% 100%, 0 75%, 0 0); background:'.($reco["color"]).';">
            <div class="mAUTO posR" style="width:60px; height:60px; clip-path: polygon(100% 0, 100% 75%, 50% 100%, 0 75%, 0 0); background: linear-gradient(135deg,  rgba(255,255,255,0) 30%,rgba(255,255,255,0.6) 50%,rgba(255,255,255,0) 70%);">
                <div class="vMM w100 h100_ colorfff">
                    <div class="taC tShadow2">
                        <div class="t40 mb5"><i class="'.($reco["icono"]).'"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>                            
</div>


                    </div>
                    <div class="tabIn pL10">
                        <div class="bS1 bCeee bGray p15 rr5">
                            <div class="ff2 t14 mb15">
                                <span class="t16 ff2 mb10">
                                  <span class="">Reconoces a <b>'.($trabajador['nombre']).'</b></span>
                                  <span class="">Como <b>'.($reco['nombre']).'</b></span>
                                </div>
                                <div class="t14 magion color666">'.($pre['comentarios']).'</div>
                            </div>
                         </div>
                    </div>
                </div>
            ';
        }




    }

    echo '
    <div class="taC pAA10">
      <div class="dIB colorVerde bS1 p1030 rr10 bCVerde bHover3 cP" data-toggle="modal" data-target="#modalCrearReconocimiento'.$interactividad['id'].'">
          Otorgar reconocimiento
      </div>
    </div>
    ';
}