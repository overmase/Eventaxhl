<?php

namespace pocketmine\command\defaults;

use pocketmine\command\CommandSender;
use pocketmine\plugin\PharPluginLoader;
use pocketmine\plugin\Plugin;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class ExtractPluginCommand extends VanillaCommand
{

    public function __construct($name)
    {
        parent::__construct(
            $name,
            "Извлекает исходный код из плагина *.phar",
            "/ep <pluginName>"
        );
        $this->setPermission("pocketmine.command.extractplugin");
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

        $pluginName = trim(implode(" ", $args));
        if ($pluginName === "" or !(($plugin = Server::getInstance()->getPluginManager()->getPlugin($pluginName)) instanceof Plugin)) {
            $sender->sendMessage(TextFormat::RED . "Недопустимое имя плагина, проверьте, что файл находится в каталоге плагина.");
            return true;
        }
        $description = $plugin->getDescription();

        if (!($plugin->getPluginLoader() instanceof PharPluginLoader)) {
            $sender->sendMessage(TextFormat::RED . "Плагин " . $description->getName() . " не находится в структуре phar.");
            return true;
        }

        $folderPath = Server::getInstance()->getPluginPath() . DIRECTORY_SEPARATOR . "Eventaxhl" . DIRECTORY_SEPARATOR . $description->getName() . "_v" . $description->getVersion() . "/";
        if (file_exists($folderPath)) {
            $sender->sendMessage("Плагин уже существует, перезапись ...");
        } else {
            @mkdir($folderPath);
        }

        $reflection = new \ReflectionClass("pocketmine\\plugin\\PluginBase");
        $file = $reflection->getProperty("file");
        $file->setAccessible(true);
        $pharPath = str_replace("\\", "/", rtrim($file->getValue($plugin), "\\/"));

        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($pharPath)) as $fInfo) {
            $path = $fInfo->getPathname();
            @mkdir(dirname($folderPath . str_replace($pharPath, "", $path)), 0755, true);
            file_put_contents($folderPath . str_replace($pharPath, "", $path), file_get_contents($path));
        }
        $sender->sendMessage("Исходный код плагина " . $description->getName() . " v" . $description->getVersion() . " был извлечен в " . $folderPath);
        return true;
    }
}