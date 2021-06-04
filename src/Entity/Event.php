<?php


namespace App\Entity;


class Event
{
    /** @var int $id */
    private $id;
    /** @var string $eventName */
    private $eventName;
    /** @var float $eventPrice */
    private $eventPrice;

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
    public function getEventName(): string
    {
        return $this->eventName;
    }

    /**
     * @param string $eventName
     */
    public function setEventName(string $eventName): void
    {
        $this->eventName = $eventName;
    }

    /**
     * @return float
     */
    public function getEventPrice(): float
    {
        return $this->eventPrice;
    }

    /**
     * @param float $eventPrice
     */
    public function setEventPrice(float $eventPrice): void
    {
        $this->eventPrice = $eventPrice;
    }
}