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
	title: false,
	desc: false,
	file: false,
	date: false,
};

function EnableButton() {
	setTimeout(() => {
		const formSignUp = document.getElementById("form");
		let AggregatedStatus =
			StatusCollection.title &&
			StatusCollection.desc &&
			StatusCollection.file &&
			StatusCollection.date;
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
		e.target.nextSibling.nextSibling.innerHTML = "What's the title?";
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
		e.target.nextSibling.nextSibling.innerHTML = "What is the event about?";
	} else if (e.target.value.length > 500) {
		SetError(e.target);
		e.target.nextSibling.nextSibling.innerHTML =
			"Trim " + (e.target.value.length - 500) + " character(s)";
	} else {
		SetOk(e.target);
	}
});
const FileCheck = document.querySelector(".check_file");
FileCheck.addEventListener("change", (e) => {
	StatusCollection[e.target.name] = false;
	const FileName = e.target.files[0].name;
	const FileNameLength = FileName.length;
	const FileExtension = FileName.substring(FileNameLength - 3);
	if (
		FileExtension !== "png" &&
		FileExtension !== "jpg" &&
		FileExtension !== "gif"
	) {
		e.target.nextSibling.nextSibling.innerHTML =
			"Unsupported file type. Only png/jpg/gif allowed.";
		SetError(e.target);
	} else {
		SetOk(e.target);
	}
});

const DateCheck = document.querySelector(".ev_date");
DateCheck.addEventListener("change", (e) => {
	StatusCollection[e.target.name] = false;
	if (!!!e.target.value) {
		SetError(e.target);
		e.target.nextSibling.nextSibling.innerHTML = "When is the event?";
	} else {
		SetOk(e.target);
	}
});

const Times = document.querySelector(".fa-times-circle");
Times.addEventListener("click", (e) => {
	location.href = "http://localhost/Shahain/Scholastic/index.php/Scholastic/home";
});
const ProgBar = document.getElementById("progress-bar");
const ProgInner = document.getElementById("progress-inner");
const TextArea = document.getElementById("desc");
const PrgNum = document.querySelector(".progress-nmb");
const NumCont = document.querySelector(".nmb-container");
ProgInner.style.width = "0px";
TextArea.addEventListener("keyup", (e) => {
	let NumChars = TextArea.value.length;
	ProgInner.style.width = String(0.53 * NumChars) + "px";
	PrgNum.innerHTML = NumChars;
	NumCont.style.width = 2 * parseFloat(ProgInner.style.width) + "px";
	ProgBar.style.transform = "translateY(-32px)";
	NumCont.style.transform = "translateY(-32px)";
	if (NumChars < 400 && NumChars > 0) {
		PrgNum.style.color = "#1d9bf0";
		ProgInner.style.backgroundColor = "#1d9bf0";
	} else if (NumChars >= 400 && NumChars <= 500) {
		PrgNum.style.color = "#f2ca02";
		ProgInner.style.backgroundColor = "#f2ca02";
	} else if (NumChars > 500) {
		PrgNum.style.color = "red";
		ProgInner.style.backgroundColor = "red";
		ProgInner.style.width = "265px";
		PrgNum.innerHTML = 500 - NumChars;
		NumCont.style.width = "530px";
		ProgBar.style.transform = "translateY(-47px)";
		NumCont.style.transform = "translateY(-47px)";
	} else {
		PrgNum.style.color = "#2d3134";
		ProgInner.style.backgroundColor = "#2d3134";
	}
});
