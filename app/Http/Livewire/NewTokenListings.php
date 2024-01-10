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
        $tokens = TokenModel::orderBy('created_at', 'desc')->take($this->numberOfLastTokens)->get();
        foreach($tokens as $token) {
            $diff = $token->created_at->diff(now());
            $formattedDiff = $diff->days . ' days ' . $diff->h . ' hours ' . $diff->i . ' minutes ' . $diff->s . ' seconds';
            $token->formattedDiff = $formattedDiff;
        }

        return $tokens;
    }

    public function render()
    {
        return view('livewire.components.new-token-listings', [
            'tokens' => $this->getLatestTokens($this->numberOfLastTokens),
        ]);
    }
}
