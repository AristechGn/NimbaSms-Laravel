<?php

namespace Aristech\NimbaSms;

use Aristech\NimbaSms\Config\NimbaSmsConfig;
use Aristech\NimbaSms\Contracts\SmsClientInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Aristech\NimbaSms\Exceptions\NimbaSmsException;

class NimbaSmsClient implements SmsClientInterface
{
    private NimbaSmsConfig $config;

    public function __construct(NimbaSmsConfig $config)
    {
        $this->config = $config;
    }

    /**
     * Effectue une requête HTTP vers l'API avec la vérification SSL configurable.
     *
     * @param string $endpoint
     * @param array $data
     * @param string $method
     * @return array
     */
    private function makeRequest(string $endpoint, array $data = [], string $method = 'POST'): array
    {
        $data = array_merge($data, [
            'serviceId' => $this->config->getServiceId(),
            'secret'    => $this->config->getSecret(),
        ]);

        $url = $this->config->getBaseUrl() . $endpoint;

        // On configure le client HTTP avec l'option "verify"
        $httpClient = Http::withOptions([
            'verify' => config('nimbasms.ssl_verify'),
        ]);

        /** @var Response $response */
        $response = $method === 'POST'
            ? $httpClient->post($url, $data)
            : $httpClient->get($url, $data);

        if ($response->failed()) {
            throw NimbaSmsException::fromResponse($response);
        }

        return $response->json();
    }

    public function send($senderName, array $recipients, $message): array
    {
        return $this->makeRequest('send', [
            'senderName' => $senderName,
            'recipients' => $recipients,
            'message'    => $message,
        ]);
    }

    public function createContact($name, array $groups, $numero): array
    {
        return $this->makeRequest('contacts/create', [
            'name'   => $name,
            'groups' => $groups,
            'numero' => $numero,
        ]);
    }

    public function getAccountDetails(): array
    {
        return $this->makeRequest('account/details', [], 'GET');
    }

    /**
     * Créer une vérification (par exemple pour envoyer un code de vérification).
     *
     * @param string $to
     *
     * @return array
     */
    public function createVerification($to): array
    {
        return $this->makeRequest('verification/create', ['to' => $to]);
    }

    /**
     * Récupérer la liste des contacts.
     *
     * @return array
     */
    public function getContacts(): array
    {
        return $this->makeRequest('contacts', [], 'GET');
    }

    /**
     * Récupérer la liste des groupes.
     *
     * @return array
     */
    public function getGroups(): array
    {
        return $this->makeRequest('groups', [], 'GET');
    }

    /**
     * Récupérer un message par son identifiant.
     *
     * @param string $messageId
     *
     * @return array
     */
    public function getMessageById($messageId): array
    {
        return $this->makeRequest('messages/' . $messageId, [], 'GET');
    }

    /**
     * Récupérer la liste des messages.
     *
     * @return array
     */
    public function getMessages(): array
    {
        return $this->makeRequest('messages', [], 'GET');
    }

    public function updateContact($contactId, $name, array $groups, $numero): array
    {
        return $this->makeRequest('contacts/update', [
            'contactId' => $contactId,
            'name'      => $name,
            'groups'    => $groups,
            'numero'    => $numero,
        ]);
    }

    public function deleteContact($contactId): array
    {
        return $this->makeRequest('contacts/delete', [
            'contactId' => $contactId,
        ]);
    }

    public function createGroup($groupName): array
    {
        return $this->makeRequest('groups/create', [
            'groupName' => $groupName,
        ]);
    }

    public function updateGroup($groupId, $groupName): array
    {
        return $this->makeRequest('groups/update', [
            'groupId'   => $groupId,
            'groupName' => $groupName,
        ]);
    }

    public function deleteGroup($groupId): array
    {
        return $this->makeRequest('groups/delete', [
            'groupId' => $groupId,
        ]);
    }

    public function validateVerification($to, $code): array
    {
        return $this->makeRequest('verification/validate', [
            'to'   => $to,
            'code' => $code,
        ]);
    }

    public function scheduleSms($senderName, array $recipients, $message, $scheduleTime): array
    {
        return $this->makeRequest('send/schedule', [
            'senderName'   => $senderName,
            'recipients'   => $recipients,
            'message'      => $message,
            'scheduleTime' => $scheduleTime,
        ]);
    }

    public function getDeliveryReport($messageId): array
    {
        return $this->makeRequest('messages/' . $messageId . '/delivery', [], 'GET');
    }
}
