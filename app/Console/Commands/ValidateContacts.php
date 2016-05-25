<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Validate Contact Emails Artisan Command
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */

namespace App\Console\Commands;

use App\Contacts;
use App\Helper;
use App\Statistics;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class ValidateContacts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reporter:validate:mx';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cycles through contacts checking if MX Records exist';

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
        $contacts = Contacts::all();

        if($contacts) {
            foreach ($contacts as $contact) {

                $contactEmail = $contact->email;
                $contactValid = $contact->valid;

                $validate = Helper::mxRecordValidation($contactEmail);

                if($validate === false) {
                    try{
                        $contact->valid = Contacts::INVALID;
                        $contact->save();
                        Log::info('Invalid Email for Contact: '.$contact->name);
                    }catch (Exception $e){
                        Log::info('Unable to save contact. Invalid Email for Contact: '.$contact->name);
                    }
                }elseif($validate === true) {

                    if($contactValid == Contacts::INVALID){
                        try{
                            $contact->valid = Contacts::VALID;
                            $contact->save();
                        }catch (Exception $e){
                            Log::info('Unable to save contact: '.$contact->name);
                        }
                    }else{
                        try{
                            $contact->valid = Contacts::VALID;
                            $contact->save();
                        }catch (Exception $e){
                            Log::info('Unable to save contact: '.$contact->name);
                        }
                    }
                }
            }

            Statistics::updateInvalidContactCount();
        }else{
            Log::error('Validate Contacts Artisan Command Failed');
        }
    }
}
