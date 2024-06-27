                  <!-- Modal Blokir-->
                  <div class="modal fade" id="modalBlokir"  aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalBlokirTitle">Konfirmasi Blokir Admin</h5>
                          <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col mb-3">
                              <p class="mb-0">Apakah Anda Yakin Blokir Admin dengan Nama: <b id="nama_admin_modal"></b>?</p>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button> 
                            <button id="blokir_button"  type="button" class="btn btn-danger">Blokir</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <script>
                    $(document).ready(function() {
                        $('.button').click(function(e) {
                            e.preventDefault();

                            var modalToShow = $(this).attr('data-bs-modal'); // Mengambil data-bs-modal dari tombol yang diklik
                            var idAdmin = $(this).data('id-admin'); // Mengambil data-id yang berisi id_admin
                            var namaAdmin = $(this).data('namaadmin'); // Mengambil data-namaadmin yang berisi nama admin

                            // Menambahkan atribut data-id-admin pada tombol "Blokir" di dalam modal
                            $('#blokir_button').attr('data-id-admin', idAdmin);
                            $('#nama_admin_modal').text(namaAdmin);

                            // Menampilkan modal yang sesuai dengan data-bs-modal
                            $('#' + modalToShow).modal('show');
                        });

                        // Mengarahkan pengguna ke controller Admin/blokirAdmin/$id_admin saat tombol "Blokir" di dalam modal ditekan
                        $('#blokir_button').click(function() {
                            var idAdmin = $(this).data('id-admin');
                            window.location.href = '<?php echo base_url("index.php/Admin/blokirAdmin/"); ?>' + idAdmin;
                        });
                    });
                  </script>