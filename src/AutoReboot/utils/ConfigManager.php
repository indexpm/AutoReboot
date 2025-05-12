<?php

namespace AutoReboot\utils;

use pocketmine\utils\Config;

class ConfigManager {
    private $config;

    public function __construct(string $filePath) {
        $this->loadConfig($filePath);
    }

    public function loadConfig(string $filePath): void {
        if (file_exists($filePath)) {
            $this->config = new Config($filePath, Config::JSON);
        } else {
            $this->config = new Config($filePath, Config::JSON, [
                "reboot_interval" => 3600
            ]);
            $this->saveConfig($filePath);
        }
    }

    public function saveConfig(string $filePath): void {
        $this->config->save();
    }

    public function getRebootInterval(): int {
        return $this->config->get("reboot_interval");
    }

    public function setRebootInterval(int $interval): void {
        $this->config->set("reboot_interval", $interval);
        $this->saveConfig($this->config->getFile());
    }
}
