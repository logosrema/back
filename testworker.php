<?php 
// require_once 'GearmanWorker.php';
class Testworkers extends GearmanWorker {

  public static function getWorker(){

    return [
       ['sms_gameswon', function($workload){return GearmanWorker::ProccessGamesWon($workload);}],
       ['sms_withdrawal', function($workload){return GearmanWorker::ProccessWithdrawal($workload);}],
        // ['test2', function($workload){return GearmanWorker::ProccessEMAIL($workload);}],
    ];

  }


}
