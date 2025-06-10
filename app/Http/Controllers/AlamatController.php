<?php

namespace App\Http\Controllers;

use App\Models\MasterKecamatan;
use App\Models\MasterKelurahan;
use App\Models\MasterKota;
use Illuminate\Http\Request;

class AlamatController extends Controller
{
    public function getKota($id_provinsi)
    {
        $kota = MasterKota::where('id_provinsi', $id_provinsi)->get();
        return response()->json($kota);
    }

    public function getKecamatan($id_kota)
    {
        $kecamatan = MasterKecamatan::where('id_kota', $id_kota)->get();
        return response()->json($kecamatan);
    }

    public function getKelurahan($id_kecamatan)
    {
        $kelurahan = MasterKelurahan::where('id_kecamatan', $id_kecamatan)->get();
        return response()->json($kelurahan);
    }
}
