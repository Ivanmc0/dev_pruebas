<div class="b000T bio w100 h100_">

    <div onClick="Ion.closeBio()" class="posA b000T w100 h100_"></div>

    <?php if($mode == 3){ ?>
        <div class="bion2 posA w100 h100_ opa p10">
            <div class="bfff bShadow3 posR w100 h100_ rr20" style="overflow:hidden;">

                <div id="bioMenu" class="pAA20 opa dN bioView bGray" style="overflow-y:auto;">
                    <?php include "lateral/menu-3.php"; ?>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="bion posA w100 h100_ opa p10">
        <div class="bfff bShadow3 posR w100 h100_ rr20" style="overflow:hidden;">

            <div onClick="Ion.closeBio()" class="posA bccc color000 rr50 wh30 taC bHover cP" style="right:10px; top:10px; z-index:10; font-size:14px; padding-top:0;">
                <div class="vMM"><i class="las la-times"></i></div>
            </div>




            <div id="bioOLC" class="opa dN bioView bGray" style="overflow-y:auto;">
                <?php include "lateral/welcome.php"; ?>
            </div>

            <div id="bioPlatforms" class="pAA50 opa dN bioView bGray" style="overflow-y:auto;">
                <?php include "lateral/platform.php"; ?>
            </div>

            <div id="bioWorker" class="opa dN bioView bGray" style="overflow-y:auto;">
                <?php include "lateral/worker.php"; ?>
            </div>

        </div>
    </div>

</div>


<!-- <script>Ion.openBio('bioOLC')</script> -->
