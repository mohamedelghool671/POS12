@extends('admin.layouts.master')
@section('content')
    <section class="container-fluid">
        <div class="card">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-4">
                        <h3 class="intro-y text-lg text-white fw-bold font-medium mt-1 mb-1" >
                            {{ __('messages.product_analysis_report') }}</h3>
                    </div>
                    <div class="col-8 mt-1">
                        <form action="{{ route('productReport') }}" method="GET" class="mb-4  d-flex justify-content-end align-items-center">
                            <input type="date" name="start_date" class="form-control mx-2" value="{{ request('start_date') }}" style="max-width: 200px;" id="start_date">
                            <input type="date" name="end_date" class="form-control mx-2" value="{{ request('end_date') }}" style="max-width: 200px;" id="end_date">
                            <button type="submit" class="btn btn-dark text-dark fw-bold mx-2" style="background-color: #ffffff; display:none;" id="filterBtn">{{ __('messages.filter') }}</button>
                            <button type="button" class="btn btn-success" onclick="exportTableToExcel('salesTable')">{{ __('messages.export_to_excel') }}</button>
                        </form>
                    </div>
                </div>

                <!-- Table of Daily Sales -->
                @if(!empty($stock) && count($stock) > 0)
                <table class="table table-bordered" id="salesTable" >
                    <thead class="table-dark">
                        <tr class="text-white text-center">
                            <th>{{ __('messages.product_id') }}</th>
                            <th>{{ __('messages.product_name') }}</th>
                            <th>{{ __('messages.category_name') }}</th>
                            <th>{{ __('messages.in_stock') }}</th>
                            <th>{{ __('messages.sold') }}</th>
                            <th>{{ __('messages.remaining_stock') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stock  as $item)
                        <tr class="text-white text-center">

                            <td>{{ $item->product_id }}</td>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->category_name }}</td>
                            <td>{{ $item->in_stock }}</td>
                            <td>{{ $item->units_sold }}</td>
                            <td>{{ $item->remaining_stock }}</td>
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

@endsection

@section('js-section')
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script>
    function exportTableToExcel(tableId, filename = 'Product_Analysis_Report_Details.xlsx') {
        const table = document.getElementById(tableId);
        const workbook = XLSX.utils.table_to_book(table, {
            sheet: "Sheet1"
        });
        XLSX.writeFile(workbook, filename);
    }

    function toggleFilterBtn() {
        var start = document.getElementById('start_date').value;
        var end = document.getElementById('end_date').value;
        document.getElementById('filterBtn').style.display = (start && end) ? 'inline-block' : 'none';
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('start_date').addEventListener('input', toggleFilterBtn);
        document.getElementById('end_date').addEventListener('input', toggleFilterBtn);
        toggleFilterBtn();
    });
</script>
@endsection
