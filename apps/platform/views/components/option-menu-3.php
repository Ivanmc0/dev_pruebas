<?php
    $classIcon   = ($nivel == 1) ? 't30' : (($nivel == 2) ? 't24' : 't18');
    $classModulo = '';

    $url0 = $geton[0]."/";
    $url1 = isset($geton[1]) ? $geton[1]."/" : '';

    if($url0.$url1 == $option["url"]){
        $selector    = 'bMorado6 color000 aHover000';
        $selector1   = 'w30x rr10 p10 bMorado colorfff';
        $classModulo = ($nivel == 1) ? 't18 ff3 ' : (($nivel == 2) ? 't16 ff2' : 't14 ff1');
    } else {
        $selector    = 'bHover2';
        $selector1   = 'w30x rr10 p10';
        $classModulo = ($nivel == 1) ? 't18 ff3 color333' : (($nivel == 2) ? 't16 ff2 color999' : 't14 ff1 color999');
    }

    if(!isset($option['hijos'])){
        $etiqO  = '<a href="'.$dominion.$option["url"].'" class="tab rr10 mb5 '.$classModulo.' '.$selector.'">';
        $etiqC  = '</a>';
        $addTab = '';
    } else {
        $etiqO  = '<div class="tab beee color666 rr10 mb5 '.$classModulo.'">';
        $etiqC  = '</div>';
        $addTab = '<div class="tabIn p5 w30x taC cerrion"><div class="bccc w100 p10 t16 color666 rr10"><i class="las la-angle-down"></i></div></div>';
    }
?>

<?= $etiqO; ?>
    <div class="tabIn <?= $selector1; ?> taC" data-toggle="tooltip" data-placement="right" title="<?= $option["modulo"]; ?>">
        <i class="<?= $classIcon; ?> <?= $option["icono"]; ?>"></i>
    </div>
    <div class="tabIn cerrion pLR10">
        <?= $option["modulo"]; ?>
    </div>
    <?= $addTab; ?>
<?= $etiqC; ?>