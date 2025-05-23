<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Đặt lại Mật Khẩu</title>
</head>
<body>

<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#f9f9f9" id="bodyTable">
	<tbody>
		<tr>
			<td style="padding-right:10px;padding-left:10px;" align="center" valign="top" id="bodyCell">
				<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperWebview" style="max-width:600px">
					<tbody>
						<tr>
							<td align="center" valign="top">
								<table border="0" cellpadding="0" cellspacing="0" width="100%">
									<tbody>
										<tr>
											<td style="padding-top: 20px; padding-bottom: 20px; padding-right: 0px;" align="right" valign="middle" class="webview"> <a href="https://jobscout.tech" style="color:#bbb;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:right;text-decoration:underline;padding:0;margin:0" target="_blank" class="text hideOnMobile">Job Portal →</a>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
				<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperBody" style="max-width:600px">
					<tbody>
						<tr>
							<td align="center" valign="top">
								<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableCard" style="background-color:#fff;border-color:#e5e5e5;border-style:solid;border-width:0 1px 1px 1px;">
                                    <tbody>
                                    <tr>
                                        <td style="background-color:#2ab463;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 30px; padding-bottom: 30px;" align="center" valign="middle" class="emailLogo">
                                            <a href="#" style="text-decoration:none" target="_blank">
                                                <img alt="" border="0" src="https://i.ibb.co/CV1ZDq9/jobscout.png" style="width:100%;max-width:150px;height:auto;display:block" width="150">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
                                            <a href="#" style="text-decoration:none" target="_blank"></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="mainTitle">
                                            <h2 class="text" style="color:#000;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:28px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:36px;text-transform:none;text-align:center;padding:0;margin:0">Hi "{{ $user_name }}"</h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom: 30px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="subTitle">
                                            <h4 class="text" style="color:#999;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:16px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-transform:none;text-align:center;padding:0;margin:0">Gặp sự cố khi đăng nhập?</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20px;padding-right:20px" align="center" valign="top" class="containtTable ui-sortable">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription">
                                                <tbody>
                                                <tr>
                                                    <td style="padding-bottom: 20px;" align="center" valign="top" class="description">
                                                        <p class="text" style="color:#666;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:22px;text-transform:none;text-align:center;padding:0;margin:0">
                                                            Chúng tôi hiểu rằng việc quên mật khẩu có thể gây khó chịu, nhưng đừng lo lắng - chúng tôi ở đây để giúp bạn!
                                                            Để lấy lại tài khoản của bạn trên Job Portal, vui lòng nhập mã OTP bên dưới vào form:
                                                        </p>
                                                    </td>
                                                </tr>
                                                @if(!empty($otp))
                                                    <tr>
                                                        <td style="padding-bottom: 20px;" align="center" valign="top" class="description">
                                                            <h3 style="color:#2ab463;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:20px;font-weight:600;margin:0;">
                                                                Mã OTP của bạn là: <strong>{{ $otp }}</strong>
                                                            </h3>
                                                        </td>
                                                    </tr>
                                                @endif
                                                {!! $body !!}

                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:1px;line-height:1px" height="20">&nbsp;</td>
                                    </tr>
                                    </tbody>

                                </table>
								<table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
									<tbody>
										<tr>
											<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
				<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperFooter" style="max-width:600px">
					<tbody>
						<tr>
							<td align="center" valign="top">
								<table border="0" cellpadding="0" cellspacing="0" width="100%" class="footer">
									<tbody>
										<tr>
											<td style="padding: 10px 10px 5px;" align="center" valign="top" class="brandInfo">
												<p class="text" style="color:#bbb;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">©&nbsp;JobPortal Inc. | Nha Trang | Khanh Hoa, 44600 Viet Nam.</p>
											</td>
										</tr>
										<tr>
											<td style="padding: 0px 10px 20px;" align="center" valign="top" class="footerLinks">
												<p class="text" style="color:#bbb;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0"> <a href="#" style="color:#bbb;text-decoration:underline" target="_blank">Tài Khoản</a>&nbsp;|&nbsp; <a href="#" style="color:#bbb;text-decoration:underline" target="_blank">Trang Tìm Việc</a>&nbsp;|&nbsp; <a href="#" style="color:#bbb;text-decoration:underline" target="_blank">Chính Sách & Bảo Mật</a>
												</p>
											</td>
										</tr>
										<tr>
											<td style="padding: 0px 10px 10px;" align="center" valign="top" class="footerEmailInfo">
												<p class="text" style="color:#bbb;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">Nếu có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi <a href="#" style="color:#bbb;text-decoration:underline" target="_blank">leequanghuy21k3@gmail.com</a>
											</td>
										</tr>
										<tr>
											<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>

</body>
</html>
