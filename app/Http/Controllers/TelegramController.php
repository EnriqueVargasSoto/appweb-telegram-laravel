<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    //

    public function webhook(Request $request)
    {
        // Procesar la solicitud de Telegram aquí
        $update = Telegram::commandsHandler(true);

        // Realizar acciones en función de los comandos o mensajes recibidos
    }

    public function start()
    {
        $keyboard = [
            ["Hacer algo"],
            ["Hacer otra cosa"],
        ];

        $response = Telegram::sendMessage([
            'chat_id' => $this->update->getMessage()->getChat()->getId(),
            'text' => '¡Hola! Soy tu bot. ¿Qué te gustaría hacer?',
            'reply_markup' => json_encode([
                'keyboard' => $keyboard,
                'one_time_keyboard' => true,
                'resize_keyboard' => true,
            ]),
        ]);

        return $response;
    }

    public function hacerAlgo()
    {
        $response = Telegram::sendMessage([
            'chat_id' => $this->update->getMessage()->getChat()->getId(),
            'text' => 'Has elegido hacer algo. ¡Excelente elección!',
        ]);

        return $response;
    }

    public function hacerOtraCosa()
    {
        $response = Telegram::sendMessage([
            'chat_id' => $this->update->getMessage()->getChat()->getId(),
            'text' => 'Has elegido hacer otra cosa. ¡Genial!',
        ]);

        return $response;
    }
}
