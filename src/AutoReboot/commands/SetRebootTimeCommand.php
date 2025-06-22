<?php

namespace AutoReboot\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\utils\TextFormat as TF;

use AutoReboot\utils\ConfigManager;
use AutoReboot\Main;

class SetRebootTimeCommand extends Command {

    private ConfigManager $configManager;

    public function __construct(ConfigManager $configManager) {
        parent::__construct("setreboottime", "Set the reboot time interval", "/setreboottime <time>", ["srt"]); 
        $this->setPermission("autoreboot.command.setreboottime");
        $this->configManager = $configManager;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {
        if (!$sender->hasPermission("autoreboot.command.setreboottime")) {
            $sender->sendMessage(TF::RED . "You do not have permission to use this command.");
            return false;
        }

        if (count($args) !== 1 || !is_numeric($args[0]) || (int)$args[0] <= 0) {
            $sender->sendMessage(TF::RED . "Usage: /setreboottime <time>");
            return false;
        }

        $time = (int)$args[0];
        $this->configManager->setRebootInterval($time);

        Main::getInstance()->reschedule();

        $sender->sendMessage(TF::GREEN . "Reboot time has been set to " . $time . " seconds.");
        return true;
    }
}

