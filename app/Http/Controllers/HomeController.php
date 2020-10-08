<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tanah;
use App\Kampung;
use App\TanahOverlay;
class HomeController extends Controller
{

    public function index()
    {
        $tanahSatu = Tanah::whereIn('status', ['approved', 'sold'])->latest()->first();
        $tanahLima = Tanah::whereIn('status', ['approved', 'sold'])->offset(1)->limit(5)->latest()->get();
        return view('index', compact('tanahSatu', 'tanahLima'));
    }

    public function search(Request $request)
    {
        $jenis = $request->jenis;
        $harga = str_replace(', ','-',$request->harga);
        $tanah = Tanah::where(function($query) use ($request){
            $arr = explode('-', $request->harga);
            if(!empty($request->jenis)){
               $query->where('jenis', $request->jenis);
            }
            if(!empty($request->harga)){
                $query->whereBetween('harga', [(int)$arr[0], (int)$arr[1]]);
             }
        })->where('title', 'like', '%' . $request->search . '%')->whereIn('status', ['approved', 'sold'])->get();
        return view('search', compact('tanah', 'jenis', 'harga'));
    }

    public function tanahShow($slug)
    {
        $tanah = Tanah::whereIn('status', ['approved', 'sold'])->where('slug', $slug)->firstOrFail();
        $overlays = TanahOverlay::where('tanah_id', $tanah->id)->get();
        $anotherTanah = Tanah::where('penjual_id', $tanah->penjual_id)->where('id', '!=', $tanah->id)->get();
        return view('tanahShow', compact('tanah', 'anotherTanah', 'overlays'));
    }

    public function tanahKecamatan(Request $request, $kecamatan)
    {
        $jenis = $request->jenis;
        $harga = str_replace(', ','-',$request->harga);
        $slug = str_replace("-", " ", $kecamatan);
        $daerah = ucfirst($slug);
        $kampung = $request->kampung;
        $tanah = Tanah::where(function($query) use ($request){
            $arr = explode('-', $request->harga);
            if(!empty($request->jenis)){
               $query->where('jenis', $request->jenis);
            }
            if(!empty($request->kampung)){
                $query->where('kampung', $request->kampung);
             }
            if(!empty($request->harga)){
                if($request->harga == '>-300000001'){
                    $query->where('harga', '>', 300000000);
                }else{
                    $query->whereBetween('harga', [(int)$arr[0], (int)$arr[1]]);
                }
             }
        })->where('kecamatan', $slug)->whereIn('status', ['approved', 'sold'])->get();
        $arrKampung = Kampung::where('kecamatan', $slug)->get();
        $means =Tanah::where('kecamatan', $slug)->get();
        $sum = 0;
        foreach($means as $tan){
            $sum += $tan->harga;
        }
        $mean = count($means) != 0 ? $sum /  count($means) : 0;
        return view('tanahDaerah', compact('tanah', 'daerah', 'mean', 'jenis', 'harga', 'arrKampung', 'kampung'));
    }
    public function tanahKota(Request $request, $kota)
    {
        $jenis = $request->jenis;
        $harga = str_replace(', ','-',$request->harga);
        $slug = str_replace("-", " ", $kota);
        $daerah = ucfirst($slug);
        $tanah = Tanah::where(function($query) use ($request){
            $arr = explode('-', $request->harga);
            if(!empty($request->jenis)){
                $query->where('jenis', $request->jenis);
            }
            if(!empty($request->harga)){
                if($request->harga == '>-300000001'){
                    $query->where('harga', '>', 300000000);
                }else{
                    $query->whereBetween('harga', [(int)$arr[0], (int)$arr[1]]);
                }
            }
        })->where('kota', $slug)->whereIn('status', ['approved', 'sold'])->get();
        $means =Tanah::where('kota', $slug)->get();
        $sum = 0;
        foreach($means as $tan){
            $sum+= $tan->harga;
        }
        $mean = count($means) != 0 ? $sum /  count($means) : 0;
        return view('tanahDaerah', compact('tanah', 'daerah', 'mean', 'jenis', 'harga'));
    }

    public function nearby(Request $request, $lat, $lng){
        $jenis = $request->jenis;
        $harga = str_replace(', ','-',$request->harga);
        $tanah = Tanah::where(function($query) use ($request){
            $arr = explode('-', $request->harga);
            if(!empty($request->jenis)){
               $query->where('jenis', $request->jenis);
            }
            if(!empty($request->harga)){
                if($request->harga == '>-300000001'){
                    $query->where('harga', '>', 300000000);
                }else{
                    $query->whereBetween('harga', [(int)$arr[0], (int)$arr[1]]);
                }
             }
        })->whereIn('status', ['approved', 'sold'])->get();
        
        $r= $request->has('radius') == true ? $request->radius : 1;
        $arr = array();
        //Google Map
        // foreach ($tanah as $key => $tan) {
        //     $dataJson = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat.",".$lng."&destinations=".$tan->lat.",".$tan->lng."&key=AIzaSyD5BFabnl0V1G4W-PBoEKpNC5xNISuZ2xE&mode=driving&sensor=false");
        //     $data = json_decode($dataJson,true);
        //     $nilaiJarak = $data['rows'][0]['elements'][0]['distance']['text'];
        //     $waktu = $data['rows'][0]['elements'][0]['duration']['text'];
        //     $values = array(
        //     'id' => $tan->id,
        //     'title' => $tan->title,
        //     'harga' => $tan->harga,
        //     'luas' => $tan->luas,
        //     'jenis' => $tan->jenis,
        //     'slug' => $tan->slug,
        //     'foto' => $tan->tanah_has_foto[0]->foto,
        //     'distance' => $data['rows'][0]['elements'][0]['distance']['text'],
        //     );
        //     $distance = $data['rows'][0]['elements'][0]['distance']['value'];

        //     if ($distance <= $r) {
        //         array_push($arr, $values); 
        //     }
        // }
        //end Google

        //Haversine
        foreach ($tanah as $key => $tan) {
            $dataJson = $this->haversine($lat, $lng, $tan->lat, $tan->lng);
            $values = array(
                'id' => $tan->id,
                'title' => $tan->title,
                'harga' => $tan->harga,
                'luas' => $tan->luas,
                'jenis' => $tan->jenis,
                'slug' => $tan->slug,
                'foto' => $tan->tanah_has_foto[0]->foto,
                'distance' => $this->haversine($lat, $lng, $tan->lat, $tan->lng).' km',
                );
                $distance = $this->haversine($lat, $lng, $tan->lat, $tan->lng);

                if ($distance <= $r) {
                    array_push($arr, $values); 
                }
        }
        //End Haversine
        $jenis = $request->jenis;
        $harga = $request->harga;
        $latitude = $lat;
        $longitude = $lng;
        return view('tanahNearby', compact('arr', 'latitude', 'longitude', 'r', 'jenis','harga'));
    }

    public function category(){
        return view('category');
    }

    public function haversine($lat , $lng, $tolat, $tolng){
        $desimal = 2;
        $earthRadius = 6371;  
        $deltaLat = deg2rad($tolat - $lat);
        $deltaLong = deg2rad($tolng - $lng);
        $a = sin($deltaLat/2) * sin($deltaLat/2) + cos(deg2rad($lat)) * cos(deg2rad($tolat)) * sin($deltaLong/2) * sin($deltaLong/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    
        $distance = $earthRadius * $c;
        return round($distance, $desimal);    
    }

    public function kampung($kecamatan)
    {
        $kampung = Kampung::where('kecamatan', $kecamatan)->get();
        return $kampung;
    }
}

// public function nearby(Request $request, $lat, $lng){
//     $jenis = $request->jenis;
//     $harga = str_replace(', ','-',$request->harga);
//     $tanah = Tanah::where(function($query) use ($request){
//         $arr = explode('-', $request->harga);
//         if(!empty($request->jenis)){
//            $query->where('jenis', $request->jenis);
//         }
//         if(!empty($request->harga)){
//             $query->whereBetween('harga', [(int)$arr[0], (int)$arr[1]]);
//          }
//     })->where('status', 'approved')->get();
//     $r= $request->has('radius') == true ? $request->radius : 1000;
//     $arr = array();
//     foreach ($tanah as $key => $tan) {
//         $dataJson = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat.",".$lng."&destinations=".$tan->lat.",".$tan->lng."&key=AIzaSyD5BFabnl0V1G4W-PBoEKpNC5xNISuZ2xE&mode=driving&sensor=false");
//         $data = json_decode($dataJson,true);
//         $nilaiJarak = $data['rows'][0]['elements'][0]['distance']['text'];
//         $waktu = $data['rows'][0]['elements'][0]['duration']['text'];
//         $values = array(
//             'id' => $tan->id,
//             'title' => $tan->title,
//             'harga' => $tan->harga,
//             'luas' => $tan->luas,
//             'jenis' => $tan->jenis,
//             'slug' => $tan->slug,
//             'foto' => $tan->tanah_has_foto[0]->foto,
//             'distance' => $data['rows'][0]['elements'][0]['distance']['text'],
//             );
//             $distance = $data['rows'][0]['elements'][0]['distance']['value'];

//             if ($distance <= $r) {
//                 array_push($arr, $values); 
//             }
//     }
//     $jenis = $request->jenis;
//     $harga = $request->harga;
//     $latitude = $lat;
//     $longitude = $lng;
//     return view('tanahNearby', compact('arr', 'latitude', 'longitude', 'r', 'jenis','harga'));
// }
