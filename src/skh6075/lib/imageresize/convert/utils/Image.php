<?php

declare(strict_types=1);

namespace skh6075\lib\imageresize\convert\utils;

use pocketmine\utils\RegistryTrait;

/**
 * @method static Image JPG()
 * @method static Image PNG()
 * @method static Image GIF()
 */

final class Image{
	use RegistryTrait;

	protected static function setup() : void{
		self::register(new self('jpg'));
		self::register(new self('png'));
		self::register(new self('gif'));
	}

	private static function register(self $result): void{
		self::_registryRegister($result->name, $result);
	}

	private function __construct(private string $name){}
}