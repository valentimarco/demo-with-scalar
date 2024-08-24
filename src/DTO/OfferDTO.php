<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class OfferDTO
{   
    #[Assert\NotBlank]
    public string $description;
    
    #[Assert\Range(minMessage: 'The price must be superior to 0.', min: 0)]
    public float $price;
}