<?php
	$email = $this->input->get('q');
?>
<!doctype html>
<html lang="en" class="fixed accounts sign-in">
	<head>
	    <meta charset="UTF-8">
		<meta name="description" key="description" content="Sistem Beton Readymix">
		<meta name="title" key="title" content="Beton Readymix">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	    <title><?php echo $this->m_themes->GetThemes('site_name');?> - LOGIN</title>
	    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url().$this->m_themes->GetThemes('site_favico');?>">
	    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo base_url().$this->m_themes->GetThemes('site_favico');?>">
	    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url().$this->m_themes->GetThemes('site_favico');?>">
	    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url().$this->m_themes->GetThemes('site_favico');?>">
	    <link rel="stylesheet" href="<?php echo base_url();?>assets/back/theme/vendor/bootstrap/css/bootstrap.css">
	    <link rel="stylesheet" href="<?php echo base_url();?>assets/back/theme/vendor/font-awesome/css/font-awesome.css">
	    <link rel="stylesheet" href="<?php echo base_url();?>assets/back/theme/vendor/animate.css/animate.css">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/back/theme/stylesheets/css/style.css">
	    <style type="text/css">
			/* Membuat pembungkus utama menjadi Flexbox */
			body, html {
				height: 100%;
				margin: 0;
			}

			.wrap {
				display: flex;
				align-items: center; /* Tengah Vertikal */
				justify-content: center; /* Tengah Horizontal */
				min-height: 100vh;
				padding: 15px; /* Spasi agar tidak mepet layar di mobile */
				background: #f5f5f5; /* Atau warna/gambar background Anda */
			}

			.page-body {
				width: 100%;
				max-width: 400px; /* Lebar maksimal kotak login */
				margin: 0 !important; /* Hapus margin default */
			}

			.box {
				background-color: rgba(255, 255, 255, 0.9);
				border-radius: 15px;
				padding: 20px;
				box-shadow: 0 4px 15px rgba(0,0,0,0.1);
				margin: 0 auto;
			}

			#toggleEmail {
				position: absolute;
				right: 15px; 
				top: 35%;
				transform: translateY(-50%);
				z-index: 100; /* Pastikan ikon di atas */
				color: #666;
				width: 20px; /* Batasi lebar ikon agar tidak menutupi seluruh kolom */
			}

			#togglePassword {
				position: absolute;
				right: 15px; 
				top: 50%;
				transform: translateY(-50%);
				z-index: 100; /* Pastikan ikon di atas */
				color: #666;
				cursor: pointer;
				width: 20px; /* Batasi lebar ikon agar tidak menutupi seluruh kolom */
			}

			.form-control {
				height: 40px;
				padding-left: 10px !important;
				width: 100%;
				position: relative;
				z-index: 1;
				
				/* Mengatur Border Biru */
				border: 1.5px solid #007bff; /* Biru standar (Bootstrap style) */
				/* Atau gunakan #87ceeb untuk biru langit seperti diskusi sebelumnya */
				
				border-radius: 10px;
				background-color: transparent;
				
				/* Padding ditingkatkan agar teks tidak menempel ke kiri */
				
				
				font-size: 15px;
				transition: all 0.3s ease;
			}

			.form-control-login {
				height: 50px;
				width: 100%;
				position: relative;
				z-index: 1;
				
				/* Mengatur Border Biru */
				border: 1.5px solid #007bff; /* Biru standar (Bootstrap style) */
				/* Atau gunakan #87ceeb untuk biru langit seperti diskusi sebelumnya */
				
				border-radius: 10px;
				background-color: transparent;
				
				/* Padding ditingkatkan agar teks tidak menempel ke kiri */
				padding: 10px 45px 10px 55px !important; 
				
				font-size: 15px;
				transition: all 0.3s ease;
			}

			#togglePassword {
				pointer-events: auto; /* Pastikan ikon bisa diklik */
			}

			/* Styling pesan teks error */
			.validation-message {
				color: #e74c3c;
				font-size: 12.5px;
				margin-top: 8px;
				font-weight: 500;
				display: block;
				animation: slideDown 0.3s ease-out;
			}

			/* Efek merah pada border input saat salah */
			.form-control-login.is-invalid {
				border-color: #e74c3c !important;
				background-color: #fff8f8 !important;
				box-shadow: 0 0 3px rgba(231, 76, 60, 0.2);
			}

			/* Animasi munculnya pesan */
			@keyframes slideDown {
				from { opacity: 0; transform: translateY(-5px); }
				to { opacity: 1; transform: translateY(0); }
			}

			/* Pastikan icon tidak bergeser saat error muncul */
			.input-with-icon {
				display: flex;
				align-items: center;
				position: relative;
			}

			/* Pastikan container memiliki posisi relatif */
			.floating-input {
				position: relative;
				margin-top: 25px;
			}

			/* Styling Input */
			.floating-input .form-control {
			width: 100%;
			padding: 15px 15px 15px 45px; /* Padding kiri ekstra untuk ikon */
			font-size: 1rem;
			color: #333;
			background-color: transparent; /* Pastikan transparan agar efek bayangan terlihat */
			border: none; /* Hapus border default */
			box-shadow: 0 0 0 1px #87ceeb; /* Efek garis border palsu */
			border-radius: 8px; /* Sudut melengkung */
			transition: all 0.2s ease;
			}

			/* Styling Label */
			.floating-input label {
			position: absolute;
			top: 1px; /* Tumpuk di atas input */
			left: 15px; /* Posisi kiri label di atas input */
			z-index: 1; /* Di depan input */
			padding: 2px 8px; /* Padding untuk teks label */
			font-size: 0.85rem;
			color: #87ceeb; /* Warna teks label */
			background-color: transparent; /* SAMA DENGAN WARNA BACKGROUND HALAMAN */
			border-radius: 4px;
			transform: translateY(-50%) translateX(-4px); /* Posisikan label melayang tepat di atas garis */
			pointer-events: none; /* Biarkan klik menembus label ke input */
			transition: all 0.2s ease;
			}

			/* Sembunyikan Pesan Error secara default */
			.floating-input label .error-msg {
			display: none;
			font-size: 0.75rem;
			color: #ff4d4d;
			}

			/* Styling Ikon */
			.floating-input .envelope-icon {
			position: absolute;
			left: 15px;
			top: 50%;
			transform: translateY(-50%);
			color: #ccc;
			font-size: 1.1rem;
			}

			/* --- LOGIKA INTERAKSI (FOCUS & VALIDASI) --- */

			/* 1. KETIKA INPUT DIKLIK (FOCUS) */
			.floating-input .form-control:focus {
			outline: none;
			box-shadow: 0 0 0 2px #00aaff; /* Tebalkan garis saat fokus */
			}

			.floating-input .form-control:focus + label {
			color: #00aaff; /* Ubah warna label saat fokus */
			}

			/* 2. KETIKA INPUT TIDAK VALID */
			.floating-input .form-control:invalid:not(:placeholder-shown) {
			box-shadow: 0 0 0 2px #ff4d4d; /* Ubah garis jadi merah saat salah */
			}

			.floating-input .form-control:invalid:not(:placeholder-shown) + label {
			color: #ff4d4d; /* Ubah warna label jadi merah */
			}

			/* Tampilkan pesan error saat tidak valid */
			.floating-input .form-control:invalid:not(:placeholder-shown) + label .error-msg {
			display: inline;
			}
	    	<?php include "assets/back/theme/stylesheets/css/style.css" ?>
	    </style>
	</head>

	<body>
		<div class="wrap">
			<div class="page-body animated slideInDown">
				<div class="box" style="background-color: rgba(255, 255, 255, 0.9); margin-top:10%;">
					<table width="100%" border="0">
						<tr>
							<th width="50%" class="text-center">
								<div class="panel-content-login bg-scale-0">
									<div class="panel-content-login bg-scale-0">
										<form id="loginform" action="<?php echo site_url('login_admin');?>" method="POST" novalidate>
											<h2>Login</h2>
											
											<!-- Group Email -->
											<div class="form-group floating-input">
												<input type="email" class="form-control" id="email" placeholder=" " name="email" value="<?= $email;?>" required>
												<label for="email">
													Email
													<span class="error-msg"> &mdash; Format email belum benar</span>
												</label>
											</div>

											<!-- Group Password -->
											 <div class="form-group floating-input">
												<input type="password" class="form-control" id="password" placeholder=" " name="password" required>
												<label for="password">
													Password
													<span class="error-msg"> &mdash; Password minimal 6 karakter</span>
												</label>
												<i class="fa fa-eye" id="togglePassword"></i>
											</div>

											<!-- Alert Message (untuk response dari Server) -->
											<div class="alert" style="display:none; margin-top:10px; padding:10px; border-radius:10px;">
												<span class="alert-content"></span>
											</div>

											<div class="form-group" style="margin:20px auto; width:auto;">
												<button type="submit" name="submit" class="btn btn-primary btn-block" id="btn-login" style="font-size:80%; font-weight:bold; border-radius:10px; height:35px;">
													<b>LOGIN</b>
												</button>
											</div>
										</form>
									</div>
								</div>
							</th>
						</tr>
					</table>
					<!--SIGN IN FORM-->
					
				</div>
				<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
			
				

				
			</div>
		</div>
		<!--BASIC scripts-->
		<!-- ========================================================= -->
		<script src="<?php echo base_url();?>assets/back/theme/vendor/jquery/jquery-1.12.3.min.js"></script>
		<script src="<?php echo base_url();?>assets/back/theme/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/back/theme/vendor/nano-scroller/nano-scroller.js"></script>
		<!--TEMPLATE scripts-->
		<!-- ========================================================= -->
		<script src="<?php echo base_url();?>assets/back/theme/javascripts/template-script.min.js"></script>
		<script src="<?php echo base_url();?>assets/back/theme/javascripts/template-init.min.js"></script>
		<script src="<?php echo base_url();?>assets/back/theme/vendor/jquery-validation/jquery.validate.min.js"></script>
		<!-- SECTION script and examples-->
		<!-- ========================================================= -->

		<script type="text/javascript">
		$(document).ready(function(){
			$(".alert").hide();

			$("#loginform").validate({
				// 1. Aturan Validasi
				rules: {
					email: {
						required: true,
						email: true,
					},
					password: {
						required: true,
						minlength: 6
					}
				},

				// 2. Pesan Error Kustom (Agar lebih bagus)
				messages: {
					email: {
						required: "Email tidak boleh kosong, ya.",
						email: "Ups! Format email kamu sepertinya salah."
					},
					password: {
						required: "Kata sandi wajib diisi.",
						minlength: "Kata sandi minimal harus 6 karakter."
					}
				},

				// 3. Pengaturan Posisi & Elemen Error
				errorElement: 'div',
				errorPlacement: function(error, element) {
					error.addClass('validation-message');
					// Menempatkan pesan error di bawah span 'input-with-icon'
					error.insertAfter(element.parent());
				},

				// 4. Highlight Input yang Error
				highlight: function(element) {
					$(element).addClass('is-invalid');
					$(element).closest('.form-group').addClass('has-error');
				},
				unhighlight: function(element) {
					$(element).removeClass('is-invalid');
					$(element).closest('.form-group').removeClass('has-error');
				},

				// 5. Logika Kirim Data (AJAX)
				submitHandler: function(form) {
					$.ajax({
						type: "POST",
						url: $(form).attr('action'),
						data: $(form).serialize(),
						dataType: 'json',
						async: true,
						beforeSend: function() {
							$('button.btn-block').button('loading');
							$(".alert").fadeIn();
							$(".alert").removeClass('alert-danger alert-success').addClass('alert-warning');
							$(".alert-content").html('<i class="fa fa-spinner fa-pulse fa-fw"></i> Mohon tunggu...');
						},
						success: function(data) {
							var output = data.output;
							if (output == 'true') {
								$(".alert").fadeIn();
								$(".alert").removeClass('alert-warning').addClass('alert-success');
								$(".alert-content").text('Berhasil Login! Mengalihkan...');
								setTimeout(function() {
									window.location.href = data.redirect;
								}, 1000);
							} else {
								$(".alert").fadeIn();
								$(".alert").removeClass('alert-warning').addClass('alert-danger');
								$(".alert-content").text('Maaf, email atau kata sandi Anda salah.');
								$('button.btn-block').button('reset');
							}
						},
						error: function() {
							$(".alert").fadeIn();
							$(".alert").removeClass('alert-warning').addClass('alert-danger');
							$(".alert-content").text('Terjadi kesalahan sistem. Coba lagi nanti.');
							$('button.btn-block').button('reset');
						}
					});
					return false;
				}
			});

			// Toggle Password Visibility
			$("#togglePassword").click(function () {
				var passwordInput = $("#password");
				if (passwordInput.attr("type") == "password") {
					passwordInput.attr("type", "text");
					$(this).removeClass("fa-eye").addClass("fa-eye-slash");
				} else {
					passwordInput.attr("type", "password");
					$(this).removeClass("fa-eye-slash").addClass("fa-eye");
				}
			});
		});
		</script>
	</body>
</html>
