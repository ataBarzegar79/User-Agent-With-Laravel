<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserAgentFilterRequest;

define('Json_File_Path', base_path() . "/storage/app/src/intoli_src_file.json");

class UserAgentDataController extends Controller
{
    public function userAgentDataProducer(UserAgentFilterRequest $request)
    {
        $userAgents = collect(json_decode(file_get_contents(Json_File_Path), true));
        $quantity = $request->get('quantity') ?? 1;
        $deviceType = $request->get('device') ?? null;

        $fiteredUserAgents = $deviceType !== null ?
            $userAgents->filter(fn($value) => $value['deviceCategory'] === $deviceType) :
            $userAgents;
        $selectedItems = $fiteredUserAgents->random(
            $quantity > $fiteredUserAgents->count() ? $fiteredUserAgents : $quantity
        );
        return response()->json(["data" => $selectedItems]);
    }
}
