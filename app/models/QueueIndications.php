<?php

class QueueIndications extends Eloquent
{

    public function fire($job, $data)
    {

        $logFile = 'laravel.log';

        Log::useDailyFiles(storage_path().'/logs/'.$logFile);

        Log::info('Log message', array('context' => $data));

        $job->delete();

    }


}