                  <!-- Modal Hapus Produk -->
                  <div class="modal fade" id="modalHapusEmail" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="modalHapusProdukTitle">Konfirmasi Hapus Subscription Email Pelanggan</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  <div class="row">
                                      <div class="col mb-3">
                                          <p class="mb-0">Apakah Anda Yakin Hapus Email: <b id="email"></b>?</p>
                                      </div>
                                  </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                                  <a id="hapus_email_button" class="btn btn-danger" href="">Hapus</a>
                              </div>
                          </div>
                      </div>
                  </div>

                  <script>
                      $(document).ready(function () {
                          $('.button').click(function (e) {
                              e.preventDefault();

                              var modalToShow = $(this).attr('data-bs-target'); // Mengambil data-bs-target dari tombol yang diklik
                              var email = $(this).data('email'); // Mengambil data-id-produk yang berisi id_produk

                              // Menambahkan atribut data-email pada tombol "Hapus" di dalam modal
                              $('#hapus_email_button').attr('href', '<?php echo site_url('Asknsugest/hapusEmail/'); ?>' + email);
                              $('#email').text(email);

                              // Menampilkan modal yang sesuai dengan data-bs-target
                              $(modalToShow).modal('show');
                          });
                      });
                  </script>
