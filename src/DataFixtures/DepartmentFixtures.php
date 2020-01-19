<?php

namespace App\DataFixtures;

use App\Entity\Department;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class DepartmentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $departmentNames = ['Direction', 'Ressources Humaines',
                            'Communication', 'Marketing'];

        foreach ($departmentNames as $name) {
            $department = new Department();
            $department->setName($name);
            // We get the manager from the UserFixtures using the DepartmentName as Reference
            $department->setManager($this->getReference($name));
            $manager->persist($department);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return array(
            UserFixtures::class
        );
    }
}
