<?php
namespace AcademixCoreElementor\Modules\TeamMembers;

use AcademixCoreElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'ace-team-members';
    }

    public function get_widgets() {
        return [
            'TeamMembers',
        ];
    }
}