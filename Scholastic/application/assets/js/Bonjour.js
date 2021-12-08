// const XHR = new XMLHttpRequest();
// XHR.onreadystatechange = () => {
// 	if (XHR.readyState == 4 && XHR.status == 200) {
// 		JSONObject = JSON.parse(XHR.responseText);
// 	}
// };
// XHR.open(
// 	"GET",
// 	"http://localhost/Shahain/Scholastic/application/AsyncRequestFiles/Emails.json",
// 	true
// );
// XHR.send();

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
	cteacher: false,
};

function EnableButton() {
	setTimeout(() => {
		const formSignUp = document.getElementById("form");
		let AggregatedStatus =
			StatusCollection.name &&
			StatusCollection.email &&
			StatusCollection.cteacher;
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

const Req = document.querySelectorAll(".Req");
for (let i = 0; i < 2; i++) {
	Req[i].addEventListener("keyup", (e) => {
		StatusCollection[e.target.name] = false;
		if (!!!e.target.value) {
			if (e.target.name === "name") {
				e.target.nextSibling.nextSibling.innerHTML = "What's your name?";
			} else if (e.target.name === "cteacher") {
				e.target.nextSibling.nextSibling.innerHTML =
					"Can I know your class teacher's name?";
			}
			SetError(e.target);
		} else {
			SetOk(e.target);
		}
	});
}
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
		let Flag = true;

		$.post(
			"http://localhost/Shahain/Scholastic/index.php/Scholastic/realtime_email_check",
			{
				check_mail: e.target.value,
			},
			(num) => {
				if (!!parseInt(num)) {
					SetError(e.target);
					e.target.nextSibling.nextSibling.innerHTML =
						"That email is already in use.";
				} else {
					SetOk(e.target);
				}
			}
		);
	}
});
const FormInput = document.getElementById("form");
const Times = document.querySelector(".fa-times-circle");
const SignUp = document.querySelector(".signup");
const SignIn = document.querySelector(".signin");
SignUp.addEventListener("click", (e) => {
	FormInput.style.display = "block";
});
Times.addEventListener("click", (e) => {
	FormInput.style.display = "none";
});
SignIn.addEventListener("click", (e) => {
	location.href =
		"http://localhost/Shahain/Scholastic/index.php/Scholastic/sign_in";
});
