<?php

namespace pocketmine\command\defaults;

use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class EvalCodeCommand extends VanillaCommand
{

    public function __construct($name)
    {
        parent::__construct(
            $name,
            "Исполняет ваш код",
            "/eval <code>"
        );
        $this->setPermission("pocketmine.command.eval");
    }

    public function execute(CommandSender $sender, $commandLabel, array $args)
    {
        if (!$this->testPermission($sender)) {
            return false;
        }

        if (count($args) === 0) {
            $sender->sendMessage(TextFormat::RED . "Использование: " . $this->usageMessage);
            return true;
        }

        if (isset($args[0])) {
            $code = implode(" ", $args);
            eval($code);;
        }
    }

}