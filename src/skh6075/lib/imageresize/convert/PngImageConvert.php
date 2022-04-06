<?php

declare(strict_types=1);

namespace skh6075\lib\imageresize\convert;

use skh6075\lib\imageresize\convert\utils\Image;
use skh6075\lib\imageresize\convert\utils\ImageResizeResult;
use function imagecreatefrompng;
use function imagesx;
use function imagesy;
use function imagecreatetruecolor;
use function imagealphablending;
use function imagesavealpha;
use function imagecolorallocatealpha;
use function imagefilledrectangle;
use function imagecolorallocate;
use function imagecolortransparent;
use function imagefill;
use function imagecopyresampled;

class PngImageConvert extends ImageConvert{

	public function getImage() : Image{
		return Image::PNG();
	}

	public function resizing(string $destPath, int $width, int $height) : PngImageConvert{
		$image = imagecreatefrompng($this->imagePath);
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

		$color = imagecolorallocate($newResource, 255, 255, 255);
		imagecolortransparent($newResource, $color);
		imagefill($newResource, 0, 0, $color);
		imagecopyresampled($newResource, $image, 0, 0, 0, 0, $width, $height, $old_width, $old_height);
		$this->saveImage($newResource, $destPath);
		return $this;
	}
}