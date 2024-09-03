

<?php
    if($_TOKENS->CookiesExists()) echo '<script>Ion.logOut();</script>';
    if(isset($_CLIENTE)){
        if($_ZOOM->get_data( "zoom_users", " AND recovery_token = '$geton[1]' AND recovery_limit > '".date("Y-m-d H:i:s")."' ", 0)){
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

                    <h3 class="ff4 t24 colorGrowi mb10">Reestablece tu contraseña</h3>
                    <h5 class="ff0 t18 color666 mb30">Ingresa los datos solicitados para continuar</h5>

                    <form action="users/reset" id="formion" name="formion" method="post" class="form-horizontal zoom_form">
                        <fieldset class="form-group position-relative">
                            <label class="colorGrowi ff3 t16 p5 mb5">Nueva contraseña</label>
                            <input type="password" class="p15 color000 bS1 rr10 bfff dB w100" name="new_password" id="new_password" required>
                        </fieldset>
                        <fieldset class="form-group position-relative">
                            <label class="colorGrowi ff3 t16 p5 mb5">Repita la nueva contraseña</label>
                            <input type="password" class="p15 color000 bS1 rr10 bfff dB w100" name="new_password_confirm" id="new_password_confirm" required>
                            <input type="password" class="p10 color000 bfff dB w100" name="userToken" id="userToken" hidden value="<?php echo $UserToken;?>">
                        </fieldset>

                        <div id="rtn-formion" class="taC mb20"></div>

                        <div id="rtn-formion" class="taC mb20"></div>
                        <button type="submit" class="btn-1 btn-zm">
                            <i class="las la-sign-in-alt"></i>
                            <span class="">Continuar</span>
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>
</div>

<?php }else{ ?>

<div class="max1000 mAUTO p50 p20_oS">
    <div class="pAA20_oS">

        <div class="bGrowi2">
            <div class="p50 p20_oS">

                <div class="pAA30 taC">
                    <h3 class="ff3 t20 colorGrowi mb10">El token para reestablecer su contraseña ya ha sido usado o caducó.</h3>
                    <h5 class="ff0 t18 color666">Lo invitamos a solicitar de nuevo la actualización de la contraseña.</h5>
                </div>

                <div class="taC">
                    <a href="<?= $dominion; ?>" class="dIB p1030 ff4 t18 bGrowi2 colorGrowi bS1 bHover cP">Volver al inicio</a>
                </div>

            </div>
        </div>

    </div>
</div>

<?php } ?>

<?php }else{ ?>

    <div class="p30 max500 mAUTO taC">
        <div class="colorGrowi2 ff0 t60 tU mb20">Error</div>
        <div class="colorfff ff1 t30">La url ingresada no está habilitada en el sistema.</div>

    </div>

<?php } ?>