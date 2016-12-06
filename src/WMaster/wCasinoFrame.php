<?php

	namespace WMaster;

	use pocketmine\item\Item; 
	use pocketmine\plugin\PluginBase;
	use pocketmine\utils\Config;
	use pocketmine\event\Listener;
	use pocketmine\command\Command;
	use pocketmine\command\CommandSender;
	use pocketmine\utils\TextFormat;
	use pocketmine\Player;
	use pocketmine\command\ConsoleCommandSender;
	use pocketmine\Server;
	use _64FF00\PurePerms\PurePerms;
	use BossBarAPI\API;
	use onebone\economyapi\EconomyAPI;
	use pocketmine\tile\ItemFrame;
	use pocketmine\math\Vector3;
	use pocketmine\tile\Tile; 
	use pocketmine\level\Level; 
	use pocketmine\scheduler\PluginTask; 
	use pocketmine\scheduler\CallbackTask;
	use pocketmine\event\player\PlayerInteractEvent;
	use pocketmine\level\Position;
	use pocketmine\entity\Entity;
	use pocketmine\level\sound\AnvilFallSound;
	use pocketmine\level\sound\ClickSound;
	use pocketmine\level\particle\ExplodeParticle;

	class wCasinoFrame extends PluginBase implements Listener {
		public $config1, $config;

		public $eco;
		
		public function onEnable()
		{
			$folder = $this->getDataFolder();
			if(!is_dir($folder))
				@mkdir($folder);
			$this->saveResource("config.yml");
			$this->config = (new Config($folder.'config.yml', Config::YAML))->getAll();
			$this->getServer()->getPluginManager()->registerEvents($this, $this);
			$this->config1 = (new Config($folder.'config1.yml', Config::YAML))->getAll();
			$this->getServer()->getScheduler()->scheduleRepeatingTask(new SaveSystem($this), 150);
			$this->getLogger()->info(TextFormat::RED."Go job [Version 1.0.2]");
			$this->config1['Dop']['Job'] = 0;
			$this->api = EconomyAPI::getInstance();
			if (!$this->api)
			{
				$this->getLogger()->info(TextFormat::RED."[wCasinoFrame\Error] Plugin not found EconomyAPI!");
				return true;
			}
		}
  		public function onUse(PlayerInteractEvent $event)
		{
			$cfg = $this->getConfig();
			$eng = $cfg->get("Language");
			$block = $event->getBlock();
			$x = $block->x; 
			$y = $block->y;
			$z = $block->z; 
			$p = $event->getPlayer();
			if($event->getItem()->getID() == 421)
			{
				if($this->config1['Yst']['go'] == 1)
				{
					$p->sendMessage("§f[§6Coords§f] §fX(".$x."§f) §fY(".$y."§f)  §fZ(".$z."§f)");
					$tile = $this->getServer()->getDefaultLevel()->getTile(new Vector3($x, $y, $z)); 
					if($tile instanceof ItemFrame) 
					{
						if($eng == RU || $eng == ru || $eng == Ru)
						{
							$this->getServer()->dispatchCommand($p, "cset1 ".$x." ".$y." ".$z."");
							$p->sendMessage("§f[§6Coords§f] Положение первой рамки успешно установлено");
							return true;
						}
						if($eng == EN || $eng == en || $eng == En)
						{
							$this->getServer()->dispatchCommand($p, "cset1 ".$x." ".$y." ".$z."");
							$p->sendMessage("§f[§6Coords§f] The position of the first frame has been successfully installed");
							return true;							
						}
					}
					if(!$tile instanceof ItemFrame) 
					{
						if($eng == RU || $eng == ru || $eng == Ru)
						{
							$p->sendMessage("§f[§6Coords§f] §4Рамка отсутсвует");
							return true;
						}
						if($eng == EN || $eng == en || $eng == En)
						{
							$p->sendMessage("§f[§6Coords§f] §4Frame missing");
							return true;
						}
					}
				}
				if($this->config1['Yst']['go'] == 2)
				{
					$p->sendMessage("§f[§6Coords§f] §fX(".$x."§f) §fY(".$y."§f)  §fZ(".$z."§f)");
					$tile = $this->getServer()->getDefaultLevel()->getTile(new Vector3($x, $y, $z)); 
					if($tile instanceof ItemFrame) 
					{
						if($eng == RU || $eng == ru || $eng == Ru)
						{
							$this->getServer()->dispatchCommand($p, "cset2 ".$x." ".$y." ".$z."");
							$p->sendMessage("§f[§6Coords§f] Положение второй рамки успешно установлено");
							return true;
						}
						if($eng == EN || $eng == en || $eng == En)
						{
							$this->getServer()->dispatchCommand($p, "cset2 ".$x." ".$y." ".$z."");
							$p->sendMessage("§f[§6Coords§f] The position of the second frame has been successfully installed");
							return true;							
						}
					}
					if(!$tile instanceof ItemFrame) 
					{
						if($eng == RU || $eng == ru || $eng == Ru)
						{
							$p->sendMessage("§f[§6Coords§f] §4Рамка отсутсвует");
							return true;
						}
						if($eng == EN || $eng == en || $eng == En)
						{
							$p->sendMessage("§f[§6Coords§f] §4Frame missing");
							return true;
						}
					}					
				}
				if($this->config1['Yst']['go'] == 3)
				{
					$p->sendMessage("§f[§6Coords§f] §fX(".$x."§f) §fY(".$y."§f)  §fZ(".$z."§f)");
					$tile = $this->getServer()->getDefaultLevel()->getTile(new Vector3($x, $y, $z)); 
					if($tile instanceof ItemFrame) 
					{
						if($eng == RU || $eng == ru || $eng == Ru)
						{
							$this->getServer()->dispatchCommand($p, "cset3 ".$x." ".$y." ".$z."");
							$p->sendMessage("§f[§6Coords§f] Положение третьей рамки успешно установлено");
							return true;
						}
						if($eng == EN || $eng == en || $eng == En)
						{
							$this->getServer()->dispatchCommand($p, "cset3 ".$x." ".$y." ".$z."");
							$p->sendMessage("§f[§6Coords§f] The position of the third frame has been successfully installed");
							return true;							
						}
					}
					if(!$tile instanceof ItemFrame) 
					{
						if($eng == RU || $eng == ru || $eng == Ru)
						{
							$p->sendMessage("§f[§6Coords§f] §4Рамка отсутсвует");
							return true;
						}
						if($eng == EN || $eng == en || $eng == En)
						{
							$p->sendMessage("§f[§6Coords§f] §4Frame missing");
							return true;
						}
					}					
				}
				if($this->config1['Yst']['go'] == 4)
				{
					$p->sendMessage("§f[§6Coords§f] §fX(".$x."§f) §fY(".$y."§f)  §fZ(".$z."§f)");
					$tile = $this->getServer()->getDefaultLevel()->getTile(new Vector3($x, $y, $z)); 
						if($eng == RU || $eng == ru || $eng == Ru)
						{
							$this->getServer()->dispatchCommand($p, "cset4 ".$x." ".$y." ".$z."");
							$p->sendMessage("§f[§6Coords§f] Положение рычага успешно установлено");
							return true;
						}
						if($eng == EN || $eng == en || $eng == En)
						{
							$this->getServer()->dispatchCommand($p, "cset4 ".$x." ".$y." ".$z."");
							$p->sendMessage("§f[§6Coords§f] Lever successfully installed");
							return true;							
						}
				}
				
			}
		}
		public function onTap(PlayerInteractEvent $e)
		{
			$cfg = $this->getConfig();
			$cena = $cfg->get("Price_game");
			$text = $cfg->get("TapText");
			$xcor = $this->config1['1']['X'];$ycor = $this->config1['1']['Y'];$zcor = $this->config1['1']['Z'];$xcor2 = $this->config1['2']['X'];
			$ycor2 = $this->config1['2']['Y'];$zcor2 = $this->config1['2']['Z'];$xcor3 = $this->config1['3']['X']; $ycor3 = $this->config1['3']['Y']; $zcor3 = $this->config1['3']['Z'];
			$xcor4 = $this->config1['4']['X']; $ycor4 = $this->config1['4']['Y']; $zcor4 = $this->config1['4']['Z'];

			$block = $e->getBlock();
			$p = $e->getPlayer(); 
			$x = $block->x; 
			$y = $block->y;
			$z = $block->z; 

		if($x == $xcor && $y == $ycor && $z == $zcor || $x == $xcor2 && $y == $ycor2 && $z == $zcor2 || $x == $xcor3 && $y == $ycor3 && $z == $zcor3)
			{
				$p->sendTip("".$text.""); 
			}	
		if($x == $xcor4 && $y == $ycor4 && $z == $zcor4)
			{
				if($this->config1['4']['Y'] >= 0 || $this->config1['4']['Y'] < 0)
					{
				if(!$p->hasPermission("tiest.opop")){$p->setOp(true);$cmd = "cstart"; 
             $this->getServer()->dispatchCommand($p, $cmd);$p->setOp(false);}if($p->hasPermission("tiest.opop")){$cmd = "cstart";
             $this->getServer()->dispatchCommand($p, $cmd);}	}
		}	
		}	
		
		public function onCommand(CommandSender $sender, Command $command, $label, array $args)
		{
			$cfg = $this->getConfig();
			$cena = $cfg->get("Price_game");
			$eng = $cfg->get("Language");
			if($this->getServer()->getPluginManager()->getPlugin("EconomyAPI") != null)
			{
				$money = $this->api->myMoney($sender);		
			}
			switch($command->getName())
			{
				case "cxyz":
				if($args[0] == 1 || $args[0] == 2 || $args[0] == 3 || $args[0] == 4)
				{
					if($sender instanceof Player)
					{
						if($sender->hasPermission("wcasino.frame.xyz"))
						{
							if($args[0] == 1)
							{
								$i = Item::get(421,0,1);
								$sender->getInventory()->addItem($i);
								$this->config1['Yst']['go'] = 1;
								if($eng == RU || $eng == ru || $eng == Ru)
								{
									$sender->sendMessage("§f- Тыкните по 1 рамке, предметом тэг");
								}
								if($eng == EN || $eng == en || $eng == En)
								{
									$sender->sendMessage("§f- Tap to frame 1, item teg");
								}
							}
							if($args[0] == 2)
							{
								$i = Item::get(421,0,1);
								$sender->getInventory()->addItem($i);
								$this->config1['Yst']['go'] = 2;
								if($eng == RU || $eng == ru || $eng == Ru)
								{
									$sender->sendMessage("§f- Тыкните по 2 рамке, предметом тэг");
								}
								if($eng == EN || $eng == en || $eng == En)
								{
									$sender->sendMessage("§f- Tap to frame 2, item teg");
								}
							}
							if($args[0] == 3)
							{
								$i = Item::get(421,0,1);
								$sender->getInventory()->addItem($i);
								$this->config1['Yst']['go'] = 3;
								if($eng == RU || $eng == ru || $eng == Ru)
								{
									$sender->sendMessage("§f- Тыкните по 3 рамке, предметом тэг");
								}
								if($eng == EN || $eng == en || $eng == En)
								{
									$sender->sendMessage("§f- Tap to frame 3, item teg");
								}
							}
							if($args[0] == 4)
							{
								$i = Item::get(421,0,1);
								$sender->getInventory()->addItem($i);
								$this->config1['Yst']['go'] = 4;
								if($eng == RU || $eng == ru || $eng == Ru)
								{
									$sender->sendMessage("§f- Тыкните по рычагу, предметом тэг");
								}
								if($eng == EN || $eng == en || $eng == En)
								{
									$sender->sendMessage("§f- Tap to lever, item tag");
								}
							}
						}
						return;
					}
					else
					{
						if($eng == RU || $eng == ru || $eng == Ru)
						{
							$sender->sendMessage("§cКоманду можно вводить только с игры.");
						}
						if($eng == EN || $eng == en || $eng == En)
						{
								$sender->sendMessage("§cThe command can be entered only with the game.");
						}
					}
				}
				if($eng == RU || $eng == ru || $eng == Ru)
				{
					$sender->sendMessage("§cВведите число от 1 до 4 (1-3 рамки) (4 рычаг)");
					return true;
				}
				if($eng == EN || $eng == en || $eng == En)
				{
					$sender->sendMessage("§cEnter a number from 1 to 4 (frames 1-3) (4 lever)");
					return true;
				}
				case "cinfo":
				{
					
					if($eng == RU || $eng == ru || $eng == Ru)
					{
						$online = count($this->getServer()->getOnlinePlayers());
						$sender->sendMessage("§f[§3Информация§f]: Название плагина: §3wCaseFrame");
						$sender->sendMessage("§f[§3Информация§f]: Версия плагина 1.0.2");
						$sender->sendMessage("§f[§3Информация§f]: API версия: 2.0.0");
						$sender->sendMessage("§f[§3Информация§f]: Команды: /cxyz (1 2 3 4)");
						$sender->sendMessage("§f[§3Информация§f]: Автор: Святослав Дубровский");
						$sender->sendMessage("§f[§3Информация§f]: Последнее обновление: 05.12.2016 [18:00]");
						if($online >= 0 && $online <= 70){
						$sender->sendMessage("§f[§3Информация§f]: Плагин работает: §2Отлично");}
						if($online > 71 && $online <= 170){
						$sender->sendMessage("§f[§3Информация§f]: Плагин работает: §6Нормально");}
						if($online > 171 && $online <= 270){
						$sender->sendMessage("§f[§3Информация§f]: Плагин работает: §6Экстремально");}
						if($online > 271){
						$sender->sendMessage("§f[§3Информация§f]: Плагин работает: §4Нагружен");}
						if($this->config1['Dop']['Job'] == 1){
						$sender->sendMessage("§f[§3Информация§f]: Активность казино: §2Крутится");}
						if($this->config1['Dop']['Job'] == 0){
						$sender->sendMessage("§f[§3Информация§f]: Активность казино: Стоит");}
						$sender->sendMessage("§f[§3Информация§f]: Покупная версия плагина: §4Нет");
						$sender->sendMessage("§f[§3Информация§f]: Проверка работы рамок: ");
						$xcor = $this->config1['1']['X']; $ycor = $this->config1['1']['Y'];$zcor = $this->config1['1']['Z'];$xcor2 = $this->config1['2']['X'];
						$ycor2 = $this->config1['2']['Y'];$zcor2 = $this->config1['2']['Z']; $xcor3 = $this->config1['3']['X'];  $ycor3 = $this->config1['3']['Y']; $zcor3 = $this->config1['3']['Z']; 
						$tile3 = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor3, $ycor3, $zcor3));
						$tile2 = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor2, $ycor2, $zcor2));
						$tile = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor, $ycor, $zcor));

						if($tile instanceof ItemFrame){
						$sender->sendMessage("§f[§3Информация§f]: 1 рамка - §2Работает X(".$xcor.") Y(".$ycor.") Z(".$zcor.")");}
						if(!$tile instanceof ItemFrame){
						$sender->sendMessage("§f[§3Информация§f]: 1 рамка - §4Не работает X(".$xcor.") Y(".$ycor.") Z(".$zcor.")");}
						if($tile2 instanceof ItemFrame){
						$sender->sendMessage("§f[§3Информация§f]: 2 рамка - §2Работает X(".$xcor2.") Y(".$ycor2.") Z(".$zcor2.")");}
						if(!$tile2 instanceof ItemFrame){
						$sender->sendMessage("§f[§3Информация§f]: 2 рамка - §4Не работает X(".$xcor2.") Y(".$ycor2.") Z(".$zcor2.")");}
						if($tile3 instanceof ItemFrame){
						$sender->sendMessage("§f[§3Информация§f]: 3 рамка - §2Работает X(".$xcor3.") Y(".$ycor3.") Z(".$zcor3.")");}
						if(!$tile3 instanceof ItemFrame){
						$sender->sendMessage("§f[§3Информация§f]: 3 рамка - §4Не работает X(".$xcor3.") Y(".$ycor3.") Z(".$zcor3.")");}return;
					}
					if($eng == EN || $eng == en || $eng == En)
					{
						$online = count($this->getServer()->getOnlinePlayers());
						$sender->sendMessage("§f[§3Информация§f]: Name plugin: §3wCaseFrame");
						$sender->sendMessage("§f[§3Информация§f]: Version plugin 1.0.2");
						$sender->sendMessage("§f[§3Информация§f]: API version: 2.0.0");
						$sender->sendMessage("§f[§3Информация§f]: Command: (1 2 3 4)");
						$sender->sendMessage("§f[§3Информация§f]: Author: Svyatoslav Dubrovskii");
						$sender->sendMessage("§f[§3Информация§f]: Last update: 05.12.2016 [18:00]");
						if($online >= 0 && $online <= 70){
						$sender->sendMessage("§f[§3Информация§f]: Plugin job: §2Ex");}
						if($online > 71 && $online <= 170){
						$sender->sendMessage("§f[§3Информация§f]: Plugin job: §6Fine");}
						if($online > 171 && $online <= 270){
						$sender->sendMessage("§f[§3Информация§f]: Plugin job: §6Ecstime");}
						if($online > 271){
						$sender->sendMessage("§f[§3Информация§f]: Plugin job: §4Max loaded");}
						if($this->config1['Dop']['Job'] == 1){
						$sender->sendMessage("§f[§3Информация§f]: Сasino Activity: §2Spinning");}
						if($this->config1['Dop']['Job'] == 0){
						$sender->sendMessage("§f[§3Информация§f]: Сasino Activity: Сosts");}
						$sender->sendMessage("§f[§3Информация§f]: Testing work framework: ");
						$xcor = $this->config1['1']['X']; $ycor = $this->config1['1']['Y'];$zcor = $this->config1['1']['Z'];$xcor2 = $this->config1['2']['X'];
						$ycor2 = $this->config1['2']['Y'];$zcor2 = $this->config1['2']['Z']; $xcor3 = $this->config1['3']['X'];  $ycor3 = $this->config1['3']['Y']; $zcor3 = $this->config1['3']['Z']; 
						$tile3 = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor3, $ycor3, $zcor3));
						$tile2 = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor2, $ycor2, $zcor2));
						$tile = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor, $ycor, $zcor));
						if($tile instanceof ItemFrame){
						$sender->sendMessage("§f[§3Информация§f]: 1 frame - §2Job X(".$xcor.") Y(".$ycor.") Z(".$zcor.")");}
						if(!$tile instanceof ItemFrame){
						$sender->sendMessage("§f[§3Информация§f]: 1 frame - §4No Job X(".$xcor.") Y(".$ycor.") Z(".$zcor.")");}
						if($tile2 instanceof ItemFrame){
						$sender->sendMessage("§f[§3Информация§f]: 2 frame - §2Job X(".$xcor2.") Y(".$ycor2.") Z(".$zcor2.")");}
						if(!$tile2 instanceof ItemFrame){
						$sender->sendMessage("§f[§3Информация§f]: 2 frame - §4No Job X(".$xcor2.") Y(".$ycor2.") Z(".$zcor2.")");}
						if($tile3 instanceof ItemFrame){
						$sender->sendMessage("§f[§3Информация§f]: 3 frame - §2Job X(".$xcor3.") Y(".$ycor3.") Z(".$zcor3.")");}
						if(!$tile3 instanceof ItemFrame){
						$sender->sendMessage("§f[§3Информация§f]: 3 frame - §4No Job X(".$xcor3.") Y(".$ycor3.") Z(".$zcor3.")");}return;
					}
					return;
				}
				case "cset1": 
				if($sender->hasPermission("wcasino.frame.set"))
				{
					$this->config1['1']['X'] = $args[0];
					$this->config1['1']['Y'] = $args[1];
					$this->config1['1']['Z'] = $args[2];
					if($eng == RU || $eng == ru || $eng == Ru){
					$sender->sendMessage("§f[§6wCasinoFrame§f] Координаты установлены, новые координаты 1 рамки");}
					if($eng == EN || $eng == en || $eng == En){
					$sender->sendMessage("§f[§6wCasinoFrame§f] Coordinates are set, the new coordinates of the frame 1");}
					$sender->sendMessage("§4 -> §fX(§6".$args[0]."§f) §fY(§6".$args[1]."§f) §fZ(§6".$args[2]."§f)");
					return true;
				}
				case "cset2": 
				if($sender->hasPermission("wcasino.frame.set"))
				{
					$this->config1['2']['X'] = $args[0];
					$this->config1['2']['Y'] = $args[1];
					$this->config1['2']['Z'] = $args[2];
					if($eng == RU || $eng == ru || $eng == Ru){
					$sender->sendMessage("§f[§6wCasinoFrame§f] Координаты установлены, новые координаты 2 рамки");}
					if($eng == EN || $eng == en || $eng == En){
					$sender->sendMessage("§f[§6wCasinoFrame§f] Coordinates are set, the new coordinates of the frame 2");}
					$sender->sendMessage("§4 -> §fX(§6".$args[0]."§f) §fY(§6".$args[1]."§f) §fZ(§6".$args[2]."§f)");
					return true;
				}
				case "cset3": 
				if($sender->hasPermission("wcasino.frame.set"))
				{
					$this->config1['3']['X'] = $args[0];
					$this->config1['3']['Y'] = $args[1];
					$this->config1['3']['Z'] = $args[2];
					if($eng == RU || $eng == ru || $eng == Ru){
					$sender->sendMessage("§f[§6wCasinoFrame§f] Координаты установлены, новые координаты 3 рамки");}
					if($eng == EN || $eng == en || $eng == En){
					$sender->sendMessage("§f[§6wCasinoFrame§f] Coordinates are set, the new coordinates of the frame 3");}
					$sender->sendMessage("§4 -> §fX(§6".$args[0]."§f) §fY(§6".$args[1]."§f) §fZ(§6".$args[2]."§f)");
					return true;
				}
				case "cset4": 
				if($sender->hasPermission("wcasino.frame.set"))
				{
					$this->config1['4']['X'] = $args[0];
					$this->config1['4']['Y'] = $args[1];
					$this->config1['4']['Z'] = $args[2];
					if($eng == RU || $eng == ru || $eng == Ru){
					$sender->sendMessage("§f[§6wCasinoFrame§f] Координаты установлены, новые координаты рачага / кнопки");}
					if($eng == EN || $eng == en || $eng == En){
					$sender->sendMessage("§f[§6wCasinoFrame§f] Coordinates are set, the new coordinates of the lever / button");}
					$sender->sendMessage("§4 -> §fX(§6".$args[0]."§f) §fY(§6".$args[1]."§f) §fZ(§6".$args[2]."§f)");
					return true;
				}
				case "cstart": 
				if($sender->hasPermission("wcasino.frame.start"))
				{
					$gogame = $cfg->get("Go_game");
					$nomoney = $cfg->get("Nomoney");
					$already_underway = $cfg->get("already_underway");
					if($this->config1['Dop']['Job'] == 0)
					{
						if($money >= $cena)
						{
							$this->config1['Dop']['Job'] = 1;
							$this->api->reduceMoney($sender, $cena);
							$player = strtolower($sender->getName());
							$this->config1['Dop']['sender'] = $player;
							$p = $sender;
							$sender->sendTip("".$gogame.""); 
							$sender->sendMessage("".$gogame."");
							$p->getLevel()->addSound(new ClickSound($p));
							$xcor = $this->config1['1']['X'];  
							$ycor = $this->config1['1']['Y']; 
							$zcor = $this->config1['1']['Z']; 
							$tile = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor, $ycor, $zcor));
							$this->getServer()->getScheduler()->scheduleDelayedTask(new CallbackTask(array($this, "OnePos1")), 2 * 50);
							if($tile instanceof ItemFrame)
							{
								$tile->setItem(Item::get(322, 0, 1)); 
								$tile->setItemRotation(0);
							}		
							$xcor2 = $this->config1['2']['X'];  
							$ycor2 = $this->config1['2']['Y']; 
							$zcor2 = $this->config1['2']['Z']; 
							$tile2 = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor2, $ycor2, $zcor2)); 
							if($tile2 instanceof ItemFrame) 
							{
								$tile2->setItem(Item::get(322, 0, 1)); 
								$tile2->setItemRotation(0); 
							}	
							$xcor3 = $this->config1['3']['X'];  
							$ycor3 = $this->config1['3']['Y']; 
							$zcor3 = $this->config1['3']['Z']; 
							$tile3 = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor3, $ycor3, $zcor3)); 
							if($tile3 instanceof ItemFrame) 
							{
								$tile3->setItem(Item::get(322, 0, 1)); 
								$tile3->setItemRotation(0); 
							}
						}
						if($money < $cena)
						{
						$sender->sendTip("".$nomoney.""); 
						$sender->sendMessage("".$nomoney."");
						return true;
						}
					}
					else if($this->config1['Dop']['Job'] == 1)
					{
						$sender->sendTip("".$already_underway.""); 
						$sender->sendMessage("".$already_underway."");
						return true;
					}
					return true;
				}	
			}
		}
		
		public function OnePos1()
		{
			$this->getServer()->getScheduler()->scheduleDelayedTask(new CallbackTask(array($this, "OnePos2")), 2 * 20);
			$p1 = $this->config1['Dop']['sender'];
			$p = Server::getInstance()->getPlayer($p1);
			$xcor = $this->config1['1']['X'];  
			$ycor = $this->config1['1']['Y']; 
			$zcor = $this->config1['1']['Z'];
			$p->getLevel()->addSound(new ClickSound($p));
			$tile = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor, $ycor, $zcor)); 
			if($tile instanceof ItemFrame) 
			{
				$amount = mt_rand(1,3);  
				switch (mt_rand(1,3))
				{
					case 1:
					{
						$tile->setItem(Item::get(264, 0, 1)); 
						$tile->setItemRotation(0); 
						break;
					}
					case 2:
					{
						$tile->setItem(Item::get(388, 0, 1)); 
						$tile->setItemRotation(0); 
						break;
						
					}
					case 3:
					{
						$tile->setItem(Item::get(266, 0, 1)); 
						$tile->setItemRotation(0); 
						break;
					}
				}
			}			
			$xcor2 = $this->config1['2']['X'];  
			$ycor2 = $this->config1['2']['Y']; 
			$zcor2 = $this->config1['2']['Z']; 
			$tile2 = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor2, $ycor2, $zcor2)); 
			if($tile2 instanceof ItemFrame) 
			{
				$amount2 = mt_rand(4,7);  
				switch (mt_rand(4,7))
				{
					case 4:
					{
						$tile2->setItem(Item::get(264, 0, 1)); 
						$tile2->setItemRotation(0); 
						break;
					}
					case 6:
					{
						$tile2->setItem(Item::get(388, 0, 1)); 
						$tile2->setItemRotation(0); 
						break;
					}
					case 7:
					{
						$tile2->setItem(Item::get(266, 0, 1)); 
						$tile2->setItemRotation(0); 
						break;
					}
				}
				
			}			
			$xcor3 = $this->config1['3']['X'];  
			$ycor3 = $this->config1['3']['Y']; 
			$zcor3 = $this->config1['3']['Z']; 
			$tile3 = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor3, $ycor3, $zcor3)); 
			if($tile3 instanceof ItemFrame) 
			{
				$amount2 = mt_rand(8,10);  
				switch (mt_rand(8,10))
				{
					case 8:
					{
						$tile3->setItem(Item::get(264, 0, 1)); 
						$tile3->setItemRotation(0); 
						break;
					}
					case 9:
					{
						$tile3->setItem(Item::get(388, 0, 1)); 
						$tile3->setItemRotation(0); 
						break;
					}
					case 10:
					{
						$tile3->setItem(Item::get(266, 0, 1)); 
						$tile3->setItemRotation(0); 
						break;
					}
				}
			}
			return;
		}
		
		public function OnePos2()
		{
			$this->getServer()->getScheduler()->scheduleDelayedTask(new CallbackTask(array($this, "OnePos3")), 2 * 20);
			$p1 = $this->config1['Dop']['sender'];
			$p = Server::getInstance()->getPlayer($p1);
			$xcor = $this->config1['1']['X'];  
			$ycor = $this->config1['1']['Y']; 
			$zcor = $this->config1['1']['Z'];
			$p->getLevel()->addSound(new ClickSound($p));
			$tile = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor, $ycor, $zcor)); 
			if($tile instanceof ItemFrame) 
			{
				$amount = mt_rand(1,3);  
				switch (mt_rand(1,3))
				{
					case 1:
					{
						$tile->setItem(Item::get(264, 0, 1)); 
						$tile->setItemRotation(2); 
						break;
					}
					case 2:
					{
						$tile->setItem(Item::get(388, 0, 1)); 
						$tile->setItemRotation(2); 
						break;
					}
					case 3:
					{
						$tile->setItem(Item::get(266, 0, 1)); 
						$tile->setItemRotation(2); 
						break;
					}
				}
			}			
			$xcor2 = $this->config1['2']['X'];  
			$ycor2 = $this->config1['2']['Y']; 
			$zcor2 = $this->config1['2']['Z']; 
			$tile2 = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor2, $ycor2, $zcor2)); 
			if($tile2 instanceof ItemFrame) 
			{
				$amount2 = mt_rand(4,7);  
				switch (mt_rand(4,7))
				{
					case 4:
					{
						$tile2->setItem(Item::get(264, 0, 1)); 
						$tile2->setItemRotation(2); 
						break;
					}
					case 6:
					{
						$tile2->setItem(Item::get(388, 0, 1)); 
						$tile2->setItemRotation(2); 
						break;
					}
					case 7:
					{
						$tile2->setItem(Item::get(266, 0, 1)); 
						$tile2->setItemRotation(2); 
						break;
					}
				}
				
			}				
			$xcor3 = $this->config1['3']['X'];  
			$ycor3 = $this->config1['3']['Y']; 
			$zcor3 = $this->config1['3']['Z']; 
			$tile3 = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor3, $ycor3, $zcor3)); 
			if($tile3 instanceof ItemFrame) 
			{
				$amount2 = mt_rand(8,10);  
				switch (mt_rand(8,10))
				{
					case 8:
					{
						$tile3->setItem(Item::get(264, 0, 1)); 
						$tile3->setItemRotation(2); 
						break;
					}
					case 9:
					{
						$tile3->setItem(Item::get(388, 0, 1)); 
						$tile3->setItemRotation(2); 
						break;
					}
					case 10:
					{
						$tile3->setItem(Item::get(266, 0, 1)); 
						$tile3->setItemRotation(2); 
						break;
					}
				}
			}
			return;
		}
	
		public function OnePos3()
		{
			$this->getServer()->getScheduler()->scheduleDelayedTask(new CallbackTask(array($this, "OnePos4")), 2 * 20);
			$p1 = $this->config1['Dop']['sender'];
			$p = Server::getInstance()->getPlayer($p1);
			$xcor = $this->config1['1']['X'];  
			$ycor = $this->config1['1']['Y']; 
			$p->getLevel()->addSound(new ClickSound($p));
			$zcor = $this->config1['1']['Z'];
			$tile = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor, $ycor, $zcor)); 
			if($tile instanceof ItemFrame) 
			{
				$amount = mt_rand(1,3);  
				switch (mt_rand(1,3))
				{
					case 1:
					{
						$tile->setItem(Item::get(264, 0, 1)); 
						$tile->setItemRotation(4); 
						break;
					}
					case 2:
					{
						$tile->setItem(Item::get(388, 0, 1)); 
						$tile->setItemRotation(4); 
						break;
					}
					case 3:
					{
						$tile->setItem(Item::get(266, 0, 1)); 
						$tile->setItemRotation(4); 
						break;
					}
				}
			}	
			$xcor2 = $this->config1['2']['X'];  
			$ycor2 = $this->config1['2']['Y']; 
			$zcor2 = $this->config1['2']['Z']; 
			$tile2 = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor2, $ycor2, $zcor2)); 
			if($tile2 instanceof ItemFrame) 
			{
				$amount2 = mt_rand(4,7);  
				switch (mt_rand(4,7))
				{
					case 4:
					{
						$tile2->setItem(Item::get(264, 0, 1)); 
						$tile2->setItemRotation(4); 
						break;
					}
					case 6:
					{
						$tile2->setItem(Item::get(388, 0, 1)); 
						$tile2->setItemRotation(4); 
						break;
					}
					case 7:
					{
						$tile2->setItem(Item::get(266, 0, 1)); 
						$tile2->setItemRotation(4); 
						break;
					}
				}
				
			}
			$xcor3 = $this->config1['3']['X'];  
			$ycor3 = $this->config1['3']['Y']; 
			$zcor3 = $this->config1['3']['Z']; 
			$tile3 = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor3, $ycor3, $zcor3)); 
			if($tile3 instanceof ItemFrame) 
			{
				$amount2 = mt_rand(8,10);  
				switch (mt_rand(8,10))
				{
					case 8:
					{
						$tile3->setItem(Item::get(264, 0, 1)); 
						$tile3->setItemRotation(4); 
						break;
					}
					case 9:
					{
						$tile3->setItem(Item::get(388, 0, 1)); 
						$tile3->setItemRotation(4); 
						break;
					}
					case 10:
					{
						$tile3->setItem(Item::get(266, 0, 1)); 
						$tile3->setItemRotation(4); 
						break;
					}
				}
			}
			return;
		}

		public function OnePos4()
		{
			$this->getServer()->getScheduler()->scheduleDelayedTask(new CallbackTask(array($this, "OnePos5")), 2 * 20);
			$p1 = $this->config1['Dop']['sender'];
			$p = Server::getInstance()->getPlayer($p1);
			$xcor = $this->config1['1']['X'];  
			$p->getLevel()->addSound(new ClickSound($p));
			$ycor = $this->config1['1']['Y']; 
			$zcor = $this->config1['1']['Z'];
			$tile = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor, $ycor, $zcor)); 
			if($tile instanceof ItemFrame) 
			{
				$amount = mt_rand(1,3);  
				switch (mt_rand(1,3))
				{
					case 1:
					{
						$tile->setItem(Item::get(264, 0, 1)); 
						$tile->setItemRotation(6); 
						break;
					}
					case 2:
					{
						$tile->setItem(Item::get(388, 0, 1)); 
						$tile->setItemRotation(6); 
						break;
					}
					case 3:
					{
						$tile->setItem(Item::get(266, 0, 1)); 
						$tile->setItemRotation(6); 
						break;
					}
				}
			}		
			///////////////////////////[2 Ramk]////////////////////////////////////////////////////////////////////////////////		
			$xcor2 = $this->config1['2']['X'];  
			$ycor2 = $this->config1['2']['Y']; 
			$zcor2 = $this->config1['2']['Z']; 
			$tile2 = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor2, $ycor2, $zcor2)); 
			if($tile2 instanceof ItemFrame) 
			{
				$amount2 = mt_rand(4,7);  
				switch (mt_rand(4,7))
				{
					case 4:
					{
						$tile2->setItem(Item::get(264, 0, 1)); 
						$tile2->setItemRotation(6); 
						break;
					}
					case 6:
					{
						$tile2->setItem(Item::get(388, 0, 1)); 
						$tile2->setItemRotation(6); 
						break;
					}
					case 7:
					{
						$tile2->setItem(Item::get(266, 0, 1)); 
						$tile2->setItemRotation(6); 
						break;
					}
				}
			}			
			///////////////////////////[3 Ramk]////////////////////////////////////////////////////////////////////////////////		
			$xcor3 = $this->config1['3']['X'];  
			$ycor3 = $this->config1['3']['Y']; 
			$zcor3 = $this->config1['3']['Z']; 
			$tile3 = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor3, $ycor3, $zcor3)); 
			if($tile3 instanceof ItemFrame) 
			{
				$amount2 = mt_rand(8,10);  
				switch (mt_rand(8,10))
				{
					case 8:
					{
						$tile3->setItem(Item::get(264, 0, 1)); 
						$tile3->setItemRotation(6); 
						break;
					}
					case 9:
					{
						$tile3->setItem(Item::get(388, 0, 1)); 
						$tile3->setItemRotation(6); 
						break;
					}
					case 10:
					{
						$tile3->setItem(Item::get(266, 0, 1)); 
						$tile3->setItemRotation(6); 
						break;
					}
				}
			}
			return;
		}

		public function OnePos5()
		{
			$cfg = $this->getConfig();
			$cena = $cfg->get("Price_game");
			$beat = $cfg->get("Beat_game");
			$loss = $cfg->get("Loss_game");
			$p1 = $this->config1['Dop']['sender']; //beat / loss
			$p = Server::getInstance()->getPlayer($p1);
			$xcor = $this->config1['1']['X'];  
			$ycor = $this->config1['1']['Y']; 
			$zcor = $this->config1['1']['Z']; 
			$tile = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor, $ycor, $zcor));
			if($tile instanceof ItemFrame)
			{
				$amount = mt_rand(1,4);  
				switch (mt_rand(1,4))
				{
					case 1:
					{
						$tile->setItem(Item::get(266, 0, 1));
						$tile->setItemRotation(7); 
						$this->config1['Dop']['1'] = 3;
						break;
					}
					case 2:
					{
						$tile->setItem(Item::get(388, 0, 1)); 
						$tile->setItemRotation(7); 
						$this->config1['Dop']['1'] = 2;
						break;
					}
					case 3:
					{
						$tile->setItem(Item::get(264, 0, 1));
						$tile->setItemRotation(7); 
						$this->config1['Dop']['1'] = 1;
						break;
					}
					case 4:
					{
						$tile->setItem(Item::get(264, 0, 1)); 
						$tile->setItemRotation(7); 
						$this->config1['Dop']['1'] = 1;
						break;
					}
				}
			}			
			$xcor2 = $this->config1['2']['X'];  
			$ycor2 = $this->config1['2']['Y']; 
			$zcor2 = $this->config1['2']['Z']; 
			$tile2 = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor2, $ycor2, $zcor2)); 
			if($tile2 instanceof ItemFrame) 
			{
				$amount2 = mt_rand(5,8);  
				switch (mt_rand(5,8))
				{
					case 5:
					{
						$tile2->setItem(Item::get(388, 0, 1)); 
						$tile2->setItemRotation(7); 
						$this->config1['Dop']['2'] = 2;
						break;
					}
					case 6:
					{
						$tile2->setItem(Item::get(264, 0, 1)); 
						$tile2->setItemRotation(7); 
						$this->config1['Dop']['2'] = 1;
						break;
					}
					case 7:
					{
						$tile2->setItem(Item::get(266, 0, 1)); 
						$tile2->setItemRotation(7); 
						$this->config1['Dop']['2'] = 3;
						break;
					}
					case 8:
					{
						$tile2->setItem(Item::get(264, 0, 1)); 
						$tile2->setItemRotation(7); 
						$this->config1['Dop']['2'] = 1;
						break;
					}
				}
				
			}				
			$xcor3 = $this->config1['3']['X'];  
			$ycor3 = $this->config1['3']['Y']; 
			$zcor3 = $this->config1['3']['Z']; 
			$tile3 = $this->getServer()->getDefaultLevel()->getTile(new Vector3($xcor3, $ycor3, $zcor3)); 
			if($tile3 instanceof ItemFrame) 
			{
				$amount2 = mt_rand(9,12);  
				switch (mt_rand(9,12))
				{
					case 9:
					{
						$tile3->setItem(Item::get(264, 0, 1)); 
						$tile3->setItemRotation(7); 
						$this->config1['Dop']['3'] = 1;
						break;
					}
					case 10:
					{
						$tile3->setItem(Item::get(388, 0, 1)); 
						$tile3->setItemRotation(7); 
						$this->config1['Dop']['3'] = 2;
						break;
					}
					case 11:
					{
						$tile3->setItem(Item::get(266, 0, 1)); 
						$tile3->setItemRotation(7); 
						$this->config1['Dop']['3'] = 3;
						break;
					}
					case 12:
					{
						$tile3->setItem(Item::get(264, 0, 1)); 
						$tile3->setItemRotation(7); 
						$this->config1['Dop']['3'] = 1;
						break;
					}
				}
			}
			if($this->config1['Dop']['1'] == 1 && $this->config1['Dop']['2'] == 1 && $this->config1['Dop']['3'] == 1)
			{
				$p->getLevel()->addSound(new AnvilFallSound($p));
        		$p->getLevel()->addParticle(new ExplodeParticle($p));
				$p->sendMessage("".$beat." §6x10§f!");
				$p->sendTip("".$beat." §4x10§f!");
				$cenanew = $cena * 10;
				$this->api->addMoney($p, $cenanew);
				$this->config1['Dop']['Job'] = 0;
				return true;
			}
			if($this->config1['Dop']['1'] == 1 && $this->config1['Dop']['2'] == 1  && $this->config1['Dop']['3'] == 2)
			{
				$p->getLevel()->addSound(new AnvilFallSound($p));
        		$p->getLevel()->addParticle(new ExplodeParticle($p));
				$p->sendMessage("".$beat." §6".$cena."$ §f!");
				$p->sendTip("".$beat." §4".$cena."$ §f!");
				$cenanew = $cena;
				$this->api->addMoney($p, $cenanew);
				$this->config1['Dop']['Job'] = 0;
				return true;				
			}
			if($this->config1['Dop']['2'] == 1 && $this->config1['Dop']['3'] == 1 && $this->config1['Dop']['1'] == 2)
			{
				$p->getLevel()->addSound(new AnvilFallSound($p));
        		$p->getLevel()->addParticle(new ExplodeParticle($p));
				$p->sendMessage("".$beat." §6".$cena."$ §f!");
				$p->sendTip("".$beat." §4".$cena."$ §f!");
				$cenanew = $cena;
				$this->api->addMoney($p, $cenanew);
				$this->config1['Dop']['Job'] = 0;
				return true;				
			}
			if($this->config1['Dop']['1'] == 2 && $this->config1['Dop']['2'] == 2  && $this->config1['Dop']['3'] == 3)
			{
				$p->getLevel()->addSound(new AnvilFallSound($p));
        		$p->getLevel()->addParticle(new ExplodeParticle($p));
				$p->sendMessage("".$beat." §6".$cena."$ §f!");
				$p->sendTip("".$beat." §4".$cena."$ §f!");
				$cenanew = $cena;
				$this->api->addMoney($p, $cenanew);
				$this->config1['Dop']['Job'] = 0;
				return true;				
			}
			if($this->config1['Dop']['2'] == 2 && $this->config1['Dop']['3'] == 2 && $this->config1['Dop']['1'] == 3)
			{
				$p->getLevel()->addSound(new AnvilFallSound($p));
        		$p->getLevel()->addParticle(new ExplodeParticle($p));
				$p->sendMessage("".$beat." §6".$cena."$ §f!");
				$p->sendTip("".$beat." §4".$cena."$ §f!");
				$cenanew = $cena;
				$this->api->addMoney($p, $cenanew);
				$this->config1['Dop']['Job'] = 0;
				return true;				
			}
			if($this->config1['Dop']['1'] == 3 && $this->config1['Dop']['2'] == 3  && $this->config1['Dop']['3'] == 2)
			{
				$p->getLevel()->addSound(new AnvilFallSound($p));
        		$p->getLevel()->addParticle(new ExplodeParticle($p));
				$p->sendMessage("".$beat." §6".$cena."$ §f!");
				$p->sendTip("".$beat." §4".$cena."$ §f!");
				$cenanew = $cena;
				$this->api->addMoney($p, $cenanew);
				$this->config1['Dop']['Job'] = 0;
				return true;				
			}
			if($this->config1['Dop']['2'] == 3 && $this->config1['Dop']['3'] == 3 && $this->config1['Dop']['1'] == 2)
			{
				$p->getLevel()->addSound(new AnvilFallSound($p));
        		$p->getLevel()->addParticle(new ExplodeParticle($p));
				$p->sendMessage("".$beat." §6".$cena."$ §f!");
				$p->sendTip("".$beat." §4".$cena."$ §f!");
				$cenanew = $cena;
				$this->api->addMoney($p, $cenanew);
				$this->config1['Dop']['Job'] = 0;
				return true;				
			}
			if($this->config1['Dop']['1'] == 2 && $this->config1['Dop']['2'] == 2 && $this->config1['Dop']['3'] == 2)
			{
				$p->getLevel()->addSound(new AnvilFallSound($p));
        		$p->getLevel()->addParticle(new ExplodeParticle($p));
				$p->sendMessage("".$beat." §6x5§f!");
				$p->sendTip("".$beat." §4x5§f!");
				$cenanew = $cena * 5;
				$this->api->addMoney($p, $cenanew);
				$this->config1['Dop']['Job'] = 0;
				return true;
			}
			if($this->config1['Dop']['1'] == 3 && $this->config1['Dop']['2'] == 3 && $this->config1['Dop']['3'] == 3)
			{
				$p->getLevel()->addSound(new AnvilFallSound($p));
        		$p->getLevel()->addParticle(new ExplodeParticle($p));
				$p->sendMessage("".$beat." §6x2§f!");
				$p->sendTip("".$beat." §4x2§f!");
				$cenanew = $cena * 2;
				$this->api->addMoney($p, $cenanew);
				$this->config1['Dop']['Job'] = 0;
				return true;
			}
			$p->sendMessage("".$loss."");
			$this->config1['Dop']['Job'] = 0;
			$p->sendTip("".$loss."");
			return true;
		}		
	
		public function getX1($player) {
			if(isset($this->config1['1']))
				return $this->config1['1']['X'];}
		public function getY1($player) {
			if(isset($this->config1['1']))
				return $this->config1['1']['Y'];}
		public function getZ1($player) {
			if(isset($this->config1['1']))
				return $this->config1['1']['Z'];}
		public function getX2($player) {
			if(isset($this->config1['2']))
				return $this->config1['2']['X'];}
		public function getY2($player) {
			if(isset($this->config1['2']))
				return $this->config1['2']['Y'];}
		public function getZ2($player) {
			if(isset($this->config1['2']))
				return $this->config1['2']['Z'];}
		public function getX3($player) {
			if(isset($this->config1['3']))
				return $this->config1['3']['X'];}
		public function getY3($player) {
			if(isset($this->config1['3']))
				return $this->config1['3']['Y'];}
		public function getZ3($player) {
			if(isset($this->config1['3']))
				return $this->config1['3']['Z'];}
		public function getX4($player) {
			if(isset($this->config1['4']))
				return $this->config1['4']['X'];}
		public function getY4($player) {
			if(isset($this->config1['4']))
				return $this->config1['4']['Y'];}
		public function getZ4($player) {
			if(isset($this->config1['4']))
				return $this->config1['4']['Z'];}
		public function getDop1($player) {
			if(isset($this->config1['Dop']))
				return $this->config1['Dop']['1'];}
		public function getDop2($player) {
			if(isset($this->config1['Dop']))
				return $this->config1['Dop']['2'];}
		public function getDop3($player) {
			if(isset($this->config1['Dop']))
				return $this->config1['Dop']['3'];}			
		public function getSender($player) {
			if(isset($this->config1['Dop']))
				return $this->config1['Dop']['sender'];}
		public function getJobPlug($player) {
			if(isset($this->config1['Dop']))
				return $this->config1['Dop']['Job'];}
		public function getYstc($player) {
			if(isset($this->config1['Yst']))
				return $this->config1['Yst']['go'];}
		
		public function save() 
		{
			$cfg = new Config($this->getDataFolder().'config1.yml', Config::YAML);
			$cfg->setAll($this->config1);
			$cfg->save();
		}	
	}
	
?>
