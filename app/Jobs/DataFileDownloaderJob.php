<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

define(
    'FILE_URL',
    'https://github.com/intoli/user-agents/raw/master/src/user-agents.json.gz'
);
define('COMPRESSED_FILE_NAME', 'intoli_src_file.gz');

class DataFileDownloaderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public int $timeout = 240;
    /**
     * @return void
     * @throws GuzzleException
     */
    public function handle(): void
    {
        //request and download the file .
        $client = new Client();
        $request = $client->request(
            'GET',
            FILE_URL,
            [
                'headers' => ['Accept-Encoding' => 'gzip'],
                'decode_content' => true
            ]
        );

        // save the downloaded file to its path .
        $stream = $request->getBody();
        $file = Storage::disk('src')->put(COMPRESSED_FILE_NAME, $stream);

        $compressedFilePath = base_path() . "/storage/app/src/" . COMPRESSED_FILE_NAME;

        $bufferSize = 4096; // read 4kb at a time
        $outFileName = str_replace('.gz', '.json', $compressedFilePath);
        // extract main file .
        $compressedFile = gzopen($compressedFilePath, 'rb');
        $outFile = fopen($outFileName, 'wb');

        while (!gzeof($compressedFile)) {
            fwrite($outFile, gzread($compressedFile, $bufferSize));
        }

        fclose($outFile);
        gzclose($compressedFile);

    }
}
