<?php


namespace Tests\Acceptance\admin;

use Codeception\Attribute\Skip;
use Codeception\Util\Locator;
use Tests\Support\AcceptanceTester;

class ListUsersCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->click('Login');
        $I->seeCurrentURLEquals('/login');
        $I->fillField('username', 'user');
        $I->fillField('password', 'pass');
        $I->click('Login');
        $I->seeCurrentURLEquals('/dashboard');
        $I->click('List Users');
        $I->seeCurrentURLEquals('/list-users');
    }

    public function editUser(AcceptanceTester $I)
    {
        $I->seeLink('Edit','edit-user?id=3');
        $I->see('Edit', Locator::href('edit-user?id=3'));
        $I->click('Edit', '#3'); //Good if id exists
        $I->seeCurrentURLEquals('/edit-user?id=3');
        $I->click('💾 Save');
        $I->seeCurrentURLEquals('/list-users');


        //Works but not dynamic. Last number seems to be the row count, i.e. 7th row. 8th will fail if no 8th row
        //$I->click('(//a[contains(text(),"Edit")])[7]');

    }

/*    #[Skip()]
    public function deleteUser(AcceptanceTester $I)
    {
        $I->click('Delete', '#52');//Good if id exists
        $I->seeCurrentURLEquals('/list-users');
    }*/
}
