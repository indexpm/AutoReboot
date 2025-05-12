<?php

namespace AutoReboot\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;

use AutoReboot\utils\ConfigManager;

class SetRebootTimeCommand extends Command {

    private $configManager;

    public function __construct(ConfigManager $configManager) {
        parent::__construct("setreboottime", "Set the reboot time interval", "/setreboottime <time>");
        $this->configManager = $configManager;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if (!$sender->hasPermission("autoreboot.command.setreboottime")) {
            $sender->sendMessage("You do not have permission to use this command.");
            return;
        }

        if (count($args) !== 1) {
            $sender->sendMessage("Usage: /setreboottime <time>");
            return;
        }

        $time = intval($args[0]);
        if ($time <= 0) {
            $sender->sendMessage("Please enter a valid time interval in seconds.");
            return;
        }

        $this->configManager->setRebootTime($time);
        $sender->sendMessage("Reboot time has been set to " . $time . " seconds.");
    }
}
