@extends('Frontend.layouts.masterDashboard')
@section('page_title')
    #1 Job Portal Company
@endsection
@section('header_shadow')
    head-shadow
@endsection
@section('body_content')
    @include('Frontend.layouts.employeeDashboardNav')
    <style>
        .no-select {
   -webkit-user-select: none;
   -moz-user-select: none;
   -ms-user-select: none;
   user-select: none;
   pointer-events: none;
}

    </style>
    <div class="dashboard-content">
        <div class="dashboard-widg-bar d-block">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h3 class="text-center mb-4">Xác nhận xóa tài khoản</h3>
                            <p class="mb-4">
                                Bạn có chắc chắn muốn xóa tài khoản của mình không? Hành động này là không thể hoàn tác
                                và sẽ xóa vĩnh viễn tất cả dữ liệu của bạn khỏi máy chủ của chúng tôi. Sau khi tài khoản
                                của bạn bị xóa, bạn sẽ không thể truy cập bất kỳ thông tin hoặc cài đặt nào của mình.
                                <br><br>
                                Nếu bạn tiến hành xóa tài khoản, tài khoản của bạn và tất cả dữ liệu liên quan sẽ bị xóa
                                vĩnh viễn khỏi máy chủ của chúng tôi. Điều này bao gồm tất cả thông tin cá nhân, tin nhắn,
                                và bất kỳ dữ liệu nào khác mà bạn đã lưu trữ trên nền tảng của chúng tôi.
                                <br><br>
                                Xin lưu ý rằng chúng tôi sẽ không thể khôi phục tài khoản của bạn hoặc bất kỳ dữ liệu nào
                                sau khi tài khoản đã bị xóa. <br>
                                Nếu bạn chắc chắn muốn tiếp tục, vui lòng nhập văn bản xác nhận bên dưới để xóa tài khoản của bạn:
                            </p>

                            <p class="border bg-light p-3 mb-4 no-select"><strong>TÔI ĐỒNG Ý XÓA TÀI KHOẢN.</strong></p>

                            <form action="{{ route('admin.employee.delete', Auth::guard('employee')->user()->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="confirm-text">Nhập:</label>
                                    <input autocomplete="off" type="text" class="form-control" id="confirm-text"
                                           oninput="this.value = this.value.toUpperCase()"
                                           name="confirm-text" required>
                                </div>
                                <button type="submit" class="btn btn-danger btn-block">Xóa Tài Khoản</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const confirmText = "TÔI ĐỒNG Ý XÓA TÀI KHOẢN.";

            const form = document.querySelector('form');
            const confirmInput = document.querySelector('#confirm-text');
            const deleteBtn = document.querySelector('button[type="submit"]');

            deleteBtn.disabled = true;

            confirmInput.addEventListener('input', () => {
                if (confirmInput.value.trim() === confirmText) {
                    deleteBtn.disabled = false;
                    confirmInput.classList.remove('is-invalid');
                    removeFeedback();
                } else {
                    deleteBtn.disabled = true;
                    confirmInput.classList.add('is-invalid');
                    showFeedback();
                }
            });

            form.addEventListener('submit', (event) => {
                if (deleteBtn.disabled) {
                    event.preventDefault();
                    confirmInput.classList.add('is-invalid');
                    showFeedback();
                }
            });

            function showFeedback() {
                if (!document.querySelector('.invalid-feedback')) {
                    const errorDiv = document.createElement('div');
                    errorDiv.classList.add('invalid-feedback');
                    errorDiv.innerHTML = 'Vui lòng nhập chính xác đoạn xác nhận để xóa tài khoản.';
                    confirmInput.parentNode.appendChild(errorDiv);
                }
            }

            function removeFeedback() {
                const feedback = document.querySelector('.invalid-feedback');
                if (feedback) {
                    feedback.remove();
                }
            }
        </script>
    @endsection
