<?php require_once('../../../appInit.php');

$insert_data    = 0;
$insert         = 0;
 
if($interactividad = $_ZOOM->get_data('grw_lel_dinamicas', ' AND id = ' . $_POST["enc"] . ' AND inactivo = 0 AND eliminado = 0', 0)){

    if ($interactividad['id_tipo'] == 5) $material = 'Contribución abierta';

    echo '
        <div class="card mb30">
            <div class="card-header">
                <div class="fR t12 color999">'.$material.'</div>
                <div class="dIB color333 t16 tB">
                    <div class="t12 color999 mb5">Campaña de mejoramiento</div>
                    '.($interactividad['nombre']).'
                </div>
            </div>
            <div class="card-body" style="padding-bottom:10px;">
    ';

    echo '<script>lele.actividad_listado_campanas('.$_POST["enc"].','.$_POST["a"].','.$_POST["t"].','.$_POST["e"].');</script>';
    echo '<div id="rtn_listado_campanas_'.$interactividad['id'].'"></div>';

    echo '

        <div class="modal fade" id="modalCrearIdea'.$interactividad['id'].'" tabindex="-1" role="dialog" aria-labelledby="modalCrearIdea'.$interactividad['id'].'Title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="border:0">
                <div class="modal-content" style="border:0">
                    <div class="posR p30 beee">
                        <button type="button" class="bfff wh30 rr50 posA color333 bHover3 cP bShadow" style="right:-10px; top:-10px;" data-dismiss="modal" aria-label="Close">
                            <div class="vMM t14"><i class="fas fa-times"></i></div>
                        </button>

                        <div class="">

                            <div class="ff3 colorVerde t20 mb10">Aporta tus ideas</div>
                            <div class="ff2 color999 t16 mb20">Cada aporte cuenta, expresa tus ideas!</div>

                            <form action="externo/accion-idear" id="idear'.$interactividad['id'].'" name="idear'.$interactividad['id'].'" method="post" class="form-horizontal zoom_form">

                                <input type="hidden" name="id_dinamica" value="'.$_POST["enc"].'" />
                                <input type="hidden" name="id_actividad" value="'.$_POST["a"].'" />
                                <input type="hidden" name="id_trabajador" value="'.$_POST["t"].'" />
                                <input type="hidden" name="id_empresa" value="'.$_POST["e"].'" />

                                <div class="bfff p20 mb20">
                                    <div class="ff0 colorVerde3 t24 mb10">¡Participa!</div>
                                    <div class="ff2 color666 t16 mb20">'.($interactividad['nombre']).'</div>
                                    <textarea class="form-control form-group-margin" type="text" name="comentarios"></textarea>
                                </div>

                                <div id="rtn-idear'.$interactividad['id'].'" class="taC mb20"></div>

                                <div class="taC eDinamicBottom dN">
                                    <button id="btn-idear'.$interactividad['id'].'" type="submit" class="dIB bfff bS1 bCVerde ff1 t16 rr20 colorVerde p1030 bHover1 cP">Continuar</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    ';


    echo '
            </div>
        </div>
    ';

}