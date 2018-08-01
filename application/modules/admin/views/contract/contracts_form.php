
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Nama Grosir','company_name','','','','Masukkan Nama Grosir'); ?>
				<?php echo $form->bs3_dropdown('Status Grosir','company_status',$contract_status,'','','Pilih Status Grosir'); ?>
				<?php echo $form->bs3_text('Nama Database','db_name','','','','Masukkan Nama Database'); ?>
				<?php echo $form->bs3_text('Server IP','server_ip','','','','Masukkan Server IP'); ?>
				<?php echo $form->bs3_text('Nama Pemilik','pic_name','','','','Masukkan Nama Pemilik'); ?>
				<?php echo $form->bs3_text('Alamat Grosir','company_address','','','','Masukkan Alamat Grosir'); ?>
				<?php echo $form->bs3_phone('Telepon','company_phone1','','','','Masukkan Telepon'); ?>
				<?php echo $form->bs3_phone('Telepon Lain','company_phone2','','','','Masukkan Telepon Lain'); ?>
				<?php echo $form->bs3_phone('Hand Phone','pic_phone','','','','Masukkan Hand Phone'); ?>
				<?php echo $form->bs3_text('Email','email_address','','','','Masukkan Email'); ?>
				<?php echo $form->bs3_date('Tanggal Persetujuan Kontrak','contract_date','','','','Tanggal Kontrak'); ?>
				<?php echo $form->bs3_date('Tanggal Awal','start_date','','','','Masukkan Tanggal Awal'); ?>
				<?php echo $form->bs3_date('Tanggal Berhenti Kontrak','terminate_date','','','','Masukkan Tanggal Berhenti Kontrak'); ?>
				<?php echo $form->bs3_dropdown('Status Data','status_data',$status_list,'','','Pilih Status Data'); ?>
				<div class="form-group">
					<label>Checkbox</label>
					<div class="form-control">
					<div class="Checkbox">
						<?php echo form_checkbox('val_1','1', TRUE); ?>
						<?php echo form_checkbox('val_2','2', TRUE); ?>
						<?php echo form_checkbox('val_3','3', TRUE); ?>
					</div>
				</div>
				</div>
				<?php echo $form->bs3_text_hidden('Create Userid','create_userid'); ?>
				<?php echo $form->bs3_text_hidden('Update Userid','update_userid'); ?>
				<?php echo $form->bs3_text_hidden('Create Time','create_time'); ?>
				<?php echo $form->bs3_text_hidden('Update Time','update_time'); ?>

				<?php echo $form->bs3_submit('Create'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'contract\'">Cancel</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
