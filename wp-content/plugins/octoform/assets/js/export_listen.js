 $(function () {
	$("#export").click(function () {
		$("#myTable").table2excel({
			filename: "FormResultaten.xls"
		});
	});
});
