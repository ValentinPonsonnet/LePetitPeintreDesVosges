<?php

namespace App\DataFixtures;

use App\Entity\Blogpost;
use App\Entity\Categorie;
use App\Entity\Peinture;
use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        //Utilisation de Faker
        $faker = Factory::create('fr_FR');

        //Cration d'un utilisateur
        $user = new User();

        $user
        ->setEmail('user@gmail.com')
        ->setPrenom($faker->firstName())
        ->setNom($faker->lastName())
        ->setTelephone($faker->phoneNumber())
        ->setApropos($faker->text())
        ->setInstagram('instagram');

        $password = $this->encoder->encodePassword($user, 'password');
        $user->setPassword($password);

        $manager->persist($user);

        //Création de 10 Blogpost
        for ($i=0; $i<10; $i++) {
            $blogpost = new Blogpost();

            $blogpost
            ->setTitre($faker->words(3, true))
            ->setDate($faker->dateTimeBetween('-1 day', 'now'))
            ->setContenu($faker->text(350))
            ->setSlug($faker->slug(3))
            ->setUser($user);

            $manager->persist($blogpost);
        }

        //Création des catégories
        for ($j=0;$j<5;$j++) {
            $categorie = new Categorie();

            $categorie
            ->setNom($faker->word())
            ->setDescription($faker->words(10, true))
            ->setSlug($faker->slug());
            
            $manager->persist($categorie);
            
            //Creation des peintures
            for ($k=0; $k<2; $k++) {
                $peinture = new Peinture();

                $peinture
                ->setNom($faker->words(3, true))
                ->setLargeur($faker->randomFloat(2, 20, 60))
                ->setHauteur($faker->randomFloat(2, 20, 60))
                ->setEnVente($faker->randomElement([true, false]))
                ->setDateRealisation($faker->dateTimeBetween('-1 month', 'now'))
                ->setDate($faker->dateTimeBetween('-1 month', 'now'))
                ->setDescription($faker->text(350))
                ->setPortefolio($faker->randomElement([true, false]))
                ->setSlug($faker->slug())
                ->setFile('/img/placeholder.jpeg')
                ->addCategorie($categorie)
                ->setPrix($faker->randomFloat(2, 100, 9999))
                ->setUser($user);

                $manager->persist($peinture);
            }
        }

        $manager->flush();
    }
}
