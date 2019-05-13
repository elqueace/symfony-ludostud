<?php

namespace App\DataFixtures;
use App\Entity\QuestionAnswer;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;
use Faker\Provider\Base;


class AppFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
         // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

            //////////////////////////////////////USERS/////////////////////////////////////
            $QR = new QuestionAnswer();
            $QR->setQuestion("ervwrvwr");
            $QR->setAnswer("rvwrvwrbvwrebwrbv93939339");
            $QR->setDomain("Sitecore");

            $manager->persist($QR);

         $manager->flush();

         $QR = new QuestionAnswer();
         $QR->setQuestion("eritinbvovwrvwr");
         $QR->setAnswer("blabla");
         $QR->setDomain("Symfony 4");

         $manager->persist($QR);

      $manager->flush();
      $QR = new QuestionAnswer();
      $QR->setQuestion("erv0fj0e00d0-nwrvwr");
      $QR->setAnswer("oeingvf");
      $QR->setDomain("Sitecore");

      $manager->persist($QR);

   $manager->flush();
    }

}
