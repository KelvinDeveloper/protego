<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use  Illuminate\Support\Facades\Mail;

/**
 * Class MailController
 *
 * @package App\Mail\Http\Controllers
 */
class MailController extends Controller
{
    public function Send($values, $view, array $attachments = [])
    {
//        if (env('APP_ENV') != 'prod') {
//
//            $values['To']    = env('DEVELOPER_EMAIL');
//            $values['Title'] = "Development - {$values["Title"]}";
//
//            if (!$values['To']) {
//                return ['message' => trans('Por favor, informe seu email de desenvolvedor DEVELOPER_EMAIL=nome@email') ];
//            }
//        }

        $sent = false;

        /**
         * Envia o email somente quando o endereço é válido
         */
        if (!filter_var($values['To'], FILTER_VALIDATE_EMAIL) === false) {

            if (Auth::user()) {

                // Envia Email via SMTP

                $mail = new \PHPMailer();                              // Instanciando o PHPMailer
                $mail->isSMTP();                                       // Ativar SMTP
                $mail->SMTPDebug  = env('APP_ENV') == 'local' ? 3 : 0; // Debugar: 1 = erros e mensagens, 2 = mensagens apenas
                $mail->SMTPAuth   = env('SMTP_AUTH', true);            // Autenticação ativada
                $mail->SMTPSecure = env('SMTP_ENCRYPT', 'TSL');        // SSL REQUERIDO pelo GMail
                $mail->Host       = env('SMTP_HOST', 'smtp-relay.gmail.com');// SMTP utilizado
                $mail->Port       = env('SMTP_PORT', 587);             // A porta 587 deverá estar aberta em seu servidor
                $mail->Username   = env('SMTP_USERNAME', 'protego@kelvinsouza.com');
                $mail->Password   = env('SMTP_PASSWORD', 'Q4w3e2r1');
                $mail->CharSet    = Config::get('database.connections.mysql.charset');

                $mail->Debugoutput = 'error_log';

                $mail->IsHTML(true);
                $mail->SetFrom( env('SMTP_USERNAME', 'protego@kelvinsouza.com'), Auth::user()->name);
                $mail->Subject = $values['Title'];
                $mail->Body    = view('mail.' . $view, $values);
                $mail->AddAddress($values['To'], Auth::user()->name);

                if ($attachments && !empty($attachments)) {
                    foreach ($attachments as $file) {
                        $mail->addAttachment($file);
                    }
                }

                $sent = $mail->send();
                dd($sent, $mail->ErrorInfo);
                $mail->smtpClose();
            }

            return $sent;
        }
    }
}