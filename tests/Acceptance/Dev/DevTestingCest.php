<?php


namespace Tests\Acceptance;

use Codeception\Util\Locator;
use Codeception\Attribute\Skip;
use Tests\Support\AcceptanceTester;

class DevTestingCest
{
    #[Skip('Method used for Dev Testing')]
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/forgot');

/*        $I->seeElement('label', ['for' => 'inputResetPasswordEmail']);//Good
        $I->seeElement(Locator::find('label', ['for' => 'inputResetPasswordEmail']));//Good
        $I->seeElement(Locator::contains('label', 'Email'));// Good*/
        $I->seeElement('input', ['required' => '']);//Good. Works with just required*/
        //$I->seeElement('input', ['required' => 'required']);//Good. Works when required="required"


        $I->seeElement(Locator::contains('span', 'Password reset instructions will be sent to this email address'));//Good


    }
}
