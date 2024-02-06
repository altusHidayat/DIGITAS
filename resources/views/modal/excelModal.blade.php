<div class="modal fade" id="excelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form action="/upload-excel/product" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row card-body">
                                <a href="/assets/excelTemplate/productTemplate.xlsx" download><span>Product Excel
                                        Template</span></a>
                            </div>
                            <div class="row card-body">
                                <label for="formFile" class="form-label">Excel File :</label>
                                <input class="form-control" type="file" name="file" id="formFile"
                                    accept=".xlsx, .xls">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form action="/upload-excel/customer" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row card-body">
                                <a href="/assets/excelTemplate/customerTemplate.xlsx" download><span>Customer Excel
                                        Template</span></a>
                            </div>
                            <div class="row card-body">
                                <label for="formFile" class="form-label">Excel File :</label>
                                <input class="form-control" type="file" name="file" id="formFile"
                                    accept=".xlsx, .xls">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
