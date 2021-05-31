document.addEventListener("DOMContentLoaded", ()=> {
    
    const loginbutton = document.querySelector("#loginbtn");
    const signoutbutton= document.querySelector("#signoutbtn");

    document.querySelector(loginbutton, "nav ul li a").addEventListener("click", e => {
        e.preventDefault();
        signoutbutton.classList.remove("form--hidden");
    });
    
    
})

