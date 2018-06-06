<?php

namespace Suilven\TermsAndConditions\Extension;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Member;
use SilverStripe\View\Requirements;
use Suilven\TermsAndConditions\Model\TermsAndConditions;

class FormTOCProtectionExtension extends Extension
{

    /**
     * @param array $options associative array, MUST contain Title in order to map to the PDF document.   A user error will
     * be thrown if the referenced TOC cannot be found
     */
    public function enableTermsAndConditionsProtection($options = array())
    {
        Requirements::javascript('suilven/silverstripe-terms-and-conditions:/javascript/thirdparty/pdf.js');
        Requirements::javascript('suilven/silverstripe-terms-and-conditions:/javascript/toc.js');

        if (empty($options['Title'])) {
            user_error('A terms and conditions document must be referenced an option of name "Title"');
        }

        // now that we have a title, try and find the terms and conditions document
        $toc = TermsAndConditions::get()->filter(['Title' => $options['Title']])->first();
        if (empty($toc)) {
            user_error("A terms and condition  document could not be found for the name \'{$options['title']}\'");
        }

        // @todo Enforce PDF
        $pdfURL = $toc->TermsAndConditionsDocument()->URL;

        $html = '<div class="pdflink">View Terms and Conditions</div>';
        $field = CompositeField::create(
            CheckboxSetField::create('ReadTOC', 'Select Option', [
                'qux' => 'Search Qux'
            ]),

            CheckboxSetField::create('Category', 'Category', [
                'Foo' => 'Foo',
                'Bar' => 'Bar'
            ]),

            LiteralField::create('PDFCanvas', 'PDF HERE? ==> <canvas id="toc-pdf" data-url="' . $pdfURL . '"></canvas>'),

            TextField::create('Signature', 'Signature')//('Please type your name here')
        );

        // Add before field specified by insertBefore
        $inserted = false;
        if (!empty($options['insertBefore'])) {
            $inserted = $this->owner->Fields()->insertBefore($field, $options['insertBefore']);
        }
        if (!$inserted) {
            // Add field to end if not added already
            $this->owner->Fields()->push($field);
        }
    }

}
