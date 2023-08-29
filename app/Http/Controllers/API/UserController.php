<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('user');

        $response = [
            'success' => true,
            'results' => $doctors,
            'message' => 'Tutto ok',
        ];
        return response()->json($response);
    }
}
