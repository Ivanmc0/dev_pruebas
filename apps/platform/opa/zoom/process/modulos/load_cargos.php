<?php require_once('../../../appInit.php');



$nivel = $_POST['nivel'];
$org = $_POST['org'];
$cargo = $_POST['cargo'];

if ($nivel > 0) {
    $html = '';
    $cargo_n = 0;
    $list = array();
    $thisCargos = $_ZOOM->get_data("grw_cargos", " AND id_organigrama = " . $org . " AND id_cargo = " . $cargo . " ORDER BY nombre ASC ", 1);
    if ($thisCargos) {


        foreach ($thisCargos as $carg) {
            $html .= '<div id="accordionWrap' . $carg['id'] . '" role="tablist" aria-multiselectable="true">
                        <div class="card collapse-icon accordion-icon-rotate mb5">';
            $thisCargo = $_ZOOM->get_data("grw_cargos", " AND id_organigrama = " . $org . " AND id = " . $carg['id'] . " ORDER BY nombre ASC ", 0);
            if ($thisCargo) {
                $cargo_n += 1;
                array_push($list, $thisCargo['id']);
            }

            $html .=   '<div id="heading' . $carg['id'] . '" class="card-header">
                <a data-toggle="collapse" href="#accordion' . $carg['id'] . '" aria-expanded="false" aria-controls="accordion' . $carg['id'] . '" class="card-title lead collapsed">' . ($carg['nombre']) . '</a>
            </div>
            <div id="accordion' . $carg['id'] . '" role="tabpanel" data-parent="#accordionWrap' . $carg['id'] . '" aria-labelledby="heading' . $carg['id'] . '" class="collapse" aria-expanded="false">
                <div class="card-content">
                    <div class="card-body">';

                    $thisChild = $_ZOOM->get_data("grw_cargos", " AND id_organigrama = " . $org . " AND id_cargo = " . $carg['id'] . " ORDER BY nombre ASC ", 1);

                    if($thisChild){
                        foreach($thisChild as $child){

                        }
                    }

                    $html .= '<div class="bGray p20">';

                    $html .=   '<div id="cargo_' . $carg['id'] . '"></div>';
                    $html .= '</div>';

                    $html .=   '</div>
                    </div>
                </div>
            </div>
            </div>
            </div>';
        }

    }
    $all = array(
        'html' => $html,
        'cargo' => $cargo_n,
        'list' => $list,
        'inicial' => $cargo,
    );

    echo json_encode($all);

} else {
    $cargo = 0;
    $thisCargos = $_ZOOM->get_data("grw_cargos", " AND id_organigrama = " . $org . " AND id_cargo = -1 ORDER BY nombre ASC ", 1);
    if ($thisCargos) {
        foreach ($thisCargos as $carg) {
            $thisCargo = $_ZOOM->get_data("grw_cargos", " AND id_organigrama = " . $org . " AND id = " . $carg['id'] . " ORDER BY nombre ASC ", 1);
            if ($thisCargo) $cargo += 1;
        }
    }
    echo $cargo;
}
