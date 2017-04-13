<?php

namespace pocketmine\event\player;

use pocketmine\item\Item;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\event\Cancellable;

class PlayerEnchantEvent extends PlayerEvent {
	
	public static $handlerList = null;
    
	private $enchantment;
	
	/**
	 * @param Item $item
	 */
	public function __construct(Item $item, Enchantment $enchantment){
		$this->item = $item;
        $this->enchantment = $enchantment;
		$this->player = null;
		
	}
	
	/**
	 * @return Enchantment
	 */
	public function getEnchantment() {
	return $this->enchantment;
	}
    
	public function getItem() {
		return $this->item;
	}
}
