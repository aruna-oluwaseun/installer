<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Vapor\Http\Controllers\SignedStorageUrlController;

class GuestSignedStorageController extends SignedStorageUrlController
{
    /**
     * Create a new signed URL.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ensureEnvironmentVariablesAreAvailable($request);

        /*Gate::authorize('uploadFiles', [
            $request->user(),
            $bucket = $request->input('bucket') ?: $_ENV['AWS_BUCKET'],
        ]);*/
        $bucket = $request->input('bucket') ?: $_ENV['AWS_BUCKET'];

        $client = $this->storageClient();

        $uuid = (string) Str::uuid();

        $signedRequest = $client->createPresignedRequest(
            $this->createCommand($request, $client, $bucket, $key = ('tmp/'.$uuid)),
            '+5 minutes'
        );

        $uri = $signedRequest->getUri();

        return response()->json([
            'uuid' => $uuid,
            'bucket' => $bucket,
            'key' => $key,
            'url' => 'https://'.$uri->getHost().$uri->getPath().'?'.$uri->getQuery(),
            'headers' => $this->headers($request, $signedRequest),
        ], 201);
    }

}
