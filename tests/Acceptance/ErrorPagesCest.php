<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class ErrorPagesCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/NonExistPage');
        $I->seePageNotFound();
        $I->seeResponseCodeIs(404);
    }
}
