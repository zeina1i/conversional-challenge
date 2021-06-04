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

    /** @var int $totalPrice */
    private $totalPrice;

    /** @var array $eventFrequencies */
    private $eventFrequencies;

    /** @var array $eventsSnapshot */
    private $eventsSnapshot;

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
     * @return array
     */
    public function getEventsSnapshot(): array
    {
        return $this->eventsSnapshot;
    }

    /**
     * @param array $eventsSnapshot
     */
    public function setEventsSnapshot(array $eventsSnapshot): void
    {
        $this->eventsSnapshot = $eventsSnapshot;
    }

    /**
     * @return int
     */
    public function getTotalPrice(): int
    {
        return $this->totalPrice;
    }

    /**
     * @param int $totalPrice
     */
    public function setTotalPrice(int $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * @return array
     */
    public function getEventFrequencies(): array
    {
        return $this->eventFrequencies;
    }

    /**
     * @param array $eventFrequencies
     */
    public function setEventFrequencies(array $eventFrequencies): void
    {
        $this->eventFrequencies = $eventFrequencies;
    }
}