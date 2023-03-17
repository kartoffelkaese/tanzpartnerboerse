const submitButton = document.querySelector('[type="submit"]');
const quizInput = document.querySelector(".capt");
quizInput.addEventListener("input", function(e) {
    const res = submitButton.getAttribute("data-res");
    if ( this.value == res ) {
        submitButton.removeAttribute("disabled");
    } else {
        submitButton.setAttribute("disabled", "");
    }
});
