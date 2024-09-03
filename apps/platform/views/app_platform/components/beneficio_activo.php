<div class="bGrowi bShadow3 rr5 cP grover" onclick="Ion.GrowiModal('beneficio', '<?= $beneficio['uuid']; ?>')">
    <div class="p10 bBS2 bC666 posR" style="border-style:dashed; z-index:2">

        <div class="posA bGray wh20 rr50" style="left:-8px; bottom:-10px; -webkit-box-shadow:inset -3px 0 2px 0px rgba(0,0,0,0.1);box-shadow:inset -3px 0 2px 0px rgba(0,0,0,0.1);"></div>
        <div class="posA bGray wh20 rr50" style="right:-8px; bottom:-10px; -webkit-box-shadow:inset 3px 0 2px 0px rgba(0,0,0,0.1);box-shadow:inset 3px 0 2px 0px rgba(0,0,0,0.1);"></div>

        <div class="p20">

            <div class="t40 colorfff mb5"><i class="lab la-gratipay"></i></div>
            <div class="hh1"></div>

            <div class="posR h150 ofH mb10">
                <div class="vMM" style="justify-content: left;">
                    <div class="w90 ff3 t30 colorVerde5"><?= $beneficio["nombre"]; ?></div>
                </div>
            </div>

            <div class="dIB beee color666 rr10 p310 ff2 t12 mb20"><?= $beneficios_cats[$beneficio["id_categoria"]]["nombre"]; ?></div>

            <div class="ff1 t14 coloreee h60 ofH mb10">
                <div class="truncate-3"><?= $beneficio["descripcion"]; ?></div>
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
            <div class="tabIn h40 colorfff t30 taR"><i class="las la-arrow-alt-circle-right"></i></div>
        </div>
    </div>
</div>