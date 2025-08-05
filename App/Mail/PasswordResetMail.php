<?php
declare(strict_types=1);

namespace App\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PasswordResetMail
{
    public static function send(string $email, string $token): bool
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Host     = config('smtp_config')['host'];
            $mail->Port     = config('smtp_config')['port'];
            $mail->Username = config('smtp_config')['username'];
            $mail->Password = config('smtp_config')['password'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = "Reset your password";
            $resetUrl = config('base_url') . "resetPassword?token=" . urlencode($token);
            $mail->Body = "Click here to reset your password: <a href='{$resetUrl}'>Reset Password</a>";
            return $mail->send();
        } catch (Exception $e) {
            error_log("Mail Error: " . $mail->ErrorInfo);
            return false;
        }
    }
}
