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

namespace pocketmine\item;


use pocketmine\block\Block;
use pocketmine\level\Level;
use pocketmine\math\Vector3;
use pocketmine\Player;

class EyeOfEnder extends Item
{

    public function __construct($meta = 0, $count = 1)
    {
        parent::__construct(self::EYE_OF_ENDER, 0, $count, "Eye Of Ender");
    }

    public function canBeActivated(): bool
    {
        return true;
    }

    public function onActivate(Level $level, Player $player, Block $block, Block $target, $face, $fx, $fy, $fz)
    {
        if ($target->getId() == Block::END_PORTAL_FRAME and $player->getServer()->endEnabled) {
            if ($target->getDamage() !== 4) {
                $level->setBlock(new Vector3($target->getX(), $target->getY(), $target->getZ()), Block::get(Block::END_PORTAL_FRAME, 4));
                $x = $target->x;
                $y = $target->y;
                $z = $target->z;
                if ($level->getBlock(new Vector3($x - 1, $y, $z))->getDamage() == 4) {
                    if ($level->getBlock(new Vector3($x - 2, $y, $z))->getDamage() == 4 or $level->getBlock(new Vector3($x + 1, $y, $z))->getDamage() == 4) {
                        if ($player->getServer()->rowPositive == false) {
                            $player->getServer()->rowPositive = true;
                        } elseif ($player->getServer()->rowNegative == false) {
                            $player->getServer()->rowNegative = true;
                        }
                    }
                } elseif ($level->getBlock(new Vector3($x + 1, $y, $z))->getDamage() == 4) {
                    if ($level->getBlock(new Vector3($x + 2, $y, $z))->getDamage() == 4 or $level->getBlock(new Vector3($x - 1, $y, $z))->getDamage() == 4) {
                        if ($player->getServer()->rowPositive == false) {
                            $player->getServer()->rowPositive = true;
                        } elseif ($player->getServer()->rowNegative == false) {
                            $player->getServer()->rowNegative = true;
                        }
                    }
                } elseif ($level->getBlock(new Vector3($x, $y, $z - 1))->getDamage() == 4) {
                    if ($level->getBlock(new Vector3($x, $y, $z - 2))->getDamage() == 4 or $level->getBlock(new Vector3($x, $y, $z + 1))->getDamage() == 4) {
                        if ($player->getServer()->columPositive == false) {
                            $player->getServer()->columPositive = true;
                        } elseif ($player->getServer()->columNegative == false) {
                            $player->getServer()->columNegative = true;
                        }
                    }
                } elseif ($level->getBlock(new Vector3($x, $y, $z + 1))->getDamage() == 4) {
                    if ($level->getBlock(new Vector3($x, $y, $z + 2))->getDamage() == 4 or $level->getBlock(new Vector3($x, $y, $z - 1))->getDamage() == 4) {
                        if ($player->getServer()->columPositive == false) {
                            $player->getServer()->columPositive = true;
                        } elseif ($player->getServer()->columNegative == false) {
                            $player->getServer()->columNegative = true;
                        }
                    }
                }

                if ($player->getServer()->columPositive && $player->getServer()->columNegative && $player->getServer()->rowPositive && $player->getServer()->rowNegative) {
                    //TODO add create portal
                }
            }

        }
        return parent::onActivate($level, $player, $block, $target, $face, $fx, $fy, $fz);
    }

}