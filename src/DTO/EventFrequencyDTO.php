<?php


namespace App\DTO;


class EventFrequencyDTO implements \JsonSerializable
{
    /** @var int $registrationFrequency */
    private $registrationFrequency;
    /** @var int $activationFrequency */
    private $activationFrequency;
    /** @var int $appointmentFrequency */
    private $appointmentFrequency;

    /**
     * @return int
     */
    public function getRegistrationFrequency(): ? int
    {
        return $this->registrationFrequency;
    }

    /**
     * @param int $registrationFrequency
     */
    public function setRegistrationFrequency(?int $registrationFrequency): void
    {
        $this->registrationFrequency = $registrationFrequency;
    }

    /**
     * @return int
     */
    public function getActivationFrequency(): ? int
    {
        return $this->activationFrequency;
    }

    /**
     * @param int $activationFrequency
     */
    public function setActivationFrequency(?int $activationFrequency): void
    {
        $this->activationFrequency = $activationFrequency;
    }

    /**
     * @return int
     */
    public function getAppointmentFrequency(): ? int
    {
        return $this->appointmentFrequency;
    }

    /**
     * @param int $appointmentFrequency
     */
    public function setAppointmentFrequency(?int $appointmentFrequency): void
    {
        $this->appointmentFrequency = $appointmentFrequency;
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
            'registration_frequency' => $this->registrationFrequency,
            'activation_frequency' => $this->activationFrequency,
            'appointment_frequency' => $this->appointmentFrequency,
        ];
    }
}