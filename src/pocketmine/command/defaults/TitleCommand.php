<?php

namespace pocketmine\command\defaults;

use pocketmine\command\CommandSender;
use pocketmine\event\TranslationContainer;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class TitleCommand extends VanillaCommand
{

    public function __construct($name)
    {
        parent::__construct(
            $name,
            "%pocketmine.command.title.description",
            "%pocketmine.command.title.usage"
        );
        $this->setPermission("pocketmine.command.title");
    }

    public function execute(CommandSender $sender, $currentAlias, array $args)
    {
        if (!$this->testPermission($sender)) {
            return true;
        }
        if (count($args) <= 0) {
            $sender->sendMessage(new TranslationContainer("%pocketmine.command.title.usage", [$this->usageMessage]));
            return false;
        }

        if (isset($args[0]) and isset($args[1]) and isset($args[2])) {
            $name = array_shift($args);
            $type = array_shift($args);
            $text = trim(implode(" ", $args));
            if (($player = $sender->getServer()->getPlayer($name)) instanceof Player) {
                switch ($type) {
                    case "actionbar":
                        $player->sendActionBar($text);
                        break;

                    case "title":
                        $player->sendTitle($text);
                        break;

                    case "subtitle":
                        $player->sendTitle("", $text);
                        break;
                }
            } else {
                $sender->sendMessage(new TranslationContainer(TextFormat::RED . "%commands.generic.player.notFound"));
            }
            return true;
        }
        return true;
    }
}