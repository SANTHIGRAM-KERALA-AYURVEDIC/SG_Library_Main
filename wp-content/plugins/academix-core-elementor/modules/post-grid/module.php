<?php
namespace AcademixCoreElementor\Modules\PostGrid;

use AcademixCoreElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'ace-post-grid';
    }

    public function get_widgets() {
        return [
            'PostGrid',
        ];
    }
}