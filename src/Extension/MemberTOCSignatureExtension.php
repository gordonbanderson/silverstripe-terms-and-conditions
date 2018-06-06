<?php

namespace Suilven\TermsAndConditions\Model;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Member;

class MemberTOCSignatureExtension extends DataExtension
{
    private static $has_many = [
        'Signatures' => TOCSignature::class
    ];

}
