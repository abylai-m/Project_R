<?php

namespace App\DataFixtures;

use App\Entity\Dish;
use Doctrine\Persistence\ObjectManager;

class DishFixture extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(5, 'dishes', function(int $i) {
            $dish = new Dish();
            $dish->setName($this->faker->text(5));

            return $dish;
        });
        $manager->flush();
    }
}
