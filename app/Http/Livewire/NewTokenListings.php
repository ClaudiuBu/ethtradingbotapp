<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Token as TokenModel;

class NewTokenListings extends Component
{
    public $listing = '';
    public $numberOfLastTokens = 5;


    public function getLatestTokens()
    {
        return TokenModel::orderBy('created_at', 'desc')->take($this->numberOfLastTokens)->get();
    }

    public function render()
    {
        return view('livewire.components.new-token-listings', [
            'tokens' => $this->getLatestTokens($this->numberOfLastTokens),
        ]);
    }
}
