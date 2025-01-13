<?php $this->extend('/layouts/admin'); ?>
<?php $this->section('content'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Form Tambah Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Form Tambah Produk</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow card-primary">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Produk</h6>
                            <?php if (session()->getFlashdata('errors')): ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                            <li><?= esc($error) ?></li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <?php if (session()->getFlashdata('new_product')): ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('new_product'); ?>
                                </div>
                            <?php endif; ?>
                            
                            <form action="/product/store" method="POST" enctype="multipart/form-data">
                                <?= csrf_field(); ?>

                                <!-- <div class="form-group">
                                    <label for="id_product">ID Produk</label>
                                    <input type="text" class="form-control" id="id_product" name="id_product" required placeholder="Masukkan ID Produk">
                                </div> -->
                                
                                <div class="form-group">
                                    <label for="nama_product">Nama Produk</label>
                                    <input type="text" class="form-control" id="nama_product" name="nama_product" required>
                                </div>

                                <div class="form-group">
                                    <label for="product_detail">Detail Produk</label>
                                    <textarea class="form-control" id="product_detail" name="product_detail" rows="4" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="number" class="form-control" id="harga" name="harga" required>
                                </div>

                                <div class="form-group">
                                    <label for="diskon">Diskon</label>
                                    <input type="number" class="form-control" id="diskon" name="diskon" required>
                                </div>

                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input type="number" class="form-control" id="stok" name="stok" required>
                                </div>

                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select class="form-control" id="kategori" name="id_kategori" required>
                                        <option value="Makeup">Makeup</option>
                                        <option value="Skincare">Skincare</option>
                                        <option value="Hairnbody">Hair & Body</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="gambar_1">Gambar 1</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="gambar_1" name="gambar_1" onchange="updateFileNameAndPreview('gambar_1', 'preview-gambar_1', 'file-name-1')">
                                        <label class="custom-file-label" for="gambar_1">Pilih file</label>
                                    </div>
                                    <span id="file-name-1" class="mt-2 text-muted"></span>
                                    <img id="preview-gambar_1" class="mt-2 img-fluid" style="max-width: 30%; display:none;" />
                                </div>

                                <div class="form-group">
                                    <label for="gambar_2">Gambar 2</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="gambar_2" name="gambar_2" onchange="updateFileNameAndPreview('gambar_2', 'preview-gambar_2', 'file-name-2')">
                                        <label class="custom-file-label" for="gambar_2">Pilih file</label>
                                    </div>
                                    <span id="file-name-2" class="mt-2 text-muted"></span>
                                    <img id="preview-gambar_2" class="mt-2 img-fluid" style="max-width: 30%; display:none;" />
                                </div>

                                <div class="form-group">
                                    <label for="gambar_3">Gambar 3</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="gambar_3" name="gambar_3" onchange="updateFileNameAndPreview('gambar_3', 'preview-gambar_3', 'file-name-3')">
                                        <label class="custom-file-label" for="gambar_3">Pilih file</label>
                                    </div>
                                    <span id="file-name-3" class="mt-2 text-muted"></span>
                                    <img id="preview-gambar_3" class="mt-2 img-fluid" style="max-width: 30%; display:none;" />
                                </div>

                                <div class="form-group">
                                    <label for="gambar_4">Gambar 4</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="gambar_4" name="gambar_4" onchange="updateFileNameAndPreview('gambar_4', 'preview-gambar_4', 'file-name-4')">
                                        <label class="custom-file-label" for="gambar_4">Pilih file</label>
                                    </div>
                                    <span id="file-name-4" class="mt-2 text-muted"></span>
                                    <img id="preview-gambar_4" class="mt-2 img-fluid" style="max-width: 30%; display:none;" />
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="manfaat">Manfaat</label>
                                    <textarea class="form-control" id="manfaat" name="manfaat" rows="4" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="kandungan">Kandungan</label>
                                    <textarea class="form-control" id="kandungan" name="kandungan" rows="4" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="cara_penggunaan">Cara Penggunaan</label>
                                    <textarea class="form-control" id="cara_penggunaan" name="cara_penggunaan" rows="4" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="ukuran">Ukuran</label>
                                    <input type="text" class="form-control" id="ukuran" name="ukuran" required>
                                </div>

                                <div class="form-group">
                                    <label for="no_bpom">No. BPOM</label>
                                    <input type="text" class="form-control" id="no_bpom" name="no_bpom" required>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Simpan Produk</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateFileNameAndPreview(fileId, previewId, fileNameId) {
    const fileInput = document.getElementById(fileId);
    const fileName = fileInput.files[0] ? fileInput.files[0].name : '';
    const label = fileInput.nextElementSibling;
    const fileNameSpan = document.getElementById(fileNameId);
    const previewImage = document.getElementById(previewId);

    // Update the file name label
    fileNameSpan.textContent = fileName;
    label.textContent = fileName || 'Pilih file';

    // Display the selected image preview
    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.style.display = 'block'; // Show the image
            previewImage.src = e.target.result; // Set the preview image source
        };
        reader.readAsDataURL(fileInput.files[0]);
    } else {
        previewImage.style.display = 'none'; // Hide the image if no file is selected
    }
}
</script>

<?php $this->endSection(); ?>
