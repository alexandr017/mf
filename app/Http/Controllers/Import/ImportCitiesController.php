<?php

namespace App\Http\Controllers\Import;

use App\Models\Cities\City;

class ImportCitiesController
{
    public function index()
    {
        $id = '1CEj2Wof480DtI5njhtH-GqSrJq_W2gItlgNF5KRrXyU';
        $gid = '1802171374';


        $context = stream_context_create([
            "ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false,
            ]
        ]);
        $csv = file_get_contents('https://docs.google.com/spreadsheets/d/' . $id . '/export?format=csv&gid=' . $gid, false, $context);
        $csv = explode("\r\n", $csv);
        $data = array_map('str_getcsv', $csv);

        $isFirstLine = true;

        foreach ($data as $row) {

            if ($isFirstLine) {
                $isFirstLine = false;
                continue;
            }

            $page = new City([
                'name' => $row[1],
                'ip' => $row[2],
                'rp' => $row[3],
                'dp' => $row[4],
                'vp' => $row[5],
                'tp' => $row[6],
                'mp' => $row[7],
            ]);

            $page->save();
        }
    }
}
