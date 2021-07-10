const navSlide = () => {
    window.addEventListener("scroll", function () {
		console.log(window.scrollY, window.innerHeight);
        if (window.scrollY > window.innerHeight) {
            document.querySelector("nav").classList.add("sticky");
        } else {
            document.querySelector("nav").classList.remove("sticky");
            links.classList.remove("toggle");
        }
    });
    var links = document.querySelector("nav .links");
    var burger = document.querySelector(".icon-burger");
    burger.addEventListener("click", function () {
        links.classList.toggle("toggle");
    })
    window.addEventListener("scroll", function() {
        document.querySelector(".colorOverlay").classList.add("fadeScroll");
        document.querySelector(".colorOverlay").style.opacity = `${0.0012 * window.scrollY}`;
    });
}

navSlide();

var page = '';
page = document.querySelector('#register');

function passConfirm() {
	let submit = document.querySelector("#submit");
	if (submit != null) {
		let password = document.querySelector("#password");
		let conf_password = document.querySelector("#conf_password");
		submit.addEventListener("click", function () {
			if (password.value != conf_password.value) {
				document.querySelector(".warning").style.display = "block";
				setTimeout(function () {
					document.querySelector(".warning").style.display = "none";
				}, 3000);
				event.preventDefault();
			}
		});
	}
}

passConfirm();

window.onload = myMain;
var date = document.querySelector('input[type="date"]');
var dateR = document.querySelector(".dateR");
var today = new Date();
var localDate = today.getFullYear() + '-' + ((today.getMonth() + 1) < 10 ? "0" + (today.getMonth() + 1) : (today.getMonth() + 1)) + '-' + (today.getDate() < 10 ? "0" + today.getDate() : today.getDate());
var submit_booking = document.querySelector('#submit_booking');

/*console.log("aaa");
if (date.value == "")
	dateR.setAttribute("min", `${localdate}`);
else
	dateR.setAttribute("min", `${date.value}`);
date.setAttribute("min", `${localDate}`);*/
function myMain() {
	if (date.value == "")
		dateR.setAttribute("min", `${localDate}`);
	else
		dateR.setAttribute("min", `${date.value}`);
	date.setAttribute("min", `${localDate}`);
}


date.addEventListener("change", () => {
	dateR.setAttribute("min", `${date.value}`);
});

if (submit_booking != null) {
	submit_booking.addEventListener("click", function () {
		if (date.value <= localDate || dateR.value <= date.value) {
			document.querySelector(".warning_date").style.display = "block";
			setTimeout(function () {
				document.querySelector(".warning_date").style.display = "none";
			}, 3000);
			event.preventDefault();
		}
	});
}
