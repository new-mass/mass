<?php


namespace frontend\components;

use Imagine\Image\ManipulatorInterface;
use Imagine\Image\Point;
use iutbay\yii2imagecache\ImageCache as Cache;
use yii\helpers\ArrayHelper;
use yii\imagine\Image;
use Yii;

class ImageCache extends Cache
{
    public $quality = 80;

    /**
     * Create thumb
     * @param string $srcPath
     * @param string $dstPath
     * @param string $size
     * @param string $mode
     * @return boolean
     */
    public function createThumb($srcPath, $dstPath, $size, $mode = ManipulatorInterface::THUMBNAIL_OUTBOUND)
    {
        if ($size == self::SIZE_FULL) {
            $thumb = Image::getImagine()->open($srcPath);
        } else {
            $width = $this->sizes[$size][0];
            $height = $this->sizes[$size][1];
            $thumb = Image::thumbnail($srcPath, $width, $height, $mode);
        }

        if (isset($this->text)) {
            $fontOptions = ArrayHelper::getValue($this->text, 'fontOptions', []);
            $fontSize = ArrayHelper::getValue($fontOptions, 'size', 12);
            $fontColor = ArrayHelper::getValue($fontOptions, 'color', 'fff');
            $fontAngle = ArrayHelper::getValue($fontOptions, 'angle', 0);
            $start = ArrayHelper::getValue($this->text, 'start', [0, 0]);

            $font = Image::getImagine()->font(Yii::getAlias($this->text['fontFile']), $fontSize, new Color($fontColor));
            $thumb->draw()->text($this->text['text'], $font, new Point($start[0], $start[1]), $fontAngle);
        }

        if ($thumb && $thumb->save($dstPath, ['quality' => $this->quality]))
            return true;

        return false;
    }
}