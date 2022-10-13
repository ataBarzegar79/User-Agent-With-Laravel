<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class UserAgentController extends Controller
{
    public function index(): JsonResponse
    {
        $json = json_decode(file_get_contents(base_path() . "/resources/src/user-agents.json"), true);
        $nj = [];
        foreach ($json as $j) {
            if ($j["deviceCategory"] === 'mobile') {
                $nj["user_agent"][] = $j["userAgent"];
            }
        }

        return response()->json(
            $nj
        );
    }
}
