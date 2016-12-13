<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;

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
        //
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
                'value'         => $object_value->value,
                'timestamp'     => $object_value->created_at,
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
