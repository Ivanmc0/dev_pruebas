<?php if($mis_reconocimientos = $_ZOOM->get_data('grw_sol_act_reconocimientos', ' AND id_reconocimiento = '.$geton[1].' AND id_reconocido = ' . $_SESSION["WORKER"]["id"] . ' AND id_empresa = '.$_SESSION["COMPANY"]["id"].' AND inactivo = 0 AND eliminado = 0', 1)){ ?>

<div class="bfff p40 p20_oS bBS1">
    <div class="ff3 t18 colorVerde mb5">Detalle de reconocimiento</div>
    <div class="color666 let2 t16">Encuentra los detalles del reconocimiento que te han otorgado</div>
</div>

<div class="p50 p30_oS">

    <div class="">

    <?php
        $recos = $_ZOOM->order_id_array($_ZOOM->get_data('grw_reconocimientos', ' AND ( id_empresa = '.$_SESSION["COMPANY"]["id"].') AND inactivo = 0 AND eliminado = 0', 1));
        $trabs = $_ZOOM->order_id_array($_ZOOM->get_data("zoom_users", ' AND id_empresa = '.$_SESSION["COMPANY"]["id"].' AND inactivo = 0 AND eliminado = 0', 1));

        $data = [];
        foreach ($mis_reconocimientos as $key => $reconocimiento) {

            if(isset($data[$reconocimiento["id_reconocimiento"]])){

                $data[$reconocimiento["id_reconocimiento"]]["cantidad"] += 1;
                $data[$reconocimiento["id_reconocimiento"]]["reconocimientos"][] = [
                    "comentarios" => $reconocimiento["comentarios"],
                    "fecha" => $reconocimiento["fecha"],
                    "reconocedor" => $trabs[$reconocimiento["id_trabajador"]],
                ];

            }else{
                $data[$reconocimiento["id_reconocimiento"]] = [
                    "id" => $reconocimiento["id_reconocimiento"],
                    "nombre" => $recos[$reconocimiento["id_reconocimiento"]]["nombre"],
                    "forma" => $recos[$reconocimiento["id_reconocimiento"]]["forma"],
                    "color" => $recos[$reconocimiento["id_reconocimiento"]]["color"],
                    "icono" => $recos[$reconocimiento["id_reconocimiento"]]["icono"],
                    "cantidad" => 1,
                    $key => [
                        "comentarios" => $reconocimiento["comentarios"],
                        "fecha" => $reconocimiento["fecha"],
                        "reconocedor" => $trabs[$reconocimiento["id_trabajador"]],
                    ],

                ];
                $data[$reconocimiento["id_reconocimiento"]]["reconocimientos"][] = [
                    "comentarios" => $reconocimiento["comentarios"],
                    "fecha" => $reconocimiento["fecha"],
                    "reconocedor" => $trabs[$reconocimiento["id_trabajador"]],
                ];

            }
        }

        // echo '<pre>';
        // print_r($data);
        // print_r($mis_reconocimientos);
        // echo '</pre>';

        foreach ($data as $key => $dato) {
    ?>

        <div class="">

            <div class="posR" style="z-index:2; margin-bottom:-30px;">
                <div class="mAUTO b333 posR" style="width:280px; height:280px; clip-path: polygon(100% 0, 100% 75%, 50% 100%, 0 75%, 0 0);">
                    <div class="mAUTO posR" style="top:5px; left:0px; width:270px; height:270px; clip-path: polygon(100% 0, 100% 75%, 50% 100%, 0 75%, 0 0); background:<?= ($dato["color"]); ?>;">
                        <div class="mAUTO posR" style="width:270px; height:270px; clip-path: polygon(100% 0, 100% 75%, 50% 100%, 0 75%, 0 0); background: linear-gradient(135deg,  rgba(255,255,255,0) 30%,rgba(255,255,255,0.6) 50%,rgba(255,255,255,0) 70%);">
                            <div class="vMM w100 h100_ colorfff">
                                <div class="taC tShadow2">
                                    <div class="t24 ff4 pLR20 mb10"><?= ($dato["nombre"]); ?></div>
                                    <div class="t100 "><i class="<?= ($dato["icono"]); ?>"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                            
            </div>



            <div class="tab h300 bfff bShadow2 p10 rr5 mb10">                            
                <div class="tabIn bS1 bCeee bGray">
                    <div class="p30 p20_oS rr5">
                        <h2 class="colorVerde ff3 t20 mb5"><?= ($dato["nombre"]); ?></h2>
                        <hr>
                        <div class="t16 magion color666 mb15">
                            Recibiste el reconocimiento
                            <?php if($dato["cantidad"] > 1) echo $dato["cantidad"]." veces."; else echo $dato["cantidad"]." vez."; ?>
                        </div>
                        
                        <div class="t12 magion color666">
                            <?php if($dato["reconocimientos"]) { ?>
                                <div class="">
                                    <?php foreach ($dato["reconocimientos"] as $key2 => $value) { ?>
                                        <div class="bfff  bCeee rr5 bShadow2 mt20" style="overflow: hidden;">
                                            <div class="tab bfff bS1- bCeee rr5 bShadow2" style="overflow: hidden;">
                                                <div class="tabIn w100x bVerde2 taC t60 coloreee p10"><i class="las la-user-circle"></i></div>
                                                <div class="tabIn p20 bGray">
                                                    <div class="t16 ff3 mb5"><?= ($value["reconocedor"]["nombre"]); ?></div>
                                                    <div class="t12 ff1 color666"><?= ($value["reconocedor"]["fecha"]); ?></div>
                                                </div>
                                            </div>
                                            <div class="p20 ff2 t18"><?= ($value["comentarios"]); ?></div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    <?php
        }
    ?>

    </div>
</div>

<?php
}else{
?>
<div class="bfff p40 p20_oS bBS1 mb20">
<div class="ff3 t18 colorVerde mb5">Mis reconocimientos</div>
<div class="color666 let2 t16">¡Ánimo!, muy pronto encontrarás aquí tus reconocimientos recibidos</div>
</div>

<div class="general pAA80 taC t150 coloreee">
<i class="fas fa-hourglass-start"></i>
</div>
<?php
}
?>
