<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Contacts;
use App\Models\Doctor;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function showdoctor()
    {
        $doctors = Doctor::with('major')->get();

        return view('front.pages.doctors', compact('doctors'));
    }
    public function showmajor()
    {
        $majors = Major::get();

        return view('front.pages.majors', compact('majors'));
    }
    public function index()
    {

        $majors = Major::get();
        $doctors = Doctor::with('major')->get();
        return view('front.pages.index', compact('doctors','majors'));
    }



    public function store(Request $request)
    {
        $data = $request->all();
        Validator::make($data, [
            'name' => ['required', 'string', 'min:5', 'max:20'],
            "phone" =>['required'],
            'email' => ['required', 'email', 'unique:doctors,email'],
        ])->validate();
        Booking::create($data);

        return back()
        ->with("success","booking created successfully");

    }

    public function createcontact(Request $request)
    {
        $data = $request->all();
        Validator::make($data, [
            'name' => ['required', 'string', 'min:5', 'max:20'],
            "phone" =>['required'],
            'email' => ['required', 'email', 'unique:doctors,email'],
            "subject" =>['required'],
            "message" =>['required'],

        ])->validate();
        Contacts::create($data);

        return back()
        ->with("success","contact created successfully");

    }



}
