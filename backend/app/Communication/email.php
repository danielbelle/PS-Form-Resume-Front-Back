<?php

namespace App\Communication;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email
{
    /**
     * Credenciais de acesso SMTP
     * @var string
     */
    const HOST = 'smtp.gmail.com';
    const USER = 'phpmytraining404@gmail.com';
    const PASS = 'ibwgasybdvsiktkt';
    const SECURE = 'TLS';
    const PORT = 587;
    const CHARSET = 'UTF-8';

    /**
     * Dados remetente
     * @var string
     */
    const FROM_EMAIL = 'henrique.danielb@gmail.com';
    const FROM_NAME = 'Daniel';

    /**
     * Msg de erro
     * @var string
     */
    private $error;

    /**
     * Método responsável por retornar msg de erro no envio
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Método responsável por enviar um e-mail
     * @param string|array $addresses
     * @param string $subject
     * @param string $body
     * @param string|array $attachments
     * @param string|array $ccs
     * @param string|array $bccs
     * @return boolean
     */
    public function sendEmail($addresses, $subject, $body, $attachments = [], $ccs = [], $bccs = [])
    {
        //Limpa msg de erro
        $this->error = '';

        //Instancia PHPMailler
        $obMail = new PHPMailer(true);
        try {
            //Credenciais de acesso ao SMTP
            $obMail->isSMTP(true);
            $obMail->Host = self::HOST;
            $obMail->SMTPAuth = true;
            $obMail->Username = self::USER;
            $obMail->Password = self::PASS;
            $obMail->SMTPSecure = self::SECURE;
            $obMail->Port = self::PORT;
            $obMail->Charset = self::CHARSET;

            //REMETENTE
            $obMail->setFrom(self::FROM_EMAIL, self::FROM_NAME);

            //DESTINATÁRIOS
            $addresses = is_array($addresses) ? $addresses : [$addresses];
            foreach ($addresses as $address) {
                $obMail->addAddress($address);
            }

            //Anexos
            $attachments = is_array($attachments) ? $attachments : [$attachments];
            foreach ($attachments as $attachment) {
                $obMail->addattAchment($attachment);
            }

            //CC
            $ccs = is_array($ccs) ? $ccs : [$ccs];
            foreach ($ccs as $cc) {
                $obMail->addCC($cc);
            }

            //BCC
            $bccs = is_array($bccs) ? $bccs : [$bccs];
            foreach ($bccs as $bcc) {
                $obMail->addBCC($bcc);
            }

            //Conteúdo e-mail
            $obMail->isHTML(true);
            $obMail->Subject = $subject;
            $obMail->Body = $body;

            //ENVIA O EMAIL
            return $obMail->send();
        } catch (Exception $e) {
            $this->error = $e;
            return false;
        }
    }
}
