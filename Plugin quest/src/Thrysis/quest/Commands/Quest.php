<?php

namespace Thrysis\quest\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\Server;

class Quest extends Command{

    public function __construct(string $name,  $description = "",  $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
        $this->setPermission("Quest.cmd");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player){
            $this->form($sender);
        }return true;
    }

    public function form($sender){
        $formapi = Server::getInstance()->getPluginManager()->getPlugin("FormAPI");
        $form = $formapi->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if($result === null){
                return true;
            }
            switch ($result){
                case 0:
                    if ($sender->getInventory()->getItemInHand()->getId() === ItemIds::POTATO){
                        if ($sender->getInventory()->getItemInHand()->getCount() === 64){
                            $sender->getInventory()->setItemInHand(VanillaItems::DIAMOND()->setCount(1));
                        }
                    }
                    break;
                case 1:
                    break;
            }
        });
        $form->setTitle("Menu des quêtes");
        $form->setContent("Bienvenue dans le menu des quêtes");
        $form->addButton("64 patates = 1 diamant");
        $form->addButton("Fermer");
        $form->sendToPlayer($sender);
    }
}
