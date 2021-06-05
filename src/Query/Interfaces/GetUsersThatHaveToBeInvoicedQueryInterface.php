<?php


namespace App\Query\Interfaces;


interface GetUsersThatHaveToBeInvoicedQueryInterface
{
    public function execute(\DateTime $from, \DateTime $to, int $customerId, array $eventPriceMap = []): array;
}