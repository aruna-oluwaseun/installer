<div>

    <h4 class="mb-4">Add Gallery
        <a id="add-gallery" href="#" class="button button-primary mt-3 mt-md-0  float-md-right">Create Gallery</a>
    </h4>

    {{ view('templates.alert') }}

    <div wire:loading.block>
        <div class="text-center pt-3 pb-3"><em class="fa fa-spinner fa-spin fa-3x"></em>
        </div>
    </div>

    <div wire:loading.remove>

        <div id="add-gallery-container" class="card card-bordered mb-3" style="display: none">
            <div class="card-header">
                <h5>New gallery</h5>
            </div>
            <div class="card-body">
                <form id="add-new-gallery" wire:submit.prevent="save">
                    <div class="form-group">
                        <label>Name of your gallery</label>
                        <input wire:model.defer="title" class="form-input" placeholder="Name of your gallery" required>
                    </div>

                    <div class="form-group mt-3">
                        <label>Gallery description</label>
                        <textarea wire:model.defer="description" class="form-input" placeholder="Add an optional description to your gallery"></textarea>
                    </div>

                    <div class="form-group mt-3">
                        <label>Gallery visibility</label><br>
                        <input type="radio" name="status" wire:model.defer="status" id="status-public" value="public"> Public (visible on profile) <br>
                        <input type="radio" name="status" wire:model.defer="status" id="status-private" value="private"> Private (visible to you only) <br>
                    </div>

                    <button type="submit" class="button button-primary mt-3" wire:loading.attr="disabled">Save</button>
                </form>
            </div>
        </div>

        <?php if(isset($gallery) && $gallery->count()) : ?>

            <?php foreach ($gallery as $gall) : ?>

                <div class="card card-bordered mb-3">
                    <div class="card-header">
                        <h6>{{ $gall->title }}</h6>
                    </div>
                    <div class="card-body">
                        <a data-gallery-id="{{ $gall->id }}" data-gallery-title="{{ $gall->title }}" href="#uploadMediaModal" data-toggle="modal" class="button button-primary mt-3 mt-md-0  float-md-right">Upload Photos</a>

                        <?php if($gall->status == 'public') : ?>
                            <h6 class="text-success">Gallery is public</h6>
                        <?php else : ?>
                            <h6 class="text-danger">Gallery is private</h6>
                        <?php endif; ?>
                        <p><strong>Description :</strong> {{ $gall->description }}</p>

                        <hr>

                        <?php if(isset($gall->media) && $gall->media->count()) : ?>

                            <div class="row">
                                <?php foreach ($gall->media as $image) : ?>
                                    <?php
                                        if(!\Illuminate\Support\Facades\Storage::exists($image->file))
                                        {
                                            continue;
                                        }

                                        if(\Illuminate\Support\Facades\Storage::exists($image->thumb))
                                        {
                                            $img = \Illuminate\Support\Facades\Storage::url($image->thumb);
                                        }
                                        else
                                        {
                                            $img = \Illuminate\Support\Facades\Storage::url($image->file);
                                        }
                                        $url = \Illuminate\Support\Facades\Storage::url($image->file);
                                    ?>
                                    {{--<div class="col-sm-6 col-md-4 col-lg-3">
                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($image->file) }}">
                                    </div>--}}
                                    <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                                    <div class="card card-bordered card-gallery">
                                        <div class="image">
                                            <img width="200" src="{{ $img }}" class="card-img-top" alt="">
                                        </div>
                                        <hr>
                                        <div class="card-body" style="padding: 1em">
                                            {{--<h5 class="card-title">Card title</h5>
                                            <p class="card-text"></p>--}}
                                            <a data-fancybox="gallery-{{ $image->gallery_id }}" href="{{ $url }}" class="btn btn-primary btn-sm mb-2">View</a>
                                            <a href="#" data-image-id="{{ $image->id }}" class="btn btn-outline-danger delete-image btn-sm mb-2">Delete</a>
                                        </div>
                                    </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                        <?php else : ?>

                        <div class="alert alert-warning mt-3">No photos in this gallery, upload some.</div>

                        <?php endif ?>
                    </div>
                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="alert alert-warning mt-4">No galleries found, you can create a new one above</div>

        <?php endif;?>

    </div>

    {{--<div class="modal fade" id="newGalleryModal" role="dialog">
        <div class="modal-dialog modal-dialog_custom">
            <!-- Modal content-->
            <div class="modal-dialog__inner" style="padding-top: 20px;">
                <button class="close" type="button" data-dismiss="modal"></button>
                <div class="modal-dialog__content">
                    <h5>New gallery</h5>
                    <hr>

                    <form class="rd-mailform_responsive" wire:submit.prevent="save">
                        <div class="form-group mt-4">
                            <label>Name of your gallery</label>
                            <input wire:model.defer="title" class="form-input" placeholder="Name of your gallery">
                        </div>

                        <div class="form-group mt-4">
                            <label>Gallery description</label>
                            <textarea wire:model.defer="description" class="form-input" placeholder="Add an optional description to your gallery"></textarea>
                        </div>

                        <button type="submit" class="button button-primary mt-3" wire:loading.attr="disabled">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>--}}

</div>
@push('scripts')
    <script type="text/javascript">

        $('#add-gallery').on('click', function(e) {
            e.preventDefault();

            $('#add-gallery-container').toggle();
        })

        $(document).on('click','.delete-image', function(event) {
            event.preventDefault();
            var image_id = $(this).data('image-id');

            Swal.fire({
                title: 'Are you sure you want remove this item?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it!'

            }).then(function (action) {
                if( action.isConfirmed ) {
                    // send via ajax
                    Livewire.emit('deleteImage',image_id);
                }

            })
        });


    </script>
@endpush
