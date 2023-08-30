<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorSponsor;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    
    public function sponsored(){
        $currentDate = $date = date("Y-m-d H:i:s");
        $activeSponsorships = DoctorSponsor::where('end_date', '>', $currentDate);

        $sponsoredDoctorsIDS = $activeSponsorships->pluck('doctor_id')->toArray();

        $sponsoredDoctors = [];

        foreach($sponsoredDoctorsIDS as $id){

            $doctor = Doctor::where('id', $id)->first();

            $doctorImage = Doctor::where('id',$id)->select('image')->first();
            $doctorImage =  'http://localhost:8000/storage/' . $doctorImage->image;

            $userID = Doctor::where('id',$id)->pluck('user_id');
            $doctorName = User::where('id', $userID[0])->select('name')->first();
            $doctorName = $doctorName->name;
            
            $doctorSpecialtiesArray = $doctor->specialties()->pluck('name')->toArray();

            $sponsoredDoctors[] = [
                'doctorImage' => $doctorImage,
                'doctorName' => $doctorName,
                'doctorSpecialtiesArray' => $doctorSpecialtiesArray
            ];

        }

        $response = [
            'success' => true,
            'results' => $sponsoredDoctors
        ];

        return response()->json($response);
    }
}