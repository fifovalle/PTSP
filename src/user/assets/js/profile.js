// Get all dot elements
const dots = document.querySelectorAll('.dot');

// Loop through each dot element
dots.forEach(dot => {
    // Add click event listener
    dot.addEventListener('click', () => {
        // Remove active class from all dots
        dots.forEach(d => d.classList.remove('active'));
        // Add active class to the clicked dot
        dot.classList.add('active');
    });
});
function showProfileSetting(id) {
    // Hide all content sections
    var contentSections = document.querySelectorAll('.col-md-10');
    contentSections.forEach(function(section) {
        section.style.display = 'none';
    });
    
    // Display the selected content section
    document.getElementById(id).style.display = 'block';
}
