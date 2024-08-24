<?php

namespace App\State\Offer;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\DTO\OfferDTO;
use App\Entity\Offer;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CreateOfferProcessor implements ProcessorInterface
{

    public function __construct(private EntityManagerInterface $manager)
    {
    }

    /**
     * @param OfferDTO $data
     * @param Operation $operation
     * @param array $uriVariables
     * @param array $context
     * @return Offer
     * @throws \Doctrine\ORM\Exception\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): Offer
    {
       $product = $this->manager->find(Product::class, $uriVariables["id"]);
       if(is_null($product)){
           throw new NotFoundHttpException("Product with id " . $uriVariables["id"] . " not found");
       }
       $offer = new Offer();
       $offer->description = $data->description;
       $offer->price = $data->price;
       $this->manager->persist($offer);
       
       $product->addOffer($offer);
       $this->manager->flush();
       return $offer;
    }
}