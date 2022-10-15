<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserAgentFilterRequest;
use Illuminate\Http\Request;

define('Json_File_Path', base_path() . "/resources/src/user-agents.json");

class UserAgentDataController extends Controller
{
    public function userAgentDataProducer(UserAgentFilterRequest $request)
    {
        $userAgents = collect(json_decode(file_get_contents(Json_File_Path), true));
        $quantity = $request->get('quantity') ?? 4;
        $deviceType = $request->get('device') ?? 'mobile';

        $fiteredUserAgents = $deviceType !== null ?
            $userAgents->filter(fn($value) => $value['deviceCategory'] === $deviceType) :
            $userAgents;
        $selectedItems = $fiteredUserAgents->random($quantity);
        return response()->json($selectedItems);
    }
}
