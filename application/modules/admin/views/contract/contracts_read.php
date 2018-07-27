
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Nama Grosir','company_name',$contract['company_name'],'readonly'); ?>
				<?php echo $form->bs3_text('Status Grosir','company_status',$contract['company_status'],'readonly'); ?>
				<?php echo $form->bs3_text('Nama Database','db_name',$contract['db_name'],'readonly'); ?>
				<?php echo $form->bs3_text('Server IP','server_ip',$contract['server_ip'],'readonly'); ?>
				<?php echo $form->bs3_text('Nama Pemilik','pic_name',$contract['pic_name'],'readonly'); ?>
				<?php echo $form->bs3_text('Alamat Grosir','company_address',$contract['company_address'],'readonly'); ?>
				<?php echo $form->bs3_text('Telepon','company_phone1',$contract['company_phone1'],'readonly'); ?>
				<?php echo $form->bs3_text('Telepon Lain','company_phone2',$contract['company_phone2'],'readonly'); ?>
				<?php echo $form->bs3_text('Hand Phone','pic_phone',$contract['pic_phone'],'readonly'); ?>
				<?php echo $form->bs3_text('Email','email_address',$contract['email_address'],'readonly'); ?>
				<?php echo $form->bs3_text('Tanggal Persetujuan Kontrak','contract_date',$contract['contract_date'],'readonly'); ?>
				<?php echo $form->bs3_text('Tanggal Awal','start_date',$contract['start_date'],'readonly'); ?>
				<?php echo $form->bs3_text('Tanggal Berhenti Kontrak','terminate_date',$contract['terminate_date'],'readonly'); ?>
				<?php echo $form->bs3_text('Status Data','status_data',$contract['status_data'],'readonly'); ?>
				<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'contract\'">Back</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
