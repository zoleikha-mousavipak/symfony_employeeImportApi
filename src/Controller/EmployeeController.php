<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Service\CsvProcessor;
use App\Service\EmployeeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmployeeController extends AbstractController
{

    public function __construct(
        private CsvProcessor $csvProcessor,
        private EmployeeService $employeeService) {
    }

    #[Route('/api/employee', name: 'upload_employees', methods: "POST")]

    public function upload(Request $request): Response
    {
        $file = $request->files->get('file');
        if (!$file) {
            return $this->json(['error' => 'No file uploaded'], Response::HTTP_BAD_REQUEST);
        }

        $csvFilePath = $file->getRealPath();
        $this->csvProcessor->process($csvFilePath);

        return $this->json(['status' => 'File processed successfully'], Response::HTTP_OK);
    }

    #[Route('/api/employee', name: 'employee_list', methods: "GET")]
    public function list(): JsonResponse
    {
        $employees =$this->employeeService->getEmployees();
        return $this->json($employees);
    }

    #[Route('/api/employee/{id}', name: 'employee_get', methods: "GET")]
    public function getEmployee(int $id): JsonResponse
    {
        $employee =$this->employeeService->getEmployee($id);

        if (!$employee) {
            return $this->json(['error' => 'Employee not found'], Response::HTTP_NOT_FOUND);
        }
        return $this->json($employee);
    }

    #[Route('/api/employee/{id}', name: 'employee_delete', methods: "DELETE")]
    public function deleteEmployee(int $id): JsonResponse
    {
        try {
            $this->employeeService->deleteEmployee($id);
            return $this->json(['message' => 'Employee deleted successfully'], Response::HTTP_OK);

        } catch (\Exception $e) {
            return $this->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }

    }

}
