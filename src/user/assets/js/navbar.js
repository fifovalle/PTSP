document.getElementById("btnLogin").addEventListener("click", function() {
    window.location.href = "../pages/login.php";
});

document.getElementById("btnCart").addEventListener("click", function() {
    window.location.href = "../pages/checkout.php";
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

function showContent1(contentId) {
    var buttons = document.querySelectorAll('.row_one');
    var contents = document.querySelectorAll('.content_one');

    // Loop through buttons and remove 'selected' class from all
    buttons.forEach(function(button) {
        button.classList.remove('selected-navbar');
    });

    // Loop through contents and hide all
    contents.forEach(function(content) {
        content.style.display = 'none';
    });

    // Show selected content and mark the button as selected
    document.getElementById(contentId).style.display = 'block';
    event.currentTarget.classList.add('selected-navbar');
}

function showContent2(contentId) {
    var buttons = document.querySelectorAll('.row_three');
    var contents = document.querySelectorAll('.content_three');

    // Loop through buttons and remove 'selected' class from all
    buttons.forEach(function(button) {
        button.classList.remove('selected-navbar');
    });

    // Loop through contents and hide all
    contents.forEach(function(content) {
        content.style.display = 'none';
    });

    // Show selected content and mark the button as selected
    document.getElementById(contentId).style.display = 'block';
    event.currentTarget.classList.add('selected-navbar');
}
