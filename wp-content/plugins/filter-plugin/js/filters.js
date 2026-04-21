document.addEventListener("DOMContentLoaded", function() {
    const filters = document.getElementsByClassName('posts-filter');
    const filteredPosts = document.getElementById('filtered-posts');

    Array.from(filters).map(filter => {
        filter.addEventListener('change', function() {
            const selectedFilters = {};

            Array.from(filters).forEach(f => {
                if (f.value) { // Only include non-empty values
                    selectedFilters[f.name] = f.value; // Use the name attribute as the key
                }
            });

            const body = new URLSearchParams({
                action: 'create_filters', 
                ...selectedFilters 
            });

            fetch(ajax_object.ajax_url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: body
            })
            .then(response => response.text())
            .then(data => {
                filteredPosts.innerHTML = data; 
            })
            .catch(error => {
                filteredPosts.innerHTML = '<p>An error has occurred</p>';
                console.error('Error:', error);
            });
        });
    });
});
