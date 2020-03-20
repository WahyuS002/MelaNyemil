<div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800 text-center"><?=$title;?></h1>
          
          <button class="btn btn-sm btn-primary"data-toggle="modal" data-target="#tambah_barang"><i class="fas fa-fw fa-plus"></i>Tambah Barang</button>
  <table class="table table-bordered ">
    <tr>
      <th class="bg-secondary text-white">No</th>
      <th class="bg-secondary text-white">Nama Barang</th>
      <th class="bg-secondary text-white">Keterangan</th>
      <th class="bg-secondary text-white">Harga</th>
      <th class="bg-secondary text-white">Stok</th>
      <th class="bg-secondary text-white">Gambar</th>

      <th class="bg-secondary text-white" colspan="3">Action</th>

    </tr>
    <?php
    $no=1;
    foreach($barang1 as $brg1):
      ?>
      <tr>
        <td><?=$no++ ?></td>
        <td><?=$brg1->nama ?></td>
        <td><?=$brg1->keterangan ?></td>
        <td>Rp. <?=$brg1->harga ?></td>
        <td><?=$brg1->stok ?> Buah</td>
        <td><?=$brg1->gambar ?></td>
        <td><?php echo anchor('Admin/edit1/'.$brg1->id_brg1,'<div class="btn btn-success btn-sm"><i class="fas fa-fw fa-edit"></i></div>');?></td>
        <td><?php echo anchor('Admin/hapus1/'.$brg1->id_brg1,'<div class="btn btn-danger btn-sm"><i class="fas fa-fw fa-trash"></i></div>')?></td>
      </tr>
    <?php endforeach;?>
    
  </table>
<!-- Modal -->
<div class="modal fade" id="tambah_barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Data Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="<?= base_url('Admin/tambah_aksi1');?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label> Nama Barang</label>
          <input type="text" name="nama" class="form-control">
        <div class="form-group">
          <label> Keterangan Barang</label>
          <input type="text" name="keterangan" class="form-control">
        <div class="form-group">
          <label> Harga Barang</label>
          <input type="number" name="harga" class="form-control">
        <div class="form-group">
          <label> Stok Barang</label>
          <input type="number" name="stok" class="form-control">
        <div class="form-group">
          <label> Gambar Barang</label>
          <input type="file" name="gambar" class="form-control">
                  
        </div>
      

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
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