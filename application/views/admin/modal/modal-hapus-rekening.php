                <!-- Modal Hapus Rekening -->
                <div class="modal fade" id="modalHapusRekening" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalHapusRekeningTitle">Konfirmasi Hapus Rekening</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-3">
                                        <p class="mb-0">Apakah Anda Yakin Menghapus Data Rekening: <b id="nama_rekening"></b>?</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button id="hapus_button" type="button" class="btn btn-danger">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function () {
                        $('.button').click(function (e) {
                            e.preventDefault();

                            var modalToShow = $(this).attr('data-bs-modal');
                            var idRekening = $(this).data('id-rekening');
                            var namaRekening = $(this).data('namarekening');
                            var hapusUrl = $(this).data('hapus-url');

                            // Set nilai data pada modal
                            $('#nama_rekening').text(namaRekening);

                            // Mengarahkan pengguna ke URL penghapusan yang sesuai saat tombol "Hapus" ditekan
                            $('#hapus_button').click(function () {
                                window.location.href = hapusUrl;
                            });

                            // Menampilkan modal
                            $('#' + modalToShow).modal('show');
                        });
                    });
                </script>
