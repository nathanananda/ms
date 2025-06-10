<?php

namespace App\Http\Controllers;

use App\Models\MasterDepartemen;
use App\Models\MasterSection;
use Illuminate\Http\Request;

class StrukturController extends Controller
{
    public function getDepartemen($divisi_id)
    {
        $data = MasterDepartemen::where('id_divisi', $divisi_id)->get();
        return response()->json($data);
    }

    public function getSection($departemen_id)
    {
        $data = MasterSection::where('id_departemen', $departemen_id)->get();
        return response()->json($data);
    }
}
