<?php

namespace pocketmine\command\defaults;

use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class ExtractPharCommand extends VanillaCommand
{

    public function __construct($name)
    {
        parent::__construct(
            $name,
            "Извлекает исходный код из *.phar файла, который находиться в корне сервера",
            "/extractphar <Phar file Name>"
        );
        $this->setPermission("pocketmine.command.extсеractphar");
    }

    public function execute(CommandSender $sender, $commandLabel, array $args)
    {
        if (!$this->testPermission($sender)) {
            return false;
        }

        if (count($args) === 0) {
            $sender->sendMessage(TextFormat::RED . "Usage: " . $this->usageMessage);
            return true;
        }
        if (!isset($args[0]) or !file_exists($args[0])) return \false;
        $folderPath = $sender->getServer()->getPluginPath() . DIRECTORY_SEPARATOR . "Eventaxhl" . DIRECTORY_SEPARATOR . basename($args[0]);
        if (file_exists($folderPath)) {
            $sender->sendMessage("Папка уже существует, перезапись ...");
        } else {
            @mkdir($folderPath);
        }

        $pharPath = "phar://$args[0]";

        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($pharPath)) as $fInfo) {
            $path = $fInfo->getPathname();
            @mkdir(dirname($folderPath . str_replace($pharPath, "", $path)), 0755, true);
            file_put_contents($folderPath . str_replace($pharPath, "", $path), file_get_contents($path));
        }
        $sender->sendMessage("Исходный код phar архива $args[0] был извлечен в $folderPath");
    }
}