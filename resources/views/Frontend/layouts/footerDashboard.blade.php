
					<!-- footer -->
					<div class="row">
						<div class="col-md-12">
							<div class="py-3"><p class="mb-0">© 2025 JobPortal. Developed By <a href="#">Le Quang Huy</a>.</p></div>
						</div>
					</div>

				</div>

			</div>
			<!-- ======================= dashboard Detail End ======================== -->

			<a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>


		</div>
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->

		<!-- ============================================================== -->
		<!-- All Jquery -->
		<!-- ============================================================== -->
		<script src="{{ asset('frontEndAssets/js/jquery.min.js') }}"></script>
		<script src="{{ asset('frontEndAssets/js/popper.min.js') }}"></script>
		<script src="{{ asset('frontEndAssets/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('frontEndAssets/js/slick.js') }}"></script>
		<script src="{{ asset('frontEndAssets/js/slider-bg.js') }}"></script>
		<script src="{{ asset('frontEndAssets/js/smoothproducts.js') }}"></script>
		<script src="{{ asset('frontEndAssets/js/snackbar.min.js') }}"></script>
		<script src="{{ asset('frontEndAssets/js/jQuery.style.switcher.js') }}"></script>
		<script src="{{ asset('frontEndAssets/js/custom.js') }}"></script>
		<script>
			$(function() {
  $(document).on('click', '.btn-add', function(e) {
    e.preventDefault();

    var dynaForm = $('.dynamic-wrap'),
      currentEntry = $(this).parents('.entry:first'),
      newEntry = $(currentEntry.clone()).appendTo(dynaForm);

    newEntry.find('input').val('');
    dynaForm.find('.entry:not(:last) .btn-add')
      .removeClass('btn-add').addClass('btn-remove')
      .removeClass('btn-success').addClass('btn-danger')
      .html('<span class="lni lni-minus"></span>');
  }).on('click', '.btn-remove', function(e) {
    $(this).parents('.entry:first').remove();

    e.preventDefault();
    return false;
  });
});
		</script>
		<!-- ============================================================== -->
		<!-- This page plugins -->
		<!-- ============================================================== -->
		@php
		$data = App\Models\EmployeeApplication::with('hiring', 'employee')->whereHas('hiring', function($query){ $query->where('company_id', auth()->id());})->get();
		$count = 1;
		@endphp
		@foreach($data as $datas)
		<div class="modal fade" id="details{{ $datas->id }}" tabindex="-1" role="dialog" aria-labelledby="messagemodal" aria-hidden="true">
			<div class="modal-dialog modal-xl login-pop-form" role="document">
				<div class="modal-content" id="messagemodal">
					<div class="modal-headers">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span class="ti-close"></span>
						</button>
					  </div>

					<div class="modal-body p-5">

						<table class="table">
							<tbody>
							  <tr>
								<th>Họ và tên</th>
								<td>{{ $datas->employee->firstname }} {{ $datas->employee->lastname }}</td>

							  </tr>
							  <tr>
								<th>Email</th>
								<td>{{ $datas->employee->user->email }}</td>

							  </tr>
							  <tr>
								<th>Vị trí chỉ định</th>
								<td>{{ $datas->employee->designation }}</td>

							  </tr>
							  <tr>
								<th>Số điện thoại</th>
								<td>{{ $datas->employee->phone }}</td>

							  </tr>
							  <tr>
								<th>Ngày sinh</th>
								<td>{{ $datas->employee->date_of_birth }}</td>

							  </tr>
							  <tr>
								<th>Mô tả</th>
								<td>{{ $datas->employee->bio }}</td>

							  </tr>
							</tbody>
						  </table>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="cover{{ $datas->id }}" tabindex="-1" role="dialog" aria-labelledby="informationmodal" aria-hidden="true">
			<div class="modal-dialog modal-xl login-pop-form" role="document">
				<div class="modal-content" id="messagemodal">
					<div class="modal-headers">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span class="ti-close"></span>
						</button>
					  </div>

					<div class="modal-body p-5">
						{{ $datas->cover_letter }}
					</div>
				</div>
			</div>
		</div>
		@php
		$count++;
		@endphp
		@endforeach
		<script>
			// Get the current hour of the day
			const currentTime = new Date().getHours();

			// Define the greeting based on the current time
			let greeting;
			if (currentTime < 12) {
			  greeting = "Buổi sáng tốt lành nhé ^^";
			} else if (currentTime < 18) {
			  greeting = "Buổi chiều tốt lành nhé ^^";
			} else {
			  greeting = "Buổi tối tốt lành nhé ^^";
			}

			document.getElementById("greeting").innerHTML = greeting;
		  </script>
	</body>
</html>
