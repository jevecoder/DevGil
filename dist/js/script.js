// password checker
function checkPasswordStrength() {
    var password = document.getElementById('floating_password').value;
    var strength = document.getElementById('password-strength');
    var iconLength = document.getElementById('icon-length');
    var iconLengthText = document.getElementById('icon-length-text');
    var iconUpperCase = document.getElementById('icon-uppercase');
    var iconUpperCaseText = document.getElementById('icon-uppercase-text');
    var iconLowerCase = document.getElementById('icon-lowercase');
    var iconLowerCaseText = document.getElementById('icon-lowercase-text');
    var iconNumber = document.getElementById('icon-number');
    var iconNumberText = document.getElementById('icon-number-text');
    var iconSpecial = document.getElementById('icon-special');
    var iconSpecialText = document.getElementById('icon-special-text');

    // Reset indicators and strength message
    strength.innerText = '';
    iconLength.innerHTML = '';
    iconLengthText.innerText = '';
    iconUpperCase.innerHTML = '';
    iconUpperCaseText.innerText = '';
    iconLowerCase.innerHTML = '';
    iconLowerCaseText.innerText = '';
    iconNumber.innerHTML = '';
    iconNumberText.innerText = '';
    iconSpecial.innerHTML = '';
    iconSpecialText.innerText = '';

    // Define criteria
    var minLength = 8;
    var upperCase = /[A-Z]/g;
    var lowerCase = /[a-z]/g;
    var numbers = /[0-9]/g;
    var specialChars = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/g;

    var isValid = true; // Flag to track password validity

    // Check length
    if (password.length >= minLength) {
        iconLength.innerHTML = '<i class="text-green-500 fas fa-check-circle"></i>';
        iconLengthText.innerText = 'At least ' + minLength + ' characters';
    } else {
        iconLength.innerHTML = '<i class="text-red-500 fas fa-times-circle"></i>';
        iconLengthText.innerText = 'At least ' + minLength + ' characters';
        iconLengthText.classList.add('shake');
        // strength.innerText = 'Password must be at least ' + minLength + ' characters long.\n';
        isValid = false;
    }

    // Check uppercase letters
    if (password.match(upperCase)) {
        iconUpperCase.innerHTML = '<i class="text-green-500 fas fa-check-circle"></i>';
        iconUpperCaseText.innerText = 'At least one uppercase letter';
    } else {
        iconUpperCase.innerHTML = '<i class="text-red-500 fas fa-times-circle"></i>';
        iconUpperCaseText.innerText = 'At least one uppercase letter';
        iconUpperCaseText.classList.add('shake');
        // strength.innerText += 'Include at least one uppercase letter.\n';
        isValid = false;
    }

    // Check lowercase letters
    if (password.match(lowerCase)) {
        iconLowerCase.innerHTML = '<i class="text-green-500 fas fa-check-circle"></i>';
        iconLowerCaseText.innerText = 'At least one lowercase letter';
    } else {
        iconLowerCase.innerHTML = '<i class="text-red-500 fas fa-times-circle"></i>';
        iconLowerCaseText.innerText = 'At least one lowercase letter';
        iconLowerCaseText.classList.add('shake');
        // strength.innerText += 'Include at least one lowercase letter.\n';
        isValid = false;
    }

    // Check numbers
    if (password.match(numbers)) {
        iconNumber.innerHTML = '<i class="text-green-500 fas fa-check-circle"></i>';
        iconNumberText.innerText = 'At least one number';
    } else {
        iconNumber.innerHTML = '<i class="text-red-500 fas fa-times-circle"></i>';
        iconNumberText.innerText = 'At least one number';
        iconNumberText.classList.add('shake');
        // strength.innerText += 'Include at least one number.\n';
        isValid = false;
    }

    // Check special characters
    if (password.match(specialChars)) {
        iconSpecial.innerHTML = '<i class="text-green-500 fas fa-check-circle"></i>';
        iconSpecialText.innerText = 'At least one special character';
    } else {
        iconSpecial.innerHTML = '<i class="text-red-500 fas fa-times-circle"></i>';
        iconSpecialText.innerText = 'At least one special character';
        iconSpecialText.classList.add('shake');
        // strength.innerText += 'Include at least one special character.\n';
        isValid = false;
    }

    // Remove shake class after animation completes
    setTimeout(function() {
        var shakeElements = document.querySelectorAll('.shake');
        shakeElements.forEach(function(elem) {
            elem.classList.remove('shake');
        });
    }, 500); // Adjust timing if necessary

    // Enable or disable register button based on password validity
    var registerBtn = document.getElementById('register-btn');
    registerBtn.disabled = !isValid;

    // Check if strength is acceptable
    if (isValid) {
        strength.innerText = 'Strong password.';
    }
}
// password checker end 