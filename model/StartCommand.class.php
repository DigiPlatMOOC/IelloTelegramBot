<?php
/**
 * Created by PhpStorm.
 * User: andrea
 * Date: 27/10/17
 * Time: 18.24
 */

require_once ("TelegramChainElement.class.php");

/**
 * Classe che implementa il comportamento del comando /start
 * che viene inviato automaticamente alla connessione con il Bot
 */
class StartCommand extends TelegramChainElement
{
    const WHEEL_CHAIR = "\xE2\x99\xBF";
    const PARK = "\xF0\x9F\x85\xBF";
    const WIKING_FACE = "\xF0\x9F\x98\x89";
    const SOS = "\xF0\x9F\x86\x98";
    const EARTH = "\xF0\x9F\x8C\x8F";
    CONST MOON = "\xF0\x9F\x8C\x94";

    const WELCOME_MESSAGE = "Ciao sono IelloBot! " . StartCommand::WHEEL_CHAIR . "\nGrazie a me puoi ottenere i posteggi per disabili nelle tue vicinaze " . StartCommand::PARK . "\nSono in grado di ricercare parcheggi in un raggio di 500m in base alla tua posizione, posso anche trovare, se esistono, parcheggi presenti in un raggio scelto da te " . StartCommand::WIKING_FACE . "\nPer poter ricercare i parcheggi ho bisogno di sapere dove ti trovi, puoi dirmelo semplicemente premendo sul tasto invia allegato e selezionare la posizione(ricordati di attivare il GPS " . StartCommand::EARTH . " " . StartCommand::MOON . ")\n\nPer maggiori informazioni digita il comando \help " . StartCommand::SOS; 

    protected function onMessage($chatId, $userId, $value, $next)
    {
        if(isset($value->message->text))
        {
            if(strpos($value->message->text, "/start") === 0)
            {
                send_message($chatId, StartCommand::WELCOME_MESSAGE);
                return;
            }
        }
        $this->handleNext($value);
    }
}
