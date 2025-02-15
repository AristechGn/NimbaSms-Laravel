<?php

namespace Aristech\NimbaSms\Contracts;

interface SmsClientInterface
{
    /**
     * Envoi d'un SMS.
     *
     * @param string $senderName
     * @param array  $recipients
     * @param string $message
     * @return array
     */
    public function send($senderName, array $recipients, $message);

    /**
     * Créer un contact.
     *
     * @param string $name
     * @param array  $groups
     * @param string $numero
     * @return array
     */
    public function createContact($name, array $groups, $numero);

    /**
     * Récupérer les détails du compte.
     *
     * @return array
     */
    public function getAccountDetails();

    /**
     * Créer une vérification (envoi d'un code).
     *
     * @param string $to
     * @return array
     */
    public function createVerification($to): array;

    /**
     * Récupérer la liste des contacts.
     *
     * @return array
     */
    public function getContacts(): array;

    /**
     * Récupérer la liste des groupes.
     *
     * @return array
     */
    public function getGroups(): array;

    /**
     * Récupérer un message par son identifiant.
     *
     * @param string $messageId
     * @return array
     */
    public function getMessageById($messageId): array;

    /**
     * Récupérer la liste des messages.
     *
     * @return array
     */
    public function getMessages(): array;

    /**
     * Mettre à jour un contact.
     *
     * @param mixed  $contactId
     * @param string $name
     * @param array  $groups
     * @param string $numero
     * @return array
     */
    public function updateContact($contactId, $name, array $groups, $numero): array;

    /**
     * Supprimer un contact.
     *
     * @param mixed $contactId
     * @return array
     */
    public function deleteContact($contactId): array;

    /**
     * Créer un groupe.
     *
     * @param string $groupName
     * @return array
     */
    public function createGroup($groupName): array;

    /**
     * Mettre à jour un groupe.
     *
     * @param mixed  $groupId
     * @param string $groupName
     * @return array
     */
    public function updateGroup($groupId, $groupName): array;

    /**
     * Supprimer un groupe.
     *
     * @param mixed $groupId
     * @return array
     */
    public function deleteGroup($groupId): array;

    /**
     * Valider une vérification.
     *
     * @param string $to
     * @param string $code
     * @return array
     */
    public function validateVerification($to, $code): array;

    /**
     * Programmer l'envoi d'un SMS.
     *
     * @param string $senderName
     * @param array  $recipients
     * @param string $message
     * @param string $scheduleTime
     * @return array
     */
    public function scheduleSms($senderName, array $recipients, $message, $scheduleTime): array;

    /**
     * Récupérer le rapport de livraison d'un message.
     *
     * @param string $messageId
     * @return array
     */
    public function getDeliveryReport($messageId): array;
} 