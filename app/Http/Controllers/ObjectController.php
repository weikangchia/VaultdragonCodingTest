<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;

use App\Object;
use App\ObjectValue;

use Carbon\Carbon;

class ObjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->getContent();
        $json = utf8_encode($data);
        $data = json_decode($json, true);

        if(count($data) != 1)
        {
            return \Response::json(array(
                'message'       => 'Please submit only one key pair value.',
                'status_code'   => 400
            ), 400);
        }

        $object_keys = array_keys($data);
        $object_values = array_values($data);

        $object_key = $object_keys[0];
        $object_value = $object_values[0];

        $db_object = Object::firstOrCreate(['key' => $object_key]);
        $db_object_value = ObjectValue::firstOrCreate(
            ['value' => $object_value, 'object_id' => $db_object->id]
        );

        return \Response::json(array(
            'key'           => $object_key,
            'value'         => $object_value,
            'timestamp'     => strtotime($db_object_value->created_at),
            'status_code'   => 201
        ), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($key)
    {
        $timestamp = Input::get('timestamp');

        if(is_null($timestamp))
        {
            $timestamp = Carbon::now(new \DateTimeZone('Asia/Singapore'))->timestamp;
        }

        $db_object_value = \DB::table('objects')
                    ->join('objects_values', 'objects.id', '=', 'objects_values.object_id')
                    ->where('objects.key', '=', $key)
                    ->where('objects_values.created_at', '<=', $timestamp)
                    ->orderBy('objects_values.created_at', 'desc')
                    ->first();

        if(is_null($db_object_value))
        {
            return \Response::json(array(
                'message'       => 'Record not found',
                'status_code'   => 404
            ), 404);
        }
        else {
            return \Response::json(array(
                'value'         => $db_object_value->value,
                'timestamp'     => $db_object_value->created_at,
                'status_code'   => 200
            ), 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
