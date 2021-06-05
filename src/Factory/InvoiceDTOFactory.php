<?php


namespace App\Factory;


use App\DTO\EventFrequencyDTO;
use App\DTO\EventPriceDTO;
use App\DTO\InvoiceDTO;

class InvoiceDTOFactory
{
    public static function create(
        int $id,
        float $totalPrice,
        array $invoiceItems,
        array $invoicedEvents,
        EventPriceDTO $eventPriceDTO,
        EventFrequencyDTO $eventFrequencyDTO
    )
    {
        $invoiceDTO = new InvoiceDTO();
        $invoiceDTO->setId($id);
        $invoiceDTO->setTotalPrice($totalPrice);
        $invoiceDTO->setInvoiceItemDetails($invoiceItems);
        $invoiceDTO->setInvoicedEvents($invoicedEvents);
        $invoiceDTO->setEventPrices($eventPriceDTO);
        $invoiceDTO->setEventFrequencies($eventFrequencyDTO);

        return $invoiceDTO;
    }
}