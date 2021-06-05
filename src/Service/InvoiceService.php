<?php

namespace App\Service;

use App\DTO\EventFrequencyDTO;
use App\Entity\Customer;
use App\Entity\Invoice;
use App\Enum\EventEnum;
use App\Factory\InvoiceFactory;
use App\Query\Interfaces\GetInvoiceByTimeIntersectionQueryInterface;
use App\Query\Interfaces\GetInvoiceWithInvoiceItemsAndUsersQueryInterface;
use App\Repository\Interfaces\InvoiceRepositoryInterface;
use App\Repository\Interfaces\UnitOfWorkInterface;

class InvoiceService
{
    private $invoiceRepository;
    private $unitOfWork;
    private $getInvoiceByTimeIntersectionQuery;
    private $getInvoiceWithInvoiceItemsAndUsersQuery;

    public function __construct(
        InvoiceRepositoryInterface $repository,
        UnitOfWorkInterface $unitOfWork,
        GetInvoiceByTimeIntersectionQueryInterface $getInvoiceByTimeIntersectionQuery,
        GetInvoiceWithInvoiceItemsAndUsersQueryInterface $getInvoiceWithInvoiceItemsAndUsersQuery
    )
    {
        $this->invoiceRepository = $repository;
        $this->unitOfWork = $unitOfWork;
        $this->getInvoiceByTimeIntersectionQuery = $getInvoiceByTimeIntersectionQuery;
        $this->getInvoiceWithInvoiceItemsAndUsersQuery = $getInvoiceWithInvoiceItemsAndUsersQuery;
    }

    public function getInvoice(int $id): ?Invoice
    {
        /** @var Invoice|null $invoice */
        $invoice = $this->invoiceRepository->find($id);

        return $invoice;
    }

    public function getInvoiceByCustomerAndTimeRange(int $customerId, \DateTime $startDate, \DateTime $endDate)
    {
        return $this->invoiceRepository->findByCustomerAndTimeRange($customerId, $startDate, $endDate);
    }

    public function createInvoice(Customer $customer, \DateTime $startDate, \DateTime $endDate): Invoice
    {
        $invoice = InvoiceFactory::createInitialInvoiceObject($customer, $startDate, $endDate);

        $this->invoiceRepository->add($invoice);
        $this->unitOfWork->flush();

        return $invoice;
    }

    public function updateInvoiceBasedOnEventFrequencies(Invoice $invoice, EventFrequencyDTO $eventFrequencyDTO)
    {
        $invoice->setRegistrationFrequency($eventFrequencyDTO->getRegistrationFrequency());
        $invoice->setActivationFrequency($eventFrequencyDTO->getActivationFrequency());
        $invoice->setAppointmentFrequency($eventFrequencyDTO->getAppointmentFrequency());
        $this->invoiceRepository->update($invoice);
        $this->unitOfWork->flush();
    }

    public function updateInvoiceBasedOnEventsNamePriceMap(Invoice $invoice, array $eventsNamePriceMap)
    {
        $invoice->setRegistrationPrice($eventsNamePriceMap[EventEnum::EVENT_REGISTRATION]);
        $invoice->setActivationPrice($eventsNamePriceMap[EventEnum::EVENT_ACTIVATION]);
        $invoice->setAppointmentPrice($eventsNamePriceMap[EventEnum::EVENT_APPOINTMENT]);
        $this->invoiceRepository->update($invoice);
        $this->unitOfWork->flush();
    }

    public function getInvoiceByTimeIntersection(int $customerId, \DateTime $startDate, \DateTime $endDate) : ?Invoice
    {
        return $this->getInvoiceByTimeIntersectionQuery->execute($customerId, $startDate, $endDate);
    }

    public function getInvoiceWithInvoiceItemsAndUsers(int $invoiceId) : ?Invoice
    {
        return $this->getInvoiceWithInvoiceItemsAndUsersQuery->execute($invoiceId);
    }
}