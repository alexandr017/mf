<?php

namespace App\Http\Controllers\Import;

use App\Models\Teams\Team;

class ImportTeamsController
{
    public function index()
    {
        $id = '1CEj2Wof480DtI5njhtH-GqSrJq_W2gItlgNF5KRrXyU';
        $gid = '0';


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

            $team = new Team([
                'name' => $row[1],
                'alias' => $row[2],
                'stadium' => $row[3],
                'stadium_info' => $row[4],
                'description' => $row[5],
                'logo' => $row[6],
                'title' => $row[7],
                'meta_description' => $row[8],
                'country_id' => $row[9],
                'city_id' => $row[10],
                'date_created' => $row[11],
                'stadium_small_preview' => $row[12],
                'stadium_big_preview' => $row[13],
                'status' => $row[14]
            ]);

            $team->save();


        }
    }
}
