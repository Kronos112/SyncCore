<?php


namespace JamesCOMMANDO;


use Core\banUI\banUI;
use Core\Core;
use Core\Commands\screenshare;
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\network\mcpe\protocol\DisconnectPacket;
use pocketmine\plugin\PluginBase;




class Main extends PluginBase implements Listener{



    public function onLoad()
    {
        $this->getLogger()->info("loading...");
        $this->unregisterCommand("mixer");
        $this->unregisterCommand("ban");

        $this->registerCommand(new banUI());
         $this->registerCommand(new ss());
    }


    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->alert("SyncCore Ready.");
    }


    public function unregisterCommand(string $string):void
    {
        $map = $this->getServer()->getCommandMap();
        $cmd = $map->getCommand($string);
        if ($cmd !== null) $this->getServer()->getCommandMap()->unregister($cmd);
    }

    public function registerCommand(Command $command):void{
        $this->getServer()->getCommandMap()->register($command->getName(), $command);
    }

    public function onDataPacketSend(DataPacketSendEvent $event){
        $pk = $event->getPacket();
        if($pk instanceof DisconnectPacket){
            if($pk->message === "Internal server error") {
                $pk->message = "Internal server error has been made please check the console for more info.";
            }
        }
    }




}
