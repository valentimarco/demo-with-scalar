<?php

namespace App\State\Product;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\DTO\ProductDTO;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class CreateProductProcessor implements ProcessorInterface
{


    public function __construct(private EntityManagerInterface $manager)
    {
    }

    /**
     * @param ProductDTO $data
     * @param Operation $operation
     * @param array $uriVariables
     * @param array $context
     * @return Product
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): Product
    {
        $product = New Product();
        $product->setName($data->name);
        $this->manager->persist($product);
        $this->manager->flush();
        
        return $product;
    }
}