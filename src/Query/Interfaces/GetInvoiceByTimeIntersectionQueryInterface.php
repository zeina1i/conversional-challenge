<?php


namespace App\Query\Interfaces;


use App\Entity\Invoice;

interface GetInvoiceByTimeIntersectionQueryInterface
{
    public function execute(int $customerId, \DateTime $startDate, \DateTime $endDate) : ?Invoice;

}