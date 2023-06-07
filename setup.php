<?php

define('PLUGIN_CUSTOM_LOGIN_VERSION', '1.0.4');

$folder = basename(dirname(__FILE__));

if ($folder !== "customlogin") {
   $msg = sprintf("Por favor, renomeie a pasta dso plugin de \"%s\" para \"customlogin\"", $folder);
   Session::addMessageAfterRedirect($msg, true, ERROR);
}

function plugin_init_customlogin() {
   global $PLUGIN_HOOKS;

   $PLUGIN_HOOKS['csrf_compliant']['customlogin'] = true;

   $plugin = new Plugin();

   if ($plugin->isActivated("customlogin")) {
      $PLUGIN_HOOKS['display_login']['customlogin'] = "plugin_customlogin_display_login";
      $PLUGIN_HOOKS['config_page']['customlogin'] = 'front/config.form.php';

      Plugin::registerClass(
         'PluginCustomloginConfig', [
            'addtabon' => [
               'Config'
            ]
         ]
      );
   }
}

function plugin_version_customlogin() {
   return [
      'name'           => 'Custom Login',
      'version'        =>  PLUGIN_CUSTOM_LOGIN_VERSION,
      'author'         => 'Dirus Informática <a href="http://www.dirus.com.br/"></a>',
      'license'        => 'GLPv3',
      'homepage'       => 'http://www.dirus.com.br/',
      'requirements'   => [
        'glpi'   => [
           'min' => '9.5.11',
        ],
        'php'    => [
           'min' => '7.0'
        ]
     ]
   ];
}

function plugin_customlogin_check_prerequisites() {
   return true;
}

function plugin_customlogin_check_config($verbose = false) {
   return true;
}

function plugin_customlogin_options() {
   return [
      Plugin::OPTION_AUTOINSTALL_DISABLED => true,
   ];
}