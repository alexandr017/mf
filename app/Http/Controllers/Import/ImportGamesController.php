<?php

namespace App\Http\Controllers\Import;

class ImportGamesController
{
    public function index()
    {

        $sql = file_get_contents(database_path('demo.sql'));
        \DB::unprepared($sql);
    }
}
