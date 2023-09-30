<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use Hash;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
     function index()
    {

    $doctors = Doctor::with('major')->simplePaginate(5);

    return DoctorResource::collection($doctors);

    }
     function store(DoctorRequest $request){


        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

       $doctor = Doctor::create($data);
       foreach ($request->images as $image) {
        $doctor->addMedia($image)->toMediaCollection('doctor_images');
       }
       return response()->json($doctor,201);

    }
      // away to hash password
     // Doctor::create([
      //...$request->all(),
      //'password' => Hash::make($request->Password
    //]);

    function deletedoctorimage($id,request $request){

        $request->validate(['image_id' => 'required']);
        $doctor = Doctor::find($id);
        $doctor->deleteMedia($request->image_id);

        return response()->json(['message'=> 'doctor image deleted successfully']);

    }
    function adddoctorimage($id){

        $doctor = Doctor::find($id);
        $doctor->addMultipleMediaFromRequest(['images'])->each(function($fileAdder){
            $fileAdder->toMediaCollection('doctor_images');
        });
        return response()->json(['message'=> 'doctor image added successfully']);

    }
    function cleardoctorimage($id,request $request){

        $doctor = Doctor::find($id);
        $doctor->ClearMediaCollection('doctor_images');

        return response()->json(['message'=> 'doctor image cleared successfully']);

    }



     function show($id)
    {
        try{
         $doctor = Doctor::findorfail($id);
        return new DoctorResource($doctor);
        }catch(\Exception $e){

           return response()->json(['id'=> 'doctor not found'],422);

        }

    }

    function update(DoctorRequest $request,$id){

        $doctor = Doctor::find($id);
        $doctor->update($request->all());
        return new DoctorResource($doctor);



    }


    function delete($id){
        Doctor::find($id)->delete();
        return response()->json(['message'=>'doctor deleted']);


    }

    function forcedelete($id){
        Doctor::withTrashed()->find($id)->forcedelete();
        return response()->json(['message'=>'doctor deleted']);


    }

    function restore($id){
        $doctor = Doctor::withTrashed()->find($id)->restore();
        return response()->json($doctor);


}
}
