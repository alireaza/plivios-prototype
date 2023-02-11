<?php

namespace App\Handlers;

use GuzzleHttp\Client;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class DownloadHandler
{
    public function handle(string $uri): array
    {
        $client = new Client(['verify' => false]);

        $temp_directory = sys_get_temp_dir();
        $temp_file = tempnam($temp_directory, 'tmp');

        $response = $client->request('GET', $uri, [
            'sink' => $temp_file,
            'http_errors' => false,
        ]);

        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            $storage = Storage::disk('downloads');

            $file = new File($temp_file);
            $hash_file = hash_file('sha256', $file);

            if ($storage->fileMissing($hash_file)) {
                $storage->putFileAs(DIRECTORY_SEPARATOR, $file, $hash_file);
            }

            $contents = $hash_file;
        } else {
            $contents = $response->getBody()->getContents();
        }

        unlink($temp_file);

        return [
            'method' => 'GET',
            'uri' => $uri,
            'payload' => [], // TODO: add more details
            'status_code' => $response->getStatusCode(),
            'status_text' => $response->getReasonPhrase(),
            'contents' => $contents
        ];
    }
}
