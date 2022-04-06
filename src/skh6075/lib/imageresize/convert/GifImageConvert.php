<?php

declare(strict_types=1);

namespace skh6075\lib\imageresize\convert;

use skh6075\lib\imageresize\convert\utils\Image;
use skh6075\lib\imageresize\convert\utils\ImageResizeResult;
use function imagecreatefromgif;
use function imagesx;
use function imagesy;
use function imagecreatetruecolor;
use function imagealphablending;
use function imagesavealpha;
use function imagecolorallocatealpha;
use function imagecopyresampled;

class GifImageConvert extends ImageConvert{

	public function getImage() : Image{
		return Image::GIF();
	}

	public function resizing(string $destPath, int $width, int $height) : GifImageConvert{
		$image = imagecreatefromgif($this->imagePath);
		if($image === false){
			$this->setResult(ImageResizeResult::FAILURE());
			return $this;
		}
		$old_width = imagesx($image);
		$old_height = imagesy($image);

		$newResource = imagecreatetruecolor($width, $height);
		imagealphablending($newResource, false);
		imagesavealpha($newResource, true);

		$transparent = imagecolorallocatealpha($newResource, 255, 255, 255, 127);
		imagefilledrectangle($newResource, 0, 0, $old_width, $old_height, $transparent);
		imagecopyresampled($newResource, $image, 0, 0, 0, 0, $old_width, $old_height, $width, $height);
		$this->saveImage($newResource, $destPath);
		return $this;
	}
}