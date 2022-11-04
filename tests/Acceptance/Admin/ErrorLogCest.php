<?php


namespace Tests\Acceptance\admin;

use Codeception\Util\Locator;
use Tests\Support\AcceptanceTester;

class ErrorLogCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/login');
        $I->amGoingTo('submit login form with a correct username & password field');
        $I->submitForm('#login', [
            'username' => 'user',
            'password' => 'pass',
        ]);

        /*
         * Dashboard
         * */
        $I->amOnPage('/dashboard');

        $I->expect('to see the text "The Dashboard"');
        $I->see('The Dashboard');
    }

    public function errorLog(AcceptanceTester $I)
    {
        $I->expect('to see "Error Log" in the Admin Dropdown');
        $I->see('Error Log', Locator::href('/errors'));

        $I->amGoingTo('click "Error Log" in the Admin Dropdown');
        $I->click('Error Log');

        $I->expect('to go to the "Error Log" page');
        $I->seeCurrentUrlEquals('/errors');
    }
}
