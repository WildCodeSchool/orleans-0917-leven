<?php

namespace Leven\Controller\Admin;

use Leven\Controller\Controller;
use Leven\Model\Brand;
use Leven\Model\BrandManager;
use Leven\Service\ImageUploader;

class BrandController extends Controller
{
    /**
     * @return string
     */
    public function brandAction()
    {
        $brands = $this->getAllBrands();
        foreach ($brands as $brand) {
            $this->buildBrandPicturePaths($brand);
        }

        return $this->twig->render(
            'Admin/brandlist.html.twig',
            ['brands' => $brands]
        );
    }

    /**
     * @return string
     */
    public function addBrandAction()
    {
        $errorMessages = [];
        $brand = new Brand();

        if (!empty($_POST)) {
            if ($this->checkPost($brand, $errorMessages)) {
                $brandManager = new BrandManager();
                $brandId = $brandManager->insert($brand);

                header('Location: admin.php?route=edit-marque&id=' . $brandId);
                exit;
            }
        }

        return $this->twig->render(
            'Admin/addbrand.html.twig',
            [
                'brand' => $brand,
                'brands' => $this->getAllBrands(),
                'errorMessages' => $errorMessages,
                'postUrl' => 'admin.php?route=ajout-marque',
            ]
        );
    }

    /**
     * @param int $brandId
     * @return string
     */
    public function editBrandAction(int $brandId)
    {
        $errorMessages = [];
        $brandManager = new BrandManager();
        $brand = $brandManager->find($brandId);
        $response = '';

        if (!$brand) {
            $response = $this->twig->render(
                'error.html.twig',
                ['errorMessage' => 'Cette marque n\'existe plus.']
            );
        } else {
            if (!empty($_POST)) {
                if ($this->checkPost($brand, $errorMessages)) {
                    $brandManager->update($brand);

                    header('Location: admin.php?route=edit-marque&id=' . $brandId);
                    exit;
                }
            }

            $this->buildBrandPicturePaths($brand);

            $response = $this->twig->render(
                'Admin/editbrand.html.twig',
                [
                    'brand' => $brand,
                    'brands' => $this->getAllBrands(),
                    'errorMessages' => $errorMessages,
                    'postUrl' => 'admin.php?route=edit-marque&id=' . $brandId,
                ]
            );
        }

        return $response;
    }

    public function deleteBrandAction($id)
    {
       $brandManager = new BrandManager();

       $brand = $brandManager->find($id);
       $this->tryDeleteFile($brand->getLogoPicture());
       $this->tryDeleteFile($brand->getBrandPicture());
       $this->tryDeleteFile($brand->getModelPicture());

       $brandManager->delete($brand);
       return $this->brandAction();
    }

    private function checkPost(Brand &$brand, array &$errorMessages) : bool
    {
        $result = false;

        $uploaders = [
            'logo_picture' => false,
            'brand_picture' => false,
            'model_picture' => false
        ];

        $name = trim($_POST['name']);
        if (!empty($name)) {
            if (strlen($name) < 30) {
                $brand->setName(ucwords($name));
            } else {
                $errorMessages[] = 'Vous ne devez pas dépasser 30 caractères pour le nom de la marque.';
            }
        } else {
            $errorMessages[] = 'Vous devez entrer au minimum le nom de la marque pour qu\'elle appraisse dans les menus.';
        }

        if (!empty($_POST['introduction_text'])) {
            $brand->setIntroductionText($_POST['introduction_text']);
        }

        if (!empty($_POST['article_text'])) {
            $brand->setArticleText($_POST['article_text']);
        }

        foreach ($uploaders as $imgId => $uploader) {
            $uploaders[$imgId] = $this->createImageUploader($imgId, $errorMessages);
        }

        if (empty($errorMessages)) {
            foreach ($uploaders as $imgId => $uploader) {
                if ($uploader) {
                    if (!$uploader->upload()) {
                        $errorMessages = array_merge($errorMessages, $uploader->getErrorMessages());
                        $uploaders[$imgId] = false;
                    }
                }
            }

            if ($uploaders['logo_picture']) {
                $this->tryDeleteFile($brand->getLogoPicture());
                $brand->setLogoPicture($uploaders['logo_picture']->getNewFileName());
            }

            if ($uploaders['brand_picture']) {
                $this->tryDeleteFile($brand->getBrandPicture());
                $brand->setBrandPicture($uploaders['brand_picture']->getNewFileName());
            }

            if ($uploaders['model_picture']) {
                $this->tryDeleteFile($brand->getModelPicture());
                $brand->setModelPicture($uploaders['model_picture']->getNewFileName());
            }

            $result = true;
        }

        return $result;
    }

    /**
     * @param $imgId
     * @param array $errorMessages
     * @return mixed
     */
    private function createImageUploader($imgId, array &$errorMessages)
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
    private function tryDeleteFile($fileName)
    {
        if ($fileName != null) {
            $path = ImageUploader::buildPath($fileName);
            if (file_exists($path)) {
                unlink($path);
            }
        }
    }
}
