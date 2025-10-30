document.addEventListener('DOMContentLoaded', function () {
    const passwordGroups = document.querySelectorAll('.password-toggle-group');

    passwordGroups.forEach(group => {
        const passwordInput = group.querySelector('input[type="password"]');
        const togglePassword = group.querySelector('.toggle-password-btn');
        const icon = togglePassword.querySelector('i');

        if (passwordInput && togglePassword && icon) {
            
            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                if (type === 'password') {
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
        }
    });
});