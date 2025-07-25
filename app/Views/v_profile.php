<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-2 mt-4">
  <h6 class="mb-4 fw-bold">History Transaksi Pembelian <span class="text-black"><?= $username ?></span></h6>

  <?php if (!empty($buy)) : ?>
    <div class="row row-cols-1 g-1">
      <?php
      usort($buy, function ($a, $b) {
        return strtotime($b['created_at']) - strtotime($a['created_at']);
      });
      ?>
      <?php foreach ($buy as $index => $item) : ?>
        <div class="col">
          <div class="card shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
              <!-- Gambar Produk -->
              <div class="me-4">
                <?php if (!empty($product[$item['id']]) && $product[$item['id']][0]['foto'] != '' && file_exists("img/" . $product[$item['id']][0]['foto'])) : ?>
                  <div class="ratio ratio-1x1" style="width: 100px;">
                    <img src="<?= base_url() . "img/" . $product[$item['id']][0]['foto'] ?>" alt="Produk">
                  </div>
                <?php else : ?>
                  <div class="bg-light d-flex align-items-center justify-content-center rounded border" style="width: 100px; height: 100px;">
                    <span class="text-muted">No Image</span>
                  </div>
                <?php endif; ?>
              </div>

              <!-- Informasi Transaksi -->
              <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h5 class="card-title mb-0 text-black">Transaksi #<?= $item['id'] ?></h5>
                  <span 
                    class="badge rounded-pill d-inline-block text-center" 
                    style="min-width: 80px; background-color: <?= ($item['status'] == "1") ? '#000000' : '#E0E0E0; color: #808080' ?>; ">
                    <?= ($item['status'] == "1") ? "Selesai" : "Diproses" ?>
                  </span>
                </div>
                <p class="text-muted mb-1">Tanggal: <?= $item['created_at'] ?></p>
                <p class="text-muted mb-1">Total Pesanan: <strong>IDR <?= number_format($item['total_harga'], 0, ',', '.')?></strong></p>
                <p class="text-muted">Alamat: <?= $item['alamat'] ?></p>
                <button type="button" class="btn btn-dark btn-sm rounded-pill fw-semibold" data-bs-toggle="modal" data-bs-target="#detailModal-<?= $item['id'] ?>">
                  Detail
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Detail Modal -->
        <div class="modal fade" id="detailModal-<?= $item['id'] ?>" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow">
              <div class="modal-header bg-white border-bottom">
                <h5 class="modal-title fw-semibold text-black">Detail Transaksi #<?= $item['id'] ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body px-4 py-4">
                <p class="text-muted">Alamat<br><?= $item['username'],' | ',$item['phone']?><br><?= $item['alamat']?></p>
                <p class="text-muted">Tanggal: <?= $item['created_at'] ?></p>
                <!-- Daftar Produk -->
                <?php
                  $subtotalProduk = 0;
                  foreach ($product[$item['id']] as $item2):
                  $subtotalProduk += $item2['harga'] * $item2['jumlah'];
                ?>
                  <div class="d-flex mb-3">
                    <div class="me-3" style="width: 90px;">
                      <div class="ratio ratio-1x1">
                        <?php if ($item2['foto'] && file_exists("img/" . $item2['foto'])): ?>
                          <img src="<?= base_url() . "img/" . $item2['foto'] ?>" alt="<?= $item2['nama'] ?>">
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <div class="fw-semibold"><?= $item2['nama'] ?></div>
                      <div class="text-muted small">Qty <?= $item2['jumlah'] ?></div>
                      <div class="mt-1">
                        <?php if (!empty($item2['harga_asli']) && $item2['harga_asli'] > $item2['harga']): ?>
                          <span class="text-muted text-decoration-line-through me-2">IDR <?= number_format($item2['harga_asli'], 0, ',', '.')?></span>
                        <?php endif; ?>
                        <small class="text-muted samll">IDR <?= number_format($item2['harga'], 0, ',', '.')?></small>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>

                <!-- Rincian Biaya -->
                <table class="table table-borderless mt-4">
                  <tbody class="small text-muted">
                    <tr>
                      <td>Subtotal Produk</td>
                      <td class="text-end">IDR <?= number_format($subtotalProduk, 0, ',', '.')?></td>
                    </tr>
                    <tr>
                      <td>Subtotal Pengiriman</td>
                      <td class="text-end">IDR <?= number_format($item['ongkir'], 0, ',', '.')?></td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr class="fw-bold fs-5">
                      <td>Total Pesanan</td>
                      <td class="text-end">IDR <?= number_format($item['total_harga'], 0, ',', '.')?></td>
                    </tr>
                  </tfoot>
                </table>

              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else : ?>
    <div class="alert alert-info text-center">
      Belum ada transaksi.
    </div>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>