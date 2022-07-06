<?php
namespace AcademixCoreElementor\Modules\InfoBoxImage;

use AcademixCoreElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'ace-info-box-image';
    }

    public function get_widgets() {
        return [
            'InfoBoxImage',
        ];
    }
}