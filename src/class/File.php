<?php

namespace Blocks\Config;

class File {
    private static $data = [];

    private const DIR_CONFIG = DIR_PATH . '/config';

    private static function load(string $module): void {
        if ( !isset(self::$data[$module]) ) {
            $module_config_file = self::DIR_CONFIG . "/$module.php";

            if (file_exists($module_config_file) && is_readable($module_config_file)) {
                self::$data[$module] = include $module_config_file;
            } else {
                trigger_error("Cannot open request module config file: '$module_config_file'", E_USER_ERROR);
            }
        }
    }

    public static function get(string $module, string $key): string|null {
        self::load($module);

        if ( isset( self::$data[$module][$key] ) ) {
            return self::$data[$module][$key];
        } else {
            return null;
        }
    }

}
