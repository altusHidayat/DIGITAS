 @extends('template.dashboardTemplateView')
 @section('content')
     @if ($errors->any())
         <div class="alert alert-danger">
             <ul>
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                 @endforeach
             </ul>
         </div>
     @endif

     @if (session('success'))
         <div class="alert alert-success">
             {{ session('success') }}
         </div>
     @endif

     @if (session('error'))
         <div class="alert alert-danger">
             {{ session('error') }}
         </div>
     @endif

     @php
         if (session('db')) {
             $db = session('db');
         }
     @endphp

     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
         <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
             data-target="#excelModal"><i class="fas fa-upload fa-sm text-white-50"></i> Import Data</a>
     </div>
     <div class="row mb-3">
         <div class="col-md-4">
             <div class="card">
                 <div class="card-header row">
                     <h3>Fetch data from difference DB</h3>
                 </div>
                 <div class="card-body">
                     <form action="/dashboard" method="POST">
                         @csrf
                         <div class="form-group">
                             <label for="">Select DB Name :</label>
                             <select name="connection" class="form-control" id="db_conn">
                                 <option {{ $db == 'db1' ? 'selected' : '' }} value="db1">DB1</option>
                                 <option {{ $db == 'db2' ? 'selected' : '' }} value="db2">DB2</option>
                             </select>
                         </div>
                         <div class="form-group">
                             <button type="submit" class="btn btn-primary">Fecth Data</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>

         <div class="col-md-4">
             <div class="card">
                 <div class="card-header">
                     <h3>Fetch data from API</h3>
                 </div>
                 <div class="card-body">
                     <form action="/fetchDataFromApi" method="POST">
                         @csrf
                         <div class="form-group">
                             <label for="">Api Url :</label>
                             <input type="text" value="https://dummyjson.com/products" name="apiUrl"
                                 class="form-control">
                             <input type="hidden" name="connection" id="fetchApiConn">
                         </div>

                         <div class="form-group">
                             <button type="submit" class="btn btn-primary">Fecth Data</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>

         <div class="col-md-4">
             <div class="card">
                 <div class="card-header row">
                     <h3>Fetch data file Excel </h3>
                     (<a href="/assets/excelTemplate/saleTemplate.xlsx" download><span>Sale Excel
                             Template</span></a>)
                 </div>
                 <div class="card-body">
                     <form action="/upload-excel/sale" method="post" enctype="multipart/form-data">
                         @csrf
                         <div class="form-group">
                             <label for="formFile" class="form-label">Excel File :</label>
                             <input class="form-control" type="file" name="file" id="formFile" accept=".xlsx, .xls">
                             <input type="hidden" name="connection" id="fetchExcelConn">
                         </div>
                         <div class="form-group">
                             <button type="submit" class="btn btn-primary">Fetch Data</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
     @include('dashboard.summaryComponent')
     @include('dashboard.chartComponent')
     @include('dashboard.SaleTableComponent')
     @include('modal.excelModal')

     <script>
         $(document).ready(function() {
             var db_conn = $("#db_conn").val();
             $("#db_conn_sale_table").val(db_conn);
             $("#fetchApiConn").val(db_conn);
             $("#fetchExcelConn").val(db_conn);
         })
     </script>
 @endsection
