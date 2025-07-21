@extends('admin.layouts.master')
@section('content')
    <section class="container-fluid">
        <div class="card">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-4">
                        <h3 class="intro-y text-lg text-white fw-bold font-medium mt-1 mb-1" >
                            {{ __('messages.sales_report_details') }}</h3>
                    </div>
                    <div class="col-8 mt-1">
                        <form action="{{ route('salesReport') }}" method="GET" class="mb-4  d-flex justify-content-end align-items-center">
                            <input type="date" name="start_date" class="form-control mx-2" value="{{ request('start_date') }}" style="max-width: 200px;" id="start_date">
                            <input type="date" name="end_date" class="form-control mx-2" value="{{ request('end_date') }}" style="max-width: 200px;" id="end_date">
                            <button type="submit" class="btn btn-dark text-dark fw-bold mx-2" style="background-color: #ffffff; display:none;" id="filterBtn">{{ __('messages.filter') }}</button>
                            <button type="button" class="btn btn-success" onclick="exportTableToExcel('salesTable')">{{ __('messages.export_to_excel') }}</button>
                        </form>
                    </div>
                </div>

                <!-- Table of Daily Sales -->
                @if(!empty($sales) && count($sales) > 0)
                <table class="table table-bordered" id="salesTable" >
                    <thead class="table-dark">
                        <tr class="text-white text-center">
                        <th>{{ __('messages.order_id') }}</th>
                            <th>{{ __('messages.order_code') }}</th>
                            <th>{{ __('messages.product_name') }}</th>
                            <th>{{ __('messages.price') }}</th>
                            <th>{{ __('messages.instock') }}</th>
                            <th>{{ __('messages.sold') }}</th>
                            <th>{{ __('messages.date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales  as $item)
                        
                        <tr class="text-white text-center">
                        <td>{{ $item->id }}</td>
                            <td>{{ $item->order_code }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->product->price }}</td>
                            <td>{{ $item->product->count }}</td>
                            <td>{{ $item->product->orders->sum('count') }}</td>
                            <td>{{ $item->created_at->format('j-F-y') }}</td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>
                @else
                <div class="alert alert-warning" role="alert">
                    <p class="text-center text-dark">{{ __('messages.no_data_in_date_range') }}</p>
                </div>
            @endif
            </div>
        </div>
        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <!-- export excel -->
     <script>
        function exportTableToExcel(tableId, filename = 'Sales_Report_Details.xlsx') {
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
