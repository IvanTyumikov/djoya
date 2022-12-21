<?php

namespace yupe\components\actions;

use Yii;
use CAction;

require_once(Yii::getPathOfAlias('vendor.studio-42.elfinder') . '/php/elFinderConnector.class.php');
require_once(Yii::getPathOfAlias('vendor.studio-42.elfinder') . '/php/elFinder.class.php');
require_once(Yii::getPathOfAlias('vendor.studio-42.elfinder') . '/php/elFinderVolumeDriver.class.php');
require_once(Yii::getPathOfAlias('vendor.studio-42.elfinder') . '/php/elFinderVolumeLocalFileSystem.class.php');
require_once(Yii::getPathOfAlias('vendor.studio-42.elfinder') . '/php/elFinderVolumeMySQL.class.php');
require_once(Yii::getPathOfAlias('vendor.studio-42.elfinder') . '/php/elFinderVolumeFTP.class.php');

/**
 * elFinder connector
 */
class ElFinderConnectAction extends CAction {

	public $settings = array();

	public function run() 
	{	
		$fm = new \elFinderConnector(new \elFinder($this->settings));
		$fm->run();
	}

}
