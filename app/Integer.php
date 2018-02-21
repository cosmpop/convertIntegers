<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Integer extends Model
{
    /**
     * @var IntegerConversion $integerConversion
     */
    private $integerConversion;

    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->integerConversion = new IntegerConversion();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'original_number',
        'roman_number',
        'nr_frequency',
        'created'
    ];

    const LIMIT_VALUE = 3999;

    /**
     * save object to integers table
     * @param $number
     * @return Integer
     * @throws \Exception
     */
    public function insert($number)
    {
        $integer = $this->getFirstResultByNumber($number);

        if(!$integer) {
            $integer = new self();
            $integer->nr_frequency = 1;
        }
        else {
            $integer->nr_frequency = $integer->nr_frequency + 1;
        }

        $integer->original_number = $number;
        $integer->roman_number = $this->integerConversion->toRomanNumerals($number);
        $integer->created = time();
        $is_success = $integer->save();

        if(!$is_success)
            throw new \Exception('Invalid number');

        return $integer;
    }

    /**
     * get first integer row by numerical number
     * @param $number
     * @return mixed
     */
    public function getFirstResultByNumber($number)
    {
        return self::where('original_number', $number)->first();
    }
}
