<?php


namespace Core\banUI;


use Frago9876543210\EasyForms\elements\Input;
use Frago9876543210\EasyForms\elements\Label;
use Frago9876543210\EasyForms\elements\Slider;
use Frago9876543210\EasyForms\elements\StepSlider;
use Frago9876543210\EasyForms\forms\CustomForm;
use Frago9876543210\EasyForms\forms\CustomFormResponse;
use Frago9876543210\EasyForms\forms\MenuForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\utils\CommandException;
use pocketmine\command\utils\InvalidCommandSyntaxException;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class banUI extends Command
{

    public function __construct()
    {
        parent::__construct("banui", "ban command with UI", "Usage: /ban");
        $this->setPermission("core.mod");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if(!$this->testPermission($sender)) return;

        if(count($args) === 0) {
            throw new InvalidCommandSyntaxException();
        }

        $sender->sendForm(new CustomForm("BanUI",
            [
                new Input("Enter your name of the cheater.", "COMMANDOSUSA000"),
                new Input("Why do you want to ban em?", "Killaura"),
                new Slider("Select How long? WIP", 1, 99, 1, 1),
            ],
            function (Player $player, CustomFormResponse $response) : void {
                list($input, $length, $reason) = $response->getValues();

                $player->getServer()->broadcastMessage(TextFormat::RED . "{$input} has been banned for {$reason} for {$length} days");
                Server::getInstance()->getPlayerExact($input)->setBanned(true);
                var_dump($response);
            }));
    }
}