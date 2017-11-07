<?php

namespace Leven\Controller;

use Leven\Model\Brand;
use Leven\Model\BrandManager;

class BrandStyleController extends Controller
{
    public function brandStyleAction($brandId)
    {
        // Important: Assume the $brandId exist in database

        $brandManager = new BrandManager();
        $brand = $brandManager->find($brandId);

        if (!$brand) {
            $brand = new Brand();
        }

        $viewParams = [
            'brand' => $brand,
            'imgRatios' =>
                [
                    'brandValue' => $this->calculateImageAspectRatio($brand->getBrandPicture()),
                    'modelValue' => $this->calculateImageAspectRatio($brand->getModelPicture()),
                ],
        ];

        $response = $this->twig->render(
            'brandstyle.css.twig',
            $viewParams
        );

        return $response;
    }


    protected function calculateImageAspectRatio($imgFileName) : float
    {
        $result = 0;

        if ($imgFileName) {
            $pathToImage = 'assets/images/uploads/' . $imgFileName;
            list($width, $height, $type, $attr) = getimagesize($pathToImage);
            $result = round($width / $height, 4);
        }

        return $result;
    }
}
