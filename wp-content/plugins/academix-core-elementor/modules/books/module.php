<?php
namespace AcademixCoreElementor\Modules\Books;

use AcademixCoreElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'ace-books';
    }

    public function get_widgets() {
        return [
            'Books',
        ];
    }
}