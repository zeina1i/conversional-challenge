<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Factory\InvoiceFactory;
use App\Factory\SessionFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $customer = new Customer();
        $customer->setEmail('customer1@gmail.com');
        $manager->persist($customer);

        $customer2 = new Customer();
        $customer2->setEmail('customer2@gmail.com');
        $manager->persist($customer2);

        $userA = UserFactory::createInitialUserObject($customer, 'userA@gmail.com', new \DateTime('2020-12-01 00:00:00'));
        $activationTimeA1 = new \DateTime('2021-01-15');
        $activationTimeA2 = new \DateTime('2021-01-18');
        $userA->setFirstActivationTime($activationTimeA1);
        $userA->setPaid(.49);
        $manager->persist($userA);
        $sessionA1 = SessionFactory::create($userA, $activationTimeA1, null);
        $manager->persist($sessionA1);
        $sessionA2 = SessionFactory::create($userA, $activationTimeA2, null);
        $manager->persist($sessionA2);


        $userB = UserFactory::createInitialUserObject($customer, 'userB@gmail.com', new \DateTime('2020-12-15 00:00:00'));
        $appointmentTimeB1 = new \DateTime('2021-01-15');
        $userB->setFirstAppointmentTime($appointmentTimeB1);
        $userB->setPaid(.49);
        $manager->persist($userB);
        $sessionB1 = SessionFactory::create($userA, null, $appointmentTimeB1);
        $manager->persist($sessionB1);

        $userC = UserFactory::createInitialUserObject($customer, 'userC@gmail.com', new \DateTime('2021-01-01 00:00:00'));
        $activationTimeC1 = new \DateTime('2021-01-10');
        $userC->setFirstActivationTime($activationTimeC1);
        $manager->persist($userC);
        $sessionC1 = SessionFactory::create($userC, $activationTimeC1, null);
        $manager->persist($sessionC1);

        $userD = UserFactory::createInitialUserObject($customer, 'userD@gmail.com', new \DateTime('2020-09-01 00:00:00'));
        $activationTimeD1 = new \DateTime('2020-10-11');
        $activationTimeD2 = new \DateTime('2021-01-12');
        $appointmentTimeD1 = new \DateTime('2020-12-27');
        $appointmentTimeD2 = new \DateTime('2021-01-22');
        $userD->setFirstActivationTime($activationTimeD1);
        $userD->setFirstAppointmentTime($appointmentTimeD1);
        $userD->setPaid(3.99);
        $manager->persist($userD);
        $sessionD1 = SessionFactory::create($userD, $activationTimeD1, $appointmentTimeD1);
        $manager->persist($sessionD1);
        $sessionD2 = SessionFactory::create($userD, $activationTimeD2, $appointmentTimeD2);
        $manager->persist($sessionD2);

        $invoice = InvoiceFactory::createInitialInvoiceObject($customer, new \DateTime('2021-01-01'), new \DateTime('2021-02-01'));
        $manager->persist($invoice);


        $userA = UserFactory::createInitialUserObject($customer2, 'userA2@gmail.com', new \DateTime('2020-12-01 00:00:00'));
        $activationTimeA1 = new \DateTime('2021-01-15');
        $activationTimeA2 = new \DateTime('2021-01-18');
        $userA->setFirstActivationTime($activationTimeA1);
        $userA->setPaid(.49);
        $manager->persist($userA);
        $sessionA1 = SessionFactory::create($userA, $activationTimeA1, null);
        $manager->persist($sessionA1);
        $sessionA2 = SessionFactory::create($userA, $activationTimeA2, null);
        $manager->persist($sessionA2);


        $userB = UserFactory::createInitialUserObject($customer2, 'userB2@gmail.com', new \DateTime('2020-12-15 00:00:00'));
        $appointmentTimeB1 = new \DateTime('2021-01-15');
        $userB->setFirstAppointmentTime($appointmentTimeB1);
        $userB->setPaid(.49);
        $manager->persist($userB);
        $sessionB1 = SessionFactory::create($userA, null, $appointmentTimeB1);
        $manager->persist($sessionB1);

        $userC = UserFactory::createInitialUserObject($customer2, 'userC2@gmail.com', new \DateTime('2021-01-01 00:00:00'));
        $activationTimeC1 = new \DateTime('2021-01-10');
        $userC->setFirstActivationTime($activationTimeC1);
        $manager->persist($userC);
        $sessionC1 = SessionFactory::create($userC, $activationTimeC1, null);
        $manager->persist($sessionC1);

        $userD = UserFactory::createInitialUserObject($customer2, 'userD2@gmail.com', new \DateTime('2020-09-01 00:00:00'));
        $activationTimeD1 = new \DateTime('2020-10-11');
        $activationTimeD2 = new \DateTime('2021-01-12');
        $appointmentTimeD1 = new \DateTime('2020-12-27');
        $appointmentTimeD2 = new \DateTime('2021-01-22');
        $userD->setFirstActivationTime($activationTimeD1);
        $userD->setFirstAppointmentTime($appointmentTimeD1);
        $userD->setPaid(3.99);
        $manager->persist($userD);
        $sessionD1 = SessionFactory::create($userD, $activationTimeD1, $appointmentTimeD1);
        $manager->persist($sessionD1);
        $sessionD2 = SessionFactory::create($userD, $activationTimeD2, $appointmentTimeD2);
        $manager->persist($sessionD2);

        $manager->flush();

    }
}
