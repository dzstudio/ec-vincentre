<?php
class SystemService {
  public static function loadSystemConfig() {
    $system = new SystemConfig();
    $items = $system->findAll();

    $configs = array();
    foreach ($items as $item) {
      $configs[$item->key] = $item->value;
    }

    return $configs;
  }

  public static function updateSystemConfig($key, $value) {
    $system = new SystemConfig();
    $config = $system->findByPk($key);

    if ($config) {
      $config->value = $value;
      $config->save();
    }

    return $config;
  }
}