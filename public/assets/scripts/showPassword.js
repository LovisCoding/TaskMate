document.getElementById('togglePassword').addEventListener('click', function () {
	const passwordInput = document.getElementById('password');
	const passwordIcon = document.getElementById('passwordIcon');
	if (passwordInput.type === 'password') {
		passwordInput.type = 'text';
		passwordIcon.classList.remove('bi-eye-slash');
		passwordIcon.classList.add('bi-eye');
	} else {
		passwordInput.type = 'password';
		passwordIcon.classList.remove('bi-eye');
		passwordIcon.classList.add('bi-eye-slash');
	}
});

document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
	const confirmPasswordInput = document.getElementById('confirm_password');
	const confirmPasswordIcon = document.getElementById('confirmPasswordIcon');
	if (confirmPasswordInput.type === 'password') {
		confirmPasswordInput.type = 'text';
		confirmPasswordIcon.classList.remove('bi-eye-slash');
		confirmPasswordIcon.classList.add('bi-eye');
	} else {
		confirmPasswordInput.type = 'password';
		confirmPasswordIcon.classList.remove('bi-eye');
		confirmPasswordIcon.classList.add('bi-eye-slash');
	}
});