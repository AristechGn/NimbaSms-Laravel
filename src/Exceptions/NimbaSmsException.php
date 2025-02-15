<?php

namespace Aristech\NimbaSms\Exceptions;

use Exception;
use Illuminate\Http\Client\Response;

class NimbaSmsException extends Exception
{
    protected $errorCode;
    protected $errorDetails;

    public function __construct($message = "", $code = 0, $errorCode = null, $errorDetails = null, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errorCode = $errorCode;
        $this->errorDetails = $errorDetails;
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function getErrorDetails()
    {
        return $this->errorDetails;
    }

    /**
     * Crée une exception correspondant à la réponse HTTP reçue.
     *
     * La réponse doit contenir une structure d'erreur conforme à celle
     * décrite dans la documentation officielle: [Nimba SMS Documentation](https://developers.nimbasms.com/)
     *
     * @param Response $response
     * @return self
     */
    public static function fromResponse(Response $response): self
    {
        $data = $response->json();

        if (isset($data['error'])) {
            $errorCode = $data['error']['code'] ?? $response->status();
            $errorMessage = $data['error']['message'] ?? 'Erreur inconnue';
            $errorDetails = $data['error']['details'] ?? null;
        } else {
            $errorCode = $response->status();
            $errorMessage = $response->body() ?: 'Erreur inconnue';
            $errorDetails = null;
        }

        return new self($errorMessage, $response->status(), $errorCode, $errorDetails);
    }
} 