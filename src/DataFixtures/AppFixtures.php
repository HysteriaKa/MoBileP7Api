<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Phone;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $colors = ['black', 'white', 'red', 'blue', 'pink', 'grey','black', 'white', 'red', 'blue', 'pink', 'grey','pink', 'grey','black', 'white', 'red', 'blue', 'pink', 'grey','pink', 'grey','black', 'white', 'red', 'blue', 'pink', 'grey'];
        for ($i = 0; $i < 20; $i++) {
            $phone = new Phone();
            $phone->setName($faker->unique()->words(mt_rand(2, 3), true));
            $phone->setColor($colors[$i]);
            $phone->setDescription($faker->sentence());
            $phone->setCreatedAt(new \DateTime);
            $phone->setPrice($faker->randomNumber(3));
            $manager->persist($phone);
        }

        $manager->flush();
    }
}
