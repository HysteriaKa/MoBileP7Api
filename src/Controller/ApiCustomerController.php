<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class ApiCustomerController extends AbstractController
{
    #[Route('/apip/customer', name: 'app_apip_customer', methods: ['GET'])]
    public function index(CustomerRepository $customerRepo, SerializerInterface $serializer): Response
    {
        $user = $this->getUser();
        $customers = $customerRepo->findBy(['client'=>$user]);
        // $json = $serializer->serialize($customers, 'json', ['read:collection']);

        return $this->json($customers, 200, [], ['Groups' => 'read:collection']);
    }

    #[Route('/apip/customer', name: 'app_apip_customer', methods: ['POST'])]
    public function addCustomer(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator): Response
    {
        $user = $this->getUser();
        $jsonRecu = $request->getContent();
        try {
            $customer = $serializer->deserialize($jsonRecu, Customer::Class, 'json');
            $customer->setClient($user);
            $errors = $validator->validate($customer);
            
            if (count($errors) > 0) {
                return $this->json($errors, 400);
            }
            $em->persist($customer);
            $em->flush();
            return $this->json($customer, 201, [], ['Groups' => 'read:collection']);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ],400);
        }
    }
}
