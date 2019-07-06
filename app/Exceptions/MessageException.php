<?php


namespace App\Exceptions;


class MessageException
{

    CONST PARAM_DYNAMIC_MESSAGE = ":parameter";

    CONST EMAIL_USED = "EMAIL_USED";
    CONST DESCRIPTION_USED = "DESCRIPTION_USED";
    CONST NOT_FOUND_REGISTER = "EMAIL_USED";

    private static $messages = [
        MessageException::EMAIL_USED => "Email used per other user.",
        MessageException::DESCRIPTION_USED => "Description already used",
        MessageException::NOT_FOUND_REGISTER => MessageException::PARAM_DYNAMIC_MESSAGE . " not found!",

    ];

    private function __constructor()
    {
    }

    static public function getMessage($code, array $params = [])
    {
        $message = self::$messages[$code];
        if ($message) {
            $isParameterDynamic = strpos($message, MessageException::PARAM_DYNAMIC_MESSAGE) >= 0;
            if ($isParameterDynamic && count($params) > 1) {
                $message = "";
                $messageSplited = explode(MessageException::PARAM_DYNAMIC_MESSAGE, $message);
                foreach ($messageSplited as $indice => $messagePart) {
                    $valueDynamic = $params[$indice] ?? "";
                    $message += $messagePart + $valueDynamic;
                }

                return $message;
            } elseif ($isParameterDynamic && count($params) == 1) {
                $posicaoPrimeiro = 0;
                $message = str_replace(
                    MessageException::PARAM_DYNAMIC_MESSAGE, $params[$posicaoPrimeiro], $message
                );
                return $message;
            }
            return $message;
        }

        return "";
    }
}