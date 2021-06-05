<?php


namespace App\Repository\Interfaces;


use App\Entity\InvoiceItem;

interface InvoiceItemRepositoryInterface
{
    public function add(InvoiceItem $invoiceItem);
}