<?php
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

                    <h3 class="ff4 t24 colorGrowi mb10">Recupera tu contraseña</h3>
                    <h5 class="ff0 t18 color666 mb30">Ingresa los datos solicitados para continuar</h5>

                    <form action="users/recovery" id="formion" name="formion" method="post" class="form-horizontal zoom_form">
                        <fieldset class="form-group position-relative">
                            <label class="colorGrowi ff3 t16 p5 mb5">Email</label>
                            <input type="email" class="p15 color000 bS1 rr10 bfff dB w100" name="email" id="email" required>
                        </fieldset>
                        <fieldset class="form-group position-relative">
                            <label class="colorGrowi ff3 t16 p5 mb5">Número de identificación</label>
                            <input type="text" class="p15 color000 bS1 rr10 bfff dB w100" name="identificacion" id="identificacion" required>

                        </fieldset>

                        <div id="rtn-formion" class="taC mb20"></div>

                        <div id="rtn-formion" class="taC mb20"></div>
                        <button type="submit" class="btn-1 btn-zm">
                            <i class="las la-sign-in-alt"></i>
                            <span class="">Recuperar</span>
                        </button>

                    </form>

                    <div class="color666 mt20">Ya tengo una cuenta, <a href="<?= $dominion; ?>" class="color666 ff1 aHover t14 aS">iniciar sesión</a>.</div>


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