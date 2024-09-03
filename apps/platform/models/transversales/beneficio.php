<?php require_once ('../../appInit.php');


    $beneficio = $_GROWI->GetCampos("grw_beneficios", "uuid, id_categoria, id_tipo, nombre, descripcion, puntos, imagen", " uuid = '".$_POST["value"]."' AND  id_empresa = ".$_SESSION['COMPANY']['id']." AND inactivo = 0 ", 1);

 


?>

    <div class="bGray bBS1 p50">
        <div class="t40 colorAzul2 w80 ff4 ff2 mb20"><?= $beneficio["nombre"]; ?></div>
        <div class="row" style="margin-bottom:-30px;">
            <div class="col-12 col-lg-6">
                <div class="dIB beee color333 rr10 p310 ff2 t12 bS1"><?= "Categoría"; ?></div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="tab">
                    <div class="tabIn color666 t12 pR10 taR">(0) Colaboradores lo han solicitado</div>
                    <div class="tabIn">
                        <div class="wh30 rr3 bVerde5 t20"><div class="vMM"><i class="las la-user"></i></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="p40">
    <div class="row">
        <div class="col-12 col-lg-7">
            <div class="pLR20 magion">
                <div class="t18 ff3 color333 mb10">Descripción</div>
                <div class="t16 ff1 color666 mb30"><?= $beneficio["descripcion"]; ?></div>

                <div class="t18 ff3 color333 mb10">Condiciones del beneficio</div>
                <div class="t16 ff1 color666">
                    Para solicitar tus 5 días extras de vacaciones, debes cumplir con los siguientes requisitos:
                    <br><br>
                    <ul>
                        <li>Tener un año de antiguedad en Campai</li>
                        <li>Haber solicitado o usado todos tus días legales de vacaciones acumulados del período anterior, correspondientes a tu país.</li>
                        <li>Debes tener 0 días de saldo en tus vacaciones.</li>
                        <li>Los 5 días extras no se acumulan por período, consideralos al momento de organizar tus vacaciones durante el año.</li>
                    </ul>
                    Recuerda planificar tus vacaciones previamente
                    con tu jefatura para solicitar este beneficio
                    (Mínimo tres semanas antes).
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="bShadow3 p10 rr10">

                <div class="bS1 bCeee ofH rr5 mb20"><img src="<?= $static."beneficios/".$beneficio["imagen"]; ?>" alt=""></div>
                <div class="ff3 t18 taC mb10">¿Quieres solicitar este beneficio?</div>

                <div class="tab taC">
                    <div class="tabIn w40x"></div>
                    <div class="tabIn w60x"><img src="<?= $dominion; ?>resources/img/bene-1.png" /></div>
                    <div class="tabIn t20"><i class="las la-long-arrow-alt-right"></i></div>
                    <div class="tabIn w60x"><img src="<?= $dominion; ?>resources/img/bene-3.png" /></div>
                    <div class="tabIn w40x"></div>
                </div>

                <div class="ff0 t16 taC mb5">Redime</div>
                <div class="ff4 t34 taC mb10"><?= $beneficio["puntos"]; ?> Pts</div>

                <div class="bVerde4 colorGrowi t12 p5 taC mb20">Hoy tienes un total de: 0 Pts</div>

                <div class="taC mb10">
                    <div class="btn-accion type2 no-drop">Solicitar beneficio</div>
                </div>

            </div>
        </div>
    </div>
</div>



