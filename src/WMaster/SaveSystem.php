<?php

	namespace WMaster;

	use pocketmine\scheduler\PluginTask;

	class SaveSystem extends PluginTask {

		public function __construct(wCasinoFrame $plugin) {
			parent::__construct($plugin);
			$this->p = $plugin;
			$plugin->getLogger()->info('[Святослав] Авто обновление конфига работает!');
		}

		public function onRun($tick) {
			$this->p->save();
		}

	}

?>
