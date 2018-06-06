<?php

namespace Suilven\TermsAndConditions\Model;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Member;

class TOCSignature extends DataObject
{
    private static $table_name = 'TOCSignature';

    private static $db = [
        'Title' => 'Varchar(255)'
    ];

    private static $has_one = [
        'Member' => Member::class,
        'TermsAndConditionsFile' => File::class
    ];
}
