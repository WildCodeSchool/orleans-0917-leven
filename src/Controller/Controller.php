<?php

namespace Leven\Controller;

use Leven\Model\BrandManager;
use Leven\Model\Brand;
use Leven\Service\ImageUploader;

/**
 * Class Controller
 *
 * @package Leven
 */
class Controller
{
    /**
     * The twig loader
     *
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../View');
        $this->twig = new \Twig_Environment(
            $loader,
            [ 'cache' => false ]
        );
    }

    /**
     * Retoune la liste des marques pour affichage dans la barre de navigation
     *
     * @return array
     */
    protected function getAllBrands()
    {
        $brandManager = new BrandManager();
        $brands = $brandManager->findAll();

        return $brands;
    }

    /**
     * Construit les chemins complets des images pour affichage dans la vue
     *
     * @param Brand $brand
     */
    protected function buildBrandPicturePaths(Brand &$brand)
    {
        if (!empty($brand->getLogoPicture())) {
            $brand->setLogoPicture(
                ImageUploader::buildPath($brand->getLogoPicture())
            );
        }

        if (!empty($brand->getBrandPicture())) {
            $brand->setBrandPicture(
                ImageUploader::buildPath($brand->getBrandPicture())
            );
        }

        if (!empty($brand->getModelPicture())) {
            $brand->setModelPicture(
                ImageUploader::buildPath($brand->getModelPicture())
            );
        }
    }
}
