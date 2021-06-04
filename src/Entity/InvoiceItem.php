<?php


namespace App\Entity;


class InvoiceItem
{
    /** @var int $id */
    private $id;
    /** @var Invoice $invoice */
    private $invoice;
    /** @var User $user */
    private $user;
    /** @var float $price */
    private $price;
    /** @var array $previousPeriodsNewEvents */
    private $previousPeriodsNewEvents;
    /** @var array $currentPeriodNewEvents */
    private $currentPeriodNewEvents;

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
     * @return Invoice
     */
    public function getInvoice(): Invoice
    {
        return $this->invoice;
    }

    /**
     * @param Invoice $invoice
     */
    public function setInvoice(Invoice $invoice): void
    {
        $this->invoice = $invoice;
    }


    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return array
     */
    public function getPreviousPeriodsNewEvents(): array
    {
        return $this->previousPeriodsNewEvents;
    }

    /**
     * @param array $previousPeriodsNewEvents
     */
    public function setPreviousPeriodsNewEvents(array $previousPeriodsNewEvents): void
    {
        $this->previousPeriodsNewEvents = $previousPeriodsNewEvents;
    }

    /**
     * @return array
     */
    public function getCurrentPeriodNewEvents(): array
    {
        return $this->currentPeriodNewEvents;
    }

    /**
     * @param array $currentPeriodNewEvents
     */
    public function setCurrentPeriodNewEvents(array $currentPeriodNewEvents): void
    {
        $this->currentPeriodNewEvents = $currentPeriodNewEvents;
    }
}