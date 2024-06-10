<?php

namespace App\Service;

use DateTime;
use League\Csv\Reader;
use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use League\Csv\Statement;
use Doctrine\ORM\EntityManagerInterface;

class CsvProcessor
{
    public function __construct(
        private EntityManagerInterface $em){
    }

    public function process(string $csvFilePath)
    {
        $csv = Reader::createFromPath($csvFilePath, 'r');
        $csv->setHeaderOffset(0);

        $records = (new Statement())->process($csv);

        foreach ($records as $record) {
            $employee = new Employee();
            $employee->setEmpID($record['Emp ID']);
            $employee->setUserName($record['User Name']);
            $employee->setNamePrefix($record['Name Prefix']);
            $employee->setFirstName($record['First Name']);
            $employee->setMiddleInitial($record['Middle Initial']);
            $employee->setLastName($record['Last Name']);
            $employee->setGender($record['Gender']);
            $employee->setEmail($record['E Mail']);

            // Parse Date of Birth
            $dateOfBirth = DateTime::createFromFormat('m/d/Y', $record['Date of Birth']);
            if ($dateOfBirth === false) {
                continue;
            }
            $employee->setDateOfBirth($dateOfBirth);

            // Parse Time of Birth
            $timeOfBirth = DateTime::createFromFormat('h:i:s A', $record['Time of Birth']);
            if ($timeOfBirth === false) {
                continue;
            }
            $employee->setTimeOfBirth($timeOfBirth);
  
            // Set other fields
            $employee->setAgeInYears((int)$record['Age in Yrs.']);
            $employee->setDateOfJoining(new \DateTime($record['Date of Joining']));
            $employee->setAgeInCompany((int)$record['Age in Company (Years)']);
            $employee->setPhoneNo($record['Phone No']);
            $employee->setPlaceName($record['Place Name']);
            $employee->setCounty($record['County']);
            $employee->setCity($record['City']);
            $employee->setZip($record['Zip']);
            $employee->setRegion($record['Region']);

            $this->em->persist($employee);
        }

        $this->em->flush();
    }

}
