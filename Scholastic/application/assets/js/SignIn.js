function SetErrorOnLoad() {
	const ErrorCont = document.querySelectorAll(".error_cont");
	for (let i = 0; i < 2; i++) {
		console.log(ErrorCont[i].previousSibling.previousSibling);
		if (!!ErrorCont[i].innerHTML) {
			ErrorCont[i].previousSibling.previousSibling.style.outlineColor = "red";
			ErrorCont[i].previousSibling.previousSibling.style.outlineStyle = "solid";
			ErrorCont[i].previousSibling.previousSibling.style.outlineWidth = "2px";
		}
	}
}

function SetError(pTarget) {
	pTarget.style.outlineColor = "red";
	pTarget.style.outlineStyle = "solid";
	pTarget.style.outlineWidth = "2px";
	pTarget.nextSibling.style.color = "red";
	StatusCollection[pTarget.name] = false;
}

function SetOk(pTarget) {
	pTarget.style.outlineColor = "#1d9bf0";
	pTarget.style.outlineStyle = "solid";
	pTarget.style.outlineWidth = "2px";
	pTarget.nextSibling.style.color = "#1d9bf0";
	pTarget.nextSibling.nextSibling.innerHTML = "";
	StatusCollection[pTarget.name] = true;
}
const SubmitBtn = document.querySelector(".signup-conf");
const StatusCollection = {
	name: false,
	email: false,
};

function EnableButton() {
	setTimeout(() => {
		const formSignUp = document.getElementById("form");
		let AggregatedStatus = StatusCollection.name && StatusCollection.email;
		if (AggregatedStatus) {
			formSignUp.classList.toggle("form-ok-activate", true);
			const SubmitBtn = document.querySelector(".signup-conf");
			SubmitBtn.disabled = false;
		} else {
			formSignUp.classList = "form";
			SubmitBtn.disabled = true;
		}
	}, 200);
}

const Req = document.querySelector(".Req");
Req.addEventListener("keyup", (e) => {
	StatusCollection[e.target.name] = false;
	if (!!!e.target.value) {
		e.target.nextSibling.nextSibling.innerHTML = "What's your name?";
		SetError(e.target);
	} else {
		SetOk(e.target);
	}
});
const Patt = document.querySelector(".Patt");

Patt.addEventListener("keyup", (e) => {
	StatusCollection[e.target.name] = false;
	if (!!!e.target.value) {
		SetError(e.target);
		e.target.nextSibling.nextSibling.innerHTML =
			"Your email address is required";
	} else if (!!!e.target.value.match(/^[a-z0-9\._]+\@[a-z]+\.[a-z]+$/)) {
		SetError(e.target);
		e.target.nextSibling.nextSibling.innerHTML =
			"Your email address is invalid";
	} else {
		SetOk(e.target);
	}
});
const FormmInput = document.getElementById("form");
const Times = document.querySelector(".fa-times-circle");
Times.addEventListener("click", (e) => {
	location.href = "http://localhost/Shahain/Scholastic/index.php/Scholastic";
});

SetErrorOnLoad();
