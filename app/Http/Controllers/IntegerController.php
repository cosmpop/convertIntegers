<?php

namespace App\Http\Controllers;

use App\Integer;
use App\Transformers\IntegerTransformer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class IntegerController extends Controller
{
    /**
     * @var Manager $fractal
     */
    private $fractal;

    /**
     * @var IntegerTransformer $integerTransformer
     */
    private $integerTransformer;

    /**
     * @var Integer $integer
     */
    private $integer;

    public function __construct
    (
        Manager $fractal,
        IntegerTransformer $integerTransformer,
        Integer $integer
    )
    {
        $this->fractal = $fractal;
        $this->integerTransformer = $integerTransformer;
        $this->integer = $integer;
    }

    /**
     * Display a listing of all integers sort by created date desc
     *
     * @return array
     */
    public function list()
    {
        $integers = Integer::orderBy('created', 'desc')->get();

        return $this->setData($integers);
    }

    /**
     * create a new record in db.
     * @param $request
     * @return array
     */
    public function create(Request $request)
    {
        $number = (int) $request->request->get('number');

        if(!$number || $number > Integer::LIMIT_VALUE)
            return response()->json('Invalid number', Response::HTTP_BAD_REQUEST);

        try {
           $model = $this->integer->insert($number);
           return $this->setData([$model]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * get a limited list of integers order by frequency of every number
     * @param $request
     * @return array
     */
    public function topConverted(Request $request)
    {
        $offset = $request->query->get('offset', 0);
        $limit = $request->query->get('limit', 10);
        $integers = Integer::limit($limit)->offset($offset)->orderBy('nr_frequency', 'desc')->get();

        return $this->setData($integers);
    }

    /**
     * useful to transform data before using it in an API.
     * @param $data
     * @return array
     */
    private function setData($data)
    {
        $collection = new Collection($data, $this->integerTransformer);
        $data = $this->fractal->createData($collection);

        return $data->toArray();
    }

}
