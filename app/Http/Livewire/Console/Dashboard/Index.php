<?php

namespace App\Http\Livewire\Console\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Invoice;

class Index extends Component
{
    public $bulan;
    public $jumlah;
    public $count_order_year;
    public $count_order_pending_year;
    public $count_order_review_year;
    public $count_order_progress_year;
    public $count_order_shipping_year;
    public $count_order_completed_year;
    public $total_revenue_month;
    public $total_revenue_all;

    public function mount()
    {
        $year = date('Y');
        $month = date('m');

        $order = DB::table('invoices')->addSelect(DB::raw('count(id) as jumlah'))
        ->addSelect(DB::raw('MONTH(created_at) as bulan'))
        ->addSelect(DB::raw('MONTHNAME(created_at) as nama_bulan'))
        ->addSelect(DB::raw('YEAR(created_at) as tahun'))
        ->whereYear('created_at','=', $year)->where('status','done')
        ->groupBy('bulan')->orderByRaw('bulan ASC')
        ->get();
        if (count($order)) {
            foreach($order as $hasil){
                $this->bulan[] = $hasil->nama_bulan;
                $this->jumlah[] = $hasil->jumlah;
            }
        } else {
            $this->bulan[] ="";
            $this->jumlah[] ="";
        }
        $this->count_order_year = Invoice::where('status','done')->whereYear('created_at','=', $year)->get()->count();
        $this->count_order_progress_year = Invoice::where('status','progress')->whereYear('created_at','=', $year)->get()->count();
        $this->count_order_shipping_year = Invoice::where('status','shipping')->whereYear('created_at','=', $year)->get()->count();
        $this->count_order_review_year = Invoice::where('status','peyment_review')->whereYear('created_at','=', $year)->get()->count();
        $this->count_order_pending_year = Invoice::where('status','pending')->whereYear('created_at','=', $year)->get()->count();
        $this->count_order_completed_year= Invoice::where('status','done')->whereYear('created_at','=', $year)->get()->count();
        $this->total_revenue_month = Invoice::where('status','done')->whereMonth('created_at','=', $month)->whereYear('created_at','=', $year)->get()->sum('grand_total');
        $this->total_revenue_all = Invoice::where('status','done')->sum('grand_total');
        
    }
    public function render()
    {
        return view('livewire.console.dashboard.index');
    }
}
