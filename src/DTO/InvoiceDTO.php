<?php


namespace App\DTO;


class InvoiceDTO implements \JsonSerializable
{
    /** @var int $id */
    private $id;
    /** @var array $invoicedEvents */
    private $invoicedEvents;
    /** @var EventFrequencyDTO $eventFrequencies */
    private $eventFrequencies;
    /** @var EventPriceDTO $eventPrices */
    private $eventPrices;
    /** @var float $totalPrice */
    private $totalPrice;
    /** @var array $invoiceItemDetails */
    private $invoiceItemDetails;

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
     * @return array
     */
    public function getInvoicedEvents(): array
    {
        return $this->invoicedEvents;
    }

    /**
     * @param array $invoicedEvents
     */
    public function setInvoicedEvents(array $invoicedEvents): void
    {
        $this->invoicedEvents = $invoicedEvents;
    }

    /**
     * @return EventFrequencyDTO
     */
    public function getEventFrequencies(): EventFrequencyDTO
    {
        return $this->eventFrequencies;
    }

    /**
     * @param EventFrequencyDTO $eventFrequencies
     */
    public function setEventFrequencies(EventFrequencyDTO $eventFrequencies): void
    {
        $this->eventFrequencies = $eventFrequencies;
    }

    /**
     * @return EventPriceDTO
     */
    public function getEventPrices(): EventPriceDTO
    {
        return $this->eventPrices;
    }

    /**
     * @param EventPriceDTO $eventPrices
     */
    public function setEventPrices(EventPriceDTO $eventPrices): void
    {
        $this->eventPrices = $eventPrices;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @param float $totalPrice
     */
    public function setTotalPrice(float $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * @return array
     */
    public function getInvoiceItemDetails(): array
    {
        return $this->invoiceItemDetails;
    }

    /**
     * @param array $invoiceItemDetails
     */
    public function setInvoiceItemDetails(array $invoiceItemDetails): void
    {
        $this->invoiceItemDetails = $invoiceItemDetails;
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
            'id' => $this->id,
            'invoice_events' => $this->invoicedEvents,
            'event_frequencies' => $this->eventFrequencies,
            'event_prices' => $this->eventPrices,
            'total_price' => $this->totalPrice,
            'invoice_item_details' => $this->invoiceItemDetails
        ];
    }
}