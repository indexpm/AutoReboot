<?php

namespace AutoReboot;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\TaskScheduler;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;

use AutoReboot\utils\ConfigManager;
use AutoReboot\commands\SetRebootTimeCommand;

class Main extends PluginBase {
    use traits\SingletonTrait;

    private $configManager;
    private $rebootTask;

    public function onEnable(): void {
        self::setInstance($this);
        $this->configManager = new ConfigManager($this);
        $this->configManager->loadConfig();
        $this->scheduleReboot();
        $this->getServer()->getCommandMap()->register("setreboottime", new SetRebootTimeCommand($this));
    }

    private function scheduleReboot(): void {
        $interval = $this->configManager->getRebootInterval();
        if ($this->rebootTask !== null) {
            $this->getScheduler()->cancelTask($this->rebootTask->getTaskId());
        }
        $this->rebootTask = new RebootTask($this);
        $this->getScheduler()->scheduleRepeatingTask($this->rebootTask, $interval * 20); 
    }

    public function rebootServer(): void {
        $this->getServer()->shutdown();
    }
}
