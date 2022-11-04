<?php


namespace Tests\Acceptance\admin;

use Codeception\Util\Locator;
use Tests\Support\AcceptanceTester;

class SettingsCest
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

    public function settings(AcceptanceTester $I)
    {
        $I->expect('to see "Settings" in the Admin Dropdown');
        $I->see('Settings', Locator::href('/settings'));

        $I->amGoingTo('click "Settings" in the Admin Dropdown');
        $I->click('Settings');

        $I->expect('to go to the "Settings" page');
        $I->seeCurrentUrlEquals('/settings');
    }
}
