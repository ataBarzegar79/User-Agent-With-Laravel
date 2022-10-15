<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAgentFilterRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class UserAgentController extends Controller
{
    public function userAgentGenerator(UserAgentFilterRequest $request): JsonResponse
    {
        $json = json_decode(file_get_contents(base_path() . "/resources/src/user-agents.json"), true);
        $helperArray['user_agent'] = [];
        $finalArray['user_agent'] = [];

        // fetching random user agents in ordered quantity and related to specific deviceCategory
        if ($request->device !== null && $request->quantity !== null) {
            foreach ($json as $j) {
                if ($j['deviceCategory'] === $request->device) {
                    $helperArray['user_agent'][] = $j['userAgent'];
                }
            }

            $rand = Arr::random($helperArray['user_agent'], $request->quantity);
            foreach ($rand as $r) {
                $finalArray['user_agent'][] = $r;
            }


            // fetching all user agents related to specific deviceCategory
        } elseif ($request->device !== null) {
            foreach ($json as $j) {
                if ($j['deviceCategory'] === $request->device) {
                    $helperArray['user_agent'][] = $j['userAgent'];
                }
            }
            $finalArray['user_agent'] = Arr::random($helperArray['user_agent']);


            // fetching random user agents in ordered quantity
        } elseif
        ($request->quantity !== null) {
            foreach ($json as $j) {
                $helperArray['user_agent'][] = $j['userAgent'];
            }
            $rand = Arr::random($helperArray['user_agent'], $request->quantity);
            foreach ($rand as $r) {
                $finalArray['user_agent'][] = $r;
            }


            // fetching a single user agents
        } else {
            foreach ($json as $j) {
                $helperArray['user_agent'][] = $j['userAgent'];
            }
            $finalArray['user_agent'] = Arr::random($helperArray['user_agent']);
        }


        return response()->json(
            $finalArray
        );
    }
}
