<?php
namespace AcademixCoreElementor\Modules\LatestEvent;

use AcademixCoreElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'ace-latest-event';
    }

    public function get_widgets() {
        return [
            'LatestEvent',
        ];
    }
}