function showContent(id) {
    var contents = document.querySelectorAll('.form-content');
    contents.forEach(function(content) {
        content.style.display = 'none';
    });
    document.getElementById(id).style.display = 'block';
}