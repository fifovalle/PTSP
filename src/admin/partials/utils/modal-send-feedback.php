<div class="modal fade" id="sendFeedbackModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo htmlspecialchars('Kirim Masukan'); ?></h1>
                <div class="modalClose" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body">
                <form action="<?php echo htmlspecialchars($akarUrl); ?>src/admin/config/send-feedback.php" method="post">
                    <div class="mb-3">
                        <label for="frontNameAddAdmin" class="form-label"><?php echo htmlspecialchars('Nama Depan'); ?></label>
                        <input type="text" name="Nama_Depan_Pengirim" class="form-control inputData" placeholder="<?php echo htmlspecialchars('Masukan Nama Depan Admin'); ?>" id="frontNameAddAdmin" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="backNameAddAdmin" class="form-label"><?php echo htmlspecialchars('Nama Belakang'); ?></label>
                        <input type="text" name="Nama_Belakang_Pengirim" class="form-control inputData" placeholder="<?php echo htmlspecialchars('Masukan Nama Belakang Admin'); ?>" id="backNameAddAdmin" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="emailAddAdmin" class="form-label"><?php echo htmlspecialchars('Email'); ?></label>
                        <input type="email" name="Email_Pengirim" class="form-control inputData" placeholder="<?php echo htmlspecialchars('Masukan Email Admin'); ?>" id="emailAddAdmin" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="numberAddAdmin" class="form-label"><?php echo htmlspecialchars('Nomor Telepon'); ?></label>
                        <div class="input-group">
                            <span class="input-group-text spanNumberData">+62</span>
                            <input type="number" name="No_Telepon_Pengirim" placeholder="<?php echo htmlspecialchars('Masukan Nomor Telepon Admin'); ?>" class="form-control inputData" id="numberAddAdmin" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="addressAddAdmin" class="form-label"><?php echo htmlspecialchars('Pesan Anda'); ?></label>
                        <textarea name="Pesan_Pengirim" placeholder="<?php echo htmlspecialchars('Masukan Pesan Anda'); ?>" class="form-control inputData addressAddAdmin" id="addressAddAdmin" autocomplete="off"></textarea>
                    </div>
                    <div class="pemuat" id="pemuat1"></div>
                    <button type="submit" class="btn btnUpload" name="Kirim" id="btnKirim"><?php echo htmlspecialchars('Kirim'); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>