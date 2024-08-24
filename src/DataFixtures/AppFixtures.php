<?php

namespace App\DataFixtures;

use App\Story\OfferStory;
use App\Story\ProductStory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        OfferStory::load();
        ProductStory::load();
    }
}
