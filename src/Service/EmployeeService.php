<?php

namespace App\Service;

use App\Entity\Employee;
use Doctrine\DBAL\Exception;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;

class EmployeeService
{

    public function __construct(
        private EntityManagerInterface $em
        ){ 
    }

    public function getEmployees(): array
    {
        $employees = $this->em->getRepository(Employee::class)->findAll();
        $serializedEmployees = [];

        foreach ($employees as $employee) {
            $serializedEmployees[] = [
                'Employee ID' => $employee->getEmpID(),
                'Name Prefix' => $employee->getNamePrefix(),
                'First Name' => $employee->getFirstName(),
                'Middle Initial' => $employee->getMiddleInitial(),
                'Last Name' => $employee->getLastName(),
                'Gender' => $employee->getGender(),
                'E Mail' => $employee->getEmail(),
                'Date of Birth' => $employee->getDateOfBirth(),
                'Time of Birth' => $employee->getTimeOfBirth(),
                'Age in Yrs' => $employee->getAgeInYears(),
                'Date of Joining' => $employee->getDateOfJoining(),
                'Age in Company (Years)' => $employee->getAgeInCompany(),
                'Phone No' => $employee->getPhoneNo(),
                'Place Name' => $employee->getPlaceName(),
                'County' => $employee->getCounty(),
                'City' => $employee->getCity(),
                'zip' => $employee->getZip(),
                'Region' => $employee->getRegion(),
                'User Name' => $employee->getUserName(),
            ];
        }
        return $serializedEmployees;
    }

    public function getEmployee($id) 
    {
        $employee = $this->em->getRepository(Employee::class)->find($id);

        if (!$employee)
        {
            throw new Exception("Employee not found", 1);
        }

        $serializedEmployee = [];

        $serializedEmployee[] = [
            'Employee ID' => $employee->getEmpID(),
            'Name Prefix' => $employee->getNamePrefix(),
            'First Name' => $employee->getFirstName(),
            'Middle Initial' => $employee->getMiddleInitial(),
            'Last Name' => $employee->getLastName(),
            'Gender' => $employee->getGender(),
            'E Mail' => $employee->getEmail(),
            'Date of Birth' => $employee->getDateOfBirth(),
            'Time of Birth' => $employee->getTimeOfBirth(),
            'Age in Yrs' => $employee->getAgeInYears(),
            'Date of Joining' => $employee->getDateOfJoining(),
            'Age in Company (Years)' => $employee->getAgeInCompany(),
            'Phone No' => $employee->getPhoneNo(),
            'Place Name' => $employee->getPlaceName(),
            'County' => $employee->getCounty(),
            'City' => $employee->getCity(),
            'zip' => $employee->getZip(),
            'Region' => $employee->getRegion(),
            'User Name' => $employee->getUserName(),
        ];
        return $serializedEmployee;
    }

    public function deleteEmployee($id)
    {
        $employee = $this->em->getRepository(Employee::class)->find($id);

        if (!$employee)
        {
            throw new Exception("Employee not found", 1);
        }
        $this->em->remove($employee);
        $this->em->flush();
    }
}
