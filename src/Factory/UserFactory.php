<?php


namespace App\Factory;


use App\Entity\Customer;
use App\Entity\User;

class UserFactory
{
    public static function createInitialUserObject(
        Customer $customer,
        string $email,
        \DateTime $registeredAt
    ) : User
    {
        $user = new User();
        $user->setCustomer($customer);
        $user->setEmail($email);
        $user->setRegisteredAt($registeredAt);
        $user->setPaid(0);

        return $user;
    }
}