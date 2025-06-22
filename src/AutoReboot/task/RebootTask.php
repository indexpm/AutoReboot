<?php

namespace AutoReboot\task;

use pocketmine\scheduler\Task;

use pocketmine\utils\TextFormat as TF;

use AutoReboot\Main;

class RebootTask extends Task {

    public function onRun(): void {
        $plugin = Main::getInstance();
        $plugin->getLogger()->info(TF::RED . "Reboot server...");
        $plugin->rebootServer();
    }
}
