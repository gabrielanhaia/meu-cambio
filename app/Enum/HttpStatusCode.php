<?php

namespace App\Enum;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * Class HttpStatusCode
 *
 * @method static NOT_FOUND()
 * Enum responsável por abstrair os códigos HTTP.
 * @package App\Enum
 */
class HttpStatusCode extends AbstractEnumeration
{
    /** @var int NOT_FOUND Não encontrado */
    const NOT_FOUND = 404;

    protected $messages = [
        self::NOT_FOUND => 'Não encontrado.'
    ];

    /**
     * Retorna a mensagem de erro de acordo com o código HTTP do enum.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->messages[$this->value()];
    }
}