<?php

namespace Suilven\TermsAndConditions\Model;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\ORM\DataObject;
use SilverStripe\Versioned\Versioned;

class TermsAndConditions extends DataObject
{
    private static $table_name = 'TermsAndConditions';

    private static $extensions = [
        Versioned::class . '.versioned',
    ];

    private static $db = [
        'Title' => 'Varchar(255)'
    ];

    private static $owns = [
        'TermsAndConditionsDocument'
    ];

    private static $has_one = [
        'TermsAndConditionsDocument' => File::class,
    ];

    public function getCMSFieldsNOT()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', UploadField::create('TermsAndConditionsDocument', 'Terms and Conditions'));
        return $fields;
    }
}
