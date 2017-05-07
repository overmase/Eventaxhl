<?php

namespace pocketmine\command\defaults;

use pocketmine\network\protocol\TransferPacket;
use pocketmine\command\CommandSender;
use pocketmine\{
    Player, Server
};

class TransferCommand extends VanillaCommand
{

    public function __construct($name)
    {
        parent::__construct(
            $name,
            "%pocketmine.command.transfer.description",
            "%pocketmine.command.transfer.usage",
            ["transfer"]
        );
        $this->setPermission("pocketmine.command.transfer");
    }

    public function execute(CommandSender $sender, $currentAlias, array $args)
    {
        $address = null;
        $port = null;
        $player = null;
        if ($sender instanceof Player) {
            if (!$this->testPermission($sender)) {
                return true;
            }

            if (count($args) <= 0) {
                $sender->sendMessage("Использование: /transferserver <address> [port]");
                return false;
            }

            $address = strtolower($args[0]);
            $port = (isset($args[1]) && is_numeric($args[1]) ? $args[1] : 19132);

            $sender->transfer($address, $port);

            return false;
        }

        if (count($args) <= 1) {
            $sender->sendMessage("Использование: /transferserver <player> <address> [port]");
            return false;
        }

        if (!($player = Server::getInstance()->getPlayer($args[0])) instanceof Player) {
            $sender->sendMessage("Указанный игрок не найден!");
            return false;
        }

        $address = strtolower($args[1]);
        $port = (isset($args[2]) && is_numeric($args[2]) ? $args[2] : 19132);

        $sender->sendMessage("Отправка " . $player->getName() . " на " . $address . ":" . $port);

        $player->transfer($address, $port);
    }
}
