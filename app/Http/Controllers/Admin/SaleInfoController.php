<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\SaleInfoService;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class SaleInfoController extends Controller
{
    protected $saleInfoService;

    public function __construct(SaleInfoService $saleInfoService)
    {
        $this->saleInfoService = $saleInfoService;
    }

    // قائمة مبيعات اليوم
    public function saleInfoList()
    {
        $order = $this->saleInfoService->getTodayOrders();
        return view('admin.saleInfo.list', compact('order'));
    }

    public function salesReportPage()
    {
        return view('admin.saleInfo.salesReport');
    }

    public function salesReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');
        if (!$startDate || !$endDate) {
            Alert::error(__('messages.error_in_filtering'), __('messages.please_select_start_end_date'));
            return redirect()->back();
        }
        $sales = $this->saleInfoService->getSalesReport($startDate, $endDate);
        return view('admin.saleInfo.salesReport', compact('sales','startDate', 'endDate'));
    }

    public function productReportPage(){
        return view('admin.saleInfo.productanalysisReport');
    }

    public function productReport(Request $request){
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        if (!$startDate || !$endDate) {
            Alert::error(__('messages.error_in_filtering'), __('messages.please_select_start_end_date'));
            return redirect()->back();
        }
        $stock = $this->saleInfoService->getProductReport($startDate, $endDate);
        return view('admin.saleInfo.productanalysisReport', compact('stock', 'startDate', 'endDate'));
    }

    public function profitlossreportpage(){
        return view ('admin.saleInfo.profit&lost');
    }

    public function profitlossReport(Request $request){
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        if (!$startDate || !$endDate) {
            Alert::error(__('messages.error_in_filtering'), __('messages.please_select_start_end_date'));
            return redirect()->back();
        }
        $productsales = $this->saleInfoService->getProfitLossReport($startDate, $endDate);
        return view('admin.saleInfo.profit&lost', compact('productsales','startDate', 'endDate'));
    }
}
