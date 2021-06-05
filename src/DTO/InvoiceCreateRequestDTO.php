<?php


namespace App\DTO;


class InvoiceCreateRequestDTO
{
    /** @var string $startDate */
    public $startDate;
    /** @var string $endDate */
    public $endDate;

    /**
     * @return string
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param string $startDate
     */
    public function setStartDate($startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return string
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param string $endDate
     */
    public function setEndDate($endDate): void
    {
        $this->endDate = $endDate;
    }
}