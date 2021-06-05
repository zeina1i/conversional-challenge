<?php


namespace App\Transformer;


use App\DTO\InvoiceDTO;
use App\Entity\Invoice;
use App\Enum\EventEnum;
use App\Factory\EventFrequencyDTOFactory;
use App\Factory\EventPriceDTOFactory;
use App\Factory\InvoiceDTOFactory;
use App\Factory\InvoiceItemDTOFactory;

class InvoiceToInvoiceDTOTransformer
{
    public function transform(Invoice $invoice) : InvoiceDTO
    {
        $eventPriceDTO = EventPriceDTOFactory::create($invoice->getAppointmentPrice(),
            $invoice->getActivationPrice(),
            $invoice->getRegistrationPrice());

        $eventFrequencyDTO = EventFrequencyDTOFactory::create(
            $invoice->getRegistrationFrequency(),
            $invoice->getActivationFrequency(),
            $invoice->getAppointmentFrequency());

        $events = [];
        if ($eventFrequencyDTO->getRegistrationFrequency() > 0) {
            $events[] = EventEnum::EVENT_REGISTRATION;
        }
        if ($eventFrequencyDTO->getActivationFrequency() > 0) {
            $events[] = EventEnum::EVENT_ACTIVATION;
        }
        if ($eventFrequencyDTO->getAppointmentFrequency() > 0) {
            $events[] = EventEnum::EVENT_APPOINTMENT;
        }

        $invoiceItemDTOs = [];
        foreach ($invoice->getInvoiceItems() as $invoiceItem) {
            $invoiceItemDTOs[] = InvoiceItemDTOFactory::create($invoiceItem);
        }

        $invoiceDTO = InvoiceDTOFactory::create($invoice->getId(),
            floatval($invoice->getTotalPrice()), $invoiceItemDTOs, $events, $eventPriceDTO, $eventFrequencyDTO);

        return $invoiceDTO;
    }
}