<?php

namespace pocketmine\event\player;

use pocketmine\event\Cancellable;
use pocketmine\Player;
use pocketmine\Server;

class PlayerTransferEvent extends PlayerEvent implements Cancellable
{

    public static $handlerList = null;

    /** @var string */
    protected $address;

    /** @var int */
    protected $port;

    public function __construct(Player $player, $address, $port)
    {
        $this->player = $player;
        $this->address = $address;
        $this->port = $port;
    }

    public function getPlayer()
    {
        return $this->player;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return "PlayerTransferEvent";
    }

}