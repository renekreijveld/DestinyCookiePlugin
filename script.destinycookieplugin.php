<?php
/**
 * @package Destiny Cookie Plugin
 * @version 1.0.9
 * @copyright Copyright (C) 2021 Destiny B.V., All rights reserved.
 * @license GNU General Public License version 3 or later; see LICENSE.txt
 * @author url: https://www.destiny.nl
 * @author email publicanda@destiny.nl
 *
 * Destiny Cookie Plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 */

defined('_JEXEC') or die;

use \Joomla\CMS\Factory;

class plgSystemDestinycookiepluginInstallerScript
{
	public $parameters;
	public $extension;
	public $extid;
	public $db;

	public function postflight($type, $parent)
	{
		$lang = Factory::getLanguage();
        $year = date('Y');
		if ($lang->getTag() == 'nl-NL')
		{
			$message = "<h3><b>Destiny Cookie Plugin 1.0.9 - Joomla 4 versie</b></h3>
			Vergeet niet om na deze installatie de plugin instellingen te controleren en de plugin te publiceren.<br>
			<a href='index.php?option=com_plugins&view=plugins&filter[search]=destiny' style='text-decoration:underline;'>Klik hier om naar de plugininstellingen te gaan</a>.<br>
			Versie 1.0.9, copyright &copy; 2021 - $year Destiny B.V., alle rechten voorbehouden. <a href='https://www.destiny.nl' target='_blank'><b>www.destiny.nl</b></a><br>";
		}
		else
		{
			$message = "<h3><b>Destiny Cookie Plugin 1.0.9 - Joomla 4 version</b></h3>
			Don't forget to check the plugin settings and to publish the plugin after this installation.<br>
			<a href='index.php?option=com_plugins&view=plugins&filter[search]=destiny' style='text-decoration:underline;'>Click here to go to the plugin settings</a>.<br>
			Version 1.0.9, copyright &copy; 2021 - $year Destiny B.V., all rights reserved. <a href='https://www.destiny.nl' target='_blank'><b>www.destiny.nl</b></a><br>";
		}
		$app = Factory::getApplication();
		Factory::getApplication()->enqueueMessage($message, 'info');
	}
}