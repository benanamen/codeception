<?php


namespace Tests\Acceptance;

use Codeception\Util\Locator;
use Tests\Support\AcceptanceTester;

class DevTestingCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/forgot');

/*       $I->seeElement('label', ['for' => 'inputResetPasswordEmail']);//Good
        $I->seeElement(Locator::find('label', ['for' => 'inputResetPasswordEmail']));//Good
        $I->seeElement(Locator::contains('label', 'Email'));//Good*/

        //$I->seeElement('input', ['required' => 'required']);//Good when required="required"

        //$I->seeElement(Locator::contains('input', 'required'));//Not good
        $I->seeElement('input', ['required']);




    }
}
