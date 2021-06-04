<?php


namespace App\Entity;


class User
{
    /** @var int $id */
    private $id;
    /** @var string $email */
    private $email;
    /** @var Customer $customer */
    private $customer;
    /** @var float $paid */
    private $paid;
    /** @var \DateTime $registeredAt */
    private $registeredAt;
    /** @var \DateTime $firstAppointmentTime */
    private $firstAppointmentTime;
    /** @var \DateTime $firstActivationTime */
    private $firstActivationTime;
    /** @var Session $firstActivation */
    private $firstActivation;
    /** @var Session $firstAppointment */
    private $firstAppointment;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     */
    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
    }

    /**
     * @return float
     */
    public function getPaid(): float
    {
        return $this->paid;
    }

    /**
     * @param float $paid
     */
    public function setPaid(float $paid): void
    {
        $this->paid = $paid;
    }

    /**
     * @return \DateTime
     */
    public function getRegisteredAt(): \DateTime
    {
        return $this->registeredAt;
    }

    /**
     * @param \DateTime $registeredAt
     */
    public function setRegisteredAt(\DateTime $registeredAt): void
    {
        $this->registeredAt = $registeredAt;
    }

    /**
     * @return \DateTime
     */
    public function getFirstAppointmentTime(): \DateTime
    {
        return $this->firstAppointmentTime;
    }

    /**
     * @param \DateTime $firstAppointmentTime
     */
    public function setFirstAppointmentTime(\DateTime $firstAppointmentTime): void
    {
        $this->firstAppointmentTime = $firstAppointmentTime;
    }

    /**
     * @return \DateTime
     */
    public function getFirstActivationTime(): \DateTime
    {
        return $this->firstActivationTime;
    }

    /**
     * @param \DateTime $firstActivationTime
     */
    public function setFirstActivationTime(\DateTime $firstActivationTime): void
    {
        $this->firstActivationTime = $firstActivationTime;
    }

    /**
     * @return Session
     */
    public function getFirstActivation(): Session
    {
        return $this->firstActivation;
    }

    /**
     * @param Session $firstActivation
     */
    public function setFirstActivation(Session $firstActivation): void
    {
        $this->firstActivation = $firstActivation;
    }

    /**
     * @return Session
     */
    public function getFirstAppointment(): Session
    {
        return $this->firstAppointment;
    }

    /**
     * @param Session $firstAppointment
     */
    public function setFirstAppointment(Session $firstAppointment): void
    {
        $this->firstAppointment = $firstAppointment;
    }
}