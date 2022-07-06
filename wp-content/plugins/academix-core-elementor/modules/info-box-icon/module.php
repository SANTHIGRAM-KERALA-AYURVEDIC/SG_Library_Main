<?php
namespace AcademixCoreElementor\Modules\InfoBoxIcon;

use AcademixCoreElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'ace-info-box-icon';
    }

    public function get_widgets() {
        return [
            'InfoBoxIcon',
        ];
    }
}