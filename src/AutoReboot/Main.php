<?php

namespace AutoReboot;

use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;

use AutoReboot\traits\SingletonTrait as ST;

use AutoReboot\utils\ConfigManager;

use AutoReboot\commands\SetRebootTimeCommand;
use AutoReboot\task\RebootTask;

class Main extends PluginBase {
    use ST;

    private ConfigManager $configManager;
    private ?RebootTask $rebootTask = null;

    protected function onEnable(): void {
        @mkdir($this->getDataFolder());

        self::setInstance($this);

        $this->configManager = new ConfigManager($this->getDataFolder() . "config.yml");
        $this->configManager->loadConfig();

        $this->scheduleReboot();

        $this->getServer()->getCommandMap()->register("setreboottime", new SetRebootTimeCommand($this->configManager));
    }

    private function scheduleReboot(): void {
        $interval = $this->configManager->getRebootInterval();

        if ($this->rebootTask <= 0) {
            $this->getLogger()->warning("If the restart interval is 0 or negative, the automatic restart will not be scheduled.");
            return;
        }

        $this->rebootTask = new RebootTask($this);
        $this->getScheduler()->scheduleRepeatingTask($this->rebootTask, $interval * 20);
        $this->getScheduler()->scheduleDelayedRepeatingTask($this->rebootTask, $interval * 20, $interval * 20);
    }

    public function rebootServer(): void {
        $this->getServer()->shutdown();
    }

    public function getConfigManager(): ConfigManager {
        return $this->configManager;
    }

    public function reschedule(): void {
        $this->scheduleReboot();
    }
}
