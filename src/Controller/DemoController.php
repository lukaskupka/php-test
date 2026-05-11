<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\PagedItems;
use App\Repository\FakeProductRepository;
use App\Service\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DemoController extends AbstractController
{
    public function __construct(
        private readonly FakeProductRepository $productRepository,
        private readonly Paginator $paginator,
    ) {
    }

    #[Route('/demo', name: 'app_demo_index')]
    public function index(Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $this->paginator->init($this->productRepository->loadCollection(), $page);

        if ($page > $this->paginator->getTotalPages()) {
            return $this->redirectToRoute('app_demo_index', ['currentPage' => $this->paginator->getTotalPages()]);
        }

        $data = new PagedItems(
            $this->paginator->getPagedItems(),
            $this->paginator->getCurrentPage(),
            $this->paginator->getTotalPages(),
            $this->paginator->hasPreviousPage(),
            $this->paginator->hasNextPage(),
        );

        return $this->render('demo.html.twig', ['data' => $data]);
    }
}
