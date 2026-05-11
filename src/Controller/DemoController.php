<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\PagedItemsDto;
use App\Services\FakeProductRepository;
use App\Services\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

class DemoController extends AbstractController
{
    public function __construct(private FakeProductRepository $productRepository, private Paginator $paginator)
    {
    }

    #[Route('/demo', name: 'app_demo_index')]
    public function index(
        #[MapQueryParameter] int $page = 1
    ): Response
    {
        $this->paginator->init($this->productRepository->loadCollection(), $page);

        if ($page > $this->paginator->getTotalPages())
        {
            return $this->redirectToRoute('app_demo_index', ['currentPage' => $this->paginator->getTotalPages()]);
        }

        $data = new PagedItemsDto(
            $this->paginator->getPagedItems(),
            $this->paginator->getCurrentPage(),
            $this->paginator->getTotalPages(),
            $this->paginator->hasPreviousPage(),
            $this->paginator->hasNextPage(),
        );

        dump($page, $data);
        return $this->render('demo.html.twig', [                 'data' => $data            ]        );
    }
}
