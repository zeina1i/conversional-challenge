<?php

namespace App\Service;

use App\Entity\Invoice;
use App\Entity\InvoiceItem;
use App\Entity\User;
use App\Repository\Interfaces\InvoiceItemRepositoryInterface;
use App\Repository\Interfaces\UnitOfWorkInterface;

class InvoiceItemService
{
    private $eventService;
    private $unitOfWork;
    private $invoiceItemRepository;
    private $userService;

    public function __construct(
        EventService $eventService,
        UnitOfWorkInterface $unitOfWork,
        InvoiceItemRepositoryInterface $invoiceItemRepository,
        UserService $userService
    )
    {
        $this->eventService = $eventService;
        $this->unitOfWork = $unitOfWork;
        $this->invoiceItemRepository = $invoiceItemRepository;
        $this->userService = $userService;
    }

    public function makeInvoiceItemForUser(Invoice $invoice, User $user)
    {
        $currentPeriodNewEvents = $this->userService->getUserOccurredEvents($user, $invoice->getStartDate(), $invoice->getEndDate());
        $previousPeriodsNewEvents = $this->userService->getUserOccurredEvents($user, null, $invoice->getStartDate());
        $eventsNamePriceMap = $this->eventService->getEventsNamePriceMap();
        $maxPrice = 0;

        foreach ($eventsNamePriceMap as $eventName => $price) {
            if (isset($currentPeriodNewEvents[$eventName]) && $maxPrice < $price) {
                $maxPrice = $price;
            }
        }

        $invoiceItem = new InvoiceItem();
        $invoiceItem->setPrice(max($maxPrice - $user->getPaid(), 0));
        $invoiceItem->setUser($user);
        $invoiceItem->setInvoice($invoice);
        $invoiceItem->setCurrentPeriodNewEvents(implode(',', $currentPeriodNewEvents));
        $invoiceItem->setPreviousPeriodsNewEvents(implode(',', $previousPeriodsNewEvents));

        return $invoiceItem;
    }

    public function makeInvoiceItemForUsers(Invoice $invoice, array $users)
    {
        $invoiceItems = [];

        foreach ($users as $user) {
            $invoiceItem = $this->makeInvoiceItemForUser($invoice, $user);
            $invoiceItems[] = $invoiceItem;
        }

        return $invoiceItems;
    }

    public function batchInsertInvoiceItems(array $invoiceItems) : array
    {
        /** @var InvoiceItem $invoiceItem */
        foreach ($invoiceItems as $invoiceItem) {
            $this->invoiceItemRepository->add($invoiceItem);
        }
        $this->unitOfWork->flush();

        return $invoiceItems;
    }
}