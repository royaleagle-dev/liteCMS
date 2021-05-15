//initiallizing the editor
$('#title').focus()
$("#editor").trumbowyg();
$('#editor').trumbowyg({
    autogrow: true
});

function getValues(){
    //get the values of the content and title divs.
    var title = $("#title").text()
    var content = $('#editor').trumbowyg('html');
    //set the values of the hidden forms (title and content) to the values gotten from content and title divs.
    var titleForm = $("#titleInput").val(title);
    var contentForm = $("#contentInput").val(content);
    //for debugging
    console.log(contentForm.val());
    console.log(titleForm.val());
}

setInterval(getValues, 1000);