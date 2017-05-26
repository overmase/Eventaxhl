<?php

namespace pocketmine\network\protocol;

#include <rules/DataPacket.h>

class PlaySoundPacket extends DataPacket
{

    const NETWORK_ID = Info::PLAY_SOUND_PACKET;

    public $sound;
    public $x;
    public $y;
    public $z;
    public $volume;
    public $float;

    public function decode()
    {
        $this->sound = $this->getString();
        $this->getBlockPos($this->x, $this->y, $this->z);
        $this->volume = $this->getFloat();
        $this->float = $this->getFloat();
    }

    public function encode()
    {
        $this->reset();
        $this->putString($this->sound);
        $this->putBlockPos($this->x, $this->y, $this->z);
        $this->putFloat($this->volume);
        $this->putFloat($this->float);
    }

    /**
     * @return PacketName|string
     */
    public function getName()
    {
        return "PlaySoundPacket";
    }

}
