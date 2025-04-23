
document.addEventListener('DOMContentLoaded', function() {
    // Tìm form chỉnh sửa trên trang
    // Giả sử chỉ có một form trên trang này
    const editUserForm = document.querySelector('form');

    if (editUserForm) {
        editUserForm.addEventListener('submit', function(event) {
            // Hiện hộp thoại xác nhận
            const confirmation = confirm('Bạn có chắc chắn muốn lưu các thay đổi này không?');

            // Nếu người dùng chọn "Cancel" (không đồng ý)
            if (!confirmation) {
                event.preventDefault(); // Ngăn chặn form gửi đi
                console.log('Hủy bỏ thao tác lưu.'); // Ghi log (tùy chọn)
            }
            // Nếu người dùng chọn "OK", form sẽ được gửi đi bình thường
        });
    } else {
        console.warn('Không tìm thấy form chỉnh sửa trên trang này.');
    }

    // Thêm các chức năng JavaScript khác tại đây nếu cần
    // Ví dụ: Xử lý validation phía client, thay đổi giao diện động,...

});
