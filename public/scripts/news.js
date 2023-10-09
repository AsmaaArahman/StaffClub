$(document).ready(function() {
	tinymce.init({
		selector: "#editor",
		plugins: 'advlist link  lists',
		toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent | bullist',
		language: "ar",
		theme: "silver"
	});
});
