// main.js
// document.addEventListener('DOMContentLoaded', function() {
//     let btn1 = document.getElementById('button1');
//     btn1.addEventListener("click", function() {
//         document.getElementById("demo").innerHTML = "Hello World";
//       });
// });
document.addEventListener('DOMContentLoaded', function() {
    let btn1 = document.getElementById('button1');
    let modal = document.getElementById("myModal");
    let span = document.getElementsByClassName("close")[0];

    btn1.addEventListener("click", function() {
        modal.style.display = "block";
    });

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});
