(function ($) {
	console.log("Admin menu script loaded");
	// Toggle function.
	$('[class*="-ame-styler-header"]').on("click", function () {
		let text = this.className;
		let stem = /\s([^\s]+)-ame-styler-header/.exec(text);

		if (stem && stem[1]) {
			let selector = "li." + stem[1] + "-ame-styler-content";
			console.log("Header clicked:", stem[1], "-> toggling", selector);
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
