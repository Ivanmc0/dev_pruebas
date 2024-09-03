<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require $_SESSION['_ROOT'] . $_SESSION['_ZENDOR'] . 'autoload.php';


class Mails
{
    public $Email, $Templates, $Views;

    public function __construct()
    {
        $this->Email                = new PHPMailer(true);
        $this->Email->isHTML(true);
        $this->Email->isSMTP();
        $this->Email->ContentType   = "text/html";
        $this->Email->CharSet       = "utf-8";
        $this->Email->SMTPKeepAlive = true;
        $this->Email->WordWrap      = 50;
        $this->Email->Encoding      = "quoted-printable";
        $this->Email->SMTPDebug     = 0;
        $this->Email->SMTPAuth      = true;
        $this->Email->Host          = $_ENV["EMAIL_SMTP"];
        $this->Email->Username      = $_ENV["EMAIL_USER"];
        $this->Email->Password      = $_ENV["EMAIL_PASS"];
        $this->Email->Port          = $_ENV["EMAIL_PORT"];
        $this->Email->SMTPSecure    = 'tls';
        $this->Email->AltBody       = '';
        //-----------------------------------------------------------
        $this->Templates = $_SESSION['_MAILS'] . 'templates/';
        $this->Views     = $_SESSION['_MAILS'] . 'views/';
    }

    public function SendMail($TipoEmail = '', $Remitente = '', $Destinatarios = 0, $Data = 0, $Copy = 0)  {

        switch ($Remitente) {
            case 'comercial':
                $this->Email->setFrom($_ENV['COMERCIAL_EMAIL'], $_ENV['COMERCIAL_NAME']);
                $this->Email->addReplyTo('lidercomercial@olcgroup.co');
                break;
            case 'gerencia':
                $this->Email->setFrom($_ENV['COMERCIAL_EMAIL'], $_ENV['COMERCIAL_NAME']);
                $this->Email->addReplyTo('gerencia@olcgroup.co');
                break;
            default:
                $this->Email->setFrom($_ENV['EMAIL_EMAIL'], $_ENV['EMAIL_EMPRESA']);
                $this->Email->addReplyTo('soporte@olcgroup.co');
                break;
        }

        $this->Email->AddAddress(strtolower($Destinatarios));

        if($Copy) $this->Email->AddBCC(strtolower($Copy));

        $this->$TipoEmail($Data);

        if($status = $this->Email->Send()) {
            $this->Email->clearAddresses();
            $this->Email->Body = '';
        }

        return $status;

    }

    private function campana1($Data = false)  {

        $this->Email->Subject = $Data['nombre'].' te invitamos a referenciarte con los mejores | '.date('Y-m-d H:i:s');

        $this->GetTemplate('/marketing/disc-invitation.php');

        $this->SetKeyTemplate("#_USUARIO_#", $Data['nombre'] );
        $this->SetKeyTemplate("#_URL_#", $Data['url'] );
        $this->SetKeyTemplate("#_EMAIL_GENERAL_#", 'lidercomercial@olcgroup.co');
        $this->SetKeyTemplate("#_EMAIL_EMPRESA_#", 'OLC Group');
    }
    private function campana2($Data = false)  {

        $this->Email->Subject = 'Massy Group y OLC te invitamos a realizar tu prueba DISC | '.date('Y-m-d H:i:s');

        $this->GetTemplate('/marketing/disc-invitation-2.php');

        $this->SetKeyTemplate("#_USUARIO_#", $Data['nombre'] );
        $this->SetKeyTemplate("#_URL_#", $Data['url'] );
        $this->SetKeyTemplate("#_EMAIL_GENERAL_#", 'gerencia@olcgroup.co');
        $this->SetKeyTemplate("#_EMAIL_EMPRESA_#", 'OLC Group');
    }

    private function campana3($Data = false)  {

        $this->Email->Subject = 'PISA y OLC Group te invitamos a realizar tu prueba DISC | '.date('Y-m-d H:i:s');

        $this->GetTemplate('/marketing/disc-invitation-3.php');

        $this->SetKeyTemplate("#_USUARIO_#", $Data['nombre'] );
        $this->SetKeyTemplate("#_URL_#", $Data['url'] );
        $this->SetKeyTemplate("#_EMAIL_GENERAL_#", 'gerencia@olcgroup.co');
        $this->SetKeyTemplate("#_EMAIL_EMPRESA_#", 'OLC Group');
    }

    private function ContactWeb($Data = false)  {
        $this->Email->Subject = 'Contacto desde Web | '.date('Y-m-d H:i:s');

        $this->GetTemplate('/web/ContactWeb.php');
        $this->SetKeyTemplate("#_NAME_#", $Data['nombre'] );
        $this->SetKeyTemplate("#_COMPANY_#", $Data['empresa'] );
        $this->SetKeyTemplate("#_EMAIL_#", $Data['email'] );
        $this->SetKeyTemplate("#_CELLPHONE_#", $Data['celular'] );
        $this->SetKeyTemplate("#_ASUNTO_#", $Data['asunto'] );
        $this->SetKeyTemplate("#_MENSAJE_#", $Data['mensaje'] );

        $this->SetKeyTemplate("#_EMAIL_GENERAL_#"   , $_ENV['EMAIL_EMAIL'] );
        $this->SetKeyTemplate("#_EMAIL_EMPRESA_#"   , $_ENV['EMAIL_EMPRESA']);
    }

    private function Login($Data = false)  {
        $this->Email->Subject = 'Has iniciado sesión | '.date('Y-m-d H:i:s');

        $this->GetTemplate('/users/login.php');
        $this->SetKeyTemplate("#_USUARIO_#"         , $Data['nombre'] );
        $this->SetKeyTemplate("#_EMAIL_GENERAL_#"   , $_ENV['EMAIL_EMAIL'] );
        $this->SetKeyTemplate("#_EMAIL_EMPRESA_#"   , $_ENV['EMAIL_EMPRESA']);
    }

    private function Recovery($Data = false)  {
        $this->Email->Subject = 'Has solicitado actualizar tu contraseña | '.date('Y-m-d H:i:s');
        $this->GetTemplate('/users/recovery.php');
        $this->SetKeyTemplate("#_USUARIO_#"         , $Data['nombre'] );
        $this->SetKeyTemplate("#_EMAIL_GENERAL_#"   , $_ENV['EMAIL_EMAIL'] );
        $this->SetKeyTemplate("#_EMAIL_EMPRESA_#"   , $_ENV['EMAIL_EMPRESA']);
        $this->SetKeyTemplate("#_LINK_RECOVERY_#"   , $Data['urlrecovery']);
    }







    private function GetTemplate ( $Template ) {
        $Header            = file_get_contents($this->Templates . 'header.php', 'r');
        $Content           = file_get_contents($this->Views . $Template , 'r');
        $Footer            = file_get_contents($this->Templates . 'footer.php', 'r');
        $this->Email->Body = $Header  . $Content  . $Footer;
    }

    private function SetKeyTemplate($Key, $Value) {
        $this->Email->Body = str_replace("$Key", $Value, $this->Email->Body);
    }

}