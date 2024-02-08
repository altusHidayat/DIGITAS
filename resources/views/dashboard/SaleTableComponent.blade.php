<div class="row">
    <style>
        .pagination {
            float: inline-end !important;
        }
    </style>
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sales Data</h6>
                </div>
                <div class="card-body">
                    <h4>Filter</h4>
                    <form action="/dashboard" method="post" id="searchForm">
                        @csrf
                        <div class="row mx-0">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Start Date :</label>
                                    <input type="date" value="{{ $startDate ?? '' }}" name="startDate" id="startDate"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">End Date :</label>
                                    <input type="date" name="endDate" id="endDate" value="{{ $endDate ?? '' }}"
                                        class="form-control" required>
                                    <input type="hidden" name="connection" id="db_conn_sale_table">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mt-4">
                                    <button class="btn btn-primary"> <i class="fas fa-search"></i> Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="saleTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total Value (RM)</th>
                                <th>Customer</th>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Date Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($sales)
                                @foreach ($sales as $sale)
                                    <tr>
                                        <td>{{ $sale->product->product_name ?? '' }}</td>
                                        <td>{{ $sale->quantity ?? 0 }}</td>
                                        <td>{{ number_format($sale->total_value, 2, '.', ',') }}</td>
                                        <td>{{ $sale->customer->customer_name ?? 0 }}</td>
                                        <td>{{ $monthName = date('F', mktime(0, 0, 0, $sale->month, 1)) }}</td>
                                        <td>{{ $sale->year ?? '' }}</td>
                                        <td>{{ $sale->created_at ?? '' }}</td>
                                    </tr>
                                @endforeach


                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <th>Total Sales (RM): </th>
                                <th>{{ number_format($totalSales, 2, '.', ',') }}</tH>
                                <td colspan="4"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sales Data Group By Month </h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="salePerMonthTable" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>Total Sales (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($saleByMonth)
                                @foreach ($saleByMonth as $sale)
                                    <tr>
                                        <td>{{ $monthName = date('F', mktime(0, 0, 0, $sale->month, 1)) }}</td>
                                        <td>{{ number_format($sale->total_value, 2, '.', ',') }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Products </h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="productTable" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Description</th>
                                <th>Price per unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products)
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->product_name ?? '' }}</td>
                                        <td>{{ $product->product_desc ?? '' }}</td>
                                        <td>{{ number_format($product->price, 2, '.', ',') }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Customers </h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="customerTable" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($customers)
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->customer_name ?? '' }}</td>
                                        <td>{{ $customer->address ?? '' }}</td>
                                        <td>{{ $customer->phone ?? '' }}</td>
                                        <td>{{ $customer->email ?? '' }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
</div>
