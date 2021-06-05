<?php


namespace App\Factory;


use App\DTO\EventPriceDTO;

class EventPriceDTOFactory
{
    public static function create(
        float $appointmentPrice,
        float $activationPrice,
        float $registrationPrice
    )
    {
        $eventPriceDTO = new EventPriceDTO();
        $eventPriceDTO->setAppointmentPrice($appointmentPrice);
        $eventPriceDTO->setActivationPrice($activationPrice);
        $eventPriceDTO->setRegistrationPrice($registrationPrice);

        return $eventPriceDTO;
    }
}