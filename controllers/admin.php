<?php

/**
 * This software is intended for use with Oxwall Free Community Software http://www.oxwall.org/ and is a proprietary licensed product. 
 * For more information see License.txt in the plugin folder.

 * ---
 * Copyright (c) 2018, Ebenezer Obasi
 * All rights reserved.
 * info@eobasi.com.

 * Redistribution and use in source and binary forms, with or without modification, are not permitted provided.

 * This plugin should be bought from the developer. For details contact info@eobasi.com.

 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES,
 * INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
 * PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

class INDEXLOGIN_CTRL_Admin extends ADMIN_CTRL_Abstract
{
	const SPOTLIGHT = 'http://spotlight.ewtnet.us/';
	
	public function __construct()
	{
		parent::__construct();

		if (OW::getRequest()->isAjax()) {
			return;
		}

		$lang = OW::getLanguage();

		$menu = new BASE_CMP_ContentMenu();

		$menuItem = new BASE_MenuItem();
		$menuItem->setKey('settings');
		$menuItem->setLabel($lang->text('indexlogin', 'indexlogin_admin_settings'));
		$menuItem->setUrl(OW::getRouter()->urlForRoute('indexlogin_admin_settings'));
		$menuItem->setIconClass('ow_ic_gear_wheel');
		$menuItem->setOrder(1);
		$menu->addElement($menuItem);

		$menuItem = new BASE_MenuItem();
		$menuItem->setKey('spotlight');
		$menuItem->setLabel($lang->text('indexlogin', 'indexlogin_admin_donate'));
		$menuItem->setUrl(OW::getRouter()->urlForRoute('indexlogin_admin_spotlight'));
		$menuItem->setIconClass('ow_ic_star');
		$menuItem->setOrder(2);
		$menu->addElement($menuItem);

		$this->addComponent('menu', $menu);
		$this->menu = $menu;
		
	}

    public function settings()
    {
        $this->setPageHeading(OW::getLanguage()->text('indexlogin', 'admin_settings_heading'));
        $this->setPageHeadingIconClass('ow_ic_gear_wheel');
		
		$this->assign('txt', OW::getLanguage()->text('indexlogin', 'indexlogin_setting_msg'));
		
		$video = '<center><iframe width="600" height="400" src="https://www.youtube.com/embed/_w63UlfBIY8" frameborder="0" allowfullscreen></iframe></center>';
		$this->assign('video', $video);
		
		$this->assign('lnik', OW::getRouter()->urlForRoute('admin_pages_main'));
    }
	
	public function spotlight()
    {
		
		$config = OW::getConfig();
		$lang = OW::getLanguage();
		
		$this->setPageTitle($lang->text('indexlogin', 'spotlight_title'));
		$this->setPageHeading($lang->text('indexlogin', 'admin_donate_heading'));
        $this->setPageHeadingIconClass('ow_ic_gear_wheel');
		
		$soft = $config->getValue('base', 'soft_version');
        $build = $config->getValue('base', 'soft_build');
        $theme = $config->getValue('base', 'selectedTheme');
		$siteName = $config->getValue('base', 'site_name');
		$siteEmail = $config->getValue('base', 'site_email');
		$url = OW::getRouter()->getBaseUrl();
		
		$uri = OW::getRequest()->buildUrlQueryString(self::SPOTLIGHT, array(
			'u'=> $url,
			's'=> base64_encode($soft),
			'b'=> base64_encode($build),
			'n'=> base64_encode($siteName),
			't'=> base64_encode($theme),
			'e'=> base64_encode($siteEmail)
		));
		
		$this->assign('url', $uri);
		
	}
}