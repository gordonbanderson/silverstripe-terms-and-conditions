<?php

namespace Suilven\TermsAndConditions\Model;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Member;

class TOCSignature extends DataObject
{
    private static $table_name = 'TOCSignature';

    private static $summary_fields = [
      'Title',
      'Email',
      'Address',
      'Note',
      'Signature',
        'Member.Title',
        'TermsAndConditionsFile.URL'
    ];

    private static $db = [
        'Title' => 'Varchar(255)',

        // if the member is not available
        'Email' => 'Varchar(255)',

        // IP address
        'Address' => 'Varchar(255)',

        // for likes of 'event regirstation'
        'Note' => 'Varchar(255)',

        // the typed in signature
        'Signature' => 'Varchar(255)'
    ];

    private static $has_one = [
        'Member' => Member::class,
        'TermsAndConditionsFile' => File::class
    ];

    public static function getIPAddress()
    {
        // see https://stackoverflow.com/questions/15699101/get-the-client-ip-address-using-php
        return getenv('HTTP_CLIENT_IP')?:
            getenv('HTTP_X_FORWARDED_FOR')?:
                getenv('HTTP_X_FORWARDED')?:
                    getenv('HTTP_FORWARDED_FOR')?:
                        getenv('HTTP_FORWARDED')?:
                            getenv('REMOTE_ADDR');
    }
}
