<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Report Buku Tabungan</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Report Buku Tabungan</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12" id="filter">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Transaction Date:</label>
                                        <div class="input-group date" id="startDate" data-target-input="nearest">
                                            <input type="text" name="startDate" class="form-control datetimepicker-input" data-target="#startDate">
                                            <div class="input-group-append" data-target="#startDate" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label></label>
                                        <div class="input-group date mt-2" id="endDate" data-target-input="nearest">
                                            <input type="text" name="endDate" class="form-control datetimepicker-input" data-target="#endDate">
                                            <div class="input-group-append" data-target="#endDate" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Account ID</label>
                                        <div class="input-group date" id="account_id">
                                            <input type="text" name="account_id" class="form-control">
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-user"></i></div>
                                            </div>
                                            <button type="button" id="search" class="btn btn-info ml-2"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Transaction Date</th>
                                    <th>Description</th>
                                    <th>Credit</th>
                                    <th>Debit</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>