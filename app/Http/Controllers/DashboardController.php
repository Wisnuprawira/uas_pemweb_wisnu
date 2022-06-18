<?php

namespace App\Http\Controllers;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
// use App\Http\Controllers\Auth;
use Auth;

class DashboardController extends Controller
{
    public function login()
    {
        return view('layouts.login');
    }

    public function register()
    {
        return view('layouts.register');
    }

    public function post_register(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        return redirect()->route('index.login');
    }

    public function post_login(Request $request)
    {
       
        $user = User::where([
            'email' =>  $request->email,
            ])->first();
        // return $user;
        if($user) {
            if(Hash::check($request->password, $user->password)){
                $data = [
                    'email' => $request->email,
                    'password' => $request->password
                ];

                if(Auth::attempt($data))
                {
                    // return $user;
                    return redirect()->route('index.pegawai');

                }else{
                    return "<script> alert('Username atau password salah.!') </script>";
                    return redirect()->route('index.login');
                }
            }else{
                return "<script> alert('Username atau password salah.!') </script>";
                return redirect()->route('index.login');
            }
        } else {
            return "<script> alert('Username atau password salah.!') </script>";
            return redirect()->route('index.login');

        }
    }
        

    public function pegawai(){
        $pegawai = Pegawai::all();
        // return $pegawai;
       return view('index', compact('pegawai'));
    }
        //Code For Seach
    public function search(Request $request)
    {
    $q = Input::get('q');

    if ($q != '') {
        $pegawai = Pegawai::where('nama', 'nomor_telpon', 'email' . $q )
            ->orwhere('nama', 'nomor_telpon', 'email' . $q )
            ->paginate(2);

        if (count($pegawai) > 0) {
            return view('pages.pegawai')->withData($pegawai);
        }
        return view('pages.pegawai')->withMessage("No Data Found");
    }
    }

    public function tambah_pegawai(Request $request)
    {
        $test = Pegawai::create([
            'nama' => $request->nama,
            'nomor_telpon' => $request->nomor,
            'email' => $request->email,
        ]);

        // return $test;
        return redirect()->back();
    }

    public function edit_pegawai(Request $request, $id)
    {
        $test = Pegawai::find($id);
        $test->update([
            'nama' => $request->nama,
            'nomor_telpon' => $request->nomor,
            'email' => $request->email,
        ]);

        // return $test;
        return redirect()->back();
    }    

    public function hapus($id)
    {
        $peg = Pegawai::find($id);
        $peg->delete();
        return redirect()->back();

    }

    public function logout(){
        auth()->logout();
        return redirect()->route('index.login');
    }
}
