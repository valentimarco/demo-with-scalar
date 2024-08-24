<?php

namespace App\Story;

use App\Factory\OfferFactory;
use App\Factory\ProductFactory;
use Zenstruck\Foundry\Story;

final class ProductStory extends Story
{
    public function build(): void
    {
        ProductFactory::createOne([
            'name' => 'test-1',
            'offers' => OfferFactory::createMany(5)
        ]);
        ProductFactory::createOne([
            'name' => 'test-2',
            'offers' => OfferFactory::createMany(5)
        ]);
        ProductFactory::createOne([
            'name' => 'test-3',
            'offers' => OfferFactory::createMany(5)
        ]);
        ProductFactory::createOne([
            'name' => 'test-4',
            'offers' => OfferFactory::createMany(5)
        ]);
    }
}
