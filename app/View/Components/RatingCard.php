<?php

namespace App\View\Components;

use App\Models\Scout;
use Carbon\Carbon;
use Illuminate\View\Component;

class RatingCard extends Component
{
    public $rating;
    public $scout;
    public $humanDate;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($rating)
    {
        $this->rating = $rating;
        $this->scout = Scout::where('id', $rating->scout_id)->first();
        $this->humanDate = Carbon::parse($this->rating->date)->format('h:i:s d/m/Y');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.rating-card');
    }
}
