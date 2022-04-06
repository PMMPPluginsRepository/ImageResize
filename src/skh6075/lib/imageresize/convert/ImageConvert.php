<?php

declare(strict_types=1);

namespace skh6075\lib\imageresize\convert;

use GdImage;
use InvalidArgumentException;
use skh6075\lib\imageresize\convert\utils\Image;
use skh6075\lib\imageresize\convert\utils\ImageResizeResult;
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

abstract class ImageConvert{

	private ImageResizeResult $result;

	public function __construct(protected string $imagePath){
		$this->result = ImageResizeResult::NONE();
	}

	/**
	 * Check the image operation result.
	 *
	 * @return ImageResizeResult
	 */
	final public function getResult(): ImageResizeResult{
		return $this->result;
	}

	final public function setResult(ImageResizeResult $result): void{
		$this->result = $result;
	}

	protected function saveImage(GdImage $image, string $destPath): void{
		switch(strtolower(pathinfo($destPath, PATHINFO_EXTENSION))){
			case "png":
				imagepng($image, $destPath);
				break;
			case "jpg":
			case "jpeg":
				imagejpeg($image, $destPath);
				break;
			case "gif":
				imagegif($image, $destPath);
				break;
			default:
				throw new InvalidArgumentException();
		}
		$this->result = ImageResizeResult::SUCCESS();
	}

	/**
	 * Check the image file extension
	 *
	 * @return Image
	 */
	abstract public function getImage(): Image;

	/**
	 * Fixed image size
	 *
	 * @param string $destPath
	 * @param int    $width
	 * @param int    $height
	 *
	 * @return void
	 */
	abstract public function resizing(string $destPath, int $width, int $height): ImageConvert;
}