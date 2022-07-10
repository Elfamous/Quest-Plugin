<?php

namespace Thrysis\quest;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener{

    public function onEnable(): void
    {
        $this->getServer()->getCommandMap()->registerAll('Commands', [
            new Commands\Quest("quest", "Ouvrir le menu des quest", "/quest", [])
        ]);
    }
}