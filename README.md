# AutoReboot

## Overview
The AutoReboot plugin for PocketMine-MP allows server administrators to automatically restart their server at specified intervals. This plugin is designed to be easy to configure and use, providing a command to change the reboot time directly from the game.

## Features
- Automatic server reboot at configurable intervals.
- JSON configuration for easy management of reboot settings.
- In-game command to update reboot intervals without needing to edit configuration files manually.

## Installation
1. Download the AutoReboot plugin.
2. Place the `AutoReboot` folder into the `plugins` directory of your PocketMine-MP server.
3. Start the server to generate the configuration file.

## Configuration
The plugin uses a JSON configuration file located at `files/plugin_data/AutoReboot/resources/config.json`. You can specify the reboot interval in seconds. The default configuration can be modified to suit your needs.

## Commands
- `/setreboottime <time>` or `/srt <time>`: Changes the reboot time interval. The time is specified in seconds. This command updates the configuration file automatically.

## Usage
After installation, you can use the `/setreboottime` or `/srt` command in-game to set the desired reboot interval. The server will automatically restart based on the specified time settings.

## Contributing
Contributions to the AutoReboot plugin are welcome. Please submit a pull request or open an issue for any enhancements or bug fixes.

## License
This project is licensed under the MIT License. See the LICENSE file for more details.
