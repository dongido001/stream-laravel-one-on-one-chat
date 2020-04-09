<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GetStream\StreamChat\Client as StreamClient;
use App\User;
use App\Channel;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    protected $client;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client =  new StreamClient(
            getenv("STREAM_API_KEY"), 
            getenv("STREAM_API_SECRET"),
            null,
            null,
            9 // timeout
        );
    }

    /**
     * Generate Token from Stream Chat
     */
    public function getnerateToken(Request $request)
    {
        return response()->json([
            'token' => $this->client->createToken($request->input('username'))
        ], 200);
    }

    /**
     * Get all users
     */
    public function getUsers(Request $request)
    {
        return response()->json([
            'users' => User::all()
        ], 200);
    }
}