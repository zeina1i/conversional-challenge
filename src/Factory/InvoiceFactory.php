<?php


namespace App\Factory;


use App\Entity\Customer;
use App\Entity\Invoice;

class InvoiceFactory
{
    public static function createInitialInvoiceObject(Customer $customer, \DateTime $startDate, \DateTime $endDate) : Invoice
    {
        $invoice = new Invoice();
        $invoice->setCustomer($customer);
        $invoice->setStartDate($startDate);
        $invoice->setEndDate($endDate);
        $invoice->setActivationFrequency(0);
        $invoice->setAppointmentFrequency(0);
        $invoice->setRegistrationFrequency(0);
        $invoice->setActivationPrice(0);
        $invoice->setAppointmentPrice(0);
        $invoice->setRegistrationPrice(0);

        return $invoice;
    }
}