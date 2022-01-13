<div>

    <div wire:loading.block>
        <div class="text-center pt-3 pb-3"><em class="fa fa-spinner fa-spin fa-3x"></em>
        </div>
    </div>

    <div wire:loading.remove>

        <h5>Contest review</h5>
        <hr>

        {{ view('templates.alert') }}

        <!-- RD Mailform-->
        <?php if(isset($review->status) && $review->status == 'contested') : ?>

            <div class="alert alert-warning">You have already contested this review.</div>

        <?php else : ?>
        <form class="rd-mailform_responsive" wire:submit.prevent="save">
            @method('PUT')

            <div class="alert alert-info mt-4">Please enter why you are contesting this review, we will then reach out to reviewer to resolve this query.</div>

            <div class="form-group mt-4">
                <label>Why are you contesting this review?</label>
                <textarea wire:model.defer="review.contest_reason" class="form-input" placeholder=""></textarea>
            </div>

            <button class="button button-primary mt-3" type="submit" wire:loading.attr="disabled">Save</button>
        </form>
        <?php endif; ?>
    </div>

</div>
