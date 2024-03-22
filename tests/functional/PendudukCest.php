<?php


namespace Functional;

use \FunctionalTester;

class PendudukCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function getPendudukDataByLogin(FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage('/api/penduduk');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'id_user' => 5
        ]);
    }
}
