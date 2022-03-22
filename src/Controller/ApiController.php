<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Repository\UserRepository;
use App\Repository\PhoneRepository;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class ApiController extends AbstractController
{
    #[Route('/api/phone', name: 'app_phone_index', methods: ['GET'])]
    public function index(PhoneRepository $phoneRepo, SerializerInterface $serializer, Request $request): Response
    {
        $phones = $phoneRepo->findAll();

        return $this->json($phones, 200, [], ['groups' => 'read:collection']);
    }

    #[Route('/api/phone', name: 'api_phone_index', methods: ['POST'])]
    public function createPhones(Request $request, SerializerInterface $serializer): Response
    {
        $json = $request->getContent();
        dd($json);
        $post = $serializer->deserialize($json, Phone::class, 'json');
        dd($post);
    }

    #[Route('/api/customer', name: 'api_customer_index', methods: ['GET'])]
    public function getCustomers(CustomerRepository $customerRepo, SerializerInterface $serializer): Response
    {
        //get user and display only his customers but need to be authenticated
        $customers = $customerRepo->findAll();
        return $this->json($customers, 200, [], ['groups' => 'read:collection']);
    }

    #[Route('/api/customer', name: 'api_customer_index', methods: ['POST'])]
    public function CreateCustomers(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, UserRepository $repoUser, ValidatorInterface $validator): Response
    {
        $json = $request->getContent();
        try {
            $customer = $serializer->deserialize($json, Customer::class, 'json');
            //TODO get user authentificated
            $user = $repoUser->findOneBy(["id" => 1]);
            // $user->setCustomers($customer);
            $customer->setClient($user);
            // $customer->setCreatedAt(new \Datetime('now'));
            $errors = $validator->validate($customer);
            if (count($errors) > 0) {
                return $this->json($errors, 400);
            }
            $em->persist($customer);
            $em->flush();
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ]);
        }
        return $this->json($customer, 201, [], ['groups' => 'read:collection']);
    }

    #[Route('/api/customer/{id}', name: 'api_customer_index', methods: ['DELETE'])]
    public function deleteCustomer(EntityManagerInterface $em, CustomerRepository $customerRepo, int $id, Request $request)
    {
        $json = $request->getContent();
        $customer = $customerRepo->findOneBy(['id' => $id]);

        //TODO get user auth if not authorized and

        // throw new JsonException("You do not have the required rights to make this request", JsonResponse::HTTP_UNAUTHORIZED);
        $em->remove($customer);
        $em->flush();
    }
}
