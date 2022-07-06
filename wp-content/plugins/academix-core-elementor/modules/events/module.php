<?php
namespace AcademixCoreElementor\Modules\Events;

use AcademixCoreElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'ace-events';
    }

    public function get_widgets() {
        return [
            'Events',
        ];
    }
}