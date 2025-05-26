@extends('Frontend.layouts.masterDashboard')
@section('page_title')
   Viet QR
@endsection
@section('header_shadow')
    head-shadow
@endsection
@section('body_content')
    <div class="container text-center mt-5">
        <h3 class="mb-3">Quét mã VietQR để thanh toán</h3>
        <p style="font-size: 18px; font-weight: bold;">
            ⏳ Thanh toán trong: <span id="countdown">10:00</span>
        </p>
        <p class="mt-3">Mã giao dịch: <strong>{{ $tnxID }}</strong></p>
        <!-- Nút Tôi đã thanh toán -->
        <div class="text-center">
            <button class="btn btn-success px-4 py-2 fw-bold" onclick="confirmPayment()">
                Tôi đã thanh toán
            </button>
        </div>

        <!-- Form ẩn gửi dữ liệu về backend -->
        <form id="paymentConfirmationForm" action="{{ route('employer.boost.confirmPayment') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="tnxID" value="{{ $tnxID }}">
            <input type="hidden" name="package_id" value="{{ $package_id }}">
            <input type="hidden" name="price" value="{{ $amount }}">
            <input type="hidden" name="date_purchased" value="{{ \Carbon\Carbon::now() }}">
        </form>
        <!-- Ảnh QR to rõ ràng -->
        <div class="d-flex justify-content-center my-4">
            <img src="https://img.vietqr.io/image/vietcombank-1016390895-compact2.jpg?amount={{ $amount }}&addInfo={{ $tnxID }}&accountName=Le%20Quang%20Huy"
                 alt="QR VietQR"
                 class="border shadow-lg"
                 style="width: 500px; max-width: 100%; border-radius: 12px;">
        </div>

    </div>


    <script>
        function confirmPayment() {
            if (confirm("Bạn có chắc chắn đã hoàn tất thanh toán không?")) {
                document.getElementById('paymentConfirmationForm').submit();
            }
        }
    </script>



    <script>
        let secondsLeft = 600; // 10 phút = 600 giây
        const countdownElement = document.getElementById('countdown');

        const countdownInterval = setInterval(() => {
            const minutes = Math.floor(secondsLeft / 60);
            const seconds = secondsLeft % 60;

            countdownElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

            if (secondsLeft <= 0) {
                clearInterval(countdownInterval);
                // Hết thời gian thì chuyển về trang danh sách boost
                window.location.href = "{{ route('employer.employee.boost') }}";
            }

            secondsLeft--;
        }, 1000);
    </script>

@endsection
