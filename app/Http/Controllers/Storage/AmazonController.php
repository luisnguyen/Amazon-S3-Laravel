<?php

namespace App\Http\Controllers\Storage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

class AmazonController extends Controller
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
        /** check file exists from object Request */
        if ($request->hasFile('file')) {

            /**
             * get extension of the file name
             * @var  $fileExt
             */
            $fileExt = $request->file('file')->getClientOriginalName();

            /**
             * get file name
             * @var $fileName
             */
            $fileName = pathinfo($fileExt, PATHINFO_FILENAME);

            /**
             * get extension of the file
             * @var $ext
             */
            $ext = $request->file('file')->getClientOriginalExtension();

            /**
             * create a unique name for the uploaded file
             */
            $awsname = trim(strtolower($fileName))."_".time().".".$ext;

            /**
             * Upload files to Amazon S3
             */
            Storage::disk('s3')->put($awsname, fopen($request->file('file'), 'r+'), 'public');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($key)
    {
        dd(Storage::disk('s3')->url($key));
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
    public function destroy($key)
    {
        dd(Storage::disk('s3')->delete($key));
    }
}
