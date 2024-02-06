<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sales Data</h6>
                </div>
                <div class="card-body">
                    <h4>Filter</h4>
                    <form action="/dashboard" method="post">
                        @csrf
                        <div class="row mx-0">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Start Date :</label>
                                    <input type="date" value="{{ $startDate ?? '' }}" name="startDate"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">End Date :</label>
                                    <input type="date" name="endDate" value="{{ $endDate ?? '' }}"
                                        class="form-control" required>
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
                    <table class="table table-bordered" id="dataable" width="100%" cellspacing="0">
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
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        @if ($sales->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">&laquo;</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $sales->previousPageUrl() }}"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            </li>
                                        @endif

                                        @foreach ($sales->getUrlRange(1, $sales->lastPage()) as $page => $url)
                                            <li class="page-item {{ $sales->currentPage() == $page ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endforeach

                                        @if ($sales->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $sales->nextPageUrl() }}"
                                                    aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link">&raquo;</span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sales Data Group By Month </h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataable" width="100%" cellspacing="0">
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
</div>
