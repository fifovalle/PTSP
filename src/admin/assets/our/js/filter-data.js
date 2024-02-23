$(document).ready(function () {
  $(".menu p").click(function () {
    $(".menu p").removeClass("active");
    $(this).addClass("active");

    let menuText = $(this).text();
    if (menuText === "Admin") {
      $("#dropdownFilter").html(`
            <div class="col listDropdownFilter">
            <span>Nama Pengguna</span>
            </div>
            <div class="col listDropdownFilter">
            <span>Email</span>
            </div>`);
    } else if (menuText === "Pengguna") {
      $("#dropdownFilter").html(`
            <div class="col listDropdownFilter">
            <span>Nama Pengguna</span>
            </div>
            <div class="col listDropdownFilter">
            <span>Email</span>
            </div>`);
    } else if (menuText === "Produk") {
      $("#dropdownFilter").html(`
            <div class="col listDropdownFilter">
            <span>Nama Produk</span>
            </div>
            <div class="col listDropdownFilter">
            <span>Status Produk</span>
            </div>`);
    } else {
      $("#dropdownFilter").html(`
            <div class="col listDropdownFilter">
            <span>Nama Produk</span>
            </div>
            <div class="col listDropdownFilter">
            <span>Status Transaksi</span>
            </div>`);
    }
  });
});
