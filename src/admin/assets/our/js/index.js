function toggleDropdown() {
  let dropdownMenu = document.getElementById("dropdownMenu");
  dropdownMenu.classList.toggle("show");
}
document.addEventListener("click", function (event) {
  let dropdownMenu = document.getElementById("dropdownMenu");
  !event.target.closest(".dropdown") && dropdownMenu.classList.contains("show")
    ? dropdownMenu.classList.remove("show")
    : null;
});

function toggleDropdownUpload() {
  let dropdownMenu = document.getElementById("dropdownMenuUpload");
  dropdownMenu.classList.toggle("show");
}
document.addEventListener("click", function (event) {
  let dropdownMenu = document.getElementById("dropdownMenuUpload");
  !event.target.closest(".dropdown") && dropdownMenu.classList.contains("show")
    ? dropdownMenu.classList.remove("show")
    : null;
});

function showOverlay() {
  $(".overlay").addClass("show");
}

function hideOverlay() {
  $(".overlay").removeClass("show");
}

$("#searchInput").on("focus input", function () {
  showOverlay();
  let $dropdownMenu = $(this).siblings(".dropdown-menu");
  $dropdownMenu.addClass("show");
  if ($(this).val().trim() !== "") {
    $(this).siblings(".close-icon").show();
  } else {
    $(this).siblings(".close-icon").hide();
  }
});

$(".close-icon").on("click", function () {
  hideOverlay();
  $(this).siblings(".dropdown-menu").removeClass("show");
  $(this).hide();
  $("#searchInput").val("");
});

$("body").on("click", function (event) {
  let $target = $(event.target);
  let $dropdown = $(".dropdown");
  let $dropdownMenu = $(".dropdown-menu");
  let $searchInput = $("#searchInput");
  if (!$target.closest($dropdown).length && !$target.is($searchInput)) {
    hideOverlay();
    $dropdownMenu.removeClass("show");
    $(".close-icon").hide();
    $searchInput.val("");
  }
});

document.getElementById("btnKirim").addEventListener("click", function () {
  document.getElementById("btnKirim").style.display = "none";
  document.getElementById("pemuat1").style.display = "block";
});

function sendAdminData() {
  setTimeout(function () {
    let btnKirim = document.getElementById("btnKirim");
    btnKirim.addEventListener("click", function () {
      sendAdminData();
    });
  }, 5000);
}

document.getElementById("btnSimpan").addEventListener("click", function () {
  document.getElementById("btnSimpan").style.display = "none";
  document.getElementById("pemuat2").style.display = "block";
});

function sendAdminData() {
  setTimeout(function () {
    let btnSimpan = document.getElementById("btnSimpan");
    btnKirim.addEventListener("click", function () {
      sendAdminData();
    });
  }, 5000);
}
