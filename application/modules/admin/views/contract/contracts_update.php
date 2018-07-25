
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Nama Grosir','company_name',$contract['company_name']); ?>
				<?php echo $form->bs3_text('Nama Database','db_name',$contract['db_name']); ?>
				<?php echo $form->bs3_text('Server IP','server_ip',$contract['server_ip']); ?>
				<?php echo $form->bs3_text('Nama Pemilik','pic_name',$contract['pic_name']); ?>
				<?php echo $form->bs3_text('Alamat Grosir','company_address',$contract['company_address']); ?>
				<?php echo $form->bs3_phone('Telepon','company_phone1',$contract['company_phone1']); ?>
				<?php echo $form->bs3_phone('Telepon Lain','company_phone2',$contract['company_phone2']); ?>
				<?php echo $form->bs3_phone('Hand Phone','pic_phone',$contract['pic_phone']); ?>
				<?php echo $form->bs3_text('Email','email_address',$contract['email_address']); ?>
				<?php echo $form->bs3_date('Tanggal Persetujuan Kontrak','contract_date',$contract['contract_date']); ?>
				<?php echo $form->bs3_date('Tanggal Awal','start_date',$contract['start_date']); ?>
				<?php echo $form->bs3_date('Tanggal Berhenti Kontrak','terminate_date',$contract['terminate_date']); ?>
				<?php echo $form->bs3_dropdown('Status Data','status_data',$status_list,$contract['status_data'],'','Pilih status data') ?>
				<?php echo $form->bs3_submit('Update'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'contract\'">Cancel</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
