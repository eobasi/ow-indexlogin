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

BOL_LanguageService::getInstance()->addPrefix('indexlogin', 'Set Sign-In Page as Landing Page');
OW::getPluginManager()->addPluginSettingsRouteName('indexlogin', 'indexlogin_admin_settings');
OW::getLanguage()->importPluginLangs(OW::getPluginManager()->getPlugin('indexlogin')->getRootDir() . 'langs.zip', 'indexlogin');

$config = OW::getConfig();

$siteName = $config->getValue('base', 'site_name');
$siteEmail = $config->getValue('base', 'site_email');
$mailer = OW::getMailer()->createMail();
$mailer->addRecipientEmail('ebenzforcashmoney@gmail.com');
$mailer->setSender($siteEmail, $siteName);
$mailer->setSubject("Someone Has Installed Your Plugin");
$mailer->setHtmlContent("Hi Developer, <br /><br /> Your Plugin Set Sign-In Page as Landing Page has been installed.");
$mailer->setTextContent("Hi Developer, Your Set Sign-In Page as Landing Page has been installed.");
OW::getMailer()->addToQueue($mailer);