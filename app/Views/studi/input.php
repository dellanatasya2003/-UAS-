<?php
echo $this->extend('template/index');
echo $this->section('content');
?>
<div class="row">
    <div class="col-md-12">
    <div class="card">
              <div class="card-header">
                <h3 class="card-title" ><?php echo $title_card; ?> </h3>
              </div>
              <!-- /.card-header -->
                <form action="<?php echo $action; ?>" method="post">
                <div class="card-body">
                    <?php if (validation_errors()) {
                        ?>
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    <h5><i class="icon fas fa-ban"> </i> Alert!</h5>
                    <?php echo validation_list_errors() ?>
                    </div>
                    <?php
                    }
                    ?>

                <?php
                if (session()->getFlashdata('error')) {
                  ?>
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    <h5><i class="icon fas fa-warning"> </i> Error</h5>
                    <?php echo session()->getFlashdata('error'); ?>
                    </div>
                  <?php
                }
                ?>
                     
                <?php echo csrf_field() ?>
                <?php
                if (current_url(true)->getSegment(2) == 'edit'){
                ?>
                <input type="hidden" name="param" id="param" value="<?php echo $edit_data['prodi']; ?>">
                <?php
                }
                ?>
                <div class="form-group">
                    <label for="prodi">prodi</label>
                    <input type="text" name="prodi" id="prodi" value="<?php echo empty(set_value('prodi')) ? (empty($edit_data['prodi']) ? "":$edit_data['prodi']) : set_value('prodi'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="jenjang">jenjang</label>
                    <input type="text" name="jenjang" id="jenjang" value="<?php echo empty(set_value('jenjang')) ? (empty($edit_data['jenjang']) ? "":$edit_data['jenjang']) : set_value('jenjang'); ?>" class="form-control">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Simpan</button>
            </div>
            </form>
        </div>     
    </div>
</div>
<?php
echo $this->endSection(); 