<!-- Import CSS DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css">

<!-- CSS Custom -->
<style>
    .table {
        border: 1px #fff !important;
        text-align: center !important;
    }

    .custom-select {
        width: 60px !important;
    }

    thead th {
        text-align: center !important;
    }
</style>

<div class="main-content-inner" style="padding: 20px; min-height: calc(100vh - 200px); position: relative;">
    <div class="row">
        <div class="col-12">
            <?php echo $this->session->flashdata('message'); ?>
            <div class="card">
                <div class="card-body">
                    <div class="data-tables">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row mb-4">
                                <div class="col-sm-7">
                                    <h4>Daftar User</h4>
                                </div>
                                <div class="col-sm-5" style="text-align:right;">
                                    <a href="<?= site_url('User/create') ?>">
                                        <button type="button" class="btn btn-danger mb-3">
                                            <i class="fa fa-plus"></i> Tambah Super Admin
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="admin-tab" data-toggle="tab" href="#admin" role="tab"
                                        aria-controls="admin" aria-selected="true">Super Admin</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pengaju-tab" data-toggle="tab" href="#pengaju" role="tab"
                                        aria-controls="pengaju" aria-selected="false">Pengaju</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="hcm-tab" data-toggle="tab" href="#hcm" role="tab"
                                        aria-controls="hcm" aria-selected="false">Admin HCM</a>
                                </li>
                            </ul>
                            <div class="tab-content mt-3" id="myTabContent">
                                <div class="tab-pane fade show active" id="admin" role="tabpanel"
                                    aria-labelledby="admin-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <table id="dataAdmin" class="table table-striped table-bordered"
                                                style="width:100%">
                                                <thead class="bg-light text-capitalize">
                                                    <tr role="row">
                                                        <th data-sortable="false">No</th>
                                                        <th>Email</th>
                                                        <th>Last Login</th>
                                                        <th>Tanggal dibuat</th>
                                                        <th data-sortable="false">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pengaju" role="tabpanel" aria-labelledby="pengaju-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <table id="dataPengaju" class="table table-striped table-bordered"
                                                style="width:100%">
                                                <thead class="bg-light text-capitalize">
                                                    <tr role="row" class="col-12">
                                                        <th data-sortable="false">No</th>
                                                        <th>Email</th>
                                                        <th>Last Login</th>
                                                        <th>Tanggal dibuat</th>
                                                        <th data-sortable="false">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="hcm" role="tabpanel" aria-labelledby="hcm-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <table id="dataHcm" class="table table-striped table-bordered"
                                                style="width:100%">
                                                <thead class="bg-light text-capitalize">
                                                    <tr role="row" class="col-12">
                                                        <th data-sortable="false">No</th>
                                                        <th>Email</th>
                                                        <th>Last Login</th>
                                                        <th>Tanggal dibuat</th>
                                                        <th data-sortable="false">Aksi</th>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>
<script>
    table = $('#dataAdmin').DataTable({
        responsive: true,
        "destroy": true,
        "processing": true,
        "serverSide": true,
        "order": [],

        "ajax": {
            "url": "<?= site_url('user/get_data_admin') ?>",
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [0],
            
        }], "language": {
            "lengthMenu": "Show&nbsp;&nbsp;&nbsp;_MENU_",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoFiltered": "",
            "infoEmpty": ""
        }

    });

    tables = $('#dataPengaju').DataTable({
        responsive: true,
        "destroy": true,
        "processing": true,
        "serverSide": true,
        "order": [],

        "ajax": {
            "url": "<?= site_url('user/get_data_pengaju') ?>",
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [0],
            
        }], "language": {
            "lengthMenu": "Show&nbsp;&nbsp;&nbsp;_MENU_",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoFiltered": "",
            "infoEmpty": ""
        }

    });

    tables1 = $('#dataHcm').DataTable({
        responsive: true,
        "destroy": true,
        "processing": true,
        "serverSide": true,
        "order": [],

        "ajax": {
            "url": "<?= site_url('user/get_data_hcm') ?>",
            "type": "POST"
        },
        "columnDefs": [{
           "targets": [0],
            
        }], "language": {
            "lengthMenu": "Show&nbsp;&nbsp;&nbsp;_MENU_",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoFiltered": "",
            "infoEmpty": ""
        }

    });
    
</script>
