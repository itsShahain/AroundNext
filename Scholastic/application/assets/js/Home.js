$(function () {
	$(".ev-bk").click(function () {
		$(this).parent().toggleClass("event-footer-ev-bk-active");
		// console.log($(this)[0].title);
		$.post(
			"http://localhost/Shahain/Scholastic/index.php/Scholastic/bookmark",
			{
				ID: $(this)[0].title,
			}
		);
	});

	$(".ev-hrt").click(function () {
		let found = false;
		$(this).parent().toggleClass("event-footer-ev-hrt-active");
		// console.log($(this).parent());
		$(this)
			.parent()[0]
			.classList.forEach((classname) => {
				if (classname === "event-footer-ev-hrt-active") {
					found = true;
				}
			});
		if (found) {
			$(this)[0].previousSibling.innerHTML =
				parseInt($(this)[0].previousSibling.innerHTML) + 1;
			$.post("http://localhost/Shahain/Scholastic/index.php/Scholastic/heart", {
				ID: $(this)[0].title,
				delta: +1,
			});
		} else {
			$(this)[0].previousSibling.innerHTML =
				parseInt($(this)[0].previousSibling.innerHTML) - 1;
			$.post("http://localhost/Shahain/Scholastic/index.php/Scholastic/heart", {
				ID: $(this)[0].title,
				delta: -1,
			});
		}
	});
	$(".search-query-main").click(function () {
		// console.log($(".search-bar")[0].value);
		SearchQ = $("#search-bar-main")[0].value;
		location.href =
			"http://localhost/Shahain/Scholastic/index.php/Scholastic/search/" +
			SearchQ;
	});
	$(".search-query-mobile").click(function () {
		// console.log($(".search-bar")[0].value);
		SearchQ = $("#search-bar-mobile")[0].value;
		location.href =
			"http://localhost/Shahain/Scholastic/index.php/Scholastic/search/" +
			SearchQ;
	});
	update_hearts();
	update_new_events();
});

function update_hearts() {
	const midCont = document.getElementById("test-post");
	if (
		location.href ===
			"http://localhost/Shahain/Scholastic/index.php/Scholastic/home" &&
		!!midCont
	) {
		$.get(
			"http://localhost/Shahain/Scholastic/index.php/Scholastic/realtime_hearts",
			function (d, s) {
				Object.keys(JSON.parse(d)).forEach((ID) => {
					// console.log(ID);
					// console.log("[title="+ID+"]");
					// console.log($("[title="+ID+"]")[1].previousSibling.innerHTML);
					//  console.log(JSON.parse(d)[ID])
					if (!!$("[title=" + ID + "]").length) {
						$("[title=" + ID + "]")[1].previousSibling.innerHTML =
							JSON.parse(d)[ID];
					}
				});
			}
		);
	}
	setTimeout(() => {
		update_hearts();
	}, 1000);
}

function update_new_events() {
	$.get(
		"http://localhost/Shahain/Scholastic/index.php/Scholastic/get_new_events",
		function (Data, Status) {
			if (!!Data) {
				$("#new-num-main")[0].innerHTML = Data;
				$("#new-num-main")[0].style.display = "flex";
				$("#new-num-mobile")[0].innerHTML = Data;
				$("#new-num-mobile")[0].style.display = "flex";
			}
		}
	);
	setTimeout(() => {
		update_new_events();
	}, 2000);
}

function ToggleOff() {
	const cardFrame = document.getElementById("card-frame");
	// console.log("toggled off");
	cardFrame.classList.toggle("card-active");
}

function Toggle() {
	const cardFrame = document.getElementById("card-frame");
	// console.log("toggled on");
	cardFrame.classList.toggle("card-active");
	setTimeout(function () {
		ToggleOff();
	}, 7000);
	setTimeout(function () {
		Toggle();
	}, 15000);
}

setTimeout(function () {
	Toggle();
}, 1000);

const SearchBarMain = document.getElementById("search-bar-main");
const SearchContainerMain = document.getElementById("search-cont-main");
SearchBarMain.addEventListener("click", (e) => {
	SearchContainerMain.style.outlineColor = "#1d9bf0";
	SearchContainerMain.style.outlineStyle = "solid";
	SearchContainerMain.style.outlineWidth = "2px";
	SearchContainerMain.style.backgroundColor = "black";
	SearchContainerMain.children[0].style.backgroundColor = "black";
});
SearchBarMain.addEventListener("blur", (e) => {
	SearchContainerMain.style.outlineColor = "none";
	SearchContainerMain.style.outlineStyle = "none";
	SearchContainerMain.style.outlineWidth = "none";
	SearchContainerMain.style.backgroundColor = "#1b1e20";
	SearchContainerMain.children[0].style.backgroundColor = "#1b1e20";
});

const SearchBarMobile = document.getElementById("search-bar-mobile");
const SearchContainerMobile = document.getElementById("search-cont-mobile");
SearchBarMobile.addEventListener("click", (e) => {
	SearchContainerMobile.style.outlineColor = "#1d9bf0";
	SearchContainerMobile.style.outlineStyle = "solid";
	SearchContainerMobile.style.outlineWidth = "2px";
	SearchContainerMobile.style.backgroundColor = "black";
	SearchContainerMobile.children[0].style.backgroundColor = "black";
});
SearchBarMobile.addEventListener("blur", (e) => {
	SearchContainerMobile.style.outlineColor = "none";
	SearchContainerMobile.style.outlineStyle = "none";
	SearchContainerMobile.style.outlineWidth = "none";
	SearchContainerMobile.style.backgroundColor = "#1b1e20";
	SearchContainerMobile.children[0].style.backgroundColor = "#1b1e20";
});

const CreateEventMobile = document.getElementById("tag-create-mobile");
CreateEventMobile.addEventListener("click", (e) => {
	location.href =
		"http://localhost/Shahain/Scholastic/index.php/Scholastic/create";
});

const CreateEventMain = document.getElementById("tag-create-main");
CreateEventMain.addEventListener("click", (e) => {
	location.href =
		"http://localhost/Shahain/Scholastic/index.php/Scholastic/create";
});

const BookMarkMain = document.getElementById("bookmark-main");
BookMarkMain.addEventListener("click", function (e) {
	location.href =
		"http://localhost/Shahain/Scholastic/index.php/Scholastic/bookmarks";
});

const BookMarkMobile = document.getElementById("bookmark-mobile");
BookMarkMobile.addEventListener("click", function (e) {
	location.href =
		"http://localhost/Shahain/Scholastic/index.php/Scholastic/bookmarks";
});

const HomeMain = document.getElementById("home-main");
HomeMain.addEventListener("click", function (e) {
	location.href =
		"http://localhost/Shahain/Scholastic/index.php/Scholastic/home";
});

const HomeMobile = document.getElementById("home-mobile");
HomeMobile.addEventListener("click", function (e) {
	location.href =
		"http://localhost/Shahain/Scholastic/index.php/Scholastic/home";
});

const NewMain = document.getElementById("new-num-main-tag");
NewMain.addEventListener("click", function (e) {
	location.href =
		"http://localhost/Shahain/Scholastic/index.php/Scholastic/new_events";
});

const NewMobile = document.getElementById("new-num-mobile-tag");
NewMobile.addEventListener("click", function (e) {
	location.href =
		"http://localhost/Shahain/Scholastic/index.php/Scholastic/new_events";
});

const Tag6Main = document.getElementById("tag6-main");
const Body = document.getElementById("main");
Tag6Main.addEventListener("click", (e) => {
	Body.classList.toggle("activate-mobile-search");
	console.log(Body);
});
const Tag6Mobile = document.getElementById("tag6-mobile");
Tag6Mobile.addEventListener("click", (e) => {
	Body.classList.toggle("activate-mobile-search");
	console.log(Body);
});

const times = document.getElementById("close-search");
times.addEventListener("click", (e) => {
	Body.classList.toggle("activate-mobile-search");
});
