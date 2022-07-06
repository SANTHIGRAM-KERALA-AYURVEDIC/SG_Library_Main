<?php
namespace AcademixCoreElementor\Modules\ProfileCard;

use AcademixCoreElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'ace-profile-card';
    }

    public function get_widgets() {
        return [
            'ProfileCard',
        ];
    }
}