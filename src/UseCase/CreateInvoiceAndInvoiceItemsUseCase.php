<?php


namespace App\UseCase;


use App\Entity\Invoice;
use App\Exception\BadRequestException;
use App\Exception\NotFoundException;
use App\Repository\MYSQL\DoctrineUnitOfWork;
use App\Service\CustomerService;
use App\Service\EventService;
use App\Service\InvoiceItemService;
use App\Service\InvoiceService;
use App\Service\SessionService;
use App\Service\UserService;

class CreateInvoiceAndInvoiceItemsUseCase
{
    private $customerService;
    private $invoiceService;
    private $userService;
    private $invoiceItemService;
    private $sessionService;
    private $eventService;
    private $unitOfWork;

    public function __construct(
        CustomerService $customerService,
        InvoiceService $invoiceService,
        UserService $userService,
        InvoiceItemService $invoiceItemService,
        SessionService $sessionService,
        EventService $eventService,
        DoctrineUnitOfWork $unitOfWork
    ) {
        $this->customerService = $customerService;
        $this->invoiceService = $invoiceService;
        $this->userService = $userService;
        $this->invoiceItemService = $invoiceItemService;
        $this->sessionService = $sessionService;
        $this->eventService = $eventService;
        $this->unitOfWork = $unitOfWork;
    }

    public function run(int $customerId, \DateTime $startDate, \DateTime $endDate) : Invoice
    {
        $customer = $this->customerService->getCustomer($customerId);
        if ($customer == null) {
            throw new NotFoundException("customer with id {$customerId} not found");
        }

        $intersectedInvoice = $this->invoiceService->getInvoiceByTimeIntersection($customerId, $startDate, $endDate);
        if ($intersectedInvoice instanceof Invoice) {
            throw new BadRequestException("another invoice date conflicted with the applied invoice date");
        }

        $this->unitOfWork->beginTransaction();
        try {
            $invoice = $this->invoiceService->createInvoice($customer, $startDate, $endDate);

            $users = $this->userService->getUsersThatHaveToBeInvoiced($startDate, $endDate, $customerId);

            $invoiceItems = $this->invoiceItemService->makeInvoiceItemForUsers($invoice, $users);
            $invoiceItems = $this->invoiceItemService->batchInsertInvoiceItems($invoiceItems);
            foreach ($invoiceItems as $invoiceItem) {
                $this->userService->updateUserBasedOnInvoiceItem($invoiceItem);
            }

            $eventFrequencyDTO = $this->sessionService->getInvoiceEventsFrequencies($customerId, $startDate, $endDate);
            $this->invoiceService->updateInvoiceBasedOnEventFrequencies($invoice, $eventFrequencyDTO);

            $eventsNamePriceMap = $this->eventService->getEventsNamePriceMap();
            $this->invoiceService->updateInvoiceBasedOnEventsNamePriceMap($invoice, $eventsNamePriceMap);

            $this->unitOfWork->flush();
            $this->unitOfWork->commit();
            $this->unitOfWork->refresh($invoice);

            return $invoice;
        } catch (\Exception $e) {
            $this->unitOfWork->rollback();
            throw $e;
        }
    }
}