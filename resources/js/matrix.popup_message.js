function popupMessage(target, type, content) {
	var t = "<div class=\"alert alert-" + type + " alert-block\"> <a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a><h4 class=\"alert-heading\">" + (type=='success' ? "Success" : "Error") + "!</h4>" + content + "</div>";
	$("#" + target).append(t);
}