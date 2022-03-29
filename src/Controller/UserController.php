<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class UserController extends AbstractController
{
    
    public function __invoke(User $data)
    {
        $count = $data->getCustomers()->count();
        return $this->json([
            "id" =>$data->getId(),
            "nbrCustomer" => $count
        ]);
    }
}
