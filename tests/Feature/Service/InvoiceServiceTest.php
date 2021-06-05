<?php


namespace App\Tests\Feature\Service;


use App\DataFixtures\AppFixtures;
use App\Entity\Customer;
use App\Service\CustomerService;
use App\Service\InvoiceService;
use App\Tests\FixtureAwareTestCase;

class InvoiceServiceTest extends FixtureAwareTestCase
{
    /** @var InvoiceService $invoiceService */
    private $invoiceService;
    /** @var CustomerService $customerService */
    private $customerService;

    public function setUp(): void
    {
        parent::setUp();
        static::bootKernel();

        $this->addFixture(new AppFixtures());
        $this->executeFixtures();

        $this->customerService = $this->getContainer()->get(CustomerService::class);
        $this->invoiceService = $this->getContainer()->get(InvoiceService::class);
    }

    public function testCreateInvoice()
    {
        /** @var Customer $customer */
        $startDate = new \DateTime('2021-06-04 10:08:06');
        $endDate = new \DateTime('2019-06-04 10:08:06');
        $customer = $this->customerService->findCustomerByEmail('customer1@gmail.com');
        $invoice = $this->invoiceService->createInvoice($customer, $startDate, $endDate);

        $this->assertEquals('customer1@gmail.com', $customer->getEmail());
        $this->assertEquals($startDate->format('Y-m-d H:i:s'), $invoice->getStartDate()->format('Y-m-d H:i:s'));
        $this->assertEquals($endDate->format('Y-m-d H:i:s'), $invoice->getEndDate()->format('Y-m-d H:i:s'));
    }
}