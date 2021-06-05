<?php


namespace App\Factory;


use App\DTO\EventFrequencyDTO;

class EventFrequencyDTOFactory
{
    public static function create(
        ?int $registrationFrequency,
        ?int $activationFrequency,
        ?int $appointmentFrequency
    ) : EventFrequencyDTO
    {
        $eventFrequency = new EventFrequencyDTO();
        $eventFrequency->setRegistrationFrequency($registrationFrequency);
        $eventFrequency->setActivationFrequency($activationFrequency);
        $eventFrequency->setAppointmentFrequency($appointmentFrequency);

        return $eventFrequency;
    }
}