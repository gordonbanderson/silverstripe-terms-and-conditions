<?php

namespace Suilven\TermsAndConditions\Model;

use SilverStripe\AssetAdmin\Forms\HistoryListField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\TextField;
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

    public function getCMSFields()
    {
        $fields = new FieldList();
        $fields->add( new TextField('Title'), 'Content');

        /** @var UploadField $uploadField */
        $uploadField = UploadField::create('TermsAndConditionsDocument');
        $uploadField->setFolderName('terms-and-conditions');
        $uploadField->setAllowedExtensions(['pdf']);
        $fields->add( $uploadField);

        // this does not work
        /*
        $historyField = HistoryListField::create('HistoryList')
            ->setRecord($this);
        $fields->add($historyField);
        */

        return $fields;
    }

}
