
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Nama Grosir','company_name',$contract['company_name'],'','','Masukkan Nama Grosir'); ?>
				<?php echo $form->bs3_dropdown('Status Grosir','company_status',$contract_status,$contract['company_status'],'','Pilih Status Grosir'); ?>
				<?php echo $form->bs3_text('Nama Database','db_name',$contract['db_name'],'','','Masukkan Nama Database'); ?>
				<?php echo $form->bs3_text('Server IP','server_ip',$contract['server_ip'],'','','Masukkan Server IP'); ?>
				<?php echo $form->bs3_text('Nama Pemilik','pic_name',$contract['pic_name'],'','','Masukkan Nama Pemilik'); ?>
				<?php echo $form->bs3_text('Alamat Grosir','company_address',$contract['company_address'],'','','Masukkan Alamat Grosir'); ?>
				<?php echo $form->bs3_phone('Telepon','company_phone1',$contract['company_phone1'],'','','Masukkan Telepon'); ?>
				<?php echo $form->bs3_phone('Telepon Lain','company_phone2',$contract['company_phone2'],'','','Masukkan Telepon Lain'); ?>
				<?php echo $form->bs3_phone('Hand Phone','pic_phone',$contract['pic_phone'],'','','Masukkan Hand Phone'); ?>
				<?php echo $form->bs3_text('Email','email_address',$contract['email_address'],'','','Masukkan Email'); ?>
				<?php echo $form->bs3_date('Tanggal Persetujuan Kontrak','contract_date',$contract['contract_date'],'','','Masukkan Tanggal Persetujuan Kontrak'); ?>
				<?php echo $form->bs3_date('Tanggal Awal','start_date',$contract['start_date'],'','','Masukkan Tanggal Awal'); ?>
				<?php echo $form->bs3_date('Tanggal Berhenti Kontrak','terminate_date',$contract['terminate_date'],'','','Masukkan Tanggal Berhenti Kontrak'); ?>
				<?php echo $form->bs3_dropdown('Status Data','status_data',$status_list,$contract['status_data'],'','Pilih Status Data'); ?>
				<?php echo $form->bs3_submit('Update'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'contract\'">Cancel</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
