<?php


namespace App\Tests\Feature\Service;


use App\DataFixtures\AppFixtures;
use App\Entity\Invoice;
use App\Entity\InvoiceItem;
use App\Entity\User;
use App\Service\CustomerService;
use App\Service\InvoiceItemService;
use App\Service\InvoiceService;
use App\Service\UserService;
use App\Tests\FixtureAwareTestCase;

class InvoiceItemServiceTest extends FixtureAwareTestCase
{
    /** @var InvoiceItemService $invoiceItemService */
    private $invoiceItemService;
    /** @var InvoiceService $invoiceService */
    private $invoiceService;
    /** @var CustomerService $customerService */
    private $customerService;
    /** @var UserService $userService */
    private $userService;


    public function setUp(): void
    {
        parent::setUp();
        $this->addFixture(new AppFixtures());
        $this->executeFixtures();

        $this->invoiceItemService = $this->getContainer()->get(InvoiceItemService::class);
        $this->invoiceService = $this->getContainer()->get(InvoiceService::class);
        $this->customerService = $this->getContainer()->get(CustomerService::class);
        $this->userService = $this->getContainer()->get(UserService::class);
    }

    /**
     * @dataProvider makeInvoiceItemForUserDataProvider
     *
     * @param string $userEmail
     * @param $price
     * @param float $paid
     * @param array $currentPeriodEvents
     * @param array $previousPeriodsEvents
     * @throws \Exception
     */
    public function testMakeInvoiceItemForUserA(string $userEmail, $price, float $paid, array $currentPeriodEvents, array $previousPeriodsEvents)
    {
        $customer = $this->customerService->findCustomerByEmail('customer1@gmail.com');
        $invoice = $this->invoiceService->getInvoiceByCustomerAndTimeRange($customer->getId(),new \DateTime('2021-01-01'), new \DateTime('2021-02-01'));
        $user = $this->userService->getUserByEmail($userEmail);
        $invoiceItem = $this->invoiceItemService->makeInvoiceItemForUser($invoice, $user);

        $this->invoiceItemAsserts($price, $paid, $user, $invoice, $invoiceItem, $previousPeriodsEvents , $currentPeriodEvents);
    }

    public function makeInvoiceItemForUserDataProvider()
    {
        return [
            ['userA@gmail.com', .50, .49, ['activation'], ['registration']],
            ['userB@gmail.com', 3.50, .49,  ['appointment'], ['registration']],
            ['userC@gmail.com', .99, 0, ['registration', 'activation'], []],
            ['userD@gmail.com', 0, 3.99, [], ['registration', 'activation', 'appointment']],
        ];
    }

    public function testMakeInvoiceItemForUsers()
    {
        $customer = $this->customerService->findCustomerByEmail('customer1@gmail.com');
        $invoice = $this->invoiceService->getInvoiceByCustomerAndTimeRange($customer->getId(),new \DateTime('2021-01-01'), new \DateTime('2021-02-01'));
        $userA = $this->userService->getUserByEmail('userA@gmail.com');
        $userB = $this->userService->getUserByEmail('userB@gmail.com');

        $invoiceItems = $this->invoiceItemService->makeInvoiceItemForUsers($invoice, [$userA, $userB]);

        $this->assertEquals(2, count($invoiceItems));

        $this->invoiceItemAsserts(.50, .49, $userA, $invoice, $invoiceItems[0], ['registration'], ['activation']);
        $this->invoiceItemAsserts(3.50, .49, $userB, $invoice, $invoiceItems[1], ['registration'], ['appointment']);
    }

    private function invoiceItemAsserts(float $price, float $paid, User $user, Invoice $invoice, InvoiceItem $invoiceItem, array $expectedPreviousPeriodsEvents, array $expectedCurrentPeriodEvents)
    {
        $previousPeriodsEvents = $invoiceItem->getPreviousPeriodsNewEvents();
        $currentPeriodEvents =  $invoiceItem->getCurrentPeriodNewEvents();
        $this->assertEquals($price, $invoiceItem->getPrice());
        $this->assertEquals($user, $invoiceItem->getUser());
        $this->assertEquals($invoice, $invoiceItem->getInvoice());
        $this->assertEquals($paid, $invoiceItem->getUser()->getPaid());
        $this->assertEquals(implode(',', $expectedPreviousPeriodsEvents), $previousPeriodsEvents);
        $this->assertEquals(implode(',', $expectedCurrentPeriodEvents), $currentPeriodEvents);
    }
}