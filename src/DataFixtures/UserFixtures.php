<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $usersData = [['didier','dupont','didier.dupont@mailthatdoesntexist.com','Direction'],
            ['paul','lemaitre','paul.lemaitre@mailthatdoesntexist.com','Ressources Humaines'],
            ['pierre','bolt','pierre.bolt@mailthatdoesntexist.com','Communication'],
            ['claire','hawk','claire.hawk@mailthatdoesntexist.com','Marketing']];

        foreach ($usersData as $userData) {
            $user = new User();
            $user->setFirstname($userData[0])
                ->setLastname($userData[1])
                ->setEmail($userData[2]);
            $manager->persist($user);
            // We set a reference to the user using his Department to
            // avoid unnecessary query in DepartmentFixtures
            $this->addReference($userData[3],$user);
        }
        $manager->flush();
    }

}
