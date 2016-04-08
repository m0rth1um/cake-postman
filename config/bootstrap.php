<?php
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Utility\Hash;

// Load and merge default with app config
$config = include 'cake_postman.default.php';
$config = $config['CakePostman'];
if ($appCakePostmanConfig = Configure::read('CakePostman')) {
    $config = Hash::merge($config, $appCakePostmanConfig);
}
Configure::write('CakePostman', $config);
Plugin::load('FrontendBridge', ['bootstrap' => false, 'routes' => true, 'autoload' => true]);
