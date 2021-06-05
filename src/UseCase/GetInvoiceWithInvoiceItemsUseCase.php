<?php


namespace App\UseCase;


use App\DTO\InvoiceDTO;
use App\Exception\BadRequestException;
use App\Exception\NotFoundException;
use App\Service\InvoiceService;
use App\Transformer\InvoiceToInvoiceDTOTransformer;

class GetInvoiceWithInvoiceItemsUseCase
{
    private $invoiceService;
    private $invoiceToInvoiceDTOTransformer;

    public function __construct(
        InvoiceService $invoiceService,
        InvoiceToInvoiceDTOTransformer $invoiceToInvoiceDTOTransformer
    ) {
        $this->invoiceService = $invoiceService;
        $this->invoiceToInvoiceDTOTransformer = $invoiceToInvoiceDTOTransformer;
    }

    public function run(int $customerId, int $invoiceId) : InvoiceDTO
    {
        $invoice = $this->invoiceService->getInvoiceWithInvoiceItemsAndUsers($invoiceId);
        if ($invoice == null) {
            throw new NotFoundException("invoice with id: {$invoiceId} not found");
        }

        if ($invoice->getCustomer()->getId() != $customerId) {
            throw new BadRequestException("invoice with id: {$invoiceId} does not belong to customer with id:{$customerId}");
        }

        $invoiceDTO = $this->invoiceToInvoiceDTOTransformer->transform($invoice);

        return $invoiceDTO;
    }
}