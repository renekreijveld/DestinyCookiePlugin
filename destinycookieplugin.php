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

defined('_JEXEC') or die();

use \Joomla\CMS\Factory;
use \Joomla\CMS\HTML\HTMLHelper;
use \Joomla\CMS\Language\Text;

class PlgSystemDestinycookieplugin extends JPlugin
{

	protected $autoloadLanguage = true;
	protected $app;

	public function onBeforeRender()
	{

		// Niet uitvoeren in de backend
		if (Factory::getApplication()->isClient('administrator'))
		{
			return;
		}

		{
			if (in_array($this->app->input->getCmd('Itemid', ''), $this->params->get('excludes', [])))
			{
				return;
			}
		}

		$session = Factory::getSession();
		if (isset($_COOKIE['destinycp']))
		{
			$dcpCookie = json_decode($_COOKIE['destinycp']);
			$session->set('destinycp_status', $dcpCookie);
		}
		else
		{
			$bannerfontfamily = $this->params->get('bannerfontfamily');
			if ($bannerfontfamily == 'other')
			{
				$bannerfont = $this->params->get('bannerfont');
			}
			elseif ($bannerfontfamily == 'template')
			{
				$bannerfont = '';
			}
			else
			{
				$bannerfont = $bannerfontfamily;
			}
			$bannerfontsize            = $this->params->get('bannerfontsize');
			$banner_bgcolor            = $this->params->get('banner_bgcolor');
			$banner_textcolor          = $this->params->get('banner_textcolor');
			$banner_linkcolor          = $this->params->get('banner_linkcolor');
			$button_continue_bgcolor   = $this->params->get('button_continue_bgcolor');
			$button_continue_textcolor = $this->params->get('button_continue_textcolor');
			$popupfontfamily           = $this->params->get('popupfontfamily');
			if ($popupfontfamily == 'other')
			{
				$popupfont = $this->params->get('popupfont');
			}
			elseif ($popupfontfamily == 'template')
			{
				$popupfont = '';
			}
			else
			{
				$popupfont = $popupfontfamily;
			}
			$popup_bgcolor              = $this->params->get('popup_bgcolor');
			$popup_titlecolor           = $this->params->get('popup_titlecolor');
			$popup_textcolor            = $this->params->get('popup_textcolor');
			$popup_barcolor             = $this->params->get('popup_barcolor');
			$popup_slidecolor           = $this->params->get('popup_slidecolor');
			$popup_buttonsave_bgcolor   = $this->params->get('popup_buttonsave_bgcolor');
			$popup_buttonsave_textcolor = $this->params->get('popup_buttonsave_textcolor');
			$popup_buttonall_bgcolor    = $this->params->get('popup_buttonall_bgcolor');
			$popup_buttonall_textcolor  = $this->params->get('popup_buttonall_textcolor');
			$popupfontsize              = $this->params->get('popupfontsize');
			$showfunc                   = $this->params->get('showfunc');
			$showana                    = $this->params->get('showana');
			$showmark                   = $this->params->get('showmark');

			$css = '';
			if ($bannerfont)
			{
				$css .= '#dcpbanner {font-family: ' . $bannerfont . ';}';
			}
			if ($popupfont)
			{
				$css .= '#dcppopup, #dcppopup h2 {font-family: ' . $popupfont . ';}';
			}
			$css .= '#dcpbanner {font-size: ' . $bannerfontsize . ';}';
			$css .= '#dcppopup {font-size: ' . $popupfontsize . ';}';
			$css .= '#dcppopup {background-color: ' . $popup_bgcolor . '; color: ' . $popup_textcolor . ';}';
			$css .= '#dcppopup h2 {color: ' . $popup_titlecolor . ';}';
			$css .= '#dcppopup .collapsible {background-color: ' . $popup_barcolor . ';}';
			$css .= '#dcpbanner {background-color: ' . $banner_bgcolor . '; color: ' . $banner_textcolor . '; }';
			$css .= '#dcpbanner a, #dcpbanner a:hover, #dcpbanner a:focus, #dcpbanner a:active {color: ' . $banner_linkcolor . '; }';
			$css .= '#dcpbanner .dcp-allow {background-color: ' . $button_continue_bgcolor . '; color: ' . $button_continue_textcolor . ';}';
			$css .= '#dcpbanner .dcp-allow:hover, #dcpbanner .dcp-allow:active, #dcpbanner .dcp-allow:focus {color: ' . $button_continue_textcolor . ';}';
			$css .= '#dcppopup #save {border-color: ' . $popup_buttonsave_bgcolor . '; color: ' . $popup_buttonsave_textcolor . ';}';
			$css .= '#dcppopup #accept {background-color: ' . $popup_buttonall_bgcolor . '; color: ' . $popup_buttonall_textcolor . ';}';
			$css .= '#dcppopup .collapsible .switch input:checked + .slider {background-color: ' . $popup_slidecolor . ';}';
			$css .= '#dcppopup .collapsible .switch input:focus + .slider {box-shadow: 0 0 1px ' . $popup_slidecolor . ';}';
			if ($showfunc == 0)
			{
				$css .= '#dcppopup .func_set {display:none;}';
			}
			if ($showana == 0)
			{
				$css .= '#dcppopup .ana_set {display:none;}';
			}
			if ($showmark == 0)
			{
				$css .= '#dcppopup .mark_set {display:none;}';
			}
			$doc = Factory::getDocument();
			$doc->addStyleDeclaration($css);
			HTMLHelper::_('stylesheet', 'media/plg_system_destinycookieplugin/css/dcpstyles.css', ['version' => 'auto', 'relative' => false]);
			HTMLHelper::_('script', 'media/plg_system_destinycookieplugin/js/destinycookiepopup.js', ['version' => 'auto', 'relative' => false]);
			$session->set('destinycp_status', 'reject');
		}
	}

	public function onAfterRender()
	{
		// Niet uitvoeren in de backend
		if (Factory::getApplication()->isClient('administrator'))
		{
			return;
		}

		if (in_array($this->app->input->getCmd('Itemid', ''), $this->params->get('excludes', [])))
		{
			return;
		}

		// Functional cookies are always allowed, load functionsl scripts
		$func_scripts_headtop = $this->params->get('func_scripts_headtop');
		$func_scripts_headbot = $this->params->get('func_scripts_headbot');
		$func_scripts_bodybot = $this->params->get('func_scripts_bodybot');
		$buffer               = Factory::getApplication()->getBody();
		if ($func_scripts_headtop)
		{
			$buffer = str_ireplace("<head>", "<head>\n" . $func_scripts_headtop . "\n", $buffer);
		}
		if ($func_scripts_headbot)
		{
			$buffer = str_ireplace("</head>", "\n" . $func_scripts_headbot . "\n</head>", $buffer);
		}
		if ($func_scripts_bodybot)
		{
			$buffer = str_ireplace("</body>", "\n" . $func_scripts_bodybot . "\n</body>", $buffer);
		}
		Factory::getApplication()->setBody($buffer);

		$session = Factory::getSession();
		if (isset($_COOKIE['destinycp']))
		{
			$dcpCookie = json_decode($_COOKIE['destinycp']);
			$session->set('destinycp_status', $dcpCookie);

			// If marketing cookies are allowed, load marketing scripts
			if ($dcpCookie->mar == 'yes')
			{
				$mark_scripts_headtop = $this->params->get('mark_scripts_headtop');
				$mark_scripts_headbot = $this->params->get('mark_scripts_headbot');
				$mark_scripts_bodybot = $this->params->get('mark_scripts_bodybot');
				$buffer               = Factory::getApplication()->getBody();
				if ($mark_scripts_headtop)
				{
					$buffer = str_ireplace("<head>", "<head>\n" . $mark_scripts_headtop . "\n", $buffer);
				}
				if ($mark_scripts_headbot)
				{
					$buffer = str_ireplace("</head>", "\n" . $mark_scripts_headbot . "\n</head>", $buffer);
				}
				if ($mark_scripts_bodybot)
				{
					$buffer = str_ireplace("</body>", "\n" . $mark_scripts_bodybot . "\n</body>", $buffer);
				}
				Factory::getApplication()->setBody($buffer);
			}

			// If analytics cookies are allowed, load analytical scripts
			if ($dcpCookie->ana == 'yes')
			{
				$ana_scripts_headtop = $this->params->get('ana_scripts_headtop');
				$ana_scripts_headbot = $this->params->get('ana_scripts_headbot');
				$ana_scripts_bodybot = $this->params->get('ana_scripts_bodybot');
				$buffer              = Factory::getApplication()->getBody();
				if ($ana_scripts_headtop)
				{
					$buffer = str_ireplace("<head>", "<head>\n" . $ana_scripts_headtop . "\n", $buffer);
				}
				if ($ana_scripts_headbot)
				{
					$buffer = str_ireplace("</head>", "\n" . $ana_scripts_headbot . "\n</head>", $buffer);
				}
				if ($ana_scripts_bodybot)
				{
					$buffer = str_ireplace("</body>", "\n" . $ana_scripts_bodybot . "\n</body>", $buffer);
				}
				Factory::getApplication()->setBody($buffer);
			}
		}
		else
		{
			$banner_text   = $this->params->get('banner_text');
			$button_oktext = $this->params->get('button_ok');
			$link_settings = $this->params->get('link_settings');
			$position      = $this->params->get('display_position');
			$popuptitle    = $this->params->get('popuptitle');
			$popupintro    = $this->params->get('popupintro');
			$popupfunc     = $this->params->get('popupfunc');
			$anachecked    = $this->params->get('anachecked');
			$popupana      = $this->params->get('popupana');
			$markchecked   = $this->params->get('markchecked');
			$popupmark     = $this->params->get('popupmark');
			$buttonsave    = $this->params->get('buttonsave');
			$buttonall     = $this->params->get('buttonall');

			// Load popup layout
			require_once JPATH_PLUGINS . '/system/destinycookieplugin/includes/cookiepopup.php';

			$html = str_replace('#active#', Text::_("DESTINY_COOKIE_PLUGIN_POPUP_ACTIVE"), $html);
			$html = str_replace('#notactive#', Text::_("DESTINY_COOKIE_PLUGIN_POPUP_NOT_ACTIVE"), $html);
			$html = str_replace('#position#', $position, $html);
			$html = str_replace('#bannertext#', nl2br($banner_text), $html);
			$html = str_replace('#buttonoktext#', $button_oktext, $html);
			$html = str_replace('#linksettings#', $link_settings, $html);
			$html = str_replace('#popuptitle#', $popuptitle, $html);
			$html = str_replace('#popupintro#', $popupintro, $html);
			$html = str_replace('#popupfunc#', $popupfunc, $html);
			if ($anachecked == 1)
			{
				$html = str_replace('id="analytics">', 'id="analytics" checked>', $html);
				$html = str_replace('#analyticsinitial#', Text::_("DESTINY_COOKIE_PLUGIN_POPUP_ACTIVE"), $html);
			}
			else
			{
				$html = str_replace('#analyticsinitial#', Text::_("DESTINY_COOKIE_PLUGIN_POPUP_NOT_ACTIVE"), $html);
			}
			$html = str_replace('#popupana#', $popupana, $html);
			if ($markchecked == 1)
			{
				$html = str_replace('id="marketing">', 'id="marketing" checked>', $html);
				$html = str_replace('#marketinginitial#', Text::_("DESTINY_COOKIE_PLUGIN_POPUP_ACTIVE"), $html);
			}
			else
			{
				$html = str_replace('#marketinginitial#', Text::_("DESTINY_COOKIE_PLUGIN_POPUP_NOT_ACTIVE"), $html);
			}
			$html = str_replace('#popupmark#', $popupmark, $html);
			$html = str_replace('#buttonsave#', $buttonsave, $html);
			$html = str_replace('#buttonall#', $buttonall, $html);
			$html = str_replace('#functional#', Text::_("DESTINY_COOKIE_PLUGIN_POPUP_FUNC_COOKIES"), $html);
			$html = str_replace('#alwaysactive#', Text::_("DESTINY_COOKIE_PLUGIN_POPUP_ALWAYS_ACTIVE"), $html);
			$html = str_replace('#analytical#', Text::_("DESTINY_COOKIE_PLUGIN_POPUP_ANA_COOKIES"), $html);
			$html = str_replace('#marketing#', Text::_("DESTINY_COOKIE_PLUGIN_POPUP_MARK_COOKIES"), $html);

			$buffer = Factory::getApplication()->getBody();
			$buffer = str_ireplace('</body>', $html . '</body>', $buffer);
			Factory::getApplication()->setBody($buffer);
		}
		return true;
	}
}
