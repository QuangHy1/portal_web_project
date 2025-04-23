<!-- Tìm kiếm bằng JS (chỉ hoạt động trên trang hiện tại) -->
    document.getElementById('searchUser').addEventListener('keyup', function () {
    let keyword = this.value.toLowerCase();
    let rows = document.querySelectorAll('#userTable tr');

    rows.forEach(row => {
    let username = row.cells[1].innerText.toLowerCase();
    let email = row.cells[2].innerText.toLowerCase();
    let role = row.cells[3].innerText.toLowerCase();

    if (username.includes(keyword) || email.includes(keyword) || role.includes(keyword)) {
    row.style.display = '';
} else {
    row.style.display = 'none';
}
});
});
