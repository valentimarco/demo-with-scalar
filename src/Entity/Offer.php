<?php
// api/src/Entity/Offer.php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Post;
use App\DTO\OfferDTO;
use App\State\Offer\CreateOfferProcessor;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An offer from my shop - this description will be automatically extracted from the PHPDoc to document the API.
 *
 */
#[ORM\Entity]
#[ApiResource(
    uriTemplate: 'product/{id}/offer',
    types: ['https://schema.org/Offer'],
    operations: [
        new GetCollection(),
        new Post(input: OfferDTO::class, processor: CreateOfferProcessor::class)
    ],
    uriVariables: [
        "id" => new Link(fromProperty: 'product', fromClass: Offer::class )
    ], 
    normalizationContext: ['groups' => ['offer:read']]
)]
class Offer
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    #[Groups(['offer:read','product:read'])]
    private ?int $id = null;

    #[ORM\Column(type: 'text')]
    #[Groups(['offer:read','product:read'])]
    public string $description = '';

    #[ORM\Column]
    #[Groups(['offer:read','product:read'])]
    public float $price = 0;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'offers')]
    public ?Product $product = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    
}
