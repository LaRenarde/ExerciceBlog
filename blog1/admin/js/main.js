$(document).ready(function(){
    handleInputFile();
    handleImageFile();
});
function handleInputFile(){
    $("#inputCustomFile").on("change", function (e){
        $(this).next('.custom-file-label').text(e.target.files[0].name);
        let htmlDivImageFile = '<img src="" id="imgFile" alt="" width="150px">';
        htmlDivImageFile += '<input type="button" id="deleteImage" value="Supprimer l\'image">';
        $("#divImageFile").html(htmlDivImageFile);
        var reader = new FileReader();
        let img = document.querySelector("#imgFile");
        let file = $('#inputCustomFile')[0].files[0];
        reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
        reader.readAsDataURL(file);
        handleImageFile();
    });
}
function handleImageFile(){
    $("#deleteImage").on("click", function(e){
        e.preventDefault();
        $divCustomFile = $("#custom-file");
        $("#custom-file").empty();
        $("#imgFile").remove();
        $(this).hide();
        console.log($("#inputUrlImageBdd").val());
        $("#inputUrlImageBdd").val("");
        console.log($("#inputUrlImageBdd").val());
        let htmlCustomFile = '<input type="file" class="custom-file-input" id="inputCustomFile" name="imgFile">';
        htmlCustomFile += '<label class="custom-file-label" for="customFile" id="labelCustomFile"></label>';
        $("#custom-file").html(htmlCustomFile);
        $("#inputCustomFile").on("change", function (e){$(this).next('.custom-file-label').text(e.target.files[0].name);});
        handleInputFile();
    });
}