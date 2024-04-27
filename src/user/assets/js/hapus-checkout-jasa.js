function confirmDeleteCheckoutJasa(id) {
  swal({
    title: "Yakin Menghapus Keranjang Anda?",
    text: "Jasa yang dihapus tidak dapat dikembalikan!",
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
        "../../admin/config/delete-checkout-services.php?id=" + id;
    }
  });
}
