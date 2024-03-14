const loginBtn = document.getElementById('loginBtn');
const container = document.getElementById('container');

loginBtn.addEventListener('click', () => {
    container.style.display = 'block';
});

document.addEventListener('click', (e) => {
    if (!container.contains(e.target) && e.target !== loginBtn) {
        container.style.display = 'none';
    }
});

const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});

const signupForm = document.getElementById('signupForm');
const step1 = document.getElementById('step1');
const step2 = document.getElementById('step2');
const step3 = document.getElementById('step3');
const nextStep1 = document.getElementById('nextStep1');
const nextStep2 = document.getElementById('nextStep2');
const prevStep2 = document.getElementById('prevStep2');
const prevStep3 = document.getElementById('prevStep3');

nextStep1.addEventListener('click', () => {
    step1.style.display = 'none';
    step2.style.display = 'block';
});

nextStep2.addEventListener('click', () => {
    step2.style.display = 'none';
    step3.style.display = 'block';
});

prevStep2.addEventListener('click', () => {
    step2.style.display = 'none';
    step1.style.display = 'block';
});

prevStep3.addEventListener('click', () => {
    step3.style.display = 'none';
    step2.style.display = 'block';
});