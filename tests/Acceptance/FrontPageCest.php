<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class FrontPageCest
{
    public function frontpage(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Login');
        $I->see('Forgot Password');
        $I->see('Register');
        $I->see('User API');
        $I->see('About');
        $I->see('Contact');
    }
}
