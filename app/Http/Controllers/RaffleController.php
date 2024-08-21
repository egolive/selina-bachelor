<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Models\RaffleParticipant;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RaffleController extends Controller
{
    public function showForm(): View|Factory|Application {
        return view('raffle.form');
    }

    public function checkCode(Request $request): View|Factory|Application {
        $validated = $request->validate([
            'code' => 'required|string',
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
