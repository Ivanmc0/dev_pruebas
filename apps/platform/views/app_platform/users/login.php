<?php
    $Uuid_Empresa_To_Support = 0;
    if ( isset( $geton[1]) ) $Uuid_Empresa_To_Support= $geton[1] ;
    
    if($_TOKENS->CookiesExists()) echo '<script>Ion.logOut();</script>';
    if(isset($_CLIENTE)){
?>

<div class="max1000 mAUTO p20_oS">
    <div class="pAA30 pAA20_oS">

        <div class="row p0 m0 bGray rr20 ofH">

            <div class="col-12 col-lg-7 p0 m0 mb30_oS bGrowi2 rr20" style="background-image:url(<?= $dominion; ?>resources/img/login.png); background-size:contain; background-size:auto 80%; background-position:center bottom; background-repeat:no-repeat; ">

                <div class="tab p20">
                    <div class="tabIn w200x"><img src="<?= $dominion; ?>resources/olc/growi-logo.png" alt="Growi Logo"></div>
                    <div class="tabIn pL10"><div class="ff2 t16 colorGrowi colorfff">Transformamos culturas para vivir mejor.</div></div>
                </div>

            </div>

            <div class="col-12 col-lg-5 p0 m0">

                <div class="p50 p20_oS">

                    <div class="mb30">
                        <img src="<?= $static; ?>logos/300/<?= $_CLIENTE['logo']; ?>">
                    </div>

                    <h3 class="ff4 t30 colorGrowi mb10">Bienvenido a growi</h3>
                    <h5 class="ff0 t20 color666 mb30">Inicia sesión para continuar</h5>

                    <form action="users/login" id="formion" name="formion" method="post" class="form-horizontal zoom_form mb30">

                        <fieldset class="form-group position-relative">
                            <label class="colorGrowi ff3 t16 p5 mb5">Email o Número de documento</label>
                            <input type="hidden" class="p10 color000 bfff dB w100" name="mi-empresa" id="mi-empresa" value="<?= $_CLIENTE["id"]; ?>">
                            <input type="text" class="p15 color000 bS1 rr10 bfff dB w100" name="user-name" id="user-name" placeholder="Usuario" required->
                            <input type="hidden" class="p10 color000 bfff dB w100" name="uuid-empresa" id="uuid-empresa" value="<?= $Uuid_Empresa_To_Support; ?>">

                        </fieldset>

                        <fieldset class="form-group position-relative">
                            <label class="colorGrowi ff3 t16 p5 mb5">Contraseña</label>
                            <input type="password" class="p15 color000 bS1 rr10 bfff dB w100" name="user-password" id="user-password" placeholder="Contraseña" required->
                        </fieldset>
                        <div id="rtn-formion" class="taC mb20"></div>
                        <button type="submit" class="btn-1 btn-zm">
                            <i class="las la-sign-in-alt"></i>
                            <span class="">Ingresar</span>
                        </button>
                    </form>

                    <?php

                        if(isset($_CLIENTE) && IN_ARRAY($_CLIENTE["id"], [152, 156, 180, 15152, 15162, 15180, 15181, 15182, 15183, 15184, 15185, 15186, 15187, 15188, 15189])){

                            // Nothing to do!

                        } else {

                            echo '<div class="mt20"><a href="'.$dominion.'recuperar/" class="color666 ff1 aHover t14 aS">¿Olvidaste tu contraseña? Recuperar.</a></div>';

                        }

                    ?>

                </div>

            </div>

        </div>

    </div>
</div>

<?php }else{ ?>

    <div class="p30 max500 mAUTO taC">
        <div class="colorGrowi2 ff0 t60 tU mb20">Error</div>
        <div class="colorfff ff1 t30">La url ingresada no está habilitada en el sistema.</div>

    </div>

<?php } ?>