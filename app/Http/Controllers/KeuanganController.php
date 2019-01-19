<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kas;
use App\User;
use App\JumlahUang;

use App\Keuangan;
class KeuanganController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:kas-list',['only' => ['kas']]);
         $this->middleware('permission:kas-edit', ['only' => ['editKas']]);

         $this->middleware('permission:keuangan-list',['only' => ['keuangan']]);
         $this->middleware('permission:keuangan-edit', ['only' => ['editKeuangan','updateKeuangan']]);
         $this->middleware('permission:keuangan-create',['only' => ['createKeuangan','storeKeuangan']]);
         $this->middleware('permission:keuangan-delete', ['only' => ['destroyKeuangan']]);
    }
	//KAS
    public function kas(Request $request)
    {
        $month=$request->input('month', date('m'));
        $year=$request->input('year', date('Y'));

        $month=($month=="")?date('m'):$month;
        $year=($year=="")?date('Y'):$year;
        $month = ($month > 12)?date('m'):$month;
        $strMonth = date('F',mktime(0, 0, 0, $month, 10));
        $users = User::role('4')->get();
        foreach ($users as $user) {
        	$dtaKas=User::find($user->id)->kas->where('tahun',$year)->where('bulan',$month);
        	$kas[$user->id]=["data"=>$dtaKas,"count"=>$dtaKas->count()];
        }
        return view('kas.index',compact('kas','users','month','strMonth','year'))->with('i',1);
    }
    public function editKas(Request $request)
    {
        $month=$request->input('month', date('m'));
        $year=$request->input('year', date('Y'));

        $month = ($month > 12)?date('m'):$month;
        $strMonth = date('F',mktime(0, 0, 0, $month, 10));

        $users = User::role('4')->get();
        foreach ($users as $user) {
        	$dtaKas=User::find($user->id)->kas->where('tahun',$year)->where('bulan',$month);
        	$kas[$user->id]=["data"=>$dtaKas,"count"=>$dtaKas->count()];
        }
        return view('kas.editkas',compact('kas','users','month','strMonth','year'))->with('i',1);
    }
    public function updateKas(Request $request)
    {
    	$JumlahUang=JumlahUang::find(1);
    	$uang=$JumlahUang->uang;

        $this->validate($request, [
            'year' => ['required','integer'],
            'month' => [
                    'required',
                    'max:2',
                    function ($attribute, $value, $fail) {
                        if ($value > 12) {
                            $fail($attribute.' is invalid.');
                        }
                    },
                ],
            'input' => ['required'],
            'input.*.*' => ['required','integer'],
        ]);
        $data = $request->all();
        foreach ($data['input'] as $k => $v) {
        	for ($i=1; $i <=4 ; $i++) {
        		$cek=Kas::where([
	        			['user_id',$k],
	        			['tahun',$data['year']],
	        			['bulan',(int) $data['month']],
	        			['minggu',$i],
        			]);
        			if($cek->count() > 0){
		        		$uang+=$v[$i]-($cek->first()->bayar);
			            $cek->update([
			                "user_id"=>$k,
			                "bayar"=>$v[$i],
			                "bulan"=>$data['month'],
			                "tahun"=>$data['year'],
			                "minggu"=>$i,
			            ]);
        			}
        			else{
		        		$uang+=$v[$i];
			            Kas::create([
			                "user_id"=>$k,
			                "bayar"=>$v[$i],
			                "bulan"=>$data['month'],
			                "tahun"=>$data['year'],
			                "minggu"=>$i,
			            ]);
        			}
        	}
        }
        // return $uang;
        $JumlahUang->update(['uang'=>$uang]);
        return redirect()->route('kas')
                        ->with('success','Saved');
    }
    //KEUANGAN
    public function keuangan(Request $request)
    {
        $keuangan=Keuangan::all();
        $jumlah_uang=JumlahUang::find(1)->uang;
        return view('keuangan.index',compact('jumlah_uang','keuangan'))->with('i',1);
    }
    public function createKeuangan(Request $request)
    {
        $jumlah_uang=JumlahUang::find(1)->uang;
        return view('keuangan.create',compact('jumlah_uang'));
    }
    public function editKeuangan(Request $request, $id)
    {
        $keuangan=Keuangan::find($id);
        $jumlah_uang=JumlahUang::find(1)->uang;
        return view('keuangan.edit',compact('jumlah_uang','keuangan'))->with('i',1);
    }
    public function storeKeuangan(Request $request)
    {
        $this->validate($request, [
            'keterangan' => ['required', 'string'],
            'harga' => ['required', 'integer'],
            'tipe' => ['required', 'in:Pemasukan,Pengeluaran'],
        ]);

        $data = $request->all();
        $input=[
            'keterangan' => $data['keterangan'],
            'harga' => $data['harga'],
            'tipe' => $data['tipe'],
        ];
        $user = Keuangan::create($input);
        
        $uang=JumlahUang::find(1)->uang;
        if($data['tipe'] == "Pemasukan")
            $uang+=$data['harga'];
        else
            $uang-=$data['harga'];
        $jumlah_uang=JumlahUang::find(1)->update(['uang'=>$uang]);

        return redirect()->route('keuangan')
                        ->with('success','Successfully');
    }
    public function updateKeuangan(Request $request, $id)
    {
        $this->validate($request, [
            'keterangan' => ['required', 'string'],
            'harga' => ['required', 'integer'],
            'tipe' => ['required', 'in:Pemasukan,Pengeluaran'],
        ]);

        $data = $request->all();
        $input=[
            'keterangan' => $data['keterangan'],
            'harga' => $data['harga'],
            'tipe' => $data['tipe'],
        ];
        $oldKeuangan = Keuangan::find($id);
        
        $uang=JumlahUang::find(1)->uang;
        if($data['tipe'] == "Pemasukan")
            $uang+=$data['harga']-($oldKeuangan->harga);
        else
            $uang-=$data['harga']-($oldKeuangan->harga);

        $oldKeuangan->update($input);
        $jumlah_uang=JumlahUang::find(1)->update(['uang'=>$uang]);

        return redirect()->route('keuangan')
                        ->with('success','Successfully');
    }
    public function destroyKeuangan($id)
    {
        $keuangan=Keuangan::find($id);
        $uang=JumlahUang::find(1)->uang;

        if($keuangan->tipe == "Pemasukan")
            $uang-=($keuangan->harga);
        else
            $uang+=($keuangan->harga);

        $jumlah_uang=JumlahUang::find(1)->update(['uang'=>$uang]);
        $keuangan->delete();
        return redirect()->route('keuangan')
                        ->with('success','Successfully');
    }
}
