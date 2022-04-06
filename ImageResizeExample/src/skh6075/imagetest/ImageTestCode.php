<?php

declare(strict_types=1);

namespace skh6075\imagetest;

use pocketmine\plugin\PluginBase;
use skh6075\lib\imageresize\ImageResize;
use Webmozart\PathUtil\Path;

final class ImageTestCode extends PluginBase{

	protected function onEnable() : void{
		$this->saveResource('crystalsword.png');
		$result = ImageResize::converter(Path::join($this->getDataFolder(), "crystalsword.png"));
		$result->resizing(Path::join($this->getDataFolder(), "big_sword.png"), 100, 100);
		var_dump($result->getResult());
	}
}