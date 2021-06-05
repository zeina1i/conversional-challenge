<?php


namespace App\Entity;


class Invoice
{
    /** @var int $id */
    private $id;

    /** @var Customer $customer */
    private $customer;

    /** @var \DateTime $startDate */
    private $startDate;

    /** @var \DateTime $endDate */
    private $endDate;

    /** @var float $totalPrice */
    private $totalPrice;

    /** @var int $registrationFrequency */
    private $registrationFrequency;

    /** @var int $activationFrequency */
    private $activationFrequency;

    /** @var int $appointmentFrequency */
    private $appointmentFrequency;

    /** @var float $registrationPrice */
    private $registrationPrice;

    /** @var float $registrationPrice */
    private $activationPrice;

    /** @var float $appointmentPrice */
    private $appointmentPrice;

    private $invoiceItems;

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
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @param $customer
     */
    public function setCustomer($customer): void
    {
        $this->customer = $customer;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     */
    public function setStartDate(\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     */
    public function setEndDate(\DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }


    /**
     * @return int
     */
    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    /**
     * @param int $totalPrice
     */
    public function setTotalPrice(float $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * @return mixed
     */
    public function getInvoiceItems()
    {
        return $this->invoiceItems;
    }

    /**
     * @param mixed $invoiceItems
     */
    public function setInvoiceItems($invoiceItems): void
    {
        $this->invoiceItems = $invoiceItems;
    }

    /**
     * @return int
     */
    public function getRegistrationFrequency(): ?int
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
    public function getActivationFrequency(): ?int
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
     * @return float
     */
    public function getRegistrationPrice(): ?float
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
    public function getActivationPrice(): ?float
    {
        return $this->activationPrice;
    }

    /**
     * @param float $activationPrice
     */
    public function setActivationPrice(?float $activationPrice): void
    {
        $this->activationPrice = $activationPrice;
    }

    /**
     * @return int
     */
    public function getAppointmentFrequency():? int
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
     * @return float
     */
    public function getAppointmentPrice(): ?float
    {
        return $this->appointmentPrice;
    }

    /**
     * @param float $appointmentPrice
     */
    public function setAppointmentPrice(?float $appointmentPrice): void
    {
        $this->appointmentPrice = $appointmentPrice;
    }
}