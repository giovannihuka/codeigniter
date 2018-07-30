
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-body">
                    <div class="row" style="margin-bottom: 4px">
                        <div class="col-md-8">
                            <div style="margin-top: 4px"  id="message">
                                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                            </div>
                        </div>
                        <div class="col-md-4 text-right">
                            <?php echo anchor(site_url('admin/contract/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('admin/contract/excel'), 'Excel', 'class="btn btn-primary"'); ?>                    </div>
                </div>
                <div class="table-responsive">
	    
        <table class="table table-bordered table-striped nowrap" id="mytable" style="width: 100%">
            <thead>
                <tr>
                    <th width="45px">No</th>
            <th width="80px">Aksi</th>
		    <th>Nama Grosir</th>
		    <th>Status Grosir</th>
		    <th>Nama Database</th>
		    <th>Server IP</th>
		    <th>Nama Pemilik</th>
		    <th>Alamat Grosir</th>
		    <th>Telepon</th>
		    <th>Telepon Lain</th>
		    <th>Hand Phone</th>
		    <th>Email</th>
		    <th>Tanggal Persetujuan Kontrak</th>
		    <th>Tanggal Awal</th>
		    <th>Tanggal Berhenti Kontrak</th>
		    <th>Status Data</th>
		    
                </tr>
            </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>