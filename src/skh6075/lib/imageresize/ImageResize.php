<?php

declare(strict_types=1);

namespace skh6075\lib\imageresize;

use InvalidArgumentException;
use skh6075\lib\imageresize\convert\GifImageConvert;
use skh6075\lib\imageresize\convert\ImageConvert;
use skh6075\lib\imageresize\convert\JpgImageConvert;
use skh6075\lib\imageresize\convert\PngImageConvert;

final class ImageResize{

	public static function converter(string $imagePath): ImageConvert{
		return match(strtolower(pathinfo($imagePath, PATHINFO_EXTENSION))){
			"png" => new PngImageConvert($imagePath),
			"jpg", "jpeg" => new JpgImageConvert($imagePath),
			"gif" => new GifImageConvert($imagePath),
			default => throw new InvalidArgumentException("The converter cannot be returned because it is an unknown image format. [Path: $imagePath]")
		};
	}
}