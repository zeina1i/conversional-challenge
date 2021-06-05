<?php


namespace App\Presentation\Rest;

use App\DTO\InvoiceCreateRequestDTO;
use App\UseCase\CreateInvoiceAndInvoiceItemsUseCase;
use App\UseCase\GetInvoiceWithInvoiceItemsUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Normalizer\ConstraintViolationListNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class InvoiceController
{
    private $createInvoiceAndInvoiceItemsUseCase;
    private $serializer;
    private $constraintViolationListNormalizer;
    private $getInvoiceWithInvoiceItemsUseCase;
    private $validator;

    public function __construct(
        CreateInvoiceAndInvoiceItemsUseCase $createInvoiceAndInvoiceItemsUseCase,
        SerializerInterface $serializer,
        ConstraintViolationListNormalizer $constraintViolationListNormalizer,
        ValidatorInterface $validator,
        GetInvoiceWithInvoiceItemsUseCase $getInvoiceWithInvoiceItemsUseCase
    )
    {
        $this->createInvoiceAndInvoiceItemsUseCase = $createInvoiceAndInvoiceItemsUseCase;
        $this->serializer = $serializer;
        $this->constraintViolationListNormalizer = $constraintViolationListNormalizer;
        $this->validator = $validator;
        $this->getInvoiceWithInvoiceItemsUseCase = $getInvoiceWithInvoiceItemsUseCase;
    }

    /**
     * @Route("/customer/{customerId}/invoice", methods={"POST"})
     * @param Request $request
     * @param int $customerId
     * @return mixed|JsonResponse
     * @throws \Exception
     */
    public function create(Request $request, int $customerId)
    {
        /** @var InvoiceCreateRequestDTO $DTO */
        [$response, $DTO] =$this->validate($request, InvoiceCreateRequestDTO::class);

        if ($response) {
            return $response;
        }

        $invoice = $this->createInvoiceAndInvoiceItemsUseCase->run($customerId, new \DateTime($DTO->getStartDate()), new \DateTime($DTO->getEndDate()));

        return new JsonResponse([
            'status' => true,
            'data' => [
                'id' =>$invoice->getId()
            ]
        ]);
    }

    /**
     * @Route("/customer/{customerId}/invoice/{invoiceId}", methods={"GET"})
     *
     * @param int $customerId
     * @param int $invoiceId
     * @return JsonResponse
     * @throws \App\Exception\BadRequestException
     * @throws \App\Exception\NotFoundException
     */
    public function get(int $customerId, int $invoiceId)
    {
        $invoiceDTO = $this->getInvoiceWithInvoiceItemsUseCase->run($customerId, $invoiceId);

        return new JsonResponse([
            'status' => true,
            'data' => [
                'invoice' => $invoiceDTO->jsonSerialize()
            ]
        ]);
    }

    private function validate(Request $request, $DTOType)
    {
        $DTO = $this->serializer->denormalize($request->request->all(), $DTOType);
        $violations = $this->validator->validate($DTO);
        if (\count($violations) > 0) {
            $message = $this->constraintViolationListNormalizer->normalize($violations);

            return [new Response(
                $this->serializer->serialize($message, 'json'),
                Response::HTTP_BAD_REQUEST,
                [
                    'Content-Type' => 'application/json'
                ]
            ), null];
        }

        return [null, $DTO];
    }
}