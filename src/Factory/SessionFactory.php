<?php


namespace App\Factory;


use App\Entity\Session;
use App\Entity\User;

class SessionFactory
{
    public static function create(User $user, ?\DateTime $activationTime, ?\DateTime $appointmentTime)
    {
        $session = new Session();
        $session->setUser($user);
        $session->setActivationTime($activationTime);
        $session->setAppointmentTime($appointmentTime);

        return $session;
    }
}