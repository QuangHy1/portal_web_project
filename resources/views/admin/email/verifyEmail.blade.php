<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Xác Thực Email</title>
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
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableCard" style="background-color:#fff;border:1px solid #e5e5e5; border-bottom-width:1px;">
                    <tbody>
                    <tr>
                        <td style="background-color:#2ab463; font-size:1px; line-height:3px;" height="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="padding: 30px 0;" align="center" valign="middle" class="emailLogo">
                            <a href="#" style="text-decoration:none" target="_blank">
                                <img alt="Job Portal Logo" border="0" src="https://i.ibb.co/CV1ZDq9/jobscout.png" style="width:100%; max-width:150px; height:auto; display:block;" width="150">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
                            {{-- Nếu muốn chèn avatar hoặc hình ảnh, bỏ comment đoạn này --}}
                            {{-- <img src="https://pbs.twimg.com/profile_images/1485050791488483328/UNJ05AV8_400x400.jpg" style="border-radius: 100%; width:100px; margin-bottom: 10px;"> --}}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 20px 5px;" align="center" valign="top" class="mainTitle">
                            <h2 style="color:#000; font-family:Poppins,Helvetica,Arial,sans-serif; font-size:28px; font-weight:500; line-height:36px; text-align:center; margin:0;">
                                Hi "{{ $user_name ?? 'User' }}"
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 20px 30px;" align="center" valign="top" class="subTitle">
                            <h4 style="color:#999; font-family:Poppins,Helvetica,Arial,sans-serif; font-size:16px; font-weight:500; line-height:24px; text-align:center; margin:0;">
                                Xác thực email của bạn
                            </h4>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 20px;" align="center" valign="top" class="containtTable ui-sortable">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription">
                                <tbody>
                                <tr>
                                    <td style="padding-bottom: 20px;" align="center" valign="top" class="description">
                                        <p style="color:#666; font-family:'Open Sans',Helvetica,Arial,sans-serif; font-size:14px; font-weight:400; line-height:22px; text-align:center; margin:0;">
                                            Cảm ơn bạn đã đăng ký với Job Portal.
                                            Chúng tôi rất vui mừng khi bạn tham gia nền tảng của chúng tôi và bắt đầu hành trình tìm kiếm việc làm cùng chúng tôi.
                                            Vui lòng click vào "Xác thực Email" bên dưới để hoàn tất quá trình xác thực email nhé!
                                        </p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableButton">
                                <tbody>
                                <tr>
                                    <td style="padding: 20px 0;" align="center" valign="top">
                                        <table border="0" cellpadding="0" cellspacing="0" align="center">
                                            <tbody>
                                            <tr>
                                                <td style="background-color: #2ab463; padding: 12px 35px; border-radius: 50px;" align="center" class="ctaButton">
                                                    <a href="{{ $verifyUrl }}" style="color:#fff; font-family:Poppins,Helvetica,Arial,sans-serif; font-size:13px; font-weight:600; letter-spacing:1px; line-height:20px; text-transform:uppercase; text-decoration:none; display:block;" target="_blank" class="text">
                                                        Xác thực Email
                                                    </a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size:1px; line-height:1px;" height="20">&nbsp;</td>
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
