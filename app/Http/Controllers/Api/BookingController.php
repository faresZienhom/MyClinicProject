<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{

    function index()
    {

    $booking = Booking::simplePaginate(5);

    return BookingResource::collection($booking);

    }
    function store(BookingRequest $request){



       $Booking = Booking::create($request->validated());
       Mail::to($Booking->doctor->email)->send(new NewBookingMail($Booking));
       return response()->json($Booking,201);


    }
    function show($id)
    {
        try{
         $Booking = Booking::findorfail($id);
        return new BookingResource($Booking);
        }catch(\Exception $e){

           return response()->json(['id'=> 'Booking not found'],422);

        }

    }
    function update(BookingRequest $request,$id){

        $Booking = Booking::find($id);
        $Booking->update($request->all());
        return new BookingResource($Booking);



    }


    function delete($id){
        Booking::find($id)->delete();
        return response()->json(['message'=>'Booking deleted']);


    }

    }


