<?php require_once('../../../appInit.php');

$insert_data    = 0;
$insert         = 0;

 
if($interactividad = $_ZOOM->get_data('grw_lel_dinamicas', ' AND id = ' . $_POST["enc"] . ' AND inactivo = 0 AND eliminado = 0', 0)){

    if ($interactividad['id_tipo'] == 3) $material = 'Público abierto';
    else if ($interactividad['id_tipo'] == 4) $material = 'Público cerrado';

    echo '
        <div class="card mb30">
            <div class="card-header">
                <div class="fR t12 color999">'.$material.'</div>
                <div class="dIB color333 t16 tB">
                    <div class="t12 color999 mb5">Reconocimientos</div>
                    '.($interactividad['nombre']).'
                </div>
            </div>
            <div class="card-body" style="padding-bottom:10px;">
    ';

    echo '<script>lele.actividad_listado_reconocimientos('.$_POST["enc"].','.$_POST["a"].','.$_POST["t"].','.$_POST["e"].');</script>';

    echo '<div id="rtn_listado_reconocimientos_'.$interactividad['id'].'"></div>';

    echo '

        <div class="modal fade" id="modalCrearReconocimiento'.$interactividad['id'].'" tabindex="-1" role="dialog" aria-labelledby="modalCrearReconocimiento'.$interactividad['id'].'Title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="border:0">
                <div class="modal-content" style="border:0">
                    <div class="posR p30 beee">
                        <button type="button" class="bfff wh30 rr50 posA color333 bHover3 cP bShadow" style="right:-10px; top:-10px;" data-dismiss="modal" aria-label="Close">
                            <div class="vMM t14"><i class="fas fa-times"></i></div>
                        </button>

                        <div class="">

                            <div class="ff3 colorVerde t20 mb10">Da un reconocimiento</div>
                            <div class="ff2 color999 t16 mb20">Porque las cosas no solo debemos pensarlas, también hay que decirlas!</div>



                    <form action="externo/accion-reconocer" id="reconocer'.$interactividad['id'].'" name="reconocer'.$interactividad['id'].'" method="post" class="form-horizontal zoom_form">

                        <input type="hidden" name="id_dinamica" value="'.$_POST["enc"].'" />
                        <input type="hidden" name="id_actividad" value="'.$_POST["a"].'" />
                        <input type="hidden" name="id_trabajador" value="'.$_POST["t"].'" />
                        <input type="hidden" name="id_empresa" value="'.$_POST["e"].'" />

                        <div class="bfff p20 mb10">
                            <div class="ff0 colorVerde3 t24 mb10">PASO 1</div>
                            <div class="ff2 color666 t16 mb20">Selecciona un colega de la empresa</div>
                            <select class="form-control form-group-margin" name="id_reconocido">
                                <option value="0">Seleccione</option>
                ';
                                $data = $_ZOOM->get_data("zoom_users", " AND id_empresa = '".$_POST["e"]."' AND id != '".$_POST["t"]."' AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC, id ASC ", 1);
                                if ($data) {
                                    foreach ($data as $dato) {
                                        echo '<option value="'.($dato["id"]).'" >'.($dato["nombre"]).'</option>';
                                    }
                                }
                echo '
                            </select>

                        </div>

                        <div class="bfff p20 paso2 dN mb10">
                            <div class="ff0 colorVerde3 t24 mb10">PASO 2</div>
                            <div class="ff2 color666 t16 mb20">Selecciona un reconocimiento para otorgar</div>
                            <select class="form-control form-group-margin" name="id_reconocimiento">
                                <option value="0">Seleccione</option>
            ';
                            $data = $_ZOOM->get_data("grw_reconocimientos", " AND ( id_empresa = '".$_POST["e"]."') AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC, id ASC ", 1);
                            if ($data) {
                                foreach ($data as $dato) {
                                    echo '<option value="'.($dato["id"]).'" >'.($dato["nombre"]).'</option>';
                                }
                            }
            echo '
                            </select>
                        </div>

                        <div class="bfff p20 paso3 dN mb20">
                            <div class="ff0 colorVerde3 t24 mb10">PASO 3</div>
                            <div class="ff2 color666 t16 mb20">Justifica el reconocimiento</div>
                            <textarea class="form-control form-group-margin" type="text" name="comentarios"></textarea>
                        </div>

                        <div id="rtn-reconocer'.$interactividad['id'].'" class="taC mb20"></div>

                        <div class="taC eDinamicBottom dN">
                            <button id="btn-reconocer'.$interactividad['id'].'" type="submit" class="dIB bfff bS1 bCVerde ff1 t16 rr20 colorVerde p1030 bHover1 cP">Continuar</button>
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