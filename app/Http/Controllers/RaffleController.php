<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Models\RaffleParticipant;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RaffleController extends Controller
{
    public function showForm(): View|Factory|Application {
        $startDate = Carbon::create(2024, 12, 01);
        $currentDate = Carbon::now();

        return view('raffle.form', compact('startDate', 'currentDate'));
    }

    public function checkCode(Request $request): View|Factory|Application {
        $validated = $request->validate([
            'code' => ['required', 'string', 'regex:/^[A-Za-z]{2}(0[1-9]|1[0-2])(19[0-9]{2}|200[0-6])$/'],
        ], [
            'code.required' => 'Der Code ist erforderlich.',
            'code.regex' => 'Der Code muss aus zwei Buchstaben, einem gültigen Monat und einem Jahr zwischen 1900 und 2006 bestehen.',
        ]);

        $participant = RaffleParticipant::where('code', $validated['code'])->first();

        if ($participant) {
            $participant->increment('count');
            if ($participant->winner) {
                return view('raffle.result', [
                    'message' => 'Glückwunsch! Dein Code hat gewonnen.',
                    'voucher_link' => $participant->voucher_link
                ]);
            }

            return view('raffle.result', [
                'message' => 'Leider hat dein Code nicht gewonnen.',
                'voucher_link' => null
            ]);
        }

        return view('raffle.result', [
            'message' => 'Der eingegebene Code existiert nicht.',
            'voucher_link' => null
        ]);
    }

    public function downloadVoucher($filename): BinaryFileResponse {
        $filePath = storage_path('app/private/' . $filename);

        if (!file_exists($filePath)) {
            abort(404, 'Gutschein nicht gefunden.');
        }

        return response()->download($filePath);
    }
}
