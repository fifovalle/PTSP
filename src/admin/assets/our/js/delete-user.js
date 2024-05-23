function confirmDeleteUser(id, type) {
  swal({
    title:
      "Yakin Menghapus " + (type === "pengguna" ? "Pengguna?" : "Perusahaan?"),
    text:
      (type === "pengguna" ? "Pengguna" : "Perusahaan") +
      " yang dihapus tidak dapat dipulihkan!",
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
        "../config/delete-user.php?id=" + id + "&type=" + type;
    }
  });
}
