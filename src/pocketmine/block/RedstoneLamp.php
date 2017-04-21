<?php

namespace pocketmine\block;

class RedstoneLamp extends LitRedstoneLamp
{
    protected $id = self::REDSTONE_LAMP;

    public function getLightLevel()
    {
        return 0;
    }

    public function getName(): string
    {
        return "Inactive Redstone Lamp";
    }

    public function isLightedByAround()
    {
        return false;
    }

    public function turnOn()
    {
        $this->getLevel()->setBlock($this, new LitRedstoneLamp(), true, true);
        return true;
    }

    public function turnOff()
    {
        return true;
    }
}