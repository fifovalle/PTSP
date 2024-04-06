function confirmDeleteHistoryTransaction(id) {
  swal({
    title: "Yakin Menghapus Riwayat Transaksi?",
    text: "Riwayat Transaksi yang dihapus tidak dapat dipulihkan!",
    icon: "warning",
    buttons: {
      cancel: {
        text: "Batal",
        value: null,
        visible: true,
        className: "",
        closeModal: true,
      },
      confirm: {
        text: "Ya, Hapus",
        value: true,
        visible: true,
        className: "",
        closeModal: true,
      },
    },
  }).then((confirm) => {
    if (confirm) {
      window.location.href =
        "http://localhost/PTSP/src/admin/config/delete-history-transaction.php?id=" +
        id;
    }
  });
}
