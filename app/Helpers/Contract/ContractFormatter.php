<?php

namespace App\Helpers\Contract;

class ContractFormatter
{
    public function formatDisplayContract(string $contract): string
    {
        $arr = explode(' ', $contract);
        foreach ($arr as $key => &$value) {
            $value = str_replace('\r\n', " \r\n ", $value);
            $value = str_replace('\n', " \n ", $value);
            //before keywords like function and if add span
            $this->formatKeywords($value);

        }
        return $contract =  implode(' ', $arr);
    }


    public function formatKeywords(&$value)
    {
        switch($value) {
            case 'function':
                $value = '<span  style="color:#a8323a;font-weight:bold;">' . $value . '</span>';
                break;
            case 'if':
                $value = '<span  style="color:#a8323a;font-weight:bold;">' . $value . '</span>';
                break;
            case 'else':
                $value = '<span  style="color:#a8323a;font-weight:bold;">' . $value . '</span>';
                break;
            case 'return':
        }
    }
}
