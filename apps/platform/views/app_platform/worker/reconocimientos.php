<div class="general1600">

    <div class="row align-items-center mb50">
        <div class="col-12 col-lg-8">

            <div class="cloud p0 bGrowi2 w100 getH" style="padding:0;">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-7 p2040">
                        <div class="t30 colorGrowi ff3 mb5"><?= $_SESSION['WORKER']['nombre']; ?></div>
                        <div class="t34 colorGrowi ff4 mb30">Celebra tus logros con cada reconocimiento</div>
                        <div class="t20 colorGrowi ff1">Y sigue brillando por hacer las cosas bien.</div>

                    </div>
                    <div class="col-12 col-lg-5 p0 align-self-end">
                        <img src="<?= $dominion; ?>resources/img/reconocimientos.png" />
                    </div>
                </div>
            </div>

        </div>
        <div class="col-12 col-lg-4">

            <div class="cloud w100 setH" style="padding:0;">

                <div class="p30">
                    <div class="ff3 colorGrowi t18 mb20">Últimos reconocimientos recibidos</div>
                    <?php
                        $reconocimientos = $_WORKERS->MisReconocimientos($_SESSION['WORKER']['id']);
                        if(isset($reconocimientos["ultimos"])){
                            foreach($reconocimientos["ultimos"] as $reconocimiento){
                                include 'app_platform/components/reconocimiento_ultimo.php';
                            }
                        }
                    ?>
                </div>

            </div>

        </div>
    </div>

<?php

    echo '<div class="t20 colorGrowi ff3 p1020 mb10">Mira tu tablero de reconocimientos</div>';
    if(isset($reconocimientos["ultimos"])){
        echo '<div class="row">';
        foreach($reconocimientos["reconocimientos"] as $reconocimiento){
            echo '<div class="col-12 col-lg-4 col-xl-3">';
            include 'app_platform/components/reconocimiento.php';
            echo '</div>';
        }
        echo '</div>';
    }
   

?>

<!-- Modal -->
<div class="modal fade" id="GrowiModal" tabindex="-1" role="dialog" aria-labelledby="GrowiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"" role="document">
        <div class="modal-content modalion posR">

            <div class="posA wh30 rr50 bHover cP bS2 t16 color999" style="right:10px; top:10px; z-index:10" data-dismiss="modal" aria-label="Close"><div class="vMM"><i class="las la-times"></i></div></div>

            <div class="modal-body-">

                <div id="rtn-GrowiModal"></div>

            </div>

        </div>
    </div>
</div>


<script>

    document.addEventListener("DOMContentLoaded", () => {
        const confettiColors = [
            "linear-gradient(45deg, #ff0000, #ff7f00)",
            "linear-gradient(45deg, #ff7f00, #ffff00)",
            "linear-gradient(45deg, #00ff00, #0000ff)",
            "linear-gradient(45deg, #0000ff, #4b0082)",
            "linear-gradient(45deg, #4b0082, #9400d3)",
            "linear-gradient(45deg, #9400d3, #ff1493)",
            "linear-gradient(45deg, #ff1493, #ff0000)"
        ];

        const confettiCount = 100; // Número de confetis generados por intervalo
        const confettiFallDuration = 1000; // Duración en milisegundos durante la cual cae confeti
        const confettiFadeDuration = 1000; // Duración en milisegundos durante la cual se reduce la cantidad de confeti

        const containers = document.querySelectorAll('.celebration-container');
        let confettiInterval;
        let totalConfetti = 0;

        function createConfetti() {
            const confetti = document.createElement("div");
            confetti.classList.add("confetti");

            // Asignar formas variadas al confeti
            const shapeType = Math.random() < 0.5 ? 'circle' : 'rectangle';
            if (shapeType === 'circle') {
                confetti.classList.add('circle');
            }

            const size = Math.random() * 10 + 5 + 5;
            if (confetti.classList.contains('rectangle')) {
                confetti.style.width = `${size}px`;
                confetti.style.height = `${size * 2}px`;
            } else {
                confetti.style.width = `${size}px`;
                confetti.style.height = `${size}px`;
            }
            confetti.style.backgroundImage = confettiColors[Math.floor(Math.random() * confettiColors.length)];

            confetti.style.left = `${Math.random() * 100}vw`;
            confetti.style.animationDuration = `${Math.random() * 3 + 2 + 1}s`;
            confetti.style.animationDelay = `${Math.random() * 2}s`;
            const rotateX = Math.random() * 360;
            const rotateY = Math.random() * 360;
            confetti.style.setProperty('--rotate-x', `${rotateX}deg`);
            confetti.style.setProperty('--rotate-y', `${rotateY}deg`);

            return confetti;
        }

        function generateConfetti() {
            containers.forEach(container => {
                for (let i = 0; i < confettiCount / containers.length; i++) {
                    const confetti = createConfetti();
                    container.appendChild(confetti);
                    totalConfetti++;
                }
            });
        }

        function startConfetti() {
            confettiInterval = setInterval(generateConfetti, 200);

            // Detener la generación de confeti después de confettiFallDuration milisegundos
            setTimeout(() => {
                clearInterval(confettiInterval);
            }, confettiFallDuration);

            // Eliminar gradualmente el confeti después de confettiFallDuration + confettiFadeDuration milisegundos
            setTimeout(() => {
                containers.forEach(container => {
                    const confettis = container.querySelectorAll('.confetti');
                    confettis.forEach(confetti => {
                        const animationDuration = parseFloat(getComputedStyle(confetti).animationDuration) * 1000;
                        const animationDelay = parseFloat(getComputedStyle(confetti).animationDelay) * 1000;
                        setTimeout(() => {
                            confetti.remove();
                            totalConfetti--;
                        }, animationDuration + animationDelay);
                    });
                });
            }, confettiFallDuration + confettiFadeDuration);
        }

        startConfetti();
    });

</script>