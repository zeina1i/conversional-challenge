<?php


namespace App\DTO;


class InvoiceItemDTO implements \JsonSerializable
{
    /** @var int $userId */
    private $userId;
    /** @var string $userEmail */
    private $userEmail;
    /** @var string $previousPeriodsEvents */
    private $previousPeriodsEvents;
    /** @var string $currentPeriodEvents */
    private $currentPeriodEvents;
    /** @var \DateTime $registrationTime */
    private $registrationTime;
    /** @var \DateTime $firstActivationTime */
    private $firstActivationTime;
    /** @var \DateTime $firstAppointmentTime */
    private $firstAppointmentTime;
    /** @var float $price */
    private $price;

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * @param mixed $userEmail
     */
    public function setUserEmail($userEmail): void
    {
        $this->userEmail = $userEmail;
    }

    /**
     * @return mixed
     */
    public function getPreviousPeriodsEvents()
    {
        return $this->previousPeriodsEvents;
    }

    /**
     * @param mixed $previousPeriodsEvents
     */
    public function setPreviousPeriodsEvents($previousPeriodsEvents): void
    {
        $this->previousPeriodsEvents = $previousPeriodsEvents;
    }

    /**
     * @return mixed
     */
    public function getCurrentPeriodEvents()
    {
        return $this->currentPeriodEvents;
    }

    /**
     * @param mixed $currentPeriodEvents
     */
    public function setCurrentPeriodEvents($currentPeriodEvents): void
    {
        $this->currentPeriodEvents = $currentPeriodEvents;
    }

    /**
     * @return mixed
     */
    public function getRegistrationTime()
    {
        return $this->registrationTime;
    }

    /**
     * @param mixed $registrationTime
     */
    public function setRegistrationTime($registrationTime): void
    {
        $this->registrationTime = $registrationTime;
    }

    /**
     * @return mixed
     */
    public function getFirstActivationTime()
    {
        return $this->firstActivationTime;
    }

    /**
     * @param mixed $firstActivationTime
     */
    public function setFirstActivationTime($firstActivationTime): void
    {
        $this->firstActivationTime = $firstActivationTime;
    }

    /**
     * @return mixed
     */
    public function getFirstAppointmentTime()
    {
        return $this->firstAppointmentTime;
    }

    /**
     * @param mixed $firstAppointmentTime
     */
    public function setFirstAppointmentTime($firstAppointmentTime): void
    {
        $this->firstAppointmentTime = $firstAppointmentTime;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }


    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'user_id' => $this->userId,
            'user_email' => $this->userEmail,
            'previous_periods_events' => $this->previousPeriodsEvents,
            'current_period_events' => $this->currentPeriodEvents,
            'registration_time' => $this->registrationTime ? $this->registrationTime->format('Y-m-d H:i:s') : null,
            'first_activation_time' => $this->firstActivationTime ? $this->firstActivationTime->format('Y-m-d H:i:s') : null,
            'first_appointment_time' => $this->firstAppointmentTime ? $this->firstAppointmentTime->format('Y-m-d H:i:s') : null,
            'price' => $this->price,
        ];
    }
}