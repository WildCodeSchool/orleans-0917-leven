<?php

namespace Leven\Controller;

use Leven\Model\BrandManager;
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
            $path = 'assets/images/uploads/' . $fileName;
            if (file_exists($path)) {
                unlink($path);
            }
        }
    }
}
