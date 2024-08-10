function myFunction(x) {
    x.classList.toggle("change");
    let navbar = document.querySelector('.bar');
    navbar.classList.toggle('active');
}

window.onscroll = () => {
    let menuIcon = document.getElementById('icon');
    let navbar = document.querySelector('.bar');
    menuIcon.classList.remove('change');
    navbar.classList.remove('active');

} 
const texts = ['Fitness', 'Fat loss', 'Weight Lifting', 'Strength Training', 'Cardio', 'Weight Gain'];
let textIndex = 0;

const changeText = () => {
    const textElement = document.querySelector('.one_text');
    textElement.classList.remove('show');
    textElement.classList.add('hide'); // Start fading out

    setTimeout(() => {
        textElement.textContent = texts[textIndex];
        textElement.classList.remove('hide');
        textElement.classList.add('show'); // Fade in
        textIndex = (textIndex + 1) % texts.length;
    }, 2000); // 2 seconds delay before showing new text
};



