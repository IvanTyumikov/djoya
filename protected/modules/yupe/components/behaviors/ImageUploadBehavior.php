<?php

namespace yupe\components\behaviors;

use Yii;
use yupe\components\image\Imagine;
use yupe\components\image\Thumbnailer;
use yupe\helpers\YFile;

/**
 * Class ImageUploadBehavior
 * @package yupe\components\behaviors
 */
class ImageUploadBehavior extends FileUploadBehavior
{
    /**
     * @var bool
     */
    public $resizeOnUpload = true;
    /**
     * @var array
     */
    public $resizeOptions = [];

    /**
     * @var array
     */
    protected $defaultResizeOptions = [
        'width' => 1950,
        'height' => 1950,
        'quality' => [
            'jpeg_quality' => 100,
            'png_compression_level' => 9,
        ],
    ];

    /**
     * @var null|string Полный путь к изображению по умолчанию в публичной папке
     */
    public $defaultImage = null;

    /**
     * @var Thumbnailer $thumbnailer ;
     */
    protected $thumbnailer;

    /**
     * @param \CComponent $owner
     */
    public function attach($owner)
    {
        parent::attach($owner);

        $this->thumbnailer = Yii::app()->thumbnailer;

        if ($this->resizeOnUpload) {
            $this->resizeOptions = array_merge(
                $this->defaultResizeOptions,
                $this->resizeOptions
            );
        }
    }

    /**
     *
     */
    protected function removeFile()
    {
        parent::removeFile();
        $this->removeThumbs();
    }

    /**
     *
     */
    protected function removeThumbs()
    {
        $filename = pathinfo($this->getFilePath(), PATHINFO_BASENAME);

        $iterator = new \GlobIterator(
            $this->thumbnailer->getBasePath() . '/' . $this->uploadPath . '/' . '*_' . $filename
        );

        foreach ($iterator as $file) {
            @unlink($file->getRealPath());
        }
    }

    /**
     * @throws \CException
     */
    public function saveFile()
    {
        if (!$this->resizeOnUpload) {
            return parent::saveFile();
        }

        $newFileName = $this->generateFilename();
        $path = $this->uploadManager->getFilePath($newFileName, $this->getUploadPath());

        if (!YFile::checkPath(pathinfo($path, PATHINFO_DIRNAME))) {
            throw new \CException(
                Yii::t(
                    'YupeModule.yupe',
                    'Directory "{dir}" is not acceptable for write!',
                    ['{dir}' => $path]
                )
            );
        }

        if ($this->getUploadedFileInstance()->type !== 'video/mp4'){
            Imagine::resize(
                $this->getUploadedFileInstance()->getTempName(),
                $this->resizeOptions['width'],
                $this->resizeOptions['height']
            )->save(
                $path,
                $this->resizeOptions['quality']
            );
        } else {
            $this->getUploadedFileInstance()->saveAs($path);
        }

        $this->getOwner()->setAttribute($this->attributeName, $newFileName);
    }

    /**
     * @param int $width
     * @param int $height
     * @param bool|true $crop
     * @param null $defaultImage
     * @return null|string
     */
    public function getImageUrl($width = 0, $height = 0, $crop = true, $defaultImage = null)
    {
        $file = $this->getFilePath();
        $webRoot = Yii::getPathOfAlias('webroot');
        $defaultImage = $defaultImage ?: $this->getDefaultImage();
        
        if (null === $file && (null === $defaultImage || !is_file($webRoot . $defaultImage))) {
            return null;
        }

        if (($width || $height) && pathinfo($file)['extension'] !== 'mp4') {
            return $this->thumbnailer->thumbnail(
                $file ?: $webRoot . $defaultImage,
                $this->uploadPath,
                $width,
                $height,
                $crop
            );
        }

        return $file ? $this->getFileUrl() : $defaultImage;
    }

    public function getDefaultImage()
    {
        $theme = Yii::app()->getTheme();
        return $theme->getAssetsUrl() . Yii::app()->getModule('yupe')->defaultImage;
    }


    public function getImageNewUrl($width = 0, $height = 0, $crop = true, $defaultImage = null, $attribute = null, $path = null)
    {
        $file = $this->getFileNewPath($attribute, $path);
        $webRoot = Yii::getPathOfAlias('webroot');
        $defaultImage = $defaultImage ?: $this->getDefaultImage();

        if (null === $file && (null === $defaultImage || !is_file($webRoot . $defaultImage))) {
            return null;
        }

        if ($width || $height) {
            return $this->thumbnailer->thumbnail(
                $file ?: $webRoot . $defaultImage,
                $this->uploadPath,
                $width,
                $height,
                $crop
            );
        }
        return $file ? $this->getFileNewUrl($attribute, $path) : $defaultImage;
    }

    /* Преобразование изображения в webp и вовзрат пути до него */
    public function getImageUrlWebp($width = 0, $height = 0, $crop = true, $defaultImage = null, $attribute = null, $path = null,  $filePath = null)
    {
        // Получаем изображение
        $file = $filePath ?: $this->getImageNewUrl($width, $height, $crop, $defaultImage, $attribute, $path);
        // Получаем массив, где есть путь до папки, имя файла и расширение
        $pathinfo = pathinfo($file);
        // Получаем относительный путь к изображению
        $relativefile = str_replace(Yii::app()->request->getHostInfo(), '', $file);
        // Получаем абсолютный путь до изображения
        $fullpathfile = Yii::getPathOfAlias('webroot').$relativefile;
        // Задаем путь к изображению webp
        $webppath = dirname($fullpathfile).'/'.$pathinfo['filename'].'.webp';

        // Проверяем наличие файла, и если его нет - преобразуем в webp
        if(!file_exists($webppath)){
            // В зависимости от расширения, преобразуем изображение в webp
            switch ($pathinfo['extension']) {
                case 'jpeg':
                    $img = imagecreatefromjpeg($fullpathfile);
                    break;
                case 'jpg':
                    $img = imagecreatefromjpeg($fullpathfile);
                    break;
                case 'png':
                    $img = imagecreatefrompng($fullpathfile);
                    break;
                case 'JPEG':
                    $img = imagecreatefromjpeg($fullpathfile);
                    break;
                case 'JPG':
                    $img = imagecreatefromjpeg($fullpathfile);
                    break;
                case 'BMP':
                    $img = imagecreatefrombmp($fullpathfile);
                    break;
                case 'PNG':
                    $img = imagecreatefrompng($fullpathfile);
                    break;
                case 'gif':
                    $img = imagecreatefromgif($fullpathfile);
                    break;
                case 'bmp':
                    $img = imagecreatefrombmp($fullpathfile);
                    break;
            }

            imagepalettetotruecolor($img);
            imagewebp($img, $webppath, 100);
            imagedestroy($img);
        }

        // Возвращаем путь к webp изображению
        return dirname($file).'/'.basename($webppath);
    }
}
