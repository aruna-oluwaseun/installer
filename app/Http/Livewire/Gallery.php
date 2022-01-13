<?php

namespace App\Http\Livewire;

use App\Models\Media;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Gallery as GalleryModel;

class Gallery extends Component
{
    // Gallery model
    public $gallery;
    public $company_id;

    // New gallery
    public $title = null;
    public $description = null;
    public $status = null;

    protected $rules = [
        'title' => 'required',
        'description' => 'nullable',
        'status' => 'nullable',
    ];

    protected $listeners = ['refreshGallery','deleteImage'];

    public function refreshGallery()
    {
        info('live refreshed');
        return $this->loadGallery();
    }

    public function mount($company_id)
    {
        $this->company_id = $company_id;
        $this->loadGallery();
    }

    public function loadGallery()
    {
        $this->gallery = GalleryModel::with(['media'])->where('company_id', $this->company_id)->get();
    }

    public function render()
    {
        return view('livewire.gallery');
    }

    public function save()
    {
        $validated = $this->validate();

        //dump($validated);
        DB::beginTransaction();
        try {

            if($validated['status'] === null)
            {
                $validated['status'] = 'public';
            }

            $validated['company_id'] = $this->company_id;
            if(!GalleryModel::create($validated))
            {
                Throw new \Exception('Failed to create gallery');
            }

            DB::commit();

            session()->flash('success', $this->title.' has been added.');

            return $this->loadGallery();

        } catch (\Throwable $exception) {
            DB::rollBack();
            report($exception);
        }

        return session()->flash('error', 'Failed to create gallery');
    }

    public function deleteImage($image_id)
    {
        $image = Media::find($image_id);

        if(!$image) {
            session()->flash('error', 'Image not found for deletion.');
            return $this->loadGallery();
        }

        try {
            if(!Storage::exists($image->file))
            {
                Throw new \Exception('No image found in storage');
            }

            if(!Storage::delete($image->file))
            {
                Throw new \Exception('Failed to remove image from storage');
            }

            if(! Media::destroy($image_id))
            {
                Throw new \Exception('Failed to update the database');
            }

            $this->loadGallery();
            return session()->flash('success', 'Image removed from gallery');

        } catch (\Throwable $exception) {
            report($exception);
        }

        return session()->flash('error', 'Failed to remove photo from Gallery');
    }

}
