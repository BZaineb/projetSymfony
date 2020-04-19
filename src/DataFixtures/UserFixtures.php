<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder){
        $this->passwordEncoder =$passwordEncoder;

    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0;$i <5; $i++){
            $user = new User();
            $user->setNom("nom".$i);
            $user->setPrenom("prenom".$i);
            $user->setPseudo("pseudo".$i);
            $user->setEmail("nom".$i."@gmail.com");
            $user->setLocalite("Maroc");
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,"lePassword".$i));
            $manager->persist($user);
        }
        

        $manager->flush();
    }
}
