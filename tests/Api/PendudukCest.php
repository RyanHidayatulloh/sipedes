<?php


namespace Api;

use \ApiTester;

class PendudukCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function getSemuaDataPenduduk(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('penduduk');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }
    
    public function getDataPendudukByUserId(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('penduduk', ['id_user' => 5]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['id_user' => 5]);
    }
}
