<style>
	body,
	table,
	td,
	a {
		-webkit-text-size-adjust: 100%;
		-ms-text-size-adjust: 100%;
	}

	table,
	td {
		mso-table-lspace: 0pt;
		mso-table-rspace: 0pt;
	}

	img {
		-ms-interpolation-mode: bicubic;
	}

	img {
		border: 0;
		height: auto;
		line-height: 100%;
		outline: none;
		text-decoration: none;
	}

	table {
		border-collapse: collapse !important;
	}

	body {
		height: 100% !important;
		margin: 0 !important;
		padding: 0 !important;
		width: 100% !important;
		font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,

			"Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif,

			"Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"
	}

	a[x-apple-data-detectors] {
		color: inherit !important;
		text-decoration: none !important;
		font-size: inherit !important;
		font-family: inherit !important;
		font-weight: inherit !important;
		line-height: inherit !important;
	}

	div[style*="margin: 16px 0;"] {
		margin: 0 !important;
	}
</style>



<body style="background-color: #f7f5fa; margin: 0 !important; padding: 0 !important;">

	<table border="0" cellpadding="0" cellspacing="0" width="750" align="center">

		<tr>

			<td bgcolor="#050505" align="center">

				<table border="0" cellpadding="0" cellspacing="0" width="480">

					<tr>

						<td align="center" valign="top" style="padding: 40px 10px 40px 10px;">

							<!--<div style="display: block; border=" 0"><a href="{{ route('index') }}" target="_blank"><img src="{{asset('frontend-assets/image/sLogo.png')}}"  width="300px" height="40px"></a></div>-->							
							<div style="display: block; border=" 0"><a href="{{ route('index') }}" target="_blank"><img src="{{asset('frontend-assets/image/logogom.png')}}"  width="300px" height="40px"></a></div>

						</td>

					</tr>

				</table>

			</td>

		</tr>

		<tr>

			<td bgcolor="#f4f4f4" align="center" color="#212529">

				<table border="0" cellpadding="0" cellspacing="0" width="750">

					<tr>

						<td bgcolor="#ffffff" align="left">

							<table width="100%" border="0" cellspacing="0" cellpadding="0">

								<tr>

									<td colspan="2" style="padding-left:30px;padding-right:15px;padding-bottom:20px; padding-top:30px; font-size: 20px; font-weight: 400; line-height: 25px;">

										<p><b>CONTACT DETAILS</b></p>

									</td>

								</tr>

								<tr>

									<td colspan="2" style="padding-left:30px;padding-right:15px;padding-bottom:5px; padding-top:5px; font-size: 20px; font-weight: 400; line-height: 25px;">

										<b>Name:</b> {{ $data['name'] }}

									</td>

								</tr>

								<tr>

									<td colspan="2" style="padding-left:30px;padding-right:15px;padding-bottom:5px; padding-top:5px; font-size: 20px; font-weight: 400; line-height: 25px;">

										<b>Email:</b> {{ $data['user_email'] }}

									</td>

								</tr>

								<tr>

									<td colspan="2" style="padding-left:30px;padding-right:15px;padding-bottom:5px; padding-top:5px; font-size: 20px; font-weight: 400; line-height: 25px;">

										<b>Question:</b> {{ $data['reason'] }}

									</td>

								</tr>

								<tr>

									<td colspan="2" style="padding-left:30px;padding-right:15px;padding-bottom:20px; padding-top:5px; font-size: 20px; font-weight: 400; line-height: 25px;">

										<b>Message: </b> {{ $data['comments'] }}

									</td>

								</tr>

							</table>

						</td>

					</tr>

				</table>

			</td>

		</tr>

		<tr>
			
			<td align="center">										
					<div style="background-color:black; text-align:center; color: white; padding-top:7px; padding-bottom:7px;">
						<a href="http://www.facebook.com/greatomusic" target="_blank" style="color:white; text-decoration:none;" onMouseOver="this.style.color='#FFF'"
						onMouseOut="this.style.color='#FFF'">Facebook</a>&nbsp;|&nbsp;<a href="http://www.twitter.com/great_o_music" target="_blank" style="color:white; text-decoration:none;" onMouseOver="this.style.color='#FFF'" onMouseOut="this.style.color='#FFF'">Twitter</a>&nbsp;|&nbsp;<a href="http://www.youtube.com/greatomusic" target="_blank" style="color:white; text-decoration:none;" onMouseOver="this.style.color='#FFF'"  onMouseOut="this.style.color='#FFF'">YouTube</a>
						<br><br>
						<a href="http://www.greatomusic.com" target="_blank" style="color:white; text-decoration:none;" onMouseOver="this.style.color='#FFF'" onMouseOut="this.style.color='#FFF'">www.greatomusic.com</a>
						<br><br>
						Copyright © Great "O" Music. All Rights Reserved.
					</div>
			</td>

		</tr>

	</table>

</body>
