document.getElementById("btnLogin").addEventListener("click", function() {
    window.location.href = "login.php";
});

document.getElementById("btnCart").addEventListener("click", function() {
    window.location.href = "checkout.php";
});
document.getElementById("btnCart").addEventListener("click", function() {
    window.location.href = "checkout.php";
});

//// Script Button Content Tarif Pelayanan ///
function showContent1(id) {
    var contents = document.querySelectorAll('.content_one');
    contents.forEach(function(content) {
        content.style.display = 'none';
    });
    document.getElementById(id).style.display = 'block';
}
function showContent2(id) {
    var contents = document.querySelectorAll('.content_three');
    contents.forEach(function(content) {
        content.style.display = 'none';
    });
    document.getElementById(id).style.display = 'block';
}
//// End Script Button Content Tarif Pelayanan ///