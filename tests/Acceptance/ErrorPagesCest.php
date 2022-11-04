<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class ErrorPagesCest
{
    // tests
    public function FourZeroFourError(AcceptanceTester $I)
    {
        $I->amOnPage('/NonExistPage');
        $I->seePageNotFound();
        $I->seeResponseCodeIs(404);
    }
}
