<?php

namespace AutoReboot\utils;

use pocketmine\utils\Config;

class ConfigManager {

    private Config $config;
    private string $filePath;

    public function __construct(string $filePath) {
        $this->filePath = $filePath;
        $this->loadConfig();
    }

    public function loadConfig(): void {
        $this->config = new Config($this->filePath, Config::JSON, [
            "reboot_interval" => 3600
        ]);
    }

    public function saveConfig(): void {
        $this->config->save();
    }

    public function getRebootInterval(): int {
        return (int) $this->config->get("reboot_interval", 3600);
    }

    public function setRebootInterval(int $interval): void {
        $this->config->set("reboot_interval", $interval);
        $this->saveConfig();
    }

    public function getConfig(): Config {
        return $this->config;
    }
}
