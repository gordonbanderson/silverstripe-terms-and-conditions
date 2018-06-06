<?php
/**
 * Created by PhpStorm.
 * User: gordon
 * Date: 5/6/2561
 * Time: 21:11 น.
 */

namespace Suilven\TermsAndConditions;
use SilverStripe\Admin\ModelAdmin;


class TermsAndConditionsModelAdmin extends ModelAdmin
{
    private static $managed_models = [
        'Suilven\TermsAndConditions\Model\TermsAndConditions'
    ];

    private static $url_segment = 't_and_c';

    private static $menu_title = 'Terms and Conditions';
}
