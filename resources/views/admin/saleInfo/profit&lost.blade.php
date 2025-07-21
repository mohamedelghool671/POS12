@extends('admin.layouts.master')
@section('content')
    <section class="container-fluid">
        <div class="card">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-4">
                        <h3 class="intro-y text-lg text-white fw-bold font-medium mt-1 mb-1" >
                            {{ __('messages.profit_and_loss_report') }}</h3>
                    </div>
                    <div class="col-8 mt-1">
                        <form action="{{ route('profitlossReport') }}" method="GET" class="mb-4  d-flex justify-content-end align-items-center">
                            <input type="date" name="start_date" class="form-control mx-2" value="{{ request('start_date') }}" style="max-width: 200px;" id="start_date">
                            <input type="date" name="end_date" class="form-control mx-2" value="{{ request('end_date') }}" style="max-width: 200px;" id="end_date">
                            <button type="submit" class="btn btn-dark text-dark fw-bold mx-2" style="background-color: #ffffff; display:none;" id="filterBtn">{{ __('messages.filter') }}</button>
                            <button type="button" class="btn btn-success" onclick="exportTableToExcel('salesTable')">{{ __('messages.export_to_excel') }}</button>
                        </form>
                    </div>
                </div>

                <!-- Table of Daily Sales -->
                @if(!empty($productsales) && count($productsales) > 0)
                <table class="table table-bordered" id="salesTable" >
                    <thead class="table-dark">
                        <tr class="text-white text-center">
                            <th>{{ __('messages.product_name') }}</th>
                            <th>{{ __('messages.sell_price') }}</th>
                            <th>{{ __('messages.purchase_price') }}</th>
                            <th>{{ __('messages.units_sold') }}</th>
                            <th>{{ __('messages.total_profit') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productsales  as $item)
                    {{-- @dd($item->orders->sum('count')) --}}
                  
                        <tr class="text-white text-center">
                            <td>{{ $item->name }}</td>
                            <td>{{ number_format($item->sell_price, 2) }}</td>
                            <td>{{ number_format($item->purchase_price, 2) }}</td>
                            <td>{{ $item->units_sold }}</td>
                            <td>{{ number_format($item->total_profit, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                @else
                <div class="alert alert-warning" role="alert">
                    <p class="text-center text-dark">{{ __('messages.no_data_to_show_within_date') }}</p>
                </div>
            @endif
            </div>
        </div>
        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <!-- export excel -->
     <script>
        function exportTableToExcel(tableId, filename = 'Profit & Lost Report_Details.xlsx') {
            const table = document.getElementById(tableId);
            const workbook = XLSX.utils.table_to_book(table, {
                sheet: "Sheet1"
            });
            XLSX.writeFile(workbook, filename);
        }
     </script>


@endsection

@section('js-section')
<script>
    function toggleFilterBtn() {
        var start = document.getElementById('start_date').value;
        var end = document.getElementById('end_date').value;
        document.getElementById('filterBtn').style.display = (start && end) ? 'inline-block' : 'none';
    }
    document.getElementById('start_date').addEventListener('input', toggleFilterBtn);
    document.getElementById('end_date').addEventListener('input', toggleFilterBtn);
    window.onload = toggleFilterBtn;
</script>
@endsection
