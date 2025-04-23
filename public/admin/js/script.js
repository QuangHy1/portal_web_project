document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('toggle-btn');
    const sidebar = document.getElementById('sidebar');
    const currentUrl = window.location.href;
    const menuLinks = document.querySelectorAll('.sidebar a.nav-link');
    // Nếu localStorage CHƯA có gì thì mặc định để MỞ sidebar
    if (!localStorage.getItem('sidebar')) {
        localStorage.setItem('sidebar', 'expanded');
    }

    // Thiết lập trạng thái mở hoặc thu gọn theo localStorage
    if (localStorage.getItem('sidebar') === 'expanded') {
        sidebar.classList.add('expand');
    } else {
        sidebar.classList.remove('expand');
    }

    // Sự kiện click toggle
    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('expand');

        if (sidebar.classList.contains('expand')) {
            localStorage.setItem('sidebar', 'expanded');
        } else {
            localStorage.setItem('sidebar', 'collapsed');
        }
    });
    menuLinks.forEach(link => {
        // So sánh pathname thay vì href đầy đủ
        if (window.location.pathname === new URL(link.href).pathname) {
            menuLinks.forEach(l => l.classList.remove('active'));
            link.classList.add('active');

            // Mở dropdown chứa link active nếu có
            const parentCollapse = link.closest('.collapse');
            if (parentCollapse) {
                const parentDropdown = parentCollapse.previousElementSibling;
                if (parentDropdown && parentDropdown.classList.contains('sidebar-link')) {
                    parentDropdown.classList.remove('collapsed');
                    parentCollapse.classList.add('show');
                }
            }
        }
    });

});
