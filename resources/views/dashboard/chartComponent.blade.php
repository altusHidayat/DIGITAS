<div class="row">
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Growth Rate For 2024</h6>
            </div>
            <input type="hidden" id="growthData" value="{{ $growthRate ?? '' }}">
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Top 3 Highest Sale Product</h6>
            </div>
            @php
                $saleByProduct = $topSaleByProduct['total_sale'] ?? '';
                $productTop3 = $topSaleByProduct['product'] ?? '';
            @endphp
            <input type="hidden" id="total_sale_top_3" value="{{ json_encode($saleByProduct) }}">
            <input type="hidden" id="product_top_3" value="{{ json_encode($productTop3) }}">
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    @if ($topSaleByProduct)
                        @php
                            $classCss = ['primary', 'success', 'info'];
                        @endphp
                        @foreach ($topSaleByProduct['product'] as $key => $product)
                            <span class="mr-2">
                                <i class="fas fa-circle text-{{ $classCss[$key] }}"></i> {{ $product[0] ?? '' }}
                            </span>
                        @endforeach
                    @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
