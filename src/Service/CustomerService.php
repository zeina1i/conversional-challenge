<?php


namespace App\Service;


use App\Repository\Interfaces\CustomerRepositoryInterface;

class CustomerService
{
    private $customerRepository;

    public function __construct(
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->customerRepository = $customerRepository;
    }

    public function findCustomerByEmail(string $email)
    {
        return $this->customerRepository->findByEmail($email);
    }

    public function getCustomer(int $id)
    {
        return $this->customerRepository->find($id);
    }
}