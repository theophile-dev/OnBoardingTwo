<?php


namespace App\Controller;

use App\Repository\DepartmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class APIDepartmentController extends AbstractController
{
    public function list(DepartmentRepository $departmentRepository): Response {
        // This return all the fields in the Department Class, maybe we don't need the manager
        return $this->json($departmentRepository->findAll(), Response::HTTP_OK);
    }
}