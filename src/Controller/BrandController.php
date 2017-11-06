<?php

namespace Leven\Controller;

use Leven\Model\BrandManager;

class BrandController extends Controller
{
    public function brandAction($brandId)
    {
        $brandManager = new BrandManager();
        $brand = $brandManager->find($brandId);
        $response = '';

        if (!$brand) {
            $response = $this->twig->render(
                'error.html.twig', ['errorMessage' => 'Cette marque n\'existe plus.']
            );
        } else {
            $response = $this->twig->render(
                'brand.html.twig',
                [
                    'brand' => $brand,
                    'brands' => $this->getAllBrands(),
                ]
            );
        }

        return $response;
    }
}
