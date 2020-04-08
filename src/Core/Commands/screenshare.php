<?php

namespace Core\screenshare;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use Core\Main;
use Core\Utils;

class screenshare extends Command{
	
public function __construct()
  {
parent::__construct("ss", "screenshare players", "Usage: /ss");
 $this->setPermission("core.ss");	
  }
  	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(!$sender->hasPermission("core.cmd.ss")){
			$sender->sendMessage(Messages::command_no_permission); //TODO ADD UTILS
			return;
			}
