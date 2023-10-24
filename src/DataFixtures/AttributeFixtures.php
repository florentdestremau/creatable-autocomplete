<?php

namespace App\DataFixtures;

use App\Entity\Attribute;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AttributeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (range(1, 5) as $item) {
            $attribute = new Attribute();
            $attribute->setName('Attribute ' . $item);

            $manager->persist($attribute);
        }

        $manager->flush();
    }
}
