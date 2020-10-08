<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login - UIkit 3 KickOff</title>
		<link rel="icon" href="img/favicon.ico">
		<!-- CSS FILES -->
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/uikit@latest/dist/css/uikit.min.css">
	</head>
	<body class="uk-flex uk-flex-center uk-flex-middle uk-background-muted uk-height-viewport" data-uk-height-viewport>
		<div class="uk-position-bottom-center uk-position-small uk-visible@m uk-position-z-index">
			<span class="uk-text-small uk-text-muted">© 2019 Company Name - <a href="https://github.com/zzseba78/Kick-Off">Created by KickOff</a> | Built with <a href="http://getuikit.com" title="Visit UIkit 3 site" target="_blank" data-uk-tooltip><span data-uk-icon="uikit"></span></a></span>
		</div>
		<div class="uk-width-1-3@m uk-padding-small">
			<!-- login -->
            <form class="toggle-class" method="POST" action="{{ route('login') }}">
                @csrf
				<fieldset class="uk-fieldset">
					<div class="uk-margin-small">
						<div class="uk-inline uk-width-1-1@m">
							<span class="uk-form-icon uk-form-icon-flip" data-uk-icon="icon: mail"></span>
							<input name="email" class="uk-input uk-border-pill" required placeholder="Email" type="email">
						</div>
					</div>
					<div class="uk-margin-small">
						<div class="uk-inline uk-width-1-1@m">
							<span class="uk-form-icon uk-form-icon-flip" data-uk-icon="icon: lock"></span>
							<input name="password" class="uk-input uk-border-pill" required placeholder="Password" type="password">
						</div>
					</div>
					<div class="uk-margin-small">
						<label><input class="uk-checkbox" type="checkbox"> Keep me logged in</label>
					</div>
					<div class="uk-margin-bottom">
						<button type="submit" class="uk-button uk-button-primary uk-border-pill uk-width-1-1@m">LOG IN</button>
					</div>
				</fieldset>
			</form>
			<!-- /login -->

			<!-- Register -->
            <form class="toggle-class" method="POST" action="{{ route('register') }}" hidden enctype="multipart/form-data">
                @csrf
				<fieldset class="uk-fieldset">
                    <div class="uk-margin-small">
						<div class="uk-inline uk-width-1-1@m">
							<input name="name" class="uk-input uk-border-pill" required placeholder="Masukan Nama Sesuai KTP" type="text" autofocus>
						</div>
					</div>
					<div class="uk-margin-small">
						<div class="uk-inline uk-width-1-1@m">
							<input name="alamat" class="uk-input uk-border-pill" required placeholder="Masukan Nama Jalan" type="text" autofocus>
						</div>
					</div>
					<div class="uk-margin-small">
						<div class="uk-inline uk-width-1-1@m">
							<input list="kecamatan" name="kecamatan" class="uk-input uk-border-pill" required placeholder="-Kecamatan-" type="text" autofocus>
							<datalist id="kecamatan">
								<option value="Lhokseumawe, Banda Sakti">
								<option value="Lhokseumawe, Blang Mangat">
								<option value="Lhokseumawe, Muara Dua">
								<option value="Lhokseumawe, Muara Satu">
								 <option value="Aceh Utara, Baktiya">
								 <option value="Aceh Utara, Baktiya Barat">
								 <option value="Aceh Utara, Banda Baro">
								 <option value="Aceh Utara, Cot Girek">
								 <option value="Aceh Utara, Dewantara">
								 <option value="Aceh Utara, Geuredong Pase">
								 <option value="Aceh Utara, Kuta Makmur">
								 <option value="Aceh Utara, Langkahan">
								 <option value="Aceh Utara, Lapang">
								 <option value="Aceh Utara, Lhoksukon">
								 <option value="Aceh Utara, Matangkuli">
								 <option value="Aceh Utara, Meurah Mulia">
								 <option value="Aceh Utara, Muara Batu">
								 <option value="Aceh Utara, Nibong">
								 <option value="Aceh Utara, Nisam">
								 <option value="Aceh Utara, Nisam Antara">
								 <option value="Aceh Utara, Paya Bakong">
								 <option value="Aceh Utara, Pirak Timur">
								 <option value="Aceh Utara, Samudera">
								 <option value="Aceh Utara, Sawang">
								 <option value="Aceh Utara, Seunuddon (Seunudon)">
								 <option value="Aceh Utara, Simpang Kramat (Keramat)">
								 <option value="Aceh Utara, Syamtalira Aron">
								 <option value="Aceh Utara, Syamtalira Bayu">
								 <option value="Aceh Utara, Tanah Jambo Aye">
								 <option value="Aceh Utara, Tanah Luas">
								 <option value="Aceh Utara, Tanah Pasir">
							</datalist>
						</div>
					</div>
					<div class="uk-margin-small">
						<div class="uk-inline uk-width-1-1@m">
							<input name="noHp" class="uk-input uk-border-pill" required placeholder="Nomor Handphone" type="text" autofocus>
						</div>
					</div>
					<div class="uk-margin-small">
						<div class="uk-inline uk-width-1-1@m">
							<input name="noKtp" class="uk-input uk-border-pill" required placeholder="Nomor KTP" type="text" autofocus>
						</div>
					</div>
					<div class="uk-margin-small" uk-margin>
						<div uk-form-custom="target: true">
							<input name="fotoKtp" type="file">
							<input class="uk-input uk-border-pill uk-width-medium@m" type="text" placeholder="Foto KTP" disabled>
							<button class="uk-border-pill uk-button uk-button-default" type="button" tabindex="-1">Select</button>
						</div>
					</div>
					<div class="uk-margin-small">
						<div class="uk-inline uk-width-1-1@m">
							<input name="email" class="uk-input uk-border-pill" required placeholder="Email" type="email">
						</div>
					</div>
					<div class="uk-margin-small">
						<div class="uk-inline uk-width-1-1@m">
							<input name="password" class="uk-input uk-border-pill" required placeholder="Password" type="password">
						</div>
                    </div>
                    <div class="uk-margin-small">
						<div class="uk-inline uk-width-1-1@m">
							<input name="password_confirmation" class="uk-input uk-border-pill" required placeholder="Password Confirmation" type="password">
						</div>
					</div>
					<div class="uk-margin-bottom">
						<button type="submit" class="uk-button uk-button-primary uk-border-pill uk-width-1-1@m">Register</button>
					</div>
				</fieldset>
			</form>
			<!-- /Register -->
			
			<!-- action buttons -->
			<div>
				<div class="uk-text-center">
					<a class="uk-link-reset uk-text-small toggle-class" data-uk-toggle="target: .toggle-class ;animation: uk-animation-fade">Need Seller Account?</a>
					<a class="uk-link-reset uk-text-small toggle-class" data-uk-toggle="target: .toggle-class ;animation: uk-animation-fade" hidden><span data-uk-icon="arrow-left"></span> Back to Login</a>
				</div>
			</div>
			<!-- action buttons -->
		</div>
		
		<!-- JS FILES -->
		<script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit-icons.min.js"></script>
	</body>
</html>