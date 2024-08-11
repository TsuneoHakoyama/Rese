<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Time;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function confirm(Request $request)
    {
        $shopId = $request->shop_id;
        $details = Shop::where('id', $shopId)
            ->with(['genres', 'prefectures'])
            ->get();

        $date = Carbon::now()->format('Y/m/d');
        $time = Carbon::now()->format('H:i');
        $reserve_times = Time::all();
        $peoples = People::all();
        
        $request['user_id'] = Auth::id();
        $confirm = $request->only([
            'shop_id',
            'user_id',
            'date',
            'time',
            'people'
        ]);

        return view('reservation-confirm', compact(['confirm', 'details', 'shopId', 'date', 'time', 'reserve_times', 'peoples']));
    }
    
    public function reservation(Request $request)
    {
        if ($request->input('back') == 'back') {
            return redirect('shop-detail')->withInput();
        }

        $request['user_id'] = Auth::id();
        $confirm = $request->only([
            'shop_id',
            'user_id',
            'date',
            'time',
            'people'
            ]);

        Reservation::create($confirm);

        return view('reservation-complete');
    }
}
