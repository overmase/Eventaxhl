<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____  
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \ 
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/ 
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_| 
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 * 
 *
*/

namespace pocketmine\entity;

use pocketmine\level\Level;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\protocol\AddEntityPacket;
use pocketmine\Player;

class LeashKnot extends Entity
{
    const NETWORK_ID = 88;

    //TO-DO: Find the REAL width, length and height.
    public $width = 0.98;
    public $length = 0.98;
    public $height = 0.98;

    protected $gravity = 0.04;
    protected $drag = 0.02;

    public $canCollide = false;

    private $dropItem = true;

    public function __construct(Level $level, CompoundTag $nbt, bool $dropItem = true)
    {
        parent::__construct($level, $nbt);
        $this->dropItem = $dropItem;
    }

    protected function initEntity()
    {
        parent::initEntity();
    }


    public function canCollideWith(Entity $entity)
    {
        return false;
    }

    public function spawnTo(Player $player)
    {
        $pk = new AddEntityPacket();
        $pk->type = LeashKnot::NETWORK_ID;
        $pk->eid = $this->getId();
        $pk->x = $this->x;
        $pk->y = $this->y;
        $pk->z = $this->z;
        $pk->speedX = $this->motionX;
        $pk->speedY = $this->motionY;
        $pk->speedZ = $this->motionZ;
        $pk->metadata = $this->dataProperties;
        $player->dataPacket($pk);

        parent::spawnTo($player);
    }
}