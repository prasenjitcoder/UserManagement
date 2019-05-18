<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture {

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager) {
        $user = new User();
        $user->setUsername("Admin");
        $user->setEmail("Admin@yopmail.com");
        $user->setFirstName("Admin");
        $user->setLastName("Admin");
        $user->setCreationTime(new \DateTime());
        $user->setLastModTime(new \DateTime());
        $user->setPassword($this->passwordEncoder->encodePassword($user, "Admin123"));
        $manager->persist($user);

        $manager->flush();
        
        $user1 = new User();
        $user1->setUsername("testuser");
        $user1->setEmail("testuser@yopmail.com");
        $user1->setFirstName("testuser");
        $user1->setLastName("testuser");
        $user1->setCreationTime(new \DateTime());
        $user1->setLastModTime(new \DateTime());
        $user1->setPassword($this->passwordEncoder->encodePassword($user1, "testuser"));
        $manager->persist($user1);

        $manager->flush();
    }

}
