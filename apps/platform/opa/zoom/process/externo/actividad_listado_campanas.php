<?php require_once('../../../appInit.php');


if($interactividad = $_ZOOM->get_data('grw_lel_dinamicas', ' AND id = ' . $_POST["enc"] . ' AND inactivo = 0 AND eliminado = 0', 0)){


    if($reconocimientos = $_ZOOM->get_data('grw_sol_act_campanias', ' AND id_trabajador = ' . $_POST['t'] . ' AND id_dinamica = ' . $interactividad['id'] . ' AND inactivo = 0 AND eliminado = 0', 1)) {
        foreach ($reconocimientos as $key => $pre) {
            $trabajador = $_ZOOM->get_data("zoom_users", ' AND id = ' . $pre['id_reconocido'] . ' AND inactivo = 0 AND eliminado = 0', 0);
            echo '

                <div class="tab mb10">
                    <div class="tabIn">
                        <div class="bS1 bCeee bGray p15 rr5">
                            <div class="ff2 t14">
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
      <div class="dIB colorVerde bS1 p1030 rr10 bCVerde bHover3 cP" data-toggle="modal" data-target="#modalCrearIdea'.$interactividad['id'].'">
          Contribuir
      </div>
    </div>
    ';
}