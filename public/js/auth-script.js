// Authentication page scripts
document.addEventListener('DOMContentLoaded', function() {
    // Password toggle functionality
    const passwordToggles = document.querySelectorAll('.password-toggle');
    
    passwordToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            // Toggle icon (you can add different SVG for eye-closed if needed)
            this.classList.toggle('active');
        });
    });

    // Login form submission
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const errorMessage = document.getElementById('error-message');
            
            // Basic validation
            if (!email || !password) {
                showError('Veuillez remplir tous les champs');
                return;
            }
            
            // Simulate login (replace with actual API call)
            console.log('Login attempt:', { email, password });
            
            // Simulate successful login
            setTimeout(() => {
                window.location.href = 'index.html';
            }, 1000);
        });
    }

    // Register form submission
    const registerForm = document.getElementById('register-form');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const fullname = document.getElementById('fullname').value;
            const email = document.getElementById('email').value;
            const institution = document.getElementById('institution').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const terms = document.getElementById('terms').checked;
            
            // Validation
            if (!fullname || !email || !password || !confirmPassword) {
                showError('Veuillez remplir tous les champs obligatoires');
                return;
            }
            
            if (password.length < 8) {
                showError('Le mot de passe doit contenir au moins 8 caractères');
                return;
            }
            
            if (password !== confirmPassword) {
                showError('Les mots de passe ne correspondent pas');
                return;
            }
            
            if (!terms) {
                showError('Veuillez accepter les conditions d\'utilisation');
                return;
            }
            
            // Simulate registration (replace with actual API call)
            console.log('Registration attempt:', { fullname, email, institution, password });
            
            // Show success message
            showSuccess('Compte créé avec succès ! Redirection...');
            
            // Redirect to login
            setTimeout(() => {
                window.location.href = 'login.html';
            }, 2000);
        });
    }

    // Social login buttons
    const googleLoginBtn = document.getElementById('google-login');
    const googleRegisterBtn = document.getElementById('google-register');
    
    if (googleLoginBtn) {
        googleLoginBtn.addEventListener('click', function() {
            console.log('Google login clicked');
            // Implement Google OAuth here
            alert('Connexion avec Google (à implémenter)');
        });
    }
    
    if (googleRegisterBtn) {
        googleRegisterBtn.addEventListener('click', function() {
            console.log('Google register clicked');
            // Implement Google OAuth here
            alert('Inscription avec Google (à implémenter)');
        });
    }

    // Helper functions
    function showError(message) {
        const errorDiv = document.getElementById('error-message');
        if (errorDiv) {
            errorDiv.textContent = message;
            errorDiv.classList.add('show');
            
            setTimeout(() => {
                errorDiv.classList.remove('show');
            }, 5000);
        }
    }

    function showSuccess(message) {
        const successDiv = document.getElementById('success-message');
        if (successDiv) {
            successDiv.textContent = message;
            successDiv.classList.add('show');
        }
    }
});