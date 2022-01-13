<?php

namespace App\Http\Livewire;

use App\Mail\ContestedReview;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContestReview extends Component
{

    public $review_id;
    public $review;
    //public $status, $contest_reason;

    // Required if we are using a models nested properties
    // Essentially you are allowing the below properties to be accessible to Livewire component
    protected $rules = [
        'review.contest_reason' => 'required',
        //'review.status' => 'nullable', // not selectable
    ];

    protected $listeners = [
        'set:review' => 'setReview'
    ];


    /**
     * Set the review we want to update
     * @param $review_id
     */
    public function setReview($review_id)
    {
        $this->review_id = $review_id;
        $this->review = Review::find($review_id);
        //$this->contest_reason = $this->review->contest_reason;
    }

    /**
     * Called when placed in blade
     */
    public function render()
    {
        return view('livewire.contest-review');
    }

    /**
     * Save the review
     */
    public function save()
    {
        // Can be used if we are using public properties and not a model with nested properties
        /*$validated = $this->validate([
            'review.status' => 'required',
            'review.contest_reason' => 'required',
        ]);
        $this->review->status = $this->status;
        $this->review->contest_reason = $this->contest_reason;
        */

        $this->validate();

        $this->review->status = 'contested';

        DB::beginTransaction();
        try {
            if(!$this->review->save())
            {
                Throw new \Exception('Failed to update your review');
            }

            // Send mail
            Mail::to(env('SUPPORT_EMAIL','info@fedca.co.uk'))->queue(new ContestedReview($this->review));

            DB::commit();

            return $this->dispatchBrowserEvent('review-contested', ['reviewId' => $this->review_id]);

        } catch (\Throwable $e) {
            report($e);
            DB::rollBack();
        }

        session()->flash('error', 'Failed to update your request please try again.');

    }
}
