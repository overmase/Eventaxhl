<?php

namespace pocketmine\command\defaults;
 
use pocketmine\network\protocol\SetTitlePacket;
use pocketmine\command\CommandSender;

class TitleCommand extends VanillaCommand {

	public function __construct($name){
		parent::__construct(
			$name,
			"%pocketmine.command.title.description",
			"%pocketmine.command.title.usage"
		);
		$this->setPermission("pocketmine.command.title");
	}
  
	public function execute(CommandSender $sender, $currentAlias, array $args){
		if($sender instanceof Player){
			if(!$this->testPermission($sender)){
				return true;
			}
			if(count($args) <= 0){
				$sender->sendMessage("Usage: /title <title> <subtile> [text]");
				return false;
			}
        }
    }
}
