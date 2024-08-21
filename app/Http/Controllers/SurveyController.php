<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SurveyRequested;
use App\Models\SurveyIndividualRequest;
use Carbon\Carbon;

class SurveyController extends Controller
{
    public function trackRequest(Request $request)
    {
        $ipAddress = $request->ip();

        $surveyRequested = SurveyRequested::first();
        if (!$surveyRequested) {
            SurveyRequested::create(['count' => 1]);
        } else {
            $surveyRequested->increment('count');
        }

        $recentRequests = SurveyIndividualRequest::where('ip_address', $ipAddress)
            ->where('created_at', '>=', Carbon::now()->subMinute())
            ->count();

        if ($recentRequests >= 19) {
            SurveyIndividualRequest::create([
                'ip_address' => $ipAddress,
                'count' => 1,
                'blocked' => true,
            ]);
        } else {
            SurveyIndividualRequest::create([
                'ip_address' => $ipAddress,
                'count' => 1,
                'blocked' => false,
            ]);
        }

        $count = $surveyRequested->count ?? 0;

        if ($count % 2 === 0) {
            return redirect()->away('https://survey.fom.de/kommunikationBachelor/?q=MEmojis');
        }

        return redirect()->away('https://survey.fom.de/kommunikationBachelor/?q=OEmojis');
    }
}
