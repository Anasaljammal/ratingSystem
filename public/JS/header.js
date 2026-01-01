// Modern Header JavaScript - Uses CSS Classes Instead of Inline Styles
var types = document.querySelectorAll('.type-container');
var search = document.getElementById('search-input');
var search_form = document.getElementById('form-search');
var search_title = document.getElementById('search-title');

if (types && types.length > 0) {
    for (let i = 0; i < types.length; i++) {
        types[i].addEventListener('click', () => {
            // Remove active class from all types
            types.forEach(type => type.classList.remove('active'));
            // Add active class to clicked type
            types[i].classList.add('active');
            
            if (i == 0) {
                if (search) {
                    search.setAttribute('placeholder', 'sections, services');
                    search.setAttribute('name', 'all');
                }
                if (search_title) search_title.innerText = 'Search All';
                sessionStorage.setItem('search_type', 'all');
            } else if (i == 1) {
                if (search) {
                    search.setAttribute('placeholder', 'sections');
                    search.setAttribute('name', 'sections');
                }
                if (search_title) search_title.innerText = 'Sections';
                sessionStorage.setItem('search_type', 'sections');
            } else if (i == 2) {
                if (search) {
                    search.setAttribute('placeholder', 'services');
                    search.setAttribute('name', 'services');
                }
                if (search_title) search_title.innerText = 'Services';
                sessionStorage.setItem('search_type', 'services');
            }
        });
    }
    
    // Restore saved search type on page load
    if (search && search_title) {
        if (sessionStorage.getItem('search_type') == 'all') {
            search.setAttribute('placeholder', 'sections, services');
            search.setAttribute('name', 'all');
            search_title.innerText = 'Search All';
            if (types[0]) types[0].classList.add('active');
            if (types[1]) types[1].classList.remove('active');
            if (types[2]) types[2].classList.remove('active');
        } else if (sessionStorage.getItem('search_type') == 'services') {
            search.setAttribute('placeholder', 'services');
            search.setAttribute('name', 'services');
            search_title.innerText = 'Services';
            sessionStorage.setItem('search_type', 'services');
            if (types[2]) types[2].classList.add('active');
            if (types[1]) types[1].classList.remove('active');
            if (types[0]) types[0].classList.remove('active');
        } else if (sessionStorage.getItem('search_type') == 'sections') {
            search.setAttribute('placeholder', 'sections');
            search.setAttribute('name', 'sections');
            search_title.innerText = 'Sections';
            if (types[1]) types[1].classList.add('active');
            if (types[0]) types[0].classList.remove('active');
            if (types[2]) types[2].classList.remove('active');
        }
    }
}
