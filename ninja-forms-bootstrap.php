<?php if ( ! defined( 'ABSPATH' ) ) exit;

/*
 * Plugin Name: Ninja Forms - Bootstrap
 * Plugin URI: https://ninjaforms.com/extensions/
 * Description: 
 * Version: 3.0.0
 * Author: The WP Ninjas
 * Author URI: http://ninjaforms.com
 * Text Domain: ninja-forms-bootstrap
 *
 * Copyright 2016 The WP Ninjas.
 */

if( version_compare( get_option( 'ninja_forms_version', '0.0.0' ), '3.0', '>' ) || get_option( 'ninja_forms_load_deprecated', FALSE ) ) {

    return;

} else {

    /**
     * Class NF_Bootstrap
     */
    final class NF_Bootstrap
    {
        const VERSION = '3.0.0';
        const SLUG    = 'bootstrap';
        const NAME    = 'Bootstrap';
        const AUTHOR  = 'WP Ninjas';
        const PREFIX  = 'NF_Bootstrap';

        /**
         * @var NF_Bootstrap
         * @since 3.0
         */
        private static $instance;

        /**
         * Plugin Directory
         *
         * @since 3.0
         * @var string $dir
         */
        public static $dir = '';

        /**
         * Plugin URL
         *
         * @since 3.0
         * @var string $url
         */
        public static $url = '';

        /**
         * NF_Bootstrap constructor.
         */
        public function __construct()
        {
        }

        /**
         * Main Plugin Instance
         *
         * Insures that only one instance of a plugin class exists in memory at any one
         * time. Also prevents needing to define globals all over the place.
         *
         * @since 3.0
         * @static
         * @static var array $instance
         * @return NF_Bootstrap Highlander Instance
         */
        public static function instance()
        {
            if (!isset(self::$instance) && !(self::$instance instanceof NF_Bootstrap)) {
                self::$instance = new NF_Bootstrap();
                self::$dir = plugin_dir_path(__FILE__);
                self::$url = plugin_dir_url(__FILE__);
                spl_autoload_register( array( self::$instance, 'autoloader' ) );
            }
            return self::$instance;
        }


        /**
         * Autoloader
         *
         * @param $class_name
         */
        public function autoloader( $class_name )
        {
            if( class_exists( $class_name ) ) return;

            if( false === strpos( $class_name, self::PREFIX ) ) return;

            $class_name = str_replace( self::PREFIX, '', $class_name );
            $classes_dir = realpath(plugin_dir_path(__FILE__)) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR;
            $class_file = str_replace('_', DIRECTORY_SEPARATOR, $class_name) . '.php';

            if (file_exists($classes_dir . $class_file)) {
                require_once $classes_dir . $class_file;
            }
        }
        
        /**
         * Template
         *
         * @param string $file_name
         * @param array $data
         */
        public static function template( $file_name = '', array $data = array() )
        {
            if( ! $file_name ) return;

            extract( $data );

            include self::$dir . 'includes/Templates/' . $file_name;
        }
        
        /**
         * Config
         *
         * @param $file_name
         * @return mixed
         */
        public static function config( $file_name )
        {
            return include self::$dir . 'includes/Config/' . $file_name . '.php';
        }

    }

    /**
     * The main function responsible for returning The Highlander Plugin
     * Instance to functions everywhere.
     *
     * Use this function like you would a global variable, except without needing
     * to declare the global.
     *
     * @since 3.0
     * @return NF_Bootstrap Highlander Instance
     */
    function NF_Bootstrap()
    {
        return NF_Bootstrap::instance();
    }

    NF_Bootstrap();
}
