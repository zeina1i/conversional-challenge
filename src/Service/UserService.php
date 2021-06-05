<?php


namespace App\Service;


use App\Entity\InvoiceItem;
use App\Entity\User;
use App\Enum\EventEnum;
use App\Query\Interfaces\GetUsersThatHaveToBeInvoicedQueryInterface;
use App\Repository\Interfaces\UserRepositoryInterface;

class UserService
{
    private $getUsersThatHaveToBeInvoicedQuery;
    private $userRepository;

    public function __construct(
        GetUsersThatHaveToBeInvoicedQueryInterface $getUsersThatHaveToBeInvoicedQuery,
        UserRepositoryInterface $userRepository
    )
    {
        $this->getUsersThatHaveToBeInvoicedQuery = $getUsersThatHaveToBeInvoicedQuery;
        $this->userRepository = $userRepository;
    }

    public function getUsersThatHaveToBeInvoiced(
        \DateTime $invoiceStartDate,
        \DateTime $invoiceEndDate,
        int $customerId,
        array $eventPriceMap = []) : array
    {
      return $this->getUsersThatHaveToBeInvoicedQuery->execute(
          $invoiceStartDate, $invoiceEndDate, $customerId, $eventPriceMap);
    }

    public function getUserOccurredEvents(User $user, \DateTime $from = null, \DateTime $to = null) : array
    {
        $events = [];
        if ($user->getRegisteredAt() && $this->checkEventOccurrence($user->getRegisteredAt(), $from, $to)) {
            $events[EventEnum::EVENT_REGISTRATION] = EventEnum::EVENT_REGISTRATION;
        }

        if ($user->getFirstActivationTime() && $this->checkEventOccurrence($user->getFirstActivationTime(), $from, $to)) {
            $events[EventEnum::EVENT_ACTIVATION] = EventEnum::EVENT_ACTIVATION;
        }

        if ($user->getFirstAppointmentTime() && $this->checkEventOccurrence($user->getFirstAppointmentTime(), $from, $to)) {
            $events[EventEnum::EVENT_APPOINTMENT] = EventEnum::EVENT_APPOINTMENT;
        }

        return $events;
    }

    private function checkEventOccurrence(\DateTime $eventTime, \DateTime $from = null, \DateTime $to = null)
    {
        if ($eventTime != null
            && ($from = null || $eventTime >= $from)
            && ($to = null || $eventTime < $to) ) {
            return true;
        }

        return false;
    }

    public function getUserByEmail(string $email) : ?User
    {
        return $this->userRepository->findByEmail($email);
    }

    public function updateUserBasedOnInvoiceItem(InvoiceItem $invoiceItem)
    {
        $user = $invoiceItem->getUser();
        $paid = $user->getPaid()+$invoiceItem->getPrice();
        $user->setPaid($paid);
        $this->userRepository->update($user);
    }
}