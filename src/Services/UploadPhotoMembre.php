<?php
// src/Service/FileUploader.php
namespace App\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;

//mettre un extends UploadedFile ???? pour pouvoir gerer le guessExtension ? 

class UploadPhotoMembre
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->getTargetDir(), $fileName);

        return $fileName;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }
    
    /*public function verifExtension(UploadedFile $file)
    {
        if($file->guessExtension() =! 'jpg' && $file->guessExtension() =! 'png' && $file->guessExtension() =! 'jpeg')
        {
            return "Merci de télécharger une photo au format .jpg ou .png";
        }
    }*/
}
