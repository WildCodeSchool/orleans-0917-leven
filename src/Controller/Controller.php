<?php

namespace Leven\Controller;

use Leven\Model\BrandManager;
use Leven\Model\Brand;
use Leven\Model\Company;
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

    /**
     * Construit les chemins complets des images pour affichage dans la vue
     *
     * @param Brand $brand
     */
    protected function buildCompanyPicturePaths(Company &$company)
    {
        if (!empty($company->getPicture1())) {
            $company->setPicture1(
                ImageUploader::buildPath($company->getPicture1())
            );
        }

        if (!empty($company->getPicture2())) {
            $company->setPicture2(
                ImageUploader::buildPath($company->getPicture2())
            );
        }

        if (!empty($company->getPicture3())) {
            $company->setPicture3(
                ImageUploader::buildPath($company->getPicture3())
            );
        }
    }

    /**
     * @param $imgId
     * @param array $errorMessages
     * @return mixed
     */
    protected function createImageUploader($imgId, array &$errorMessages)
    {
        $uploader = false;
        if (!empty($_FILES[$imgId])
            && $_FILES[$imgId]['error'] !== UPLOAD_ERR_NO_FILE
        ) {
            $uploader = new ImageUploader($_FILES[$imgId]);

            if (!$uploader->checkUpload()) {
                $errorMessages = array_merge($errorMessages, $uploader->getErrorMessages());
                $uploader = false;
            }
        }

        return $uploader;
    }

    /**
     * @param mixed $fileName
     */
    protected function tryDeleteFile($fileName)
    {
        if ($fileName != null) {
            $path = ImageUploader::buildPath($fileName);
            if (file_exists($path)) {
                unlink($path);
            }
        }
    }
}
