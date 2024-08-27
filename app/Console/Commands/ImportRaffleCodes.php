<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RaffleParticipant;
use League\Csv\Reader;

class ImportRaffleCodes extends Command
{
    protected $signature = 'import:rafflecodes';
    protected $description = 'Importiert Raffle-Codes aus der Datei code.csv im Laravel-Root und legt zufällig Gewinner fest';

    public function handle()
    {
        RaffleParticipant::truncate();

        $file = storage_path('app/raffles/codes.csv');
        $csv = Reader::createFromPath($file, 'r');
        $csv->setHeaderOffset(0);

        $records = $csv->getRecords(['CD01_01']);

        $codes = [];
        foreach ($records as $record) {
            $codes[] = $record['CD01_01'];
        }

        if (empty($codes)) {
            $this->error('Keine Codes in der CSV-Datei gefunden.');
            return;
        }

        $winners = array_rand($codes, 4);
        $vouchers = [
            '140633113.pdf',
            '140633114.pdf',
            '140633113_temp_2.pdf',
            '140633113_temp_3.pdf',
        ];
        shuffle($vouchers);

        foreach ($codes as $index => $code) {
            $isWinner = in_array($index, (array) $winners, true);
            $voucherLink = $isWinner ? array_pop($vouchers) : null;

            RaffleParticipant::create([
                'code' => $code,
                'count' => 0,
                'winner' => $isWinner,
                'voucher_link' => $voucherLink,
            ]);
        }

        $this->info('Codes erfolgreich importiert.');
    }
}
