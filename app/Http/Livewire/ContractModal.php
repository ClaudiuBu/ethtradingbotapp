<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContractModal extends Component
{
    public $open = false;

    private $contract;

    public function formatContract(string $contract): string
    {
        $arr = explode(' ', $contract);
        foreach ($arr as $key => &$value) {
            $value = str_replace('\r\n', " \r\n ", $value);
            $value = str_replace('\n', " \n ", $value);
            //before keywords like function and if add span
            if(in_array($value, ['function','if','else'])) {
                $value = '<span  style="color:#a8323a;font-weight:bold;">' . $value . '</span>';
            }

        }

        return $contract =  implode(' ', $arr);
    }

    public function render()
    {
        $viewData = [];

        if ($this->open) {
            $viewData['contract'] = $this->contract;
        }

        //remove quotes end and start
        //$contract = substr($this->contract, 1, -1);
        //html string
        //$contract = htmlspecialchars($contract);
        // die;
        return view('livewire.components.modals.contract-modal', [
            // 'contract' => $contract,
        ]);
    }
}
