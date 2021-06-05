<?php


namespace App\Repository\Interfaces;


use App\Entity\Invoice;

interface InvoiceRepositoryInterface
{
    public function add(Invoice $invoice);
    public function update(Invoice $invoice);
    public function find(int $id);
    public function findByCustomerAndTimeRange($customerId, \DateTime $startDate, \DateTime $endDate);
}