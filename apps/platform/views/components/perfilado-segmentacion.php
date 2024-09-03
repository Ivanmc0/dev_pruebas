<div class="dB bfff bShadow3 rr20" style="overflow:hidden">

    <div class="tab bBS1 p30">
        <div class="tabIn pR20">
            <div class="ff3 t24 color000 mb10">Segmentación Básica</div>
            <div class="ff0 t16 color666">
                Esta información nos permite conocerte mejor, para descubrir tendencias que te agrueguen valor.
            </div>
        </div>
        <div class="tabIn w80x">
            <div class="wh80 bAzul4 rr50 t50"><div class="vMM rr50"><i class="las la-user"></i></div></div>
        </div>
    </div>

    <div class="taC p10">
        <?php

            if(isset($botoneshabilitados['a72c5c84-120a-11ef-938b-b42e99a5cf9a'])){
                $boton         = $botoneshabilitados['a72c5c84-120a-11ef-938b-b42e99a5cf9a'];
                $boton['tipo'] = 1;
                $size          = 'zm';
                $perz          = '';
                include '../views/components/boton_float.php';
            };

        ?>
    </div>

</div>