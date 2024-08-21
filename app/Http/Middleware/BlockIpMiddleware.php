<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\SurveyIndividualRequest;
use Carbon\Carbon;

class BlockIpMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $ipAddress = $request->ip();

        $blockedRequest = SurveyIndividualRequest::where('ip_address', $ipAddress)
            ->where('blocked', true)
            ->first();

        if ($blockedRequest) {
            $blockedAt = $blockedRequest->created_at;
            $unblockTime = $blockedAt->addMinutes(5);

            if (Carbon::now()->greaterThanOrEqualTo($unblockTime)) {
                $blockedRequest->update(['blocked' => false]);
            } else {
                return response()->json(['message' => 'Your IP is blocked'], 403);
            }
        }

        return $next($request);
    }
}
