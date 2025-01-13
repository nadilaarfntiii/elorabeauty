<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Produk</li>
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
                            <h6 class="m-0 font-weight-bold text-primary">Form Edit Produk</h6>
                            <?php if (session()->getFlashdata('edit_product')): ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('edit_product'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <form action="/product/update/<?= $product['id_product']; ?>" method="POST" enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <div class="form-group">
                                    <label for="nama_product">Nama Produk</label>
                                    <input type="text" class="form-control" id="nama_product" name="nama_product" value="<?= old('nama_product', $product['nama_product']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="product_detail">Detail Produk</label>
                                    <input type="text" class="form-control" id="product_detail" name="product_detail" value="<?= old('product_detail', $product['product_detail']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="id_kategori">Kategori Produk</label>
                                    <select class="form-control" id="id_kategori" name="id_kategori" required>
                                        <option value="" disabled hidden>Pilih kategori</option>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?= esc($category['nm_kategori']); ?>" 
                                                <?= (old('id_kategori', $product['id_kategori']) == $category['nm_kategori']) ? 'selected' : ''; ?>>
                                                <?= esc($category['nm_kategori']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="form-text text-muted">Pilih kategori yang sesuai dengan jenis produk.</small>
                                </div>

                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="number" class="form-control" id="harga" name="harga" value="<?= old('harga', $product['harga']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="diskon">Diskon</label>
                                    <input type="number" class="form-control" id="diskon" name="diskon" value="<?= old('diskon', $product['diskon']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input type="number" class="form-control" id="stok" name="stok" value="<?= old('stok', $product['stok']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="gambar_1">Gambar Produk 1</label><br>
                                    <img id="preview_gambar_1" src="/uploads/<?= esc($product['gambar_1']); ?>" alt="Gambar 1" width="100" style="<?= $product['gambar_1'] ? '' : 'display: none;'; ?>">
                                    <div class="custom-file mt-2">
                                        <input type="file" class="custom-file-input" id="gambar_1" name="gambar_1" onchange="updateFilePreview('gambar_1')">
                                        <label class="custom-file-label" for="gambar_1">Pilih file</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="gambar_2">Gambar Produk 2</label><br>
                                    <img id="preview_gambar_2" src="/uploads/<?= esc($product['gambar_2']); ?>" alt="Gambar 2" width="100" style="<?= $product['gambar_2'] ? '' : 'display: none;'; ?>">
                                    <div class="custom-file mt-2">
                                        <input type="file" class="custom-file-input" id="gambar_2" name="gambar_2" onchange="updateFilePreview('gambar_2')">
                                        <label class="custom-file-label" for="gambar_1">Pilih file</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="gambar_3">Gambar Produk 3</label><br>
                                    <img id="preview_gambar_3" src="/uploads/<?= esc($product['gambar_3']); ?>" alt="Gambar 3" width="100" style="<?= $product['gambar_3'] ? '' : 'display: none;'; ?>">
                                    <div class="custom-file mt-2">
                                        <input type="file" class="custom-file-input" id="gambar_3" name="gambar_3" onchange="updateFilePreview('gambar_3')">
                                        <label class="custom-file-label" for="gambar_3">Pilih file</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="gambar_4">Gambar Produk 4</label><br>
                                    <img id="preview_gambar_4" src="/uploads/<?= esc($product['gambar_4']); ?>" alt="Gambar 4" width="100" style="<?= $product['gambar_4'] ? '' : 'display: none;'; ?>">
                                    <div class="custom-file mt-2">
                                        <input type="file" class="custom-file-input" id="gambar_4" name="gambar_4" onchange="updateFilePreview('gambar_4')">
                                        <label class="custom-file-label" for="gambar_4">Pilih file</label>
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required><?= old('deskripsi', $product['deskripsi']); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="manfaat">Manfaat</label>
                                    <textarea class="form-control" id="manfaat" name="manfaat" rows="3" required><?= old('manfaat', $product['manfaat']); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="kandungan">Kandungan</label>
                                    <textarea class="form-control" id="kandungan" name="kandungan" rows="3" required><?= old('kandungan', $product['kandungan']); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="cara_penggunaan">Cara Penggunaan</label>
                                    <textarea class="form-control" id="cara_penggunaan" name="cara_penggunaan" rows="3" required><?= old('cara_penggunaan', $product['cara_penggunaan']); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="ukuran">Ukuran</label>
                                    <input type="text" class="form-control" id="ukuran" name="ukuran" value="<?= old('ukuran', $product['ukuran']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="no_bpom">Nomor BPOM</label>
                                    <input type="text" class="form-control" id="no_bpom" name="no_bpom" value="<?= old('no_bpom', $product['no_bpom']); ?>" required>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateFilePreview(fileId) {
    const fileInput = document.getElementById(fileId);
    const label = fileInput.nextElementSibling;
    const fileName = fileInput.files[0] ? fileInput.files[0].name : 'Pilih file';
    label.textContent = fileName;

    // Pratinjau gambar
    const previewImage = document.getElementById('preview_' + fileId);
    if (fileInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewImage.style.display = 'block';
        };
        reader.readAsDataURL(fileInput.files[0]);
    } else {
        previewImage.style.display = 'none';
    }
}
</script>

<?= $this->endSection() ?>
