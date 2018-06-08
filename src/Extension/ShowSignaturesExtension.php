<?php

namespace Suilven\TermsAndConditions\Extension;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Member;
use SilverStripe\View\Requirements;
use Suilven\TermsAndConditions\Model\TermsAndConditions;
use Suilven\TermsAndConditions\Model\TOCSignature;

class ShowSignaturesExtension extends DataExtension
{
    private static $has_many = [
        'Signatures' => TOCSignature::class
    ];

    /**
     * Add a tab of readonly signatures
     *
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {

        $signatures = $this->owner->Signatures();

        error_log('SIGNATURES: ' . $signatures->Count());

        $fields->addFieldToTab('Root.Signatures',
            new GridField('Signatures', 'Signatures', $signatures)
        );
    }
}
