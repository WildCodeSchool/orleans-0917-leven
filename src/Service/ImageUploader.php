<?php

namespace Leven\Service;

/**
 * Permet de télécharger un fichier vers le serveur
 * Class ImageUploader
 * @package Leven\Service
 */
class ImageUploader
{
    /**
     * Taille maximum du fichier à télécharger
     */
    const MAX_FILE_SIZE = 2000000;

    /**
     * Répertoire de déstination du fichier uploadé
     */
    const UPLOAD_DIRECTORY = 'assets/images/uploads/';

    /**
     * Types mimes autorisés
     */
    const ALLOWED_EXTENSIONS = [
        'image/jpeg' => 'jpeg',
        'image/gif' => 'gif',
        'image/png' => 'png',
        'image/svg+xml' => 'svg',
    ];

    private $file;
    private $fileName;
    private $fileExtension;
    private $newFileName;
    private $errorMessages;

    /**
     * @param string $fileName
     * @return string
     */
    public static function buildPath(string $fileName)
    {
        return self::UPLOAD_DIRECTORY . $fileName;
    }

    /**
     * @return array
     */
    public function getErrorMessages() : array
    {
        return $this->errorMessages;
    }

    /**
     * @return string
     */
    public function getNewFileName() : string
    {
        return $this->newFileName;
    }

    /**
     * ImageUploader constructor.
     * @param array $file Le contenue de la variable $_FILES['file_id']
     */
    public function __construct(array $file)
    {
        $this->file = $file;
    }

    /**
     * Vérifie le téléchargement du fichier et s'il réspecte les conditions
     * @return bool Vrai si l'image peut être téléchargé
     */
    public function checkUpload()
    {
        $this->errorMessages = [];
        $this->fileName = basename($this->file['name']);

        if ($this->file['error'] === UPLOAD_ERR_OK) {
            // On récupère l'extension du fichier par son type mime (ce qui est plus sûr que de la
            // récupérer depuis le nom du fichier car elle peut être facilement modifiée par l'utilisateur).
            $fileMimeType = $this->file['type'];
            $this->fileExtension = $this->isSupportedExtension($fileMimeType);
            if (!$this->fileExtension) {
                $this->errorMessages[] = "Le format du fichier '$this->fileName' n'est pas supporté ($fileMimeType).";
            }

            // Vérification de la taille du ficher
            if ($this->file['size'] > self::MAX_FILE_SIZE) {
                $friendlyFileSize = $this->bytesToSize1024($this->file['size'], 1);
                $friendlyMaxSize = $this->bytesToSize1024(self::MAX_FILE_SIZE, 1);
                $this->errorMessages[] = "Le fichier '$this->fileName' est trop grand ($friendlyFileSize), il ne devrait pas dépasser $friendlyMaxSize";
            }
        } else {
            $this->setUploadErrorMessage();
        }

        return !$this->hasErrors();
    }

    /**
     * Télécharge un fichier depuis un formulaire html
     * Les données du formulaire sont contenue dans le membre privé $file qui auront été passées dans le consructeur
     * @return bool
     */
    public function upload() : bool
    {
        $this->errorMessages = [];

        $this->newFileName = 'img_' . uniqid() . '.' . $this->fileExtension;
        if (!move_uploaded_file($this->file['tmp_name'], self::buildPath($this->newFileName))) {
            $this->errorMessages[] = "Erreur lors de l'envoi du fichier '$this->fileName'.";
        }

        return !$this->hasErrors();
    }

    /**
     * Retourne vrai si l'upload à échoué et faux en cas de réussitte.
     * @return bool
     */
    public function hasErrors()
    {
        return !empty($this->errorMessages);
    }

    /**
     * @param $bytes
     * @param int $precision
     * @return string
     */
    private function bytesToSize1024($bytes, $precision = 2) : string
    {
        $unit = array('B','KB','MB');
        return @round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), $precision).' '.$unit[$i];
    }

    /**
     * Vérifie si le type mime du fichier est supporté
     * @param $mimeType
     * @return mixed
     */
    private function isSupportedExtension($mimeType)
    {
        $extension = false;
        if (array_key_exists($mimeType, self::ALLOWED_EXTENSIONS)) {
            $extension = self::ALLOWED_EXTENSIONS[$mimeType];
        }
        return $extension;
    }

    /**
     * Définie le message d'erreur de l'upload selon son code d'erreru renvoyé.
     */
    private function setUploadErrorMessage()
    {
        $this->errorMessages = [];

        $errorCode = $this->file['error'];
        $message = '';

        switch ($errorCode) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $friendlyFileSize = $this->bytesToSize1024($this->file['size'], 1);
                $friendlyMaxSize = $this->bytesToSize1024(self::MAX_FILE_SIZE, 1);
                $message = "Le fichier '$this->fileName' est trop grand ($friendlyFileSize), il ne devrait pas dépasser $friendlyMaxSize";
                break;
            case UPLOAD_ERR_PARTIAL:
                $message = "Le fichier '$this->fileName' n'a été que partiellement téléchargé.";
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = "Aucun fichier n'a été téléchargé.";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $message = "Le fichier '$this->fileName' ne peut pas être téléchargé car il manque un dossier temporaire sur le serveur.";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $message = "Impossible d'écrire le fichier '$this->fileName' sur le disque.";
                break;
            case UPLOAD_ERR_EXTENSION:
                $message = "Une extension PHP a arrêté le téléchargement du fichier '$this->fileName'.";
                break;
            default:
                $message = "Erreur inconnue lors du téléchargement du fichier '$this->fileName'.";
                break;
        }

        $this->errorMessages[] = $message;
    }
}
