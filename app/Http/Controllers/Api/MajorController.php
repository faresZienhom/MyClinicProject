<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MajorRequest;
use App\Http\Resources\MajorResource;
use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    function index()
    {

    $majors = Major::simplePaginate(5);

    return MajorResource::collection($majors);

    }
    function store(MajorRequest $request){



       $major = Major::create($request->all());
       return response()->json($major,201);


    }
    function show($id)
    {
        try{
         $major = Major::findorfail($id);
        return new MajorResource($major);
        }catch(\Exception $e){

           return response()->json(['id'=> 'major not found'],422);

        }

    }
    function update(MajorRequest $request,$id){

        $major = Major::find($id);
        $major->update($request->all());
        return new MajorResource($major);



    }


    function delete($id){
        Major::find($id)->delete();
        return response()->json(['message'=>'major deleted']);


    }

    }

