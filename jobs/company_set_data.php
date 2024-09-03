<?php include 'jobsInit.php';

        $FechaIni = '2024-01-01 00:00:00'; 
        $FechaFin = '2024-12-31 23:59:59';
        $Empresas = $_COMPANY->FlagDataOpen(); // Pregunta por las empresas que levantaron bandera con nuevos datos
        
        if (!$Empresas) return ;

        foreach ( $Empresas as $Empresa ) {
            $_COMPANY->VerifyDatos( $Empresa['id'], $FechaIni, $FechaFin  );
        }

?>