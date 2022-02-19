<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Daftar Transaksi</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <form action="<?= base_url("Transaction/register") ?>" method="post">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Anda bisa memasukan informasi transaksi nasabah pada form berikut!</h3>
                            <button type="submit" id="daftar" class="btn btn-success" style="float: right;"><i class="fa fa-credit-card" aria-hidden="true"></i> Bayar</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama</label>
                                        <input type="text" name='name' class="form-control" id="name" placeholder="Masukan Nama Anda!" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Description</label>
                                        <select class="form-control" name="description" id="description" required>
                                            <option value="setor_tunai">Setor Tunai</option>
                                            <option value="beli_pulsa">Beli Pulsa</option>
                                            <option value="bayar_listrik">Bayar Listrik</option>
                                            <option value="tarik_tunai">Tarik Tunai</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="exampleInputEmail1">Amount</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="number" name="amount" class="form-control" placeholder="50000" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Transaction Date:</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" name="transaction_date" class="form-control datetimepicker-input" data-target="#reservationdate">
                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Debit Credit Status</label>
                                        <select class="form-control" name="credit_status" required>
                                            <option value="D">Debit</option>
                                            <option value="C">Credit</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">List Transaksi Terakhir!</h3>
                        <!-- <button type="submit" id="daftar" class="btn btn-success" style="float: right;"><i class="fa fa-th-large" aria-hidden="true"></i> Filter</button> -->
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>AccountID</th>
                                    <th>Nasabah Name</th>
                                    <th>Total Points</th>
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