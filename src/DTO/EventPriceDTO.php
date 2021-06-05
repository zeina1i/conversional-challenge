<?php


namespace App\DTO;


class EventPriceDTO implements \JsonSerializable
{
    /** @var float $registrationPrice */
    private $registrationPrice;
    /** @var float $activationPrice */
    private $activationPrice;
    /** @var float $appointmentPrice */
    private $appointmentPrice;

    /**
     * @return float
     */
    public function getRegistrationPrice(): float
    {
        return $this->registrationPrice;
    }

    /**
     * @param float $registrationPrice
     */
    public function setRegistrationPrice(float $registrationPrice): void
    {
        $this->registrationPrice = $registrationPrice;
    }

    /**
     * @return float
     */
    public function getActivationPrice(): float
    {
        return $this->activationPrice;
    }

    /**
     * @param float $activationPrice
     */
    public function setActivationPrice(float $activationPrice): void
    {
        $this->activationPrice = $activationPrice;
    }

    /**
     * @return float
     */
    public function getAppointmentPrice(): float
    {
        return $this->appointmentPrice;
    }

    /**
     * @param float $appointmentPrice
     */
    public function setAppointmentPrice(float $appointmentPrice): void
    {
        $this->appointmentPrice = $appointmentPrice;
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
            'registration_price' => $this->registrationPrice,
            'activation_price' => $this->activationPrice,
            'appointment_price' => $this->appointmentPrice,
        ];
    }
}