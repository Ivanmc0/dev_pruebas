<div class="bfff bShadow3 rr5 posR cP grover" onclick="Ion.GrowiModal('beneficio', '<?= $beneficio['uuid']; ?>')">

    <div class="p10 bBS2 posR" style="border-style:dashed; z-index:2">

        <div class="posA bGray wh20 rr50" style="left:-8px; bottom:-10px; -webkit-box-shadow:inset -3px 0 2px 0px rgba(0,0,0,0.1);box-shadow:inset -3px 0 2px 0px rgba(0,0,0,0.1);"></div>
        <div class="posA bGray wh20 rr50" style="right:-8px; bottom:-10px; -webkit-box-shadow:inset 3px 0 2px 0px rgba(0,0,0,0.1);box-shadow:inset 3px 0 2px 0px rgba(0,0,0,0.1);"></div>

        <div class="ofH rr5"><img src="<?= $static."beneficios/".$beneficio["imagen"]; ?>" alt=""></div>
        <div class="p20">
            <div class="dIB beee color666 rr10 p310 ff2 t12 mb20"><?= $beneficios_cats[$beneficio["id_categoria"]]["nombre"]; ?></div>
            <div class="h90 ofH mb20">
                <div class="ff3 t20 mb10"><div class="truncate-2"><?= $beneficio["nombre"]; ?></div></div>
                <div class="ff1 t14 color666"><div class="truncate-3"><?= $beneficio["descripcion"]; ?></div></div>
            </div>

            <div class="tab">
                <div class="tabIn">
                    <div class="wh30 rr3 bccc t20"><div class="vMM"><i class="las la-user"></i></div></div>
                </div>
                <div class="tabIn color999 t12 pL10">(0) Colaboradores lo han solicitado</div>
            </div>
        </div>
    </div>
    <div class="p1020">
        <div class="tab">
            <div class="tab50">
                <div class="tab p5 bVerde5 rr40 dIB">
                    <div class="tabIn w30x h30"><img src="<?= $dominion; ?>resources/img/punto.png" /></div>
                    <div class="tabIn t18 ff4 colorGrowi taC"><?= $beneficio["puntos"] > 0 ? $beneficio["puntos"]." Pts" : 'Gratis'; ?></div>
                </div>
            </div>
            <div class="tabIn colorGrowi t30 taR"><i class="las la-arrow-alt-circle-right"></i></div>
        </div>
    </div>
</div>