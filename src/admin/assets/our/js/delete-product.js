function confirmDelete(id) {
  swal({
    title: "Yakin Menghapus Akun?",
    text: "Akun yang dihapus tidak dapat dipulihkan!",
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
    customClass: {
      title: "custom-swal-title",
      content: "custom-swal-content",
    },
  }).then((confirm) => {
    if (confirm) {
      window.location.href = "../config/delete-product.php?id=" + id;
    }
  });
}
