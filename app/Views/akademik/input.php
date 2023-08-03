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
                <input type="hidden" name="param" id="param" value="<?php echo $edit_data['tahun']; ?>">
                <?php
                }
                ?>
                <div class="form-group">
                    <label for="tahun">tahun</label>
                    <input type="text" name="tahun" id="tahun" value="<?php echo empty(set_value('tahun')) ? (empty($edit_data['tahun']) ? "":$edit_data['tahun']) : set_value('tahun'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="sebaran">sebaran</label>
                    <input type="text" name="sebaran" id="sebaran" value="<?php echo empty(set_value('sebaran')) ? (empty($edit_data['sebaran']) ? "":$edit_data['sebaran']) : set_value('sebaran'); ?>" class="form-control">
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