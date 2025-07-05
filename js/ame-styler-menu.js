(function ($) {
	console.log("Admin menu script loaded");
	// Collapse all content toggles on load, except those containing active/current menu items
	// On load, open all content sections in the active group
let activeLi = $("li.wp-menu-open, li.current");
if (activeLi.length) {
	let classList = activeLi.attr("class") || "";
	let match = /([^-\s]+)-ame-styler-content/.exec(classList);
	if (match && match[1]) {
		$("li." + match[1] + "-ame-styler-content").show();
	}
}

	// Toggle function.
	$('[class*="-ame-styler-header"]').on("click", function () {
		let text = this.className;
		let stem = /\s([^\s]+)-ame-styler-header/.exec(text);

		if (stem && stem[1]) {
			let selector = "li." + stem[1] + "-ame-styler-content";
			console.log("Header clicked:", stem[1], "-> toggling", selector);
			// Toggle the clicked group
			let target = $(selector);
			$(target).toggle();
		}
	});

	// "Open" section if item is active.
	let classes1 = $("li.wp-menu-open").attr("class") || "";
	let classes2 = $("li.current").attr("class") || "";

	let classes = classes1 + " " + classes2;

	let classList = classes.split(" ");
	classList = [...new Set(classList)]; // Remove duplicates.

	let len = classList.length;
	for (let i = 0; i < len; i++) {
		if (classList[i].includes("-menu-section-item")) {
			target = $("li." + classList[i]);
			$(target).toggle();
		}
	}
})(jQuery);
