<?php

namespace App\Exceptions\Api\V1;

use App\Enum\HttpStatusCode;
use Exception;
use Throwable;

class ApiException extends Exception
{
    /** @var HttpStatusCode $httpStatusCodeEnum Enumerador com o código HTTP do erro. */
    protected $httpStatusCodeEnum;

    /**
     * ApiException constructor.
     * @param HttpStatusCode $httpStatusCodeEnum Enumerador com o código HTTP do erro.
     * @param string $message Mensagem de erro.
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        HttpStatusCode $httpStatusCodeEnum,
        string $message = "",
        int $code = 0,
        Throwable $previous = null
    )
    {
        $this->httpStatusCodeEnum = $httpStatusCodeEnum;
        if (empty($message)) {
            $message = $httpStatusCodeEnum->getMessage();
        }

        parent::__construct($message, $code, $previous);
    }
}
