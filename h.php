<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace room17\SkyBlock\command\presets;

use room17\SkyBlock\utils\PointLeaderboardManager;
use room17\SkyBlock\command\IslandCommand;
use room17\SkyBlock\session\Session;
use room17\SkyBlock\utils\message\MessageContainer;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;
use pocketmine\Server;

class MenuCommand extends IslandCommand {

    public function getName(): string {
        return "menu";
    }

    public function getAliases(): array {
        return [];
    }

    public function getUsageMessageContainer(): MessageContainer {
        return new MessageContainer("MENU_USAGE");
    }

    public function getDescriptionMessageContainer(): MessageContainer {
        return new MessageContainer("MENU_DESCRIPTION");
    }

    public function onCommand(Session $session, array $args): void {
        $player = $session->getPlayer();
        if (!$player instanceof Player) {
            $session->sendTranslatedMessage(new MessageContainer("COMMAND_IN_GAME_ONLY"));
            return;
        }
        $this->MenuUI($player);
    }

    public function MenuUI(Player $player): void {
        $form = new SimpleForm(function (Player $player, ?int $data) {
            if ($data === null) return;

            switch ($data) {
                case 0:
                    Server::getInstance()->dispatchCommand($player, "is help");
                    break;
                case 1:
                    $this->sendMenuUI($player);
                    break;
                case 2:
                    Server::getInstance()->dispatchCommand($player, "is chat");
                    break;
            }
        });

        $form->setTitle("SkyBlock Menu");
        $form->setContent("Select Options");
        $form->addButton("Island Help", 0,"textures/ui/icon_agent.png");
        $form->addButton("Manage Island", 0,"textures/ui/world_glyph_desaturated.png");
        $form->addButton("Island Chat Room", 0, "textures/ui/chat_send.png");

        $player->sendForm($form);
    }
  
  public function sendMenuUI(Player $player): void {
        $form = new SimpleForm(function (Player $player, ?int $data) {
            if ($data === null) return;

            switch ($data) {
                case 0:
                    Server::getInstance()->dispatchCommand($player, "is create");
                    break;
                case 1:
                    Server::getInstance()->dispatchCommand($player, "is disband");
                    break;
                case 2:
                    Server::getInstance()->dispatchCommand($player, "is join");
                    break;
                case 3:
                    Server::getInstance()->dispatchCommand($player, "is leave");
                    break;
                case 4:
                    Server::getInstance()->dispatchCommand($player, "is setspawn");
                    break;
                case 5:
                    Server::getInstance()->dispatchCommand($player, "is transfer");
                    break;
                case 6:
                    Server::getInstance()->dispatchCommand($player, "is visit");
                    break;
                case 7:
                    Server::getInstance()->dispatchCommand($player, "is category");
                    break;
                case 8:
                    Server::getInstance()->dispatchCommand($player, "is invite");
                    break;
                case 9:
                    Server::getInstance()->dispatchCommand($player, "is members");
                    break;
                case 10:
                    Server::getInstance()->dispatchCommand($player, "is promote");
                    break;
                case 11:
                    Server::getInstance()->dispatchCommand($player, "is lock");
                    break;
                case 12:
                    Server::getInstance()->dispatchCommand($player, "is banish");
                    break;
                case 13:
                    Server::getInstance()->dispatchCommand($player, "is blocks");
                    break;
                case 14:
                    Server::getInstance()->dispatchCommand($player, "is coorpate");
                    break;
                case 15:
                    Server::getInstance()->dispatchCommand($player, "is demote");
                    break;
                case 16:
                    Server::getInstance()->dispatchCommand($player, "is danny");
                    break;
                case 17:
                    Server::getInstance()->dispatchCommand($player, "is fire");
                    break;
            }
        });

        $form->setTitle("Create Island");
        $form->setContent("Manage Island Settings");
        $form->addButton("Create Island");
        $form->addButton("Delete Island");
        $form->addButton("Teleport Island");
        $form->addButton("Leave Island");
        $form->addButton("Setspawn Island");
        $form->addButton("Transfer Island");
        $form->addButton("Visit Island");
        $form->addButton("Category");
        $form->addButton("Invite");
        $form->addButton("Members");
        $form->addButton("Promote");
        $form->addButton("Lock");
        $form->addButton("Banish");
        $form->addButton("Block");
        $form->addButton("Cooperate");
        $form->addButton("Demote");
        $form->addButton("Danny");
        $form->addButton("Fire");

        $player->sendForm($form);
    }

  public function TopForm(Player $player): void {
        $form = new SimpleForm(function (Player $player, ?int $data) {
            if ($data === null) return;

            switch ($data) {
                case 0:
                    $leaderboard = new PointLeaderboardManager($this);
                    $leaderboard->openLeaderboardUI($player);
                    break;
                case 1:
                    $aliveTimeManager = new AliveTimeManager($this);
                    $leaderboard->openLeaderboardUI($player, $aliveTimeManager);
                    break;
                case 2:
                    break;
            }
        });

        $form->setTitle("SkyBlock Leaderboard");
        $form->setContent("");
        $form->addButton("Top Point\nLeaderboard Island");
        $form->addButton("Top Alive Time\nLeaderboard Island");
        $form->addButton("Back");

        $player->sendForm($form);
    }
}
