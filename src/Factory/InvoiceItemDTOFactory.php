<?php


namespace App\Factory;


use App\DTO\InvoiceItemDTO;
use App\Entity\InvoiceItem;

class InvoiceItemDTOFactory
{
    public static function create(InvoiceItem $invoiceItem) : InvoiceItemDTO
    {
        $invoiceItemDTO = new InvoiceItemDTO();
        $invoiceItemDTO->setUserId($invoiceItem->getUser()->getId());
        $invoiceItemDTO->setUserEmail($invoiceItem->getUser()->getEmail());
        $invoiceItemDTO->setFirstActivationTime($invoiceItem->getUser()->getFirstActivationTime());
        $invoiceItemDTO->setFirstAppointmentTime($invoiceItem->getUser()->getFirstAppointmentTime());
        $invoiceItemDTO->setRegistrationTime($invoiceItem->getUser()->getRegisteredAt());
        $invoiceItemDTO->setCurrentPeriodEvents($invoiceItem->getCurrentPeriodNewEvents());
        $invoiceItemDTO->setPreviousPeriodsEvents($invoiceItem->getPreviousPeriodsNewEvents());
        $invoiceItemDTO->setPrice($invoiceItem->getPrice());

        return $invoiceItemDTO;
    }
}