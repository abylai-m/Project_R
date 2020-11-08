<?php

namespace App\DataFixtures;

use App\Entity\Table;
use Doctrine\Persistence\ObjectManager;

class TableFixture extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(5, 'tables', function(int $i) {
            $table = new Table();
            $table->setNumber(++$i);

            return $table;
        });
        $manager->flush();
    }
}
