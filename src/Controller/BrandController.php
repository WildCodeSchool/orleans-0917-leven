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
            if (!empty($brand->getLogoPicture())) {
                $brand->setLogoPicture('assets/images/uploads/' . $brand->getLogoPicture());
            }

            if (!empty($brand->getBrandPicture())) {
                $brand->setBrandPicture('assets/images/uploads/' . $brand->getBrandPicture());
            }

            if (!empty($brand->getModelPicture())) {
                $brand->setModelPicture('assets/images/uploads/' . $brand->getModelPicture());
            }

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
