<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageData;
    public $reply;

    /**
     * Constructeur avec les données du message et la réponse
     */
    public function __construct($messageData, $reply)
    {
        $this->messageData = $messageData;
        $this->reply = $reply;
    }

    /**
     * Construire l'email
     */
    public function build()
    {
        return $this->subject('Réponse à votre message : ' . $this->messageData->subject)
                    ->view('home.replyMessage'); // <-- ta vue existante
    }
}
