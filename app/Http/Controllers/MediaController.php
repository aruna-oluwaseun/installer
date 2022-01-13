<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{

    /**
     * Uplaod media
     * @param Request $request
     */
    public function store(Request $request, $gallery_id)
    {
        info('the gallery id is ' . $gallery_id);

        $request->validate([
           'tmp'        => 'required',
           'filetype'   => 'required',
           'filename'   => 'required'
        ]);

        $key = $request->input('tmp');
        //$filename = $request->input('filename');
        $filename = explode('/',$key)[1];

        if($request->exists('filetype'))
        {
            if($ext = mime2ext($request->input('filetype')))
            {
                $filename .= '.'.$ext;
            }
        }
        $dir = 'companies/'.current_user_company_id().'/gallery/'.$gallery_id.'/';


        DB::beginTransaction();
        try {

            $gallery = Gallery::find($gallery_id);

            if(!$gallery)
            {
                Throw new \Exception('Could not find the gallery to associate with media');
            }

            if(!Storage::copy($key, $dir.$filename))
            {
                Throw new \Exception('Failed to upload media');
            }

            $media = $dir.$filename;

            if(!Storage::setVisibility($media,'public'))
            {
                Throw new \Exception('Failed to set visibility to public');
            }


           $media_item = [
               'company_id' => $gallery->company_id,
               'gallery_id' => $gallery_id,
               'file'       => $media,
               'created_at' => date('Y-m-d H:i:s'),
               'updated_at' => date('Y-m-d H:i:s'),
           ];

            if(!Media::create($media_item))
            {
                Throw new \Exception('Failed to save media to database, rolling back upload');
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'File Uploaded'
            ],200);


        } catch (\Throwable $e)
        {
            report($e);
            DB::rollBack();

            if(isset($media))
            {
                Storage::delete($media);
            }
        }

        return response()->json([
            'success' => false,
            'message' => isset($e) ? $e->getMessage() : 'Failed to upload media to gallery'
        ],200);

    }
}
