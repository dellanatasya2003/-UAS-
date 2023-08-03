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
                <input type="hidden" name="param" id="param" value="<?php echo $edit_data['npm']; ?>">
                <?php
                }
                ?>
                <div class="form-group">
                    <label for="npm">npm</label>
                    <input type="text" name="npm" id="npm" value="<?php echo empty(set_value('npm')) ? (empty($edit_data['npm']) ? "":$edit_data['npm']) : set_value('npm'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nama">nama</label>
                    <input type="text" name="nama" id="nama" value="<?php echo empty(set_value('nama')) ? (empty($edit_data['nama']) ? "":$edit_data['nama']) : set_value('nama'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="alamat">alamat</label>
                    <input type="text" name="alamat" id="alamat" value="<?php echo empty(set_value('alamat')) ? (empty($edit_data['alamat']) ? "":$edit_data['alamat']) : set_value('alamat'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="asrama">asrama</label>
                    <input type="text" name="asrama" id="asrama" value="<?php echo empty(set_value('asrama')) ? (empty($edit_data['asrama']) ? "":$edit_data['asrama']) : set_value('asrama'); ?>" class="form-control">
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