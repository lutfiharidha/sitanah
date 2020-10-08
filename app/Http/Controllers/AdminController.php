<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjual;
use App\Tanah;
use App\FotoTanah;
use Auth;
use App\User;

class AdminController extends Controller
{
    public function index(){
        $allPenjual = Penjual::limit(3)->get();
        $allTanah = Tanah::limit(3)->get();
        return view('admin.dashboard', compact('allPenjual', 'allTanah'));
    }

    public function profile()
    {
        $profile = User::findOrFail(auth()->user()->id);
        return view('admin.profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->user()->id,
        ]);
        
        $user = User::findOrFail(auth()->user()->id);
        $user->name = $request->name;
        $user->email = strtolower($request->email);
        if ($request->password) {
            $this->validate($request,[
                'password' => 'min:8|confirmed',
            ]);
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('dashboardAdmin')->with('success', 'Profile Updated');
    }

    public function dataAdmin()
    {
        $admins=User::where('level', 'admin')->get();
        return view('admin.dataAdmin',compact('admins'));
    }

    public function addAdmin()
    {
        return view('admin.addAdmin');
    }

    public function storeAdmin(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|',
            'password' => 'string|min:8|confirmed',
        ]);
        
        $user = new User;
        $user->name = $request->name;
        $user->email = strtolower($request->email);
        $user->password = bcrypt($request->password);
        $user->level = 'admin';
        $user->save();

        return redirect()->route('dashboardAdmin')->with('success', 'Admin Sudah Ditambah ');
    }

    public function indexPenjual(){
        $allPenjual = User::where('status', 'approved')->get();
        return view('admin.penjualVerif', compact('allPenjual'));
    }
    public function indexPenjualUn(){
        $allPenjual = User::where('status', 'pending')->get();
        return view('admin.penjualUnverif', compact('allPenjual'));
    }
    public function indexPenjualBan(){
        $allPenjual = User::where('status', 'banned')->get();
        return view('admin.penjualBanned', compact('allPenjual'));
    }
    public function statusPenjual(Request $request, $id){
        $penjual = User::find($id);
        if ($request->has('approved')) {
            $penjual->status = 'approved';
            $penjual->save();
            return redirect()->back()->with('success', "$penjual->name has been approved");
        }
        $penjual->status = 'banned';
        $penjual->message = $request->message;
        $penjual->save();
        return redirect()->back()->with('success', "$penjual->name has been banned");
    }

    public function indexTanah(){
        $allTanah = Tanah::where('status', 'approved')->get();
        return view('admin.tanahVerif', compact('allTanah'));
    }
    public function indexTanahUn(){
        $allTanah = Tanah::where('status', 'pending')->get();
        return view('admin.tanahUnverif', compact('allTanah'));
    }
    public function indexTanahBan(){
        $allTanah = Tanah::where('status', 'banned')->get();
        return view('admin.tanahBanned', compact('allTanah'));
    }

    public function statusTanah(Request $request, $id){
        $tanah = Tanah::find($id);
        if ($request->has('approved')) {
            $tanah->status = 'approved';
            $tanah->save();
            return redirect()->back()->with('success', "$tanah->title has been approved");
        }
        $tanah->status = 'banned';
        $tanah->message = $request->message;
        $tanah->save();
        return redirect()->back()->with('success', "$tanah->title has been banned");
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

}