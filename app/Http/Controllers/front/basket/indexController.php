<?php

namespace App\Http\Controllers\front\basket;

use App\Helper\sepetHelper;
use App\Http\Controllers\Controller;
use App\Models\Kitaplar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class indexController extends Controller
{

    public function index()
    {
        return view('front.basket.index');
    }
    public function add($id)
    {
        $c = Kitaplar::where('id', '=', $id)->count();
        if ($c != 0) {
            $w = Kitaplar::where('id', '=', $id)->get();
            sepetHelper::add($id, $w[0]['fiyat'], asset($w[0]['image']), $w[0]['name']);
            return redirect()->back()->with('status', 'Sepete Eklediniz');
        } else {
            return redirect()->route('index');
        }
    }

    public function remove($id)
    {
        sepetHelper::remove($id);
        return redirect()->back();
    }
    public function complete()
    {
        if (sepetHelper::countData() != -1) {
            return view('front.basket.complete');
        } else {
            return redirect('/');
        }
    }



    public function completeStore(Request $request)
    {
        $request->validate(['adres' => 'required', 'telefon' => 'required']);
        $adres = $request->input('adres');
        $telefon = $request->input('telefon');
        $mesaj = $request->input('mesaj');
        $json = json_encode(sepetHelper::allList());
        $array =
            [
                'userid' => Auth::id(),
                'adres' => $adres,
                'telefon' => $telefon,
                'mesaj' => $mesaj,
                'json' => $json
            ];

        // $basket = session()->get("basket");

        $insert = Order::create($array);
        if ($insert) {
            Session::forget('basket');
            return redirect()->back()->with('status', 'Siparişiniz Alındı');
        } else {
            return redirect()->back()->with('status', 'Sipariş Alınamadı');
        }
    }



    public function flush()
    {
        Session::forget('basket');
        return redirect('/');
    }
}
