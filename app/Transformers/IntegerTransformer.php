<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Integer;

class IntegerTransformer extends TransformerAbstract
{
    public function transform(Integer $integer)
    {
        return [
            'id' => $integer->id,
            'original_number' => $integer->original_number,
            'roman_number' => $integer->roman_number,
            'nr_frequency' => $integer->nr_frequency,
            'created' => $integer->created
        ];
    }

}
