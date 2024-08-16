document.addEventListener("DOMContentLoaded", function() {
    const passwordInput = document.getElementById('password');
    const passwordCriteria = document.getElementById('passwordCriteria');
    const togglePasswordButton = document.getElementById('togglePassword');
    const form = document.querySelector('form');

    function validatePassword() {
        const password = passwordInput.value;
        const criteria = [
            { regex: /.{8,}/, label: 'At least 8 characters' },
            { regex: /[A-Z]/, label: 'At least one uppercase letter' },
            { regex: /\d/, label: 'At least one number' },
            { regex: /[!@#$%^&*(),.?":{}|<>]/, label: 'At least one symbol' }
        ];

        let valid = true;
        passwordCriteria.innerHTML = '';

        criteria.forEach(({ regex, label }) => {
            const isValid = regex.test(password);
            const listItem = document.createElement('li');
            listItem.textContent = label;
            listItem.style.color = isValid ? 'green' : 'red';
            passwordCriteria.appendChild(listItem);
            if (!isValid) valid = false;
        });

        return valid;
    }

    // Validate password on input
    passwordInput.addEventListener('input', function() {
        validatePassword();
    });

    // Toggle password visibility
    togglePasswordButton.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.textContent = type === 'password' ? 'Show' : 'Hide';
    });

    form.addEventListener('submit', function(event) {
        if (!validatePassword()) {
            event.preventDefault(); // Prevent form submission
            alert('Please fulfill the password criteria.');
        }
    });
});
