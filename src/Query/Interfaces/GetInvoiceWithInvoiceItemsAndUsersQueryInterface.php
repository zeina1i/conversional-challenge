<?php


namespace App\Query\Interfaces;


use App\Entity\Invoice;

interface GetInvoiceWithInvoiceItemsAndUsersQueryInterface
{
    public function execute(int $invoiceId) : ?Invoice;
}