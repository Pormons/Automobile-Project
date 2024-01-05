<?php

namespace App\Livewire\Dealer;

use App\Models\PurchasedVehicle;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Dashboard extends Component
{
    public $annual, $month, $inventory, $sold, $available, $orders, $sold_status, $rejected, $pending;
    public $currentYear, $year, $months;
    public $brands;
    public function render()
    {
        $this->currentYear = now()->year;
        $currentMonth = now()->month;

        $this->annual = Auth::user()->dealerTransaction()
            ->whereYear('purchase_date', $this->year ? $this->year : now()->year)
            ->where('status', 'sold')
            ->join('purchased_vehicles', 'transactions.transaction_id', '=', 'purchased_vehicles.transaction')
            ->sum('purchased_vehicles.price');

        $this->month = Auth::user()->dealerTransaction()
            ->whereYear('purchase_date', $this->year ? $this->year : now()->year)
            ->whereMonth('purchase_date', $currentMonth)
            ->where('status', 'sold')
            ->join('purchased_vehicles', 'transactions.transaction_id', '=', 'purchased_vehicles.transaction')
            ->sum('purchased_vehicles.price');

        $this->orders = Auth::user()->dealerTransaction->count();
        $this->sold_status = Auth::user()->dealerTransaction->where('status', 'sold')->count();
        $this->rejected = Auth::user()->dealerTransaction->where('status', 'Rejected')->count();
        $this->pending = Auth::user()->dealerTransaction->where('status', 'Pending')->count();

        $this->inventory = Auth::user()->inventories->count();

        $result = Auth::user()->inventories()->selectRaw('
            brand_name,
            model_name,
            COUNT(*) AS total,
            SUM(CASE WHEN available = 1 THEN 1 ELSE 0 END) AS available,
            SUM(CASE WHEN sold_status = 1 THEN 1 ELSE 0 END) AS sold,
            SUM(CASE WHEN available = 0 AND sold_status = 0 THEN 1 ELSE 0 END) AS not_available
            ')
            ->join('vehicles', 'inventories.vin', '=', 'vehicles.vin')
            ->join('brand_models', 'vehicles.model', '=', 'brand_models.id')
            ->join('brands', 'brand_models.brand', '=', 'brands.id')
            ->groupBy('brand_name', 'model_name')->get();


        $columnChartModel = (new ColumnChartModel())->multiColumn();

        foreach ($result as $row) {
            $columnChartModel->addSeriesColumn('available', "{$row->model_name} ({$row->total})", $row->available);
            $columnChartModel->addSeriesColumn('sold', "{$row->model_name} ({$row->total})", $row->sold);
            $columnChartModel->addSeriesColumn('not available', "{$row->model_name} ({$row->total})", $row->not_available);
        }


        $pies = Auth::user()
            ->dealerTransaction()->selectRaw('
                model_name,
                SUM(purchased_vehicles.price) AS sold')
            ->join('purchased_vehicles', 'transactions.transaction_id', '=', 'purchased_vehicles.transaction')
            ->join('inventories', 'purchased_vehicles.inventory_id', '=', 'inventories.id')
            ->join('vehicles', 'inventories.vin', '=', 'vehicles.vin')
            ->join('brand_models', 'vehicles.model', '=', 'brand_models.id')
            ->whereYear('transactions.purchase_date', $this->year ? $this->year : now()->year)
            ->where('inventories.sold_status', true)
            ->groupBy('brand_models.model_name')
            ->limit(2)
            ->get();


        $horizontalChartModel = (new ColumnChartModel());
        foreach ($pies as $pie) {
            $rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
            $horizontalChartModel->addColumn($pie->model_name, $pie->sold, '#' . $rand);
        }

        $lines = Auth::user()->dealerTransaction()->selectRaw('DATE(purchase_date) as date, SUM(price) as total_sales')
            ->join('purchased_vehicles', 'transactions.transaction_id', '=', 'purchased_vehicles.transaction')
            ->whereYear('purchase_date', $this->year ? $this->year : now()->year)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $lineChartModel = (new LineChartModel())->singleLine();
        foreach ($lines as $line) {
            $lineChartModel->addPoint($line->date, $line->total_sales);
        }


        return view('livewire.dealer.dashboard')->with([
            'columnChartModel' => $columnChartModel->stacked()->withGrid()->withDataLabels(),
            'horizontalChartModel' => $horizontalChartModel->withDataLabels()->setHorizontal(),
            'lineChartModel' => $lineChartModel,
        ]);
    }
}
