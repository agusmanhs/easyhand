<?php

namespace App\Services;

use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    /**
     * Send a message to the configured Telegram Group.
     *
     * @param string $message
     * @return void
     */
    public static function sendToGroup(string $message): void
    {
        $chatId = env('TELEGRAM_GROUP_ID');
        
        if (!$chatId) {
            Log::warning('Telegram Group ID not configured.');
            return;
        }

        try {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'HTML',
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send Telegram message: ' . $e->getMessage());
        }
    }
}
