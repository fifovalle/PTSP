function showContent(id) {
    var contents = document.querySelectorAll('.form-content');
    contents.forEach(function(content) {
        content.style.display = 'none';
    });
    document.getElementById(id).style.display = 'block';

    // Remove 'selected' class from all spans
    var allOptions = document.querySelectorAll('.box-option');
    allOptions.forEach(function(option) {
        option.classList.remove('selected');
    });

    // Add 'selected' class to the clicked span
    var clickedOption = document.querySelector('#button-option button[onclick="showContent(\'' + id + '\')"] .box-option');
    clickedOption.classList.add('selected');
}
