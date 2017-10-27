<?php
/**
 * Created by PhpStorm.
 * User: andrea
 * Date: 27/10/17
 * Time: 18.34
 */

require_once ("TelegramChainElement.class.php");

class RadiusCommand extends TelegramChainElement
{
    /** Risposte */
    const RADIUS_SETTED = "Ok, quando vorrai richercherò parcheggi ad una distanza massima di: ";
    const RADIUS_ZERO = "Il raggio non può essere uguale a zero!";
    const RADIUS_INVALID = "Non ho capito!\nUso del comando: /raggio <distanza_in_metri>";

    protected function onMessage($chatId, $userId, $value, $next)
    {
        if(isset($value->message->text))
        {
            /* Verifico se il comando è /raggio */
            if(strpos($value->message->text, "/raggio") == 0) {

                /* Estrazione del raggio */
                $raggio = substr($value->message->text, 7);

                /* Validazione Raggio */
                if ($raggio && !empty($raggio) && is_numeric($raggio)) {
                    if ($raggio > 0) {
                        db_perform_action("REPLACE INTO Users(user_id, raggio) VALUES($userId, $raggio)");
                        send_message($chatId, RadiusCommand::RADIUS_SETTED. $raggio . "m");
                        return;
                    } else {
                        send_message($chatId, RadiusCommand::RADIUS_ZERO);
                        return;
                    }
                } else {
                    send_message($chatId, RadiusCommand::RADIUS_INVALID);
                    return;
                }
            }
        }
        $this->handleNext($value);
    }
}