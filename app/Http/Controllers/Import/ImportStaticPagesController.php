<?php

namespace App\Http\Controllers\Import;

use App\Models\StaticPages\StaticPage;

class ImportStaticPagesController
{
    public function index()
    {
        $id = '1CEj2Wof480DtI5njhtH-GqSrJq_W2gItlgNF5KRrXyU';
        $gid = '637596004';


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

            $page = new StaticPage([
                'alias' => $row[1],
                'title' => $row[2],
                'meta_description' => $row[3],
                'h1' => $row[4],
                'content' => $row[5],
                'menu_content' => $row[6],
            ]);

            $page->save();
        }
    }
}
