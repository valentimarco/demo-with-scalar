<?php

declare(strict_types=1);

namespace App\Controller\ScalarUi;


use ApiPlatform\OpenApi\Factory\OpenApiFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ScalarUiController extends AbstractController
{

    public function __construct(private readonly NormalizerInterface $normalizer, private readonly OpenApiFactoryInterface $openApiFactory)
    {
    }

    /**
     * @throws ExceptionInterface
     */
    public function __invoke(Request $request): Response
    {
        $openApi = $this->openApiFactory->__invoke( ['base_url' => $request->getBaseUrl() ?: '/'] );

        $openApiJson = $this->normalizer->normalize( $openApi, 'json', [] );

        //needed because, scalar by defualt take the url as server
        unset( $openApiJson["servers"] );

        return $this->render( 'docs.html.twig', ["openApiJson" => $openApiJson] );
    }
}
