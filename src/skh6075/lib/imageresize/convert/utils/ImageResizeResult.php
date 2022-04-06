<?php

declare(strict_types=1);

namespace skh6075\lib\imageresize\convert\utils;

use pocketmine\utils\RegistryTrait;

/**
 * @method static ImageResizeResult SUCCESS()
 * @method static ImageResizeResult FAILURE()
 * @method static ImageResizeResult NONE()
 */

final class ImageResizeResult{
	use RegistryTrait;

	protected static function setup() : void{
		self::register(new self('success'));
		self::register(new self('failure'));
		self::register(new self('none'));
	}

	private static function register(self $result): void{
		self::_registryRegister($result->name, $result);
	}

	private function __construct(private string $name){}
}