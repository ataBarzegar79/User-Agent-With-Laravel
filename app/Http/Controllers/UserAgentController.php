<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserAgentController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $json = json_decode(file_get_contents(base_path() . "/resources/src/user-agents.json"), true);
        $helperArray["user_agent"] = [];
        $finalArray["user_agent"] = [];

        // fetching random user agents in ordered quantity and related to specific deviceCategory
        if ($request->device !== null && $request->quantity !== null) {
            foreach ($json as $j) {
                if ($j["deviceCategory"] === $request->device) {
                    $helperArray["user_agent"][] = $j["userAgent"];
                }
            }

            $rand = array_rand($helperArray["user_agent"], $request->quantity);
            foreach ((array)$rand as $r) {
                $finalArray["user_agent"][] = $helperArray["user_agent"][$r];
            }


            // fetching all user agents related to specific deviceCategory
        } elseif ($request->device !== null) {
            foreach ($json as $j) {
                if ($j["deviceCategory"] === $request->device) {
                    $finalArray["user_agent"][] = $j["userAgent"];
                }
            }


            // fetching random user agents in ordered quantity
        } elseif
        ($request->quantity !== null) {
            foreach ($json as $j) {
                $helperArray["user_agent"][] = $j["userAgent"];
            }
            $rand = array_rand($helperArray["user_agent"], $request->quantity);
            foreach ((array)$rand as $r) {
                $finalArray["user_agent"][] = $helperArray["user_agent"][$r];
            }


            // fetching all user agents
        } else {
            foreach ($json as $j) {
                $finalArray["user_agent"][] = $j["userAgent"];
            }
        }


        return response()->json(
            $finalArray
        );
    }
}
