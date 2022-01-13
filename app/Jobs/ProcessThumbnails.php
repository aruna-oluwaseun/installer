<?php

namespace App\Jobs;

use App\Models\Media;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProcessThumbnails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function retryUntil()
    {
        return now()->addMinutes(10);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        try {

            $images = Media::whereNull('thumb')->whereNull('thumb_attempted')->limit(10)->get();

            if( $images && $images->count() ) {

                foreach ($images as $image)
                {
                    if(Storage::exists($image->file))
                    {
                        $image->thumb_attempted = date('Y-m-d H:i:s');
                        $image->save();

                        $path = basename(Storage::path($image->file));
                        $filename = 'companies/'.$image->company_id.'/gallery/'.$image->gallery_id.'/thumb_'.$path;

                        $img = Image::make(Storage::url($image->file));

                        $img->resize(200, null, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        });

                        if(! Storage::put($filename, $img->stream()) )
                        {
                            Throw new \Exception('Failed to stream newly created thumbnail');
                        }

                        if(! Storage::setVisibility($filename,'public') )
                        {
                            Throw new \Exception('Failed set the visibility to public');
                        }

                        $image->thumb = $filename;

                        if(! $image->save() )
                        {
                            Throw new \Exception('Failed to save thumbnail to database');
                        }


                    }
                }
            }

        } catch (\Throwable $exception) {
            Bugsnag::notifyException($exception);

        }

    }
}
