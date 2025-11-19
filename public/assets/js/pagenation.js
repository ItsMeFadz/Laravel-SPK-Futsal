
document.addEventListener('DOMContentLoaded', function() {
    // Get all table rows
    const tableRows = document.querySelectorAll('#userTableBody tr');
    const rowsPerPage = 10; // Adjust this number as needed
    const totalPages = Math.ceil(tableRows.length / rowsPerPage);
    const paginationContainer = document.getElementById('pagination');

    // Immediately hide all rows except first page to prevent flash
    tableRows.forEach((row, index) => {
        if (index >= rowsPerPage) {
            row.style.display = 'none';
        }
    });

    // Generate pagination links immediately
    generatePaginationLinks(totalPages);

    function showPage(page) {
        const startIndex = (page - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;

        // Hide all rows
        tableRows.forEach(row => row.style.display = 'none');

        // Show rows for current page
        for (let i = startIndex; i < endIndex && i < tableRows.length; i++) {
            tableRows[i].style.display = '';
        }

        // Update active state in pagination
        const pageLinks = document.querySelectorAll('.page-link');
        pageLinks.forEach(link => {
            link.parentElement.classList.remove('active');
            if (parseInt(link.textContent) === page) {
                link.parentElement.classList.add('active');
            }
        });
    }

    function generatePaginationLinks(totalPages) {
        // Clear existing pagination
        paginationContainer.innerHTML = '';

        // Don't show pagination if there's only one page or no data
        if (totalPages <= 1) {
            return;
        }

        // Previous button
        const prevLi = document.createElement('li');
        prevLi.className = 'page-item prev';
        const prevLink = document.createElement('a');
        prevLink.className = 'page-link';
        prevLink.href = 'javascript:void(0);';
        prevLink.innerHTML = '<i class="tf-icon bx bx-chevrons-left"></i>';
        prevLink.addEventListener('click', function() {
            const currentPage = getCurrentPage();
            if (currentPage > 1) {
                showPage(currentPage - 1);
            }
        });
        prevLi.appendChild(prevLink);
        paginationContainer.appendChild(prevLi);

        // Page numbers
        for (let i = 1; i <= totalPages; i++) {
            const pageLi = document.createElement('li');
            pageLi.className = 'page-item' + (i === 1 ? ' active' : '');
            const pageLink = document.createElement('a');
            pageLink.className = 'page-link';
            pageLink.href = 'javascript:void(0);';
            pageLink.textContent = i;
            pageLink.addEventListener('click', function() {
                showPage(i);
            });
            pageLi.appendChild(pageLink);
            paginationContainer.appendChild(pageLi);
        }

        // Next button
        const nextLi = document.createElement('li');
        nextLi.className = 'page-item next';
        const nextLink = document.createElement('a');
        nextLink.className = 'page-link';
        nextLink.href = 'javascript:void(0);';
        nextLink.innerHTML = '<i class="tf-icon bx bx-chevrons-right"></i>';
        nextLink.addEventListener('click', function() {
            const currentPage = getCurrentPage();
            if (currentPage < totalPages) {
                showPage(currentPage + 1);
            }
        });
        nextLi.appendChild(nextLink);
        paginationContainer.appendChild(nextLi);
    }

    function getCurrentPage() {
        const activeLink = document.querySelector('.pagination .active a');
        return activeLink ? parseInt(activeLink.textContent) : 1;
    }
});