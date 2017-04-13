<?php

namespace pocketmine\block;

use pocketmine\item\Item;

class CommandBlock extends Solid{
	protected $id = self::COMMAND_BLOCK;

	public function __construct($meta = 0){
		$this->meta = $meta;
	}

	public function canBeActivated() : bool {
		return true;
	}

	public function getName() : string{
		return "Command Block";
	}

	public function getHardness() {
		return -1;
	}
	
}
