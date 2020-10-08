<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tanah;
use App\Penjual;
use App\FotoTanah;
use Auth;
use Storage;
use App\User;
use App\TanahOverlay;

class PenjualController extends Controller
{
    public function index(){
        $penjual = Penjual::where('user_id', Auth::user()->id)->first();
        $approved = Tanah::where('penjual_id', $penjual->id)->where('status', 'approved')->get();
        $pending = Tanah::where('penjual_id', $penjual->id)->where('status', 'pending')->get();
        return view('penjual.dashboard', compact('pending', 'approved'));
    }

    public function profile()
    {
        $profile = User::findOrFail(auth()->user()->id);
        return view('penjual.profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->user()->id,
        ]);
        
        $user = User::findOrfail(auth()->user()->id);
        $user->name = $request->name;
        $user->email = strtolower($request->email);
        if ($request->password) {
            $this->validate($request,[
                'password' => 'min:8|confirmed',
            ]);
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect()->route('dashboardPenjual')->with('success', 'Profile Updated');
    }

    public function indexTanah(){
        $penjual = Penjual::where('user_id', Auth::user()->id)->first();
        $allTanah = Tanah::where('penjual_id', $penjual->id)->get();
        return view('penjual.tanahIndex', compact('allTanah'));
    }

    public function addTanah(){
        $penjual = Penjual::where('user_id', Auth::user()->id)->first();
        return view('penjual.tanahAdd', compact('penjual'));
    }

    public function storeTanah(Request $request){
        $this->validate($request, [
            'no_telp' => 'nullable|numeric|digits_between:1,13|unique:users,no_telp',
            'email' => 'required|email|unique:users,email,'. Auth::user()->id,
            'title' =>'required',
            'kecamatan' => 'required',
            'kampung' => 'required',
            'alamat' => 'required',
            'harga' => 'required',
            'luas' => 'required',
            'jenis' => 'required',
            'sertifikat' => 'required',
        ]);
        $addressInfo = $request->kecamatan;
        $addressArray = explode(', ', $addressInfo);
        $addressFields = array(
            str_replace(', ', ' ', $request->alamat).' ',
            $request->kampung,
            $addressArray[0],
            $addressArray[1],
            ' Aceh ',
            'ID'
        );
        $addressData = implode('', array_filter($addressFields));
        $prepAddr = str_replace(' ','+',$addressData);
        $url='https://maps.googleapis.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false&key=AIzaSyD5BFabnl0V1G4W-PBoEKpNC5xNISuZ2xE';
        $source = file_get_contents($url);
        $obj = json_decode($source);
        $slug = strtolower($request->title);
        $penjual = Penjual::where('user_id', Auth::user()->id)->first();
        $tanah = new Tanah;
        $tanah->title = $request->title;
        $tanah->kota = $addressArray[0];
        $tanah->kecamatan = str_replace("", "", $addressArray[1]);
        $tanah->alamat = $request->alamat;
        $tanah->kampung = $request->kampung;
        $tanah->description = $request->description;
        $tanah->harga = str_replace('.','', $request->harga);
        $tanah->luas = $request->luas;
        $tanah->jenis = $request->jenis;
        $tanah->sertifikat = $request->sertifikat;
        $tanah->slug = preg_replace('/\s+/', '-', $slug)."-$penjual->id".date('i');
        $tanah->lat = $obj->results[0]->geometry->location->lat;
        $tanah->lng = $obj->results[0]->geometry->location->lng;
        $tanah->penjual_id = $penjual->id;
        $tanah->save();
        $photos = $request->fotoTanah;
        foreach ($photos as $key => $photo) {
            $fotoTanah = $request->fotoTanah[$key];
            $nameTanah = rand(3000,999999).$fotoTanah->getClientOriginalName();
            $destinationPath = public_path().'/img/tanah/';
            $fotoTanah->move($destinationPath,$nameTanah);
            $dPhoto = new FotoTanah;
            $dPhoto->tanah_id = $tanah->id;
            $dPhoto->foto = $nameTanah;
            $dPhoto->save();
        }

        $penjual = Penjual::where('user_id', Auth::user()->id)->first();
        $penjual->no_telp = $request->noHp;
        $penjual->save();

        $user = User::find(Auth::user()->id);
        $user->email = $request->email;
        $user->name = $request->nama;
        $user->save();
        return redirect()->route('addOverlay', $tanah->id);
    }

    public function editTanah($id){
        $tanah = Tanah::find($id);
        $fotoTanah = FotoTanah::where('tanah_id', $id)->get();
        $penjual = Penjual::where('user_id', Auth::user()->id)->first();

        return view('penjual.tanahEdit', compact('tanah', 'fotoTanah', 'penjual'));
    }

    public function updateTanah(Request $request, $id){
        $this->validate($request, [
            'no_telp' => 'nullable|numeric|digits_between:1,13|unique:users,no_telp',
            'email' => 'required|email|unique:users,email,'. Auth::user()->id,
            'title' =>'required',
            'kecamatan' => 'required',
            'kampung' => 'required',
            'alamat' => 'required',
            'harga' => 'required',
            'luas' => 'required',
            'jenis' => 'required',
            'sertifikat' => 'required',
        ]);

        $addressInfo = $request->kecamatan;
        $addressArray = explode(', ', $addressInfo);
        $addressFields = array(
            str_replace(', ', ' ', $request->alamat).' ',
            $request->kampung,
            $addressArray[0],
            $addressArray[1],
            ' Aceh ',
            'ID'
        );
        $addressData = implode('', array_filter($addressFields));
        $prepAddr = str_replace(' ','+',$addressData);
        $url='https://maps.googleapis.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false&key=AIzaSyD5BFabnl0V1G4W-PBoEKpNC5xNISuZ2xE';
        $source = file_get_contents($url);
        $obj = json_decode($source);

        $slug = strtolower($request->title);
        $penjual = Penjual::where('user_id', Auth::user()->id)->first();
        $route = redirect()->route('indexTanah');

        $tanah = Tanah::find($id);
        if($request->alamat != $tanah->alamat || $request->kecamatan != $tanah->kota.','.$tanah->kecamatan){
            $overlays = TanahOverlay::where('tanah_id', $id)->get();
            foreach ($overlays as $key => $overlay) {
                $overlay->delete();
            }
            $route = redirect()->route('addOverlay', $tanah->id);
        }
        $tanah->title = $request->title;
        $tanah->kota = $addressArray[0];
        $tanah->kecamatan = str_replace("", "", $addressArray[1]);
        $tanah->alamat = $request->alamat;
        $tanah->kampung = $request->kampung;
        $tanah->description = $request->description;
        $tanah->harga = str_replace('.','', $request->harga);
        $tanah->luas = $request->luas;
        $tanah->jenis = $request->jenis;
        $tanah->sertifikat = $request->sertifikat;
        $tanah->status = 'pending';
        $tanah->slug = preg_replace('/\s+/', '-', $slug)."-$penjual->id".date('i');
        $tanah->lat = $obj->results[0]->geometry->location->lat;
        $tanah->lng = $obj->results[0]->geometry->location->lng;
        $tanah->penjual_id = $penjual->id;
        $tanah->save();

        if($request->has('fotoTanah')){
            $photos = $request->fotoTanah;
            foreach ($photos as $key => $photo) {
                $fotoTanah = $request->fotoTanah[$key];
                $nameTanah = rand(3000,999999).$fotoTanah->getClientOriginalName();
                $destinationPath = public_path().'/img/tanah/';
                $fotoTanah->move($destinationPath,$nameTanah);
                $dPhoto = new FotoTanah;
                $dPhoto->tanah_id = $tanah->id;
                $dPhoto->foto = $nameTanah;
                $dPhoto->save();
            }
        }
        $fotoTanah = FotoTanah::where('tanah_id', $id)->get();
        foreach ($fotoTanah as $key => $foto) {
            if($request->has('deleteFoto_'.$foto->id)){
                $oldImage = public_path().'/img/tanah/'.$foto->foto;
                unlink($oldImage);
                $foto->delete();
            }
            if($request->has('fotoTanah_'.$foto->id)){
                $oldImage = public_path().'/img/tanah/'.$foto->foto;
                unlink($oldImage);
                $photos = $request->file('fotoTanah_'.$foto->id);
                $nameTanah = rand(3000,999999).$photos->getClientOriginalName();
                $destinationPath = public_path().'/img/tanah/';
                $photos->move($destinationPath,$nameTanah);
                $dPhoto = FotoTanah::find($foto->id);
                $dPhoto->tanah_id = $tanah->id;
                $dPhoto->foto = $nameTanah;
                $dPhoto->save();
            }
        }
        
    
        $penjual = Penjual::where('user_id', Auth::user()->id)->first();
        $penjual->no_telp = $request->noHp;
        $penjual->save();

        $user = User::find(Auth::user()->id);
        $user->email = $request->email;
        $user->name = $request->nama;
        $user->save();
        return $route;
    }

    public function soldTanah($tanah)
    {
        $tanah = Tanah::find($tanah);
        $tanah->status = 'sold';
        $tanah->save();
        return redirect()->route('indexTanah');
    }

    public function deleteTanah(Tanah $tanah){
        $fotoTanah = FotoTanah::where('tanah_id', $tanah->id)->get();
        foreach ($fotoTanah as $key => $foto) {
            $oldImage = public_path().'/img/tanah/'.$foto->foto;
            unlink($oldImage);
            $foto->delete();
        }
        $tanah->delete();
        return redirect()->back()->with('message','Deleted');
    }


    public function addOverlay(Request $request, $id){
        $tanah = Tanah::find($id);
        $overTanah = TanahOverlay::where('tanah_id', $id)->get();
        if (count($overTanah) > 0) {
            return redirect()->route('indexTanah');
        }
        return view('penjual.overlayAdd', compact('tanah'));
    }

    public function storeOverlay(Request $request, $id){
        $tanah = Tanah::find($id);
        $overlays = $request->overlay;
        if ($overlays != null) {
            foreach ($overlays as $key => $overlay) {
                $overlayTanah = $request->overlay[$key];
                $overlayArray = explode(',', $overlayTanah);
                $dOverlay = new TanahOverlay;
                $dOverlay->tanah_id = $id;
                $dOverlay->lat = $overlayArray[0];
                $dOverlay->lng = $overlayArray[1];
                $dOverlay->save();
            }
        }
        
        return redirect()->route('indexTanah');
    }
}
