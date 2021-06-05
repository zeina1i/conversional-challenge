<?php


namespace App\Tests\Feature\UseCase;


use App\DataFixtures\AppFixtures;
use App\Entity\Invoice;
use App\Entity\InvoiceItem;
use App\Entity\User;
use App\Service\CustomerService;
use App\Service\UserService;
use App\Tests\FixtureAwareTestCase;
use App\UseCase\CreateInvoiceAndInvoiceItemsUseCase;

class CreateInvoiceAndInvoiceItemsUseCaseTest extends FixtureAwareTestCase
{
    /** @var CreateInvoiceAndInvoiceItemsUseCase $createInvoiceAndInvoiceItemsUseCase */
    private $createInvoiceAndInvoiceItemsUseCase;
    /** @var CustomerService $customerService */
    private $customerService;
    /** @var UserService $userService */
    private $userService;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        static::bootKernel();

        $this->addFixture(new AppFixtures());
        $this->executeFixtures();

        $this->customerService = $this->getContainer()->get(CustomerService::class);
        $this->createInvoiceAndInvoiceItemsUseCase = $this->getContainer()->get(CreateInvoiceAndInvoiceItemsUseCase::class);
        $this->userService = $this->getContainer()->get(UserService::class);
    }

    public function testCreateInvoiceAndInvoiceItems()
    {
        $customer = $this->customerService->findCustomerByEmail('customer2@gmail.com');
        $userA = $this->userService->getUserByEmail('userA2@gmail.com');
        $userB = $this->userService->getUserByEmail('userB2@gmail.com');
        $userC = $this->userService->getUserByEmail('userC2@gmail.com');
        $invoice = $this->createInvoiceAndInvoiceItemsUseCase->run($customer->getId(), new \DateTime('2021-01-01'), new \DateTime('2021-02-01'));

        $this->invoiceAsserts($invoice);

        $this->invoiceItemAsserts(.5, .99, $userA, $invoice, $invoice->getInvoiceItems()[0]);
        $this->invoiceItemAsserts(3.5, 3.99, $userB, $invoice, $invoice->getInvoiceItems()[1]);
        $this->invoiceItemAsserts(.99, .99, $userC, $invoice, $invoice->getInvoiceItems()[2]);
    }

    private function invoiceItemAsserts(float $price, float $paid, User $user, Invoice $invoice, InvoiceItem $invoiceItem)
    {
        $this->assertEquals($price, $invoiceItem->getPrice());
        $this->assertEquals($paid, $user->getPaid());
        $this->assertEquals($invoice, $invoiceItem->getInvoice());
    }

    private function invoiceAsserts(Invoice $invoice)
    {
        $this->assertEquals(new \DateTime('2021-01-01'), $invoice->getStartDate());
        $this->assertEquals(new \DateTime('2021-02-01'), $invoice->getEndDate());

        $this->assertEquals(1, $invoice->getRegistrationFrequency());
        $this->assertEquals(4, $invoice->getActivationFrequency());
        $this->assertEquals(2, $invoice->getAppointmentFrequency());

        $this->assertEquals(.49, $invoice->getRegistrationPrice());
        $this->assertEquals(.99, $invoice->getActivationPrice());
        $this->assertEquals(3.99, $invoice->getAppointmentPrice());

        $this->assertEquals(3, count($invoice->getInvoiceItems()));
    }
}