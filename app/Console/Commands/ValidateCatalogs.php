<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Validate Director Catalogs Artisan Command
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */

namespace App\Console\Commands;

use App\Catalogs;
use App\Statistics;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class ValidateCatalogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reporter:validate:catalogs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks the connections to director catalogs, updates catalog records and ending statistic';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $catalogs = Catalogs::all();
        
        if($catalogs){
            foreach ($catalogs as $catalog){

                $catalogName = $catalog->name;

                try {
                    DB::connection($catalogName)->getPdo();
                }catch(\PDOException $e) {
                    $error = $e->getMessage();
                    Log::error('Connection to '.$catalogName.' Failed. Error: '.$error);
                }

                if(isset($error)){
                    $catalog->status = Catalogs::FAILED;
                    try{
                        $catalog->save();
                    }catch (Exception $e){
                        $eMsg = $e->getMessage();
                        Log::error('Unable to update status on: '.$catalogName);
                    }
                }else{
                    $catalog->status = Catalogs::PASSED;
                    try{
                        $catalog->save();
                    }catch (Exception $e){
                        $eMsg = $e->getMessage();
                        Log::error('Unable to update status on: '.$catalogName);
                    }
                }
            }

            Statistics::updateInvalidCatalogCount();
        }else{
            Log::error('Validate Catalogs Artisan Command Failed');
        }
    }
}
