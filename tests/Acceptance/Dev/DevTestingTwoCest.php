<?php


namespace Tests\Acceptance;

use Codeception\Util\Locator;
use Codeception\Attribute\Skip;
use Tests\Support\AcceptanceTester;

class DevTestingTwoCest
{
    #[Skip('Method used for Dev Testing')]
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/about');
        $I->seeCurrentUrlEquals('/contact');



/*

I tried these. I could not catch the 302 redirect

$I->haveHttpHeader('redirect', '402');
$I->seeResponseCodeIs(400);
$I->seeResponseCodeIsRedirection();
$I->startFollowingRedirects();
$I->wait(3);
$I->followRedirect();
$I->haveHttpHeader('X-Requested-With', 'Codeception');




*/

    }
}
